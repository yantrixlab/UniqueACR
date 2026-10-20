<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->date('preferred_date')->nullable()->after('source_id')->index();
            $table->string('preferred_time', 40)->nullable()->after('preferred_date');
        });
    }

    public function down(): void
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropIndex(['preferred_date']);
            $table->dropColumn(['preferred_date', 'preferred_time']);
        });
    }
};
