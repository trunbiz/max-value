<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('web_id')->nullable();
            $table->integer('publisher_id')->nullable();
            $table->integer('zone_id')->nullable();
            $table->date('date')->nullable();
            $table->integer('request')->nullable();
            $table->integer('impressions')->nullable();
            $table->integer('change_impressions')->nullable();
            $table->double('cpm', 15, 3)->nullable();
            $table->double('change_cpm', 15, 3)->nullable();
            $table->double('revenue', 15, 3);
            $table->double('change_revenue', 15, 3);
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->index('web_id');
            $table->index('publisher_id');
            $table->index('zone_id');
            $table->index('date');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report');
    }
}
