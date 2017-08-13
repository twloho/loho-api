<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status');
            $table->string('serial_number');

            $table->string('last_name');
            $table->string('first_name');
            $table->tinyInteger('gender');
            $table->string('identification')->unique();
            $table->dateTimeTz('birthday');

            $table->string('email')->unique();
            $table->string('home_phone_number');
            $table->string('cell_phone_number')->unique();

            $table->string('postcode');
            $table->string('city');
            $table->string('zone');
            $table->string('address');

            $table->string('contact_last_name');
            $table->string('contact_first_name');
            $table->string('contact_cell_phone_number');

            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('members');
    }
}
