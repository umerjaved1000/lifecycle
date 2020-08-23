<?php

use Illuminate\Database\Seeder;
use App\EmailTemplate;

class mailSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $customer_confirm_booking = EmailTemplate::where('key', 'customer_confirm_booking')->first();
        if (!$customer_confirm_booking) {
            $customer_confirm_booking = new EmailTemplate();
        }
        $customer_confirm_booking->key = 'customer_confirm_booking';
        $customer_confirm_booking->name = 'Customer Confirm Booking';
        $customer_confirm_booking->type = 'customer';
        $customer_confirm_booking->save();

        $customer_cancel_booking = EmailTemplate::where('key', 'customer_cancel_booking')->first();
        if (!$customer_cancel_booking) {
            $customer_cancel_booking = new EmailTemplate();
        }
        $customer_cancel_booking->key = 'customer_cancel_booking';
        $customer_cancel_booking->name = 'Customer Cancel Booking';
        $customer_cancel_booking->type = 'customer';
        $customer_cancel_booking->save();

        $customer_complete_booking = EmailTemplate::where('key', 'customer_complete_booking')->first();
        if (!$customer_complete_booking) {
            $customer_complete_booking = new EmailTemplate();
        }
        $customer_complete_booking->key = 'customer_complete_booking';
        $customer_complete_booking->name = 'Customer Complete Booking';
        $customer_complete_booking->type = 'customer';
        $customer_complete_booking->save();

        $customer_registration = EmailTemplate::where('key', 'customer_registration')->first();
        if (!$customer_registration) {
            $customer_registration = new EmailTemplate();
        }
        $customer_registration->key = 'customer_registration';
        $customer_registration->name = 'Customer Registration';
        $customer_registration->type = 'customer';
        $customer_registration->save();

        $trainer_registration = EmailTemplate::where('key', 'trainer_registration')->first();
        if (!$trainer_registration) {
            $trainer_registration = new EmailTemplate();
        }
        $trainer_registration->key = 'trainer_registration';
        $trainer_registration->name = 'Trainer Registration';
        $trainer_registration->type = 'trainer';
        $trainer_registration->save();

        $trainer_request_booking = EmailTemplate::where('key', 'trainer_request_booking')->first();
        if (!$trainer_request_booking) {
            $trainer_request_booking = new EmailTemplate();
        }
        $trainer_request_booking->key = 'trainer_request_booking';
        $trainer_request_booking->name = 'Trainer Request Booking';
        $trainer_request_booking->type = 'trainer';
        $trainer_request_booking->save();

        $trainer_complete_booking = EmailTemplate::where('key', 'trainer_complete_booking')->first();
        if (!$trainer_complete_booking) {
            $trainer_complete_booking = new EmailTemplate();
        }
        $trainer_complete_booking->key = 'trainer_complete_booking';
        $trainer_complete_booking->name = 'Trainer Complete Booking';
        $trainer_complete_booking->type = 'trainer';
        $trainer_complete_booking->save();

        $trainer_cancel_booking = EmailTemplate::where('key', 'trainer_cancel_booking')->first();
        if (!$trainer_cancel_booking) {
            $trainer_cancel_booking = new EmailTemplate();
        }
        $trainer_cancel_booking->key = 'trainer_cancel_booking';
        $trainer_cancel_booking->name = 'Trainer Cancel Booking';
        $trainer_cancel_booking->type = 'trainer';
        $trainer_cancel_booking->save();

        $trainer_new_course_registeration = EmailTemplate::where('key', 'trainer_new_course_registeration')->first();
        if (!$trainer_new_course_registeration) {
            $trainer_new_course_registeration = new EmailTemplate();
        }
        $trainer_new_course_registeration->key = 'trainer_new_course_registeration';
        $trainer_new_course_registeration->name = 'Trainer New Course Registration';
        $trainer_new_course_registeration->type = 'trainer';
        $trainer_new_course_registeration->save();

        $venue_booking = EmailTemplate::where('key', 'venue_booking')->first();
        if (!$venue_booking) {
            $venue_booking = new EmailTemplate();
        }
        $venue_booking->key = 'venue_booking';
        $venue_booking->name = 'Venue Booking';
        $venue_booking->type = 'venue';
        $venue_booking->save();
        
        $venue_registerationg = EmailTemplate::where('key', 'venue_registeration')->first();
        if (!$venue_registerationg) {
            $venue_registerationg = new EmailTemplate();
        }
        $venue_registerationg->key = 'venue_registeration';
        $venue_registerationg->name = 'Venue Registeration';
        $venue_registerationg->type = 'venue';
        $venue_registerationg->save();

        $venue_cancelation = EmailTemplate::where('key', 'venue_cancelation')->first();
        if (!$venue_cancelation) {
            $venue_cancelation = new EmailTemplate();
        }
        $venue_cancelation->key = 'venue_cancelation';
        $venue_cancelation->name = 'Venue Cancelation';
        $venue_cancelation->type = 'venue';
        $venue_cancelation->save();
    }

}
