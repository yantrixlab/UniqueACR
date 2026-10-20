<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('source', 20)->nullable()->after('message');
            $table->date('reviewed_at')->nullable()->after('source');
            $table->string('review_url', 500)->nullable()->after('reviewed_at');
        });
    }

    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['source', 'reviewed_at', 'review_url']);
        });
    }
};
