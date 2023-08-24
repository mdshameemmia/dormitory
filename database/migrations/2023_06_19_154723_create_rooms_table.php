<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('room_number')->nullable();
            $table->integer('number_of_bed')->nullable();
            $table->integer('number_of_booked')->nullable();
            $table->text('description')->nullable();
            $table->enum('status',['Occupied','Vacant','Maintenance'])->nullable();
            
            $table->unsignedBigInteger('dormitory_id');
            $table->unsignedBigInteger('room_type_id');
 
            $table->foreign('dormitory_id')->references('id')->on('dormitories')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('room_type_id')->references('id')->on('room_types')->onUpdate('cascade')
            ->onDelete('cascade');

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
        Schema::dropIfExists('rooms');
    }
}
