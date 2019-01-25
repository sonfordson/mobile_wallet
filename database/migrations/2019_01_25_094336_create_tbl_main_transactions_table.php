<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblMainTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_main_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->integer('request_id');
            $table->string('receipt');
            $table->string('partya');
            $table->string('partyb');
            $table->string('amount');
            $table->string('charge');
            $table->string('status');
            $table->date('date');
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
        Schema::dropIfExists('tbl_main_transactions');
    }
}
