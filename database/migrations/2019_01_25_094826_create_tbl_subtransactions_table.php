<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblSubtransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_subtransactions', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->integer('request_id');
            $table->string('receipt');
            $table->string('phone');
            $table->string('amount');
            $table->string('amount_type');
            $table->string('transaction_type');
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
        Schema::dropIfExists('tbl_subtransactions');
    }
}
