<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('schedules', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('subject_id');
            $table->date('from_date')->index();
            $table->date('to_date')->index();
            $table->time('from_time');
            $table->time('to_time');
            $table->timestamps();
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('subject_id')->references('id')->on('subjects');
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
