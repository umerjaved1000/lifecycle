<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmailTemplate;
use Mail;
use App\Mail\sendMail;

// use Illuminate\Support\Facades\Mail;

class MailController extends Controller {

    public function test_mail() {
        try {
            $mail = 'umer.gracetech@gmail.com';
            Mail::to($mail)->send(new \App\Mail\sendMail('Done Welcome now', 'Confirm', NULL));
        } catch (\Exception $ex) {
            return;
//     dd($ex->getMessage());
        }
    }

    public function sendMail($email, $subject, $key, $data = NULL, $cc = NULL, $attachment = NULL) {
        try {
            $content = EmailTemplate::where('key', $key)->first();
            if (!$content) {
                return;
            }
            $body = $content->content;
            $trainer_name = '';
            $course_name = '';
            $customer_name = '';
            $venue_name = '';
            if (is_array($data)) {
                if (array_key_exists('trainer', $data)) {
                    $trainer_name = $data['trainer'];
                }
                if (array_key_exists('course', $data)) {
                    $course_name = $data['course'];
                }
                if (array_key_exists('venue', $data)) {
                    $venue_name = $data['venue'];
                }
                if (array_key_exists('customer', $data)) {
                    $customer_name = $data['customer'];
                }
            }
            $body = str_replace('{{$trainer_name}}', $trainer_name, $body);
            $body = str_replace('{{$course_name}}', $course_name, $body);
            $body = str_replace('{{$venue_name}}', $venue_name, $body);
            $body = str_replace('{{$customer_name}}', $customer_name, $body);

            if ($cc != NULL) {
                Mail::to($email)
                        ->cc($cc)
                        ->send(new sendMail($body, $subject, $attachment));
                return;
            }

            Mail::to($email)->send(new \App\Mail\sendMail($body, $subject, $attachment));
            return;
        } catch (\Exception $ex) {
            return;
        }
    }

}
