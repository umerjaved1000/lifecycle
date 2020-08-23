<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('trainers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('region')->nullable();
            $table->string('post_code')->nullable();
            $table->string('home_contact')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->integer('fees')->default(0);
            $table->longText('notes')->nullable();
            $table->date('ceased_date')->nullable();
            $table->date('induction_training')->nullable();
            $table->date('last_cpd_training')->nullable();
            $table->integer('login_id')->nullable();
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
        Schema::dropIfExists('trainers');
    }

}
