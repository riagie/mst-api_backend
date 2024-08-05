<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesDetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_sales_det', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_id');
            $table->unsignedBigInteger('barang_id');
            $table->decimal('harga_bandrol', 15, 2);
            $table->integer('qty');
            $table->decimal('diskon_pct', 5, 2);
            $table->decimal('diskon_nilai', 15, 2);
            $table->decimal('harga_diskon', 15, 2);
            $table->decimal('total', 15, 2);
            $table->foreign('sales_id')->references('id')->on('t_sales');
            $table->foreign('barang_id')->references('id')->on('m_barang');
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
        Schema::dropIfExists('t_sales_det');
    }
}
