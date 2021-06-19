<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatusToAssetKamarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asset_kamar', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('asset_kamar', function (Blueprint $table) {
            $table->tinyInteger('status')->default('0')->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asset_kamar', function (Blueprint $table) {
            //
        });
    }
}
