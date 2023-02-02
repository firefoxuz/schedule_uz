<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('dows', static function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('A full textual representation of the day of the week');
            $table->unsignedTinyInteger('iso_num')->comment('ISO 8601 numeric representation of the day of the week');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dows');
    }
};
