<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        User::query()
            ->where('name', 'Super Admin')
            ->update(['name' => 'UniqueAircon']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::query()
            ->where('name', 'UniqueAircon')
            ->update(['name' => 'Super Admin']);
    }
};
