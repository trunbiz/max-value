<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsAdvertisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_advertisers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ad_api_id');
            $table->bigInteger('advertiser_api_id');
            $table->bigInteger('ad_unit_id');
            $table->integer('count_percent')->default(80);
            $table->integer('order')->default(0);
            $table->text('ad_code')->nullable();
            $table->text('conditions')->nullable();
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
        Schema::dropIfExists('ads_advertisers');
    }
}
