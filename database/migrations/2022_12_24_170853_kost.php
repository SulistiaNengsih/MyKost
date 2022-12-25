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
        Schema::create('kost', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('id_user');
            $table->string('nama', 100);
            $table->string('alamat', 200);
            $table->double('biaya_sewa_bulanan');
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kost');
    }
};
