<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblBusinessAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_business_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->integer('account_no');
            $table->string('account_name');
            $table->string('status');
            $table->float('account_balance');
            $table->string('last_activity');
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
        Schema::dropIfExists('tbl_business_accounts');
    }
}
