<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssetIdToAssetKamarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asset_kamar', function (Blueprint $table) {
            $table->dropColumn('nama_asset');
            $table->integer('quantity')->default('0')->change();
            $table->foreignId('asset_id')->nullable()->after('kamar_id')->constrained()->onDelete('cascade');
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
