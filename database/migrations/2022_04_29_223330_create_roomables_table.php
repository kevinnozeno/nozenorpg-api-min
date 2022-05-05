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
            $table->id();
            $table->foreignId('room_id');
            $table->morphs('roomable');
            $table->json('statistics')->nullable();
            $table->boolean('is_active')->default(false);

            $table->timestamps();

            $table->unique(['room_id', 'roomable_id', 'roomable_type']);
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
