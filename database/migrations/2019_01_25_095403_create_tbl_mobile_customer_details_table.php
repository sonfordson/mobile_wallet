<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblMobileCustomerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_mobile_customer_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('first_name');
            $table->string('second_name');
            $table->date('reg_date');
            $table->string('id_number');
            $table->string('status');
            $table->string('last_activity');
            $table->string('phone_number');
            $table->string('pin');
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
        Schema::dropIfExists('tbl_mobile_customer_details');
    }
}
