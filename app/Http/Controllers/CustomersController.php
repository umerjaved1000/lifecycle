<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Response;
use App\Customer;
use App\Venue;

class CustomersController extends Controller {

    public function index() {
        $get_customers = Customer::all();
        return view('customers.index', array('customers' => $get_customers));
    }

    public function create() {
        //  $get_courses = Course::all();, array('courses' => $get_courses)
        $venues = Venue::get();
        return view('customers.add_customer', array('venues' => $venues));
    }

    public function store(Request $request) {

        $this->validate($request, [
            'customer_name' => 'required',
            'customer_email' => 'required',
            'customer_post_code' => 'required',
            'customer_landline' => 'required',
            'customer_mobile' => 'required',
            'customer_status' => 'required',
            'client_type' => 'required',
            'contact_method' => 'required',
        ]);
        try {
            $booking_controller = new BookingsController();
            $location_details = $booking_controller->search_location($request->customer_post_code);
            if (is_array($location_details) && $location_details['latitude'] != 0 && $location_details['longitude'] != 0 && $location_details['is_found'] == 1) {
                $store_customer = new Customer;
                $store_customer->name = $request->customer_name;
                $store_customer->email = $request->customer_email;
                $store_customer->post_code = $request->customer_post_code;
                $store_customer->landline = $request->customer_landline;
                $store_customer->mobile = $request->customer_mobile;
                $store_customer->fax = $request->customer_fax;
                $store_customer->website = $request->customer_website;
                $store_customer->status = $request->customer_status;
                $store_customer->discount_rate = $request->customer_discount;
                $store_customer->work_package_number = $request->customer_work_package;
                $store_customer->marketing_opt = $request->customer_marketing_opt;
                $store_customer->contact_name = $request->contact_name;
                $store_customer->contact_position = $request->contact_position;
                $store_customer->direct_number = $request->direct_number;
                $store_customer->direct_email = $request->direct_email;
                $store_customer->contact_mobile = $request->contact_mobile;
                $store_customer->account_manager_name = $request->account_manager_name;
                $store_customer->manager_contact_number = $request->manager_contact_number;
                $store_customer->manager_email = $request->manager_email;
                $store_customer->contact_method = $request->contact_method;
                $store_customer->client_type = $request->client_type;
                $store_customer->venue_id = $request->venue_id;
                $store_customer->venue_contact_name = $request->venue_contact_name;
                $store_customer->venue_contact_email = $request->venue_contact_email;
                $store_customer->venue_contact_number = $request->venue_contact_number;
                $store_customer->venue_contact_address = $request->venue_contact_address;
                $store_customer->lat = $location_details['latitude'];
                $store_customer->lng = $location_details['longitude'];

                $store_customer->save();
                #email Part
                $email = $request->customer_email;
                $data = array();
                $data['customer'] = $request->customer_name;
                $key = 'customer_registration';
                $subject = 'Confirm Registeration';
                $send_mail = new MailController();
                $send_mail->sendMail($email, $subject, $key, $data);
                # end email part
                Session::flash('heading', 'Success!');
                Session::flash('message', 'Customer added successfully');
                Session::flash('icon', 'success');
                return redirect('customers');
            }
            Session::flash('heading', 'Error!');
            Session::flash('message', 'Postal Code is invalid');
            Session::flash('icon', 'error');
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            Session::flash('heading', 'Error!');
            Session::flash('message', $e->getMessage());
            Session::flash('icon', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function delete(Request $request) {
        $customer_id = Customer::find($request->id);
        $customer_id->delete();
        Session::flash('heading', 'Success!');
        Session::flash('message', 'Customer deleted successfully');
        Session::flash('icon', 'success');
        return redirect('customers');
    }

    public function update(Request $request) {
        $customer = Customer::find($request->id);
        $venues = Venue::get();
        return view('customers.edit_customer', array('venues' => $venues, 'customer' => $customer));
    }

    public function edit(Request $request) {

        $this->validate($request, [
            'customer_name' => 'required',
            'customer_email' => 'required',
            'customer_post_code' => 'required',
            'customer_landline' => 'required',
            'customer_mobile' => 'required',
            'customer_status' => 'required',
            'client_type' => 'required',
            'contact_method' => 'required',
        ]);
        try {
            $update_customer = Customer::find($request->id);
            if (!$update_customer) {
                Session::flash('heading', 'Error!');
                Session::flash('message', 'Uhh!.. don\'t cheat us.');
                Session::flash('icon', 'error');
            }
            $booking_controller = new BookingsController();
            $location_details = $booking_controller->search_location($request->customer_post_code);
            if (is_array($location_details) && $location_details['latitude'] != 0 && $location_details['longitude'] != 0 && $location_details['is_found'] == 1) {

                $update_customer->name = $request->customer_name;
                $update_customer->email = $request->customer_email;
                $update_customer->lat = $location_details['latitude'];
                $update_customer->lng = $location_details['longitude'];
                $update_customer->post_code = $request->customer_post_code;
                $update_customer->landline = $request->customer_landline;
                $update_customer->mobile = $request->customer_mobile;
                $update_customer->fax = $request->customer_fax;
                $update_customer->website = $request->customer_website;
                $update_customer->status = $request->customer_status;
                $update_customer->discount_rate = $request->customer_discount;
                $update_customer->work_package_number = $request->customer_work_package;
                $update_customer->marketing_opt = $request->customer_marketing_opt;
                $update_customer->contact_name = $request->contact_name;
                $update_customer->contact_position = $request->contact_position;
                $update_customer->direct_number = $request->direct_number;
                $update_customer->direct_email = $request->direct_email;
                $update_customer->contact_mobile = $request->contact_mobile;
                $update_customer->account_manager_name = $request->account_manager_name;
                $update_customer->manager_contact_number = $request->manager_contact_number;
                $update_customer->manager_email = $request->manager_email;
                $update_customer->contact_method = $request->contact_method;
                $update_customer->client_type = $request->client_type;
                $update_customer->venue_id = $request->venue_id;
                $update_customer->venue_contact_name = $request->venue_contact_name;
                $update_customer->venue_contact_email = $request->venue_contact_email;
                $update_customer->venue_contact_number = $request->venue_contact_number;
                $update_customer->venue_contact_address = $request->venue_contact_address;
                $update_customer->save();
                Session::flash('heading', 'Success!');
                Session::flash('message', 'Customer updated successfully');
                Session::flash('icon', 'success');
                return redirect('customers');
            }
            Session::flash('heading', 'Error!');
            Session::flash('message', 'Postal Code is invalid');
            Session::flash('icon', 'error');
        } catch (\Exception $e) {
            Session::flash('heading', 'Error!');
            Session::flash('message', $e->getMessage());
            Session::flash('icon', 'error');
            return redirect()->back()->withInput();
        }
    }

}
