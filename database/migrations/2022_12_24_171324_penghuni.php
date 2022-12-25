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
        Schema::create('penghuni', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('id_kost');
            $table->string('nama', 100);
            $table->string('no_telepon', 15);
            $table->string('status', 15);
            $table->string('no_kamar', 5);
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penghuni');
    }
};
