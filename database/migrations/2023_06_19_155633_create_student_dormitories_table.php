<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDormitoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_dormitories', function (Blueprint $table) {
            $table->id();
            $table->string('student_name')->nullable();
            $table->boolean('status');

            $table->unsignedBigInteger('dormitory_id');
            $table->unsignedBigInteger('room_id');

            $table->foreign('dormitory_id')->references('id')->on('dormitories')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onUpdate('cascade')
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
        Schema::dropIfExists('student_dormitories');
    }
}
