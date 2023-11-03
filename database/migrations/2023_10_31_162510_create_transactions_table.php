<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->string('title')->nullable();
            $table->string('status')->nullable();
            $table->text('description')->nullable();
            $table->double('amount')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();

            $table->index('code');
            $table->index('created_by');
            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
