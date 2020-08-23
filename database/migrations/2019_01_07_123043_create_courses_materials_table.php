<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesMaterialsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('courses_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('document_name')->nullable();
            $table->string('document_link')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('booking_id')->nullable();
            $table->integer('trainer_id')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('added_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('courses_materials');
    }

}
