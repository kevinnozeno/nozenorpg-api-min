<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roomables', function (Blueprint $table) {
            $table->foreignId('room_id');
            $table->foreignId('roomable_id');
            $table->string('roomable_type');

            $table->unique(['room_id', 'roomable_id', 'roomable_type']);

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
        Schema::dropIfExists('roomables');
    }
}
