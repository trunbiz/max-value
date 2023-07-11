<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableWalletUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wallet_users', function (Blueprint $table) {
            $table->string('method_id', 191)->nullable();
            $table->string('network', 191)->nullable();
            $table->string('network_address', 191)->nullable();
            $table->string('beneficiary_name', 191)->nullable();
            $table->string('account_number', 191)->nullable();
            $table->string('bank_name', 191)->nullable();
            $table->string('swift', 191)->nullable();
            $table->string('bank_address', 191)->nullable();
            $table->string('routing_number', 191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wallet_users', function (Blueprint $table) {
            $table->dropColumn('method_id');
            $table->dropColumn('network');
            $table->dropColumn('network_address');
            $table->dropColumn('beneficiary_name');
            $table->dropColumn('account_number');
            $table->dropColumn('bank_name');
            $table->dropColumn('swift');
            $table->dropColumn('bank_address');
            $table->dropColumn('routing_number');
        });
    }
}
