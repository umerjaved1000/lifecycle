<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Venue;
use Session;
use App\Fee;

class VenuesController extends Controller {

    public function index() {
        $get_venues = Venue::all();
        return view('venues.index', array('venues' => $get_venues));
    }

    public function create() {
        $get_fees = Fee::get();
        return view('venues.add_venue', array('get_fees' => $get_fees));
    }

    public function store(Request $request) {

        $this->validate($request, [
            'venue_name' => 'required',
            'venue_email' => 'required',
            'venue_address' => 'required',
            'venue_region' => 'required',
            'venue_post_code' => 'required',
            'venue_landline' => 'required',
            'venue_contact_name' => 'required',
            'venue_contact_email' => 'required',
            'venue_contact_landline' => 'required',
            'venue_contact_mobile' => 'required',
            'venue_fees' => 'required',
            'venue_facilities' => 'required'
        ]);
        try {
            $booking_controller = new BookingsController();
            $location_details = $booking_controller->search_location($request->venue_address . ' ' . $request->venue_region . ' ' . $request->venue_post_code);

            if (!is_array($location_details) || $location_details['latitude'] == 0 || $location_details['longitude'] == 0 && $location_details['is_found'] == 0) {
                Session::flash('heading', 'Error!');
                Session::flash('message', 'Postal Code or Address is invalid');
                Session::flash('icon', 'error');
                return redirect()->back()->withInput();
            }
            $store_venue = new Venue;
            if (!empty($request->venue_name)) {
                $store_venue->name = $request->venue_name;
            }
            if (!empty($request->venue_email)) {
                $store_venue->email = $request->venue_email;
            }
            if (!empty($request->venue_address)) {
                $store_venue->address = $request->venue_address;
            }
            if (!empty($request->venue_region)) {
                $store_venue->region = $request->venue_region;
            }
            if (!empty($request->venue_post_code)) {
                $store_venue->post_code = $request->venue_post_code;
            }
            if (!empty($request->venue_post_code)) {
                $store_venue->landline = $request->venue_landline;
            }
            if (!empty($request->venue_fax)) {
                $store_venue->fax = $request->venue_fax;
            }
            if (!empty($request->venue_website)) {
                $store_venue->website = $request->venue_website;
            }
            if (!empty($request->venue_contact_name)) {
                $store_venue->contact_name = $request->venue_contact_name;
            }
            if (!empty($request->venue_contact_email)) {
                $store_venue->contact_email = $request->venue_contact_email;
            }
            if (!empty($request->venue_contact_landline)) {
                $store_venue->contact_landline = $request->venue_contact_landline;
            }
            if (!empty($request->venue_contact_mobile)) {
                $store_venue->contact_mobile = $request->venue_contact_mobile;
            }
            if (!empty($request->venue_facilities)) {
                $store_venue->facilities = $request->venue_facilities;
            }
            if (!empty($request->venue_fees)) {
                $store_venue->fees = $request->venue_fees;
            }
            if (!empty($request->date_completed)) {
                $store_venue->date_completed = $request->date_completed;
            }

            if (!empty($request->venue_notes)) {
                $store_venue->notes = $request->venue_notes;
            } else {
                $store_venue->notes = NULL;
            }
            $file = \Request::file('venue_copy');
            if ($file) {
                $file_name = time() . $file->getClientOriginalName();
                $file->move(base_path() . '/public/upload/', $file_name);

                $store_venue->copy = $file_name;
            }
            $store_venue->lat = $location_details['latitude'];
            $store_venue->lng = $location_details['longitude'];
            $store_venue->save();
            #email Part
            $email = $request->venue_email;
            $data = $request->venue_name;
            $key = 'venue_registeration';
            $subject = 'Confirm Registeration';
            $send_mail = new MailController();
            $send_mail->sendMail($email, $subject, $key, $data);
            # end email part
            Session::flash('heading', 'Success!');
            Session::flash('message', 'Venue added successfully');
            Session::flash('icon', 'success');
            return redirect('venues');
        } catch (\Exception $e) {
            Session::flash('heading', 'Error!');
            Session::flash('message', $e->getMessage());
            Session::flash('icon', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function delete(Request $request) {
        $venue_id = Venue::find($request->id);
        $venue_id->delete();
        Session::flash('heading', 'Success!');
        Session::flash('message', 'Venue deleted successfully');
        Session::flash('icon', 'success');
        return redirect('venues');
    }

    public function venueDetails(Request $request) {
        $venue_id = Venue::find($request->id);
        return Response::json($venue_id);
    }

    public function update(Request $request) {
        $venue = Venue::find($request->id);
        $get_fees = Fee::get();
        return view('venues.edit_venue', array('venue' => $venue, 'get_fees' => $get_fees));
    }

    public function edit(Request $request) {

        $this->validate($request, [
            'venue_name' => 'required',
            'venue_email' => 'required',
            'venue_address' => 'required',
            'venue_region' => 'required',
            'venue_post_code' => 'required',
            'venue_landline' => 'required',
            'venue_contact_name' => 'required',
            'venue_contact_email' => 'required',
            'venue_contact_landline' => 'required',
            'venue_contact_mobile' => 'required',
            'venue_fees' => 'required',
            'venue_facilities' => 'required'
        ]);
        try {
            $update_venue = Venue::find($request->venue_id);
            if (!$update_venue) {
                Session::flash('heading', 'Error!');
                Session::flash('message', 'Uhh!.. don\'t cheat us.');
                Session::flash('icon', 'error');
            }
            $booking_controller = new BookingsController();
            $location_details = $booking_controller->search_location($request->venue_address . ' ' . $request->venue_region . ' ' . $request->venue_post_code);

            if (!is_array($location_details) || $location_details['latitude'] == 0 || $location_details['longitude'] == 0 && $location_details['is_found'] == 0) {
                Session::flash('heading', 'Error!');
                Session::flash('message', 'Postal Code or Address is invalid');
                Session::flash('icon', 'error');
                return redirect()->back()->withInput();
            }
            if (!empty($request->venue_name)) {
                $update_venue->name = $request->venue_name;
            }
            if (!empty($request->venue_email)) {
                $update_venue->email = $request->venue_email;
            }
            if (!empty($request->venue_address)) {
                $update_venue->address = $request->venue_address;
            }
            if (!empty($request->venue_region)) {
                $update_venue->region = $request->venue_region;
            }
            if (!empty($request->venue_post_code)) {
                $update_venue->post_code = $request->venue_post_code;
            }
            if (!empty($request->venue_landline)) {
                $update_venue->landline = $request->venue_landline;
            }
            if (!empty($request->venue_fax)) {
                $update_venue->fax = $request->venue_fax;
            }
            if (!empty($request->venue_website)) {
                $update_venue->website = $request->venue_website;
            }
            if (!empty($request->venue_contact_name)) {
                $update_venue->contact_name = $request->venue_contact_name;
            }
            if (!empty($request->venue_contact_email)) {
                $update_venue->contact_email = $request->venue_contact_email;
            }
            if (!empty($request->venue_contact_landline)) {
                $update_venue->contact_landline = $request->venue_contact_landline;
            }
            if (!empty($request->venue_contact_mobile)) {
                $update_venue->contact_mobile = $request->venue_contact_mobile;
            }
            if (!empty($request->venue_facilities)) {
                $update_venue->facilities = $request->venue_facilities;
            } else {
                $update_venue->facilities = NULL;
            }
            if (!empty($request->venue_fees)) {
                $update_venue->fees = $request->venue_fees;
            }
            if (!empty($request->date_completed)) {
                $update_venue->date_completed = $request->date_completed;
            }
            $file = \Request::file('venue_copy');
            if ($file) {
                $file_name = time() . $file->getClientOriginalName();
                $file->move(base_path() . '/public/upload/', $file_name);

                $update_venue->copy = $file_name;
            }
            if (!empty($request->venue_notes)) {
                $update_venue->notes = $request->venue_notes;
            } else {
                $update_venue->notes = NULL;
            }
            $update_venue->lat = $location_details['latitude'];
            $update_venue->lng = $location_details['longitude'];
            $update_venue->save();
            Session::flash('heading', 'Success!');
            Session::flash('message', 'Venue updated successfully');
            Session::flash('icon', 'success');
            return redirect('venues');
        } catch (\Exception $e) {
            Session::flash('heading', 'Error!');
            Session::flash('message', $e->getMessage());
            Session::flash('icon', 'error');
            return redirect()->back()->withInput();
        }
    }

}
