<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('ads_campaign', function (Blueprint $table) {
////            $table->id();
////            $table->integer('ad_ad_id')->nullable();
////            $table->integer('campaign_id')->nullable();
////            $table->integer('zone_id')->nullable();
////            $table->integer('is_active')->nullable();
////            $table->json('extra_request')->nullable();
////            $table->json('extra_response')->nullable();
////            $table->integer('is_delete')->default(0);
////            $table->timestamps();
////            $table->index('ad_ad_id');
////            $table->index('campaign_id');
////            $table->index('zone_id');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads_campaign');
    }
}
