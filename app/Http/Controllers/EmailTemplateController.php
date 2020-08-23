<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmailTemplate;
use Session;

class EmailTemplateController extends Controller {

    public function trainer_emails() {
        $trainer_emails = EmailTemplate::where('type', 'trainer')->get();
        return view('email.trainers_email', array('trainer_emails' => $trainer_emails));
    }

    public function customers_email() {
        $customers_email = EmailTemplate::where('type', 'customer')->get();
        return view('email.customers_email', array('customers_email' => $customers_email));
    }

    public function venues_email() {
        $venues_email = EmailTemplate::where('type', 'venue')->get();
        return view('email.venues_email', array('venues_email' => $venues_email));
    }

    public function send_mail(Request $request) {
        $details = EmailTemplate::find($request->id);
//    dd($details);
        return view('email.send_mail', array('details' => $details));
    }

    public function submit_mail(Request $request) {
        $update_template = EmailTemplate::find($request->template_id);
        try {
            $update_template->content = $request->message;
            $update_template->save();
            Session::flash('heading', 'Success!');
            Session::flash('message', 'Template Updates Successfully..');
            Session::flash('icon', 'success');
            if ($request->email_type === 'trainer') {
                return redirect('/trainers_email');
            } else if ($request->email_type === 'customer') {
                return redirect('/customers_email');
            } else if ($request->email_type === 'venue') {
                return redirect('/venues_email');
            } else {
                return back();
            }
        } catch (\Exception $e) {
            Session::flash('heading', 'Error!');
            Session::flash('message', $e->getMessage());
            Session::flash('icon', 'error');
            return redirect()->back()->withInput();
        }
    }

//
}
