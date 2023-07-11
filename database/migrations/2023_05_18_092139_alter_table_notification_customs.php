<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableNotificationCustoms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notification_customs', function (Blueprint $table) {
            $table->text('link')->nullable();
            $table->tinyInteger('viewed')->default(1);
            $table->string('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notification_customs', function (Blueprint $table) {
            $table->dropColumn('link');
            $table->dropColumn('viewed');
            $table->dropColumn('type');
        });
    }
}
