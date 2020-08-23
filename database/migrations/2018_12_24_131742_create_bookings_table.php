<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('trainer_id')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('course_type')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('cost')->nullable();
            $table->integer('vat')->nullable();
            $table->integer('fees')->nullable();
            $table->integer('paid')->nullable();
            $table->string('address')->nullable();
            $table->string('venue')->nullable();
            $table->tinyInteger('booked')->nullable();
            $table->tinyInteger('course_audited')->nullable();
            $table->longText('description')->nullable();
            $table->text('notes')->nullable();
            $table->longText('behaviour_issue')->nullable();
            $table->longText('course_issue')->nullable();
            $table->longText('venue_issue')->nullable();
            $table->string('document')->nullable();
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
        Schema::dropIfExists('bookings');
    }

}
