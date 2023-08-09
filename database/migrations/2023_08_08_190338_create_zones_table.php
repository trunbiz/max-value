<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->integer('ad_site_id')->nullable();
            $table->integer('ad_zone_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('id_zone_format')->nullable();
            $table->integer('id_dimension_method')->nullable();
            $table->json('dimensions')->nullable();
            $table->integer('status')->nullable();
            $table->json('extra_params')->nullable()->comment('Save config params request');
            $table->json('extra_response')->nullable()->comment('Save config params response');
            $table->integer('is_delete')->default(0);
            $table->timestamps();
            $table->index('ad_site_id');
            $table->index('ad_zone_id');
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zones');
    }
}
