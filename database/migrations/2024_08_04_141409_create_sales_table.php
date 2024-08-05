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
        Schema::create('t_sales', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 15);
            $table->dateTime('tgl');
            $table->unsignedBigInteger('cust_id');
            $table->decimal('subtotal', 15, 2);
            $table->decimal('diskon', 15, 2);
            $table->decimal('ongkir', 15, 2);
            $table->decimal('total_bayar', 15, 2);
            $table->foreign('cust_id')->references('id')->on('m_customer');
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
        Schema::dropIfExists('t_sales');
    }
}
