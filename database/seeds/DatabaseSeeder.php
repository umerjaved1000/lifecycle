<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

        $this->call(AdminSeeder::class);
        $this->call(mailSeeder::class);
        $this->call(feeSeeder::class);
    }

}
