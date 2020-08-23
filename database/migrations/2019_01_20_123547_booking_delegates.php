<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookingDelegates extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('bookings', function (Blueprint $table) {
            $table->tinyInteger('delegates_information')->nullable();
            $table->tinyInteger('client_issues_closed')->nullable();
            $table->tinyInteger('certificates_emailed')->nullable();
            $table->tinyInteger('invoice_paid')->nullable();
            $table->tinyInteger('kpis_updated')->nullable();
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
