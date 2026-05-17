<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('discount_price', 10, 2)->nullable()->after('price');
            $table->json('specifications')->nullable()->after('description');
            $table->boolean('is_featured')->default(false)->index()->after('images');
            $table->string('meta_title')->nullable()->after('is_featured');
            $table->string('meta_description', 320)->nullable()->after('meta_title');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['discount_price', 'specifications', 'is_featured', 'meta_title', 'meta_description']);
        });
    }
};
