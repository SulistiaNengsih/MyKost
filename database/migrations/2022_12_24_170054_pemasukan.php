<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemasukan', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->bigInteger('id_kategori_pemasukan');
            $table->string('ket_pemasukan', 50);
            $table->date('tanggal');
            $table->double('nominal');
            $table->varchar('foto', 200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemasukan');
    }
};
