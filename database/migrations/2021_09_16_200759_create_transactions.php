<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('id_transactions');
            $table->integer('amount');
            $table->foreignId('id_account_from')->nullable()->index();
            $table->foreignId('id_account_up')->nullable()->index();
            $table->timestamps();
        });

        Schema::table('transactions', function($table) {
            $table->foreign('id_account_up')->references('id_account')->on('accounts');
        });
        
        Schema::table('transactions', function($table) {
            $table->foreign('id_account_from')->references('id_account')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
        });
    }
}
