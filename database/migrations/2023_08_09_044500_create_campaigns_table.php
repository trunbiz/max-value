<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->integer('ad_campaign_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('id_advertiser')->nullable();
            $table->integer('id_run_status')->nullable();
            $table->json('extra_request')->nullable();
            $table->json('extra_response')->nullable();
            $table->integer('is_delete')->default(0);
            $table->timestamps();
            $table->index('ad_campaign_id');
            $table->index('id_advertiser');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
