<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('Description');
            $table->string('img');
            $table->integer( 'price')->unsigned();
            $table->float(  'time');

            $table->foreignId('lecturer_id');
            $table->foreignId('category_course_id');

            $table->foreign('lecturer_id')
                ->references('id')
                ->on('lecturers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('category_course_id')
                ->references('id')
                ->on('category_courses')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
