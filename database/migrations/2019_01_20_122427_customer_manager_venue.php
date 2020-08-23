<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerManagerVenue extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('account_manager_name')->nullable();
            $table->string('manager_contact_number')->nullable();
            $table->string('manager_email')->nullable();
            $table->string('contact_method')->nullable();
            $table->string('client_type')->nullable();
            $table->longText('notes')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_position')->nullable();
            $table->string('direct_number')->nullable();
            $table->string('direct_email')->nullable();
            $table->string('contact_mobile')->nullable();
            $table->integer('venue_id')->nullable();
            $table->string('venue_contact_address')->nullable();
            $table->string('venue_contact_name')->nullable();
            $table->string('venue_contact_number')->nullable();
            $table->string('venue_contact_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
