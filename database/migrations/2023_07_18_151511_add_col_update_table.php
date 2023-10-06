<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColUpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('report', function (Blueprint $table) {
//            //
////            $table->integer('ad_impressions')->after('impressions')->nullable()->comment('impressions lấy từ adServer');
////            $table->double('ad_cpm', 15, 3)->after('cpm')->nullable()->comment('cpm lấy từ adServer');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('report', function (Blueprint $table) {
            //
        });
    }
}
