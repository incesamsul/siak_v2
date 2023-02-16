<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServisanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servisan', function (Blueprint $table) {
            $table->increments('id_servisan');
            $table->date('tgl_masuk');
            $table->date('tgl_keluar')->nullable();
            $table->unsignedInteger('id_customer');
            $table->unsignedInteger('id_brand');
            $table->unsignedInteger('id_model');
            $table->string('warna');
            $table->string('masalah');
            $table->string('catatan');
            $table->timestamps();
            $table->foreign('id_customer')->references('id_customer')->on('customer')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_brand')->references('id_brand')->on('brand')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_model')->references('id_model')->on('model')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servisan');
    }
}
