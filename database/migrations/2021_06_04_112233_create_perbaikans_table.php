<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerbaikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbaikan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('keluhan_id');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('status_perbaikan')->nullable();
            $table->date('tanggal_perbaikan')->nullable();
            $table->timestamps();
            $table->foreign('keluhan_id')->references('id')->on('keluhan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perbaikan');
    }
}
