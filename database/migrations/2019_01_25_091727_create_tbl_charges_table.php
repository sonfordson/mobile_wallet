<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_charges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('min');
            $table->string('max');
            $table->string('withdraw_charges');
            $table->string('unregistered_user');
            $table->string('registered_user');
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
        Schema::dropIfExists('tbl_charges');
    }
}
