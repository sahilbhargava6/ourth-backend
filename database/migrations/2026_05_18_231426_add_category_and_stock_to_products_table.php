<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Make vendor_id nullable so admin can upload platform products
            $table->foreignId('vendor_id')->nullable()->change();

            // Proper category FK alongside legacy string column
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete()->after('vendor_id');

            // Stock and unit on the product itself (simpler than always joining inventory)
            $table->unsignedInteger('stock_quantity')->default(0)->after('is_featured');
            $table->string('unit', 30)->default('piece')->after('stock_quantity');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'stock_quantity', 'unit']);
            $table->foreignId('vendor_id')->nullable(false)->change();
        });
    }
};
