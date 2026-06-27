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
        Schema::create('sales', function (Blueprint $table) {

            $table->id();

            $table->string('g_number');

            $table->date('date');
            $table->date('last_change_date');

            $table->string('supplier_article');
            $table->string('tech_size')->nullable();

            $table->string('barcode', 50);

            $table->decimal('total_price', 12, 2);

            $table->unsignedTinyInteger('discount_percent');

            $table->boolean('is_supply');
            $table->boolean('is_realization');

            $table->decimal('promo_code_discount', 12, 2)->nullable();

            $table->string('warehouse_name');
            $table->string('country_name');

            $table->string('oblast_okrug_name')->nullable();
            $table->string('region_name')->nullable();

            $table->BigInteger('income_id');

            $table->string('sale_id')->nullable();
            $table->string('odid')->nullable();

            $table->unsignedTinyInteger('spp');

            $table->decimal('for_pay', 12, 2);
            $table->decimal('finished_price', 12, 2);
            $table->decimal('price_with_disc', 12, 2);

            $table->BigInteger('nm_id');

            $table->string('subject');
            $table->string('category');
            $table->string('brand');

            $table->boolean('is_storno')->nullable();

            // время импорта записи
            $table->timestamp('imported_at')->nullable();

            $table->timestamps();

            $table->index('date');
            $table->index('last_change_date');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
