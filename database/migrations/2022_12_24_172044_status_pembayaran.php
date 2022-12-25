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
        Schema::create('status_pembayaran', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInt('id_penghuni');
            $table->bigInt('id_tahun');
            $table->bigInt('id_bulan');
            $table->date('tanggal_bayar');
            $table->varchar('foto_bukti_bayar', 200);
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_pembayaran');
    }
};
