<?php

use Illuminate\Database\Seeder;
use App\Fee;

class feeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $fees_weekday_values = Fee::where('fees_type', 'weekday')->first();
        if (!$fees_weekday_values) {
            $fees_weekday_values = new Fee();
        }
        $fees_weekday_values->fees_type = 'weekday';
        $fees_weekday_values->fees = '80';
        $fees_weekday_values->save();

        $fees_evening_values = Fee::where('fees_type', 'evening')->first();
        if (!$fees_evening_values) {
            $fees_evening_values = new Fee();
        }
        $fees_evening_values->fees_type = 'evening';
        $fees_evening_values->fees = '120';
        $fees_evening_values->save();

        $fees_weekend_values = Fee::where('fees_type', 'weekend')->first();
        if (!$fees_weekend_values) {
            $fees_weekend_values = new Fee();
        }
        $fees_weekend_values->fees_type = 'weekend';
        $fees_weekend_values->fees = '150';
        $fees_weekend_values->save();
    }

}
