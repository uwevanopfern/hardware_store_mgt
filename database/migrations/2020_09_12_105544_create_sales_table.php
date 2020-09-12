<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->integer('product_id');
            $table->integer('client_id')->nullable();
            $table->string('quantity_sold');
            $table->decimal('unit_price', 9, 3);
            $table->string('discount')->default('0')->nullable();
            $table->string('tax_rate');
            $table->decimal('tax_amount', 9, 3);
            $table->decimal('sub_total', 9, 3);
            $table->decimal('total_amount', 9, 3);
            $table->string('receipt_signature', 30)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
