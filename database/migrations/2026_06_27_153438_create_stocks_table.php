<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {

            $table->id();

            $table->date('date');
            $table->date('last_change_date');

            $table->string('supplier_article');
            $table->string('tech_size')->nullable();

            $table->string('barcode', 50);

            $table->unsignedInteger('quantity');

            $table->boolean('is_supply');
            $table->boolean('is_realization');

            $table->unsignedInteger('quantity_full');

            $table->string('warehouse_name');

            $table->unsignedInteger('in_way_to_client');
            $table->unsignedInteger('in_way_from_client');

            $table->BigInteger('nm_id');

            $table->string('subject');
            $table->string('category');
            $table->string('brand');

            $table->BigInteger('sc_code');

            $table->decimal('price', 12, 2);
            $table->unsignedTinyInteger('discount');

            // время импорта записи
            $table->timestamp('imported_at')->nullable();

            $table->timestamps();

            // Индексы
            $table->index('date');
            $table->index('last_change_date');
            $table->index('barcode');
            $table->index('warehouse_name');

        });
    }
    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
