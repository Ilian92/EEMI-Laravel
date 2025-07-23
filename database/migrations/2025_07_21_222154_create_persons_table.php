<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('face_photo'); // chemin vers la photo de visage
            $table->string('feet_photo'); // chemin vers la photo de pieds
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('persons');
    }
};