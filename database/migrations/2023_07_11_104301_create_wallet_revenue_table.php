<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletRevenueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('wallet_revenue', function (Blueprint $table) {
////            $table->id();
////            $table->integer('user_id')->nullable();
////            $table->date('date')->nullable();
////            $table->string('revenue')->nullable();
////            $table->index('user_id');
////            $table->index('date');
////            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_revenue');
    }
}
