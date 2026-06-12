<?php

namespace App\Console\Commands;

use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class MediaRestore extends Command
{
    protected $signature = 'media:restore
                            {zip : Absolute path to the backup ZIP file}
                            {--force : Re-create DB records even if a record already exists for that path}
                            {--dry-run : Show what would be restored without writing anything}';

    protected $description = 'Restore media files and DB records from a backup ZIP file';

    private const ALLOWED = ['jpg','jpeg','png','gif','webp','svg','pdf','docx','xlsx','csv','mp4','mp3'];

    public function handle(MediaService $mediaService): int
    {
        @ini_set('memory_limit', '512M');

        $zipPath = $this->argument('zip');
        $force   = $this->option('force');
        $dryRun  = $this->option('dry-run');

        if (! file_exists($zipPath)) {
            $this->error("ZIP file not found: {$zipPath}");
            return self::FAILURE;
        }

        $zip = new ZipArchive();
        if ($zip->open($zipPath) !== true) {
            $this->error('Could not open ZIP file. It may be corrupt.');
            return self::FAILURE;
        }

        $this->info("Opening: {$zipPath}");
        $this->info("Entries in ZIP: {$zip->numFiles}");
        $dryRun && $this->warn('[DRY RUN] No files will be written.');
        $this->newLine();

        $imported = 0;
        $relinked = 0;
        $skipped  = 0;
        $errors   = 0;

        $bar = $this->output->createProgressBar($zip->numFiles);
        $bar->start();

        for ($i = 0; $i < $zip->numFiles; $i++) {
            $bar->advance();

            $name = $zip->getNameIndex($i);

            // Skip directory entries and hidden files
            if (str_ends_with($name, '/') || str_starts_with(basename($name), '.')) {
                continue;
            }

            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            if (! in_array($ext, self::ALLOWED)) {
                $skipped++;
                continue;
            }

            // Sanitise path — strip ".." segments, preserve subdirectories
            $parts  = array_filter(explode('/', $name), fn ($s) => $s !== '' && $s !== '..');
            $target = implode('/', $parts); // e.g. "media/products/image.jpg"

            if (! str_starts_with($target, 'media/')) {
                $skipped++;
                continue;
            }

            // Optionally skip if DB record already exists
            $exists = Media::query()->where('path', $target)->exists();
            if ($exists && ! $force) {
                $skipped++;
                continue;
            }

            if ($dryRun) {
                $this->newLine();
                $this->line("  WOULD restore: {$target}");
                $imported++;
                continue;
            }

            // Ensure the subdirectory exists on disk
            $absDir = Storage::disk('public')->path(dirname($target));
            if (! is_dir($absDir)) {
                mkdir($absDir, 0775, true);
            }

            // Write file to disk if missing (or force)
            $diskMissing = ! Storage::disk('public')->exists($target);
            if ($diskMissing || $force) {
                $contents = $zip->getFromIndex($i);
                if ($contents === false) {
                    $this->newLine();
                    $this->warn("  SKIP (unreadable in ZIP): {$name}");
                    $errors++;
                    continue;
                }
                Storage::disk('public')->put($target, $contents);
                $imported++;
            } else {
                $relinked++;
            }

            // Create or update DB record
            if ($exists && $force) {
                Media::query()->where('path', $target)->delete();
            }

            try {
                $mediaService->createFromPath($target);
            } catch (\Throwable $e) {
                $this->newLine();
                $this->warn("  DB error for {$target}: {$e->getMessage()}");
                $errors++;
            }
        }

        $bar->finish();
        $zip->close();

        $this->newLine(2);
        $this->info('─────────────────────────────────');
        $this->info("  Files written to disk : {$imported}");
        $this->info("  DB records re-linked   : {$relinked}");
        $this->info("  Skipped (exist/invalid): {$skipped}");
        $errors && $this->warn("  Errors                 : {$errors}");
        $this->info('─────────────────────────────────');

        return self::SUCCESS;
    }
}
