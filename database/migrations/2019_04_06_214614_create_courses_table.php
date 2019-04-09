<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedInteger('level_id');
            $table->foreign('level_id')->references('id')->on('levels');
            $table->string('name');
            $table->text('description');
            $table->string('slug'); // URL amigable
            $table->string('picture')->nullable();
            $table->enum('status', [
                \App\Course::PUBLISHED,
                \App\Course::PENDING,
                \App\Course::REJECTED,

            ])->default(\App\Course::PENDING); // permite definir un nombre y varias opciones. con el modelo Course se toma una de las 3 opciones y por default cuando se cree un curso va a tener como estado PENDING

            $table->boolean('previous_approved')->default(false); 
            $table->boolean('previous_rejected')->default(false); 

            $table->timestamps();
            $table->softDeletes(); // saber si el curso esta eliminado o no
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
