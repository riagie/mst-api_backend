<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiskonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_diskon', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_id');
            $table->decimal('diskon_pct', 5, 2);
            $table->decimal('diskon_nilai', 15, 2);
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
        Schema::dropIfExists('t_diskon');
    }
}
