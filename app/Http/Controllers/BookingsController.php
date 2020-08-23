<?php

namespace App\Http\Controllers;

use DB;
use App\Quotation;
use Illuminate\Http\Request;
use Session;
use Response;
use App\Booking;
use App\Customer;
use App\Venue;
use App\Course;
use App\Trainer;
use App\TrainerCourse;
use App\BookingDetail;
use App\Fee;

class BookingsController extends Controller {

    public function index() {
        //DB::enableQueryLog();
        $get_bookings = DB::table('bookings')->join('trainers', 'bookings.trainer_id', '=', 'trainers.id')->join('courses', 'bookings.course_id', '=', 'courses.id')->join('customers', 'bookings.customer_id', '=', 'customers.id')->join('venues', 'bookings.venue', '=', 'venues.id')->select('bookings.*', 'venues.name as venue_name', 'venues.address as venue_address', 'courses.title as course_title', 'customers.name as customer_name', 'trainers.name as trainer_name')->get();
        //  dd(DB::getQueryLog());
        return view('bookings.index', array('bookings' => $get_bookings));
    }

    public function bookingDetals(Request $request) {
        //DB::enableQueryLog();
        $booking = DB::table('bookings')->join('trainers', 'bookings.trainer_id', '=', 'trainers.id')->join('courses', 'bookings.course_id', '=', 'courses.id')->join('customers', 'bookings.customer_id', '=', 'customers.id')->join('venues', 'bookings.venue', '=', 'venues.id')->select('bookings.*', 'venues.name as venue_name', 'venues.address as venue_address', 'courses.title as course_title', 'customers.name as customer_name', 'customers.landline as customer_landline', 'customers.discount_rate as discount_rate', 'customers.email as customer_email', 'trainers.name as trainer_name')->where('bookings.id', '=', $request->id)
                ->first();
        //  dd(DB::getQueryLog());
        $get_courses = Course::all();
        $get_customers = Customer::all();
        $get_venues = Venue::all();
        $trainer_details = Trainer::find($booking->trainer_id);
        return view('bookings.edit_booking', ['booking' => $booking], array('courses' => $get_courses, 'customers' => $get_customers, 'venues' => $get_venues, 'trainer_details' => $trainer_details));
    }

    public function singleBookingDetals(Request $request) {
        //DB::enableQueryLog();
        $booking = DB::table('bookings')->join('trainers', 'bookings.trainer_id', '=', 'trainers.id')->join('courses', 'bookings.course_id', '=', 'courses.id')->join('customers', 'bookings.customer_id', '=', 'customers.id')->join('venues', 'bookings.venue', '=', 'venues.id')
                ->select('bookings.*', 'venues.name as venue_name', 'venues.address as venue_address', 'courses.title as course_title', 'customers.name as customer_name', 'customers.landline as customer_landline', 'customers.discount_rate as discount_rate', 'customers.email as customer_email', 'trainers.name as trainer_name')->where('bookings.id', '=', $request->id)
                ->first();
        //  DB::enableQueryLog();
        $booking_detail = BookingDetail::where('booking_id', $request->id)->get();
        //    dd(DB::getQueryLog());

        return view('bookings.booking-details', array(
            'booking' => $booking,
            'booking_details' => $booking_detail
        ));
    }

    public function create() {
        $get_courses = Course::all();
        $get_customers = Customer::all();
        $get_venues = Venue::all();
        $get_fees = Fee::get();
        return view('bookings.add_booking', array('courses' => $get_courses, 'customers' => $get_customers, 'venues' => $get_venues, 'get_fees' => $get_fees));
    }

    public function customerDetails(Request $request) {
        $customer = Customer::find($request->id);
        return Response::json($customer);
    }

    public function trainerDetails(Request $request) {
        $trainer = DB::table('trainers')->join('trainer_courses', 'trainers.id', '=', 'trainer_courses.trainer_id')->join('courses', 'trainer_courses.course_id', '=', 'courses.id')->select('trainers.name', 'trainers.id as trainer_id', 'courses.id as course_id', 'courses.title')->where(['courses.id' => $request->id])->get();
        return Response::json(array('trainers_list' => $trainer));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'customer_name' => 'required',
            'course' => 'required',
            'course_type' => 'required',
            'trainer' => 'required',
            'cost' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'venue' => 'required',
            'fees' => 'required',
        ]);
        try {
            $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date = date('Y-m-d', strtotime($request->end_date));
            $store_bookings = new Booking;
            $store_bookings->customer_id = $request->customer_name;
            $store_bookings->course_id = $request->course;
            $store_bookings->trainer_id = $request->trainer;
            $store_bookings->venue = $request->venue;
            $store_bookings->course_type = $request->course_type;
            $store_bookings->fees = $request->fees;
            $store_bookings->cost = $request->cost;
            $store_bookings->start_date = $start_date;
            $store_bookings->end_date = $end_date;
            $store_bookings->save();




            $booking_id = $store_bookings->id;
            $delgate_names = $request->delegate_name;
            $delgate_email = $request->delegate_email;
            $delgate_telephone = $request->delegate_telephone;
            $delegate_license = $request->delegate_license;

            foreach ($delgate_names as $index => $delegate_name) {
                $data[] = [
                    'delegate_name' => $delegate_name,
                    'email' => $delgate_email[$index],
                    'driving_license' => $delegate_license[$index],
                    'telephone' => $delgate_telephone[$index],
                    'booking_id' => $booking_id,
                ];
            }
            BookingDetail::insert($data);
            #email trainer part
            $trainer_id = $request->trainer;
            $get_trainer = Trainer::find($trainer_id);
            $email = $get_trainer->email;
            $data = $get_trainer->name;
            $key = 'trainer_request_booking';
            $subject = 'Booking Request';
            $send_mail = new MailController();
            $send_mail->sendMail($email, $subject, $key, $data);
            # end email trainer part
            # 
            # 
            #email customer part
            $customer_id = $request->customer_name;
            $get_customer = Customer::find($customer_id);
            $customer_email = $get_customer->email;
            $customer_data = $get_customer->name;
            $customer_key = 'customer_confirm_booking';
            $customer_subject = 'Confirm Booking';
            $send_mail->sendMail($customer_email, $customer_subject, $customer_key, $customer_data);
            # end customer email part
            # 
            #email venue part
            $venue_id = $request->venue;
            $get_venue = Customer::find($venue_id);
            $venue_email = $get_venue->email;
            $venue_data = $get_venue->name;
            $venue_key = 'customer_confirm_booking';
            $venue_subject = 'Confirm Booking';
            $send_mail->sendMail($venue_email, $venue_subject, $venue_key, $venue_data);
            # end venue email part
            Session::flash('heading', 'Success!');
            Session::flash('message', 'Booking has been added.');
            Session::flash('icon', 'success');
            return redirect('bookings');
        } catch (\Exception $e) {
            Session::flash('heading', 'Error!');
            Session::flash('message', $e->getMessage());
            Session::flash('icon', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function edit(Request $request) {

        $this->validate($request, [
            'customer_name' => 'required',
            'course' => 'required',
            'course_type' => 'required',
            'trainer' => 'required',
            'cost' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'venue' => 'required',
            'fees' => 'required',
        ]);
        try {
            $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date = date('Y-m-d', strtotime($request->end_date));
            $update_booking = Booking::find($request->booking_id);
            $update_booking->customer_id = $request->customer_name;
            $update_booking->course_id = $request->course;
            $update_booking->trainer_id = $request->trainer;
            $update_booking->venue = $request->venue;
            $update_booking->course_type = $request->course_type;
            $update_booking->fees = $request->fees;
            $update_booking->cost = $request->cost;
            $update_booking->start_date = $start_date;
            $update_booking->end_date = $end_date;
            $update_booking->save();

            $booking_id = $request->booking_id;
            $delgate_names = $request->delegate_name;
            $delgate_email = $request->delegate_email;
            $delgate_telephone = $request->delegate_telephone;
            $delegate_license = $request->delegate_license;

            foreach ($delgate_names as $index => $delegate_name) {
                $data[] = [
                    'delegate_name' => $delegate_name,
                    'email' => $delgate_email[$index],
                    'driving_license' => $delegate_license[$index],
                    'telephone' => $delgate_telephone[$index],
                    'booking_id' => $booking_id,
                ];
            }
            BookingDetail::insert($data);

            Session::flash('heading', 'Success!');
            Session::flash('message', 'Booking has been updated.');
            Session::flash('icon', 'success');
            return redirect('bookings');
        } catch (\Exception $e) {
            Session::flash('heading', 'Error!');
            Session::flash('message', $e->getMessage());
            Session::flash('icon', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function venue_fees(Request $request) {
        $venue_id = $request->venue_id;
        $get_venue = Venue::find($venue_id);
        $fees = $get_venue->fees;
        return Response::json(array('fees' => $fees));
    }

    public function nearest_trainer(Request $request, $course_id, $venue_id) {
        $trainer = array();
        ob_start();
        ?>
        <div class="form-group  ">
            <label for="trainer" class="col-sm-12 control-label">Please add trainer.</label>
        </div>
        <?php
        $html = ob_get_clean();
        $lat = '';
        $lng = '';
        $is_succes = 0;
        $venue_details = Trainer::find($venue_id);
        if (!$venue_details) {
            return Response::json(array('html' => $html, 'lat' => $lat, 'lng' => $lng, 'success' => $is_succes));
        }
        $venue_location_details = $this->search_location($venue_details->post_code);
        if (!is_array($venue_location_details) || $venue_location_details['latitude'] == 0 || $venue_location_details['longitude'] == 0 && $venue_location_details['is_found'] == 0) {
            return Response::json(array('html' => $html, 'lat' => $lat, 'lng' => $lng, 'success' => $is_succes));
        }
        $trainer = DB::table('trainers')
                        ->join('trainer_courses', 'trainers.id', '=', 'trainer_courses.trainer_id')
                        ->join('courses', 'trainer_courses.course_id', '=', 'courses.id')
                        ->select('trainers.*', 'trainers.id as trainer_id', 'courses.id as course_id', 'courses.title')
                        ->where(['courses.id' => $course_id])->get();

        $radius = 1000;
        $lat = $venue_location_details['latitude'];
        $lng = $venue_location_details['longitude'];
        $tableName = 'trainers';
        $nearbytrainers = DB::table('trainers')
                ->join('trainer_courses', 'trainers.id', '=', 'trainer_courses.trainer_id')
                ->join('courses', 'trainer_courses.course_id', '=', 'courses.id')
                ->select('courses.id as course_id', 'trainers.*', DB::raw(' (' . $radius . '*acos(cos(radians(' . $lat . '))*cos( radians(lat))*cos(radians(lng)-radians(' . $lng . '))+sin(radians(' . $lat . '))*sin(radians(lat)))) as distance'))
                ->where([
                    ['lat', '<>', NULL],
                    ['lng', '<>', NULL],
                ])
                ->where(['course_id' => $course_id])
                ->orderBy('distance')
                ->first();
        if (!$nearbytrainers) {
            return Response::json(array('html' => $html, 'lat' => $lat, 'lng' => $lng, 'success' => $is_succes));
        }
        ob_start();
        ?>
        <div class="trainer_details">
            <div class="form-group">
                <h4 class="text-center">Nearest Trainer</h4>
            </div>
            <div class="form-group  ">
                <label for="trainer" class="col-sm-2 control-label">Name</label>
                <label for="trainer" class="col-sm-10 "><?php echo $nearbytrainers->name ?></label>
            </div>
            <div class="form-group  ">
                <label for="trainer" class="col-sm-2 control-label">Address</label>
                <label for="trainer" class="col-sm-10 "><?php echo $nearbytrainers->address ?></label>
            </div>
            <div class="form-group  ">
                <label for="trainer" class="col-sm-2 control-label">Region</label>
                <label for="trainer" class="col-sm-10"><?php echo $nearbytrainers->region ?></label>
            </div>
            <div class="form-group  ">
                <label for="trainer" class="col-sm-2 control-label">Postal Code</label>
                <label for="trainer" class="col-sm-10 "><?php echo $nearbytrainers->region ?></label>
            </div>
            <?php if (count($trainer) > 0) { ?>
                <div class="col-md-12 m-b-20">
                    <button class="btn btn-primary pull-right" onclick="show_other_trainers()">Other Trainers</button>
                </div>
            <?php } ?>
        </div>
        <?php if (count($trainer) > 0) { ?>
            <div class="other_trainers m-b-20 m-t-20" style="display: none;">
                <div class="form-group  others_trainers" >
                    <label for="trainer" class="col-sm-2 control-label">Trainer *</label>
                    <div class="col-sm-10">
                        <select class="form-control other_trainer text-capitalize"  id="other_trainer" name="other_trainer" >
                            <?php foreach ($trainer as $value) { ?>
                                <option value="<?php echo $value->id ?>"<?php echo $value->id ?>><?php echo $value->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php
        $html = ob_get_clean();
        return Response::json(array('html' => $html, 'lat' => $lat, 'lng' => $lng, 'success' => 1, 'id' => $nearbytrainers->id));
    }

    public function other_trainer(Request $request, $trainer_id) {
        $lat = '';
        $lng = '';
        $nearbytrainers = Trainer::find($trainer_id);
        ob_start();
        ?>
        <div class="trainer_details">
            <div class="form-group  ">
                <h4 class="text-center">Selected Trainer</h4>
            </div>
            <div class="form-group  ">
                <label for="trainer" class="col-sm-2 control-label">Name</label>
                <label for="trainer" class="col-sm-10 "><?php echo $nearbytrainers->name ?></label>
            </div>
            <div class="form-group  ">
                <label for="trainer" class="col-sm-2 control-label">Address</label>
                <label for="trainer" class="col-sm-10 "><?php echo $nearbytrainers->address ?></label>
            </div>
            <div class="form-group  ">
                <label for="trainer" class="col-sm-2 control-label">Region</label>
                <label for="trainer" class="col-sm-10"><?php echo $nearbytrainers->region ?></label>
            </div>
            <div class="form-group  ">
                <label for="trainer" class="col-sm-2 control-label">Postal Code</label>
                <label for="trainer" class="col-sm-10 "><?php echo $nearbytrainers->region ?></label>
            </div>

            <div class="col-md-12 m-b-20">
                <button class="btn btn-primary pull-right" onclick="show_other_trainers()">Other Trainers</button>
            </div>
        </div>

        <?php
        $html = ob_get_clean();
        return Response::json(array('html' => $html, 'lat' => $nearbytrainers->lat, 'lng' => $nearbytrainers->lng, 'id' => $nearbytrainers->id));
    }

    public function search_location($location) {

        $locality = '';
        $country = '';
        try {
//            $result = $this->searchLocation($location);
            $address = str_replace(" ", "+", $location);
            $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&key=AIzaSyAVELSX6ErxUO5vgrxO_z9SHZyf_RvdP3w");
            $result = json_decode($json);
            if (isset($result->status) && $result->status == 'OK') {
                if (is_array($result->results) && count($result->results) > 0) {
                    $address_details = $result->results['0']->address_components;
                    $geometry = $result->results['0']->geometry;
                    foreach ($address_details as $address) {
                        if ($address->types[0] == 'locality') {
                            $locality = $address->long_name;
                        } elseif ($address->types[0] == 'country') {
                            $country = $address->long_name;
                        } else {
                            continue;
                        }
                    }
                    $latitude = $geometry->location->lat;
                    $longitude = $geometry->location->lng;
                    return array(
                        'locality' => $locality,
                        'country' => $country,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'is_found' => 1
                    );
                } else {
                    return array(
                        'locality' => 0,
                        'country' => 0,
                        'latitude' => 0,
                        'longitude' => 0,
                        'is_found' => 0
                    );
                }
            } else {
                return array(
                    'locality' => 0,
                    'country' => 0,
                    'latitude' => 0,
                    'longitude' => 0,
                    'is_found' => 0
                );
            }
        } catch (\Exception $ex) {
            return array(
                'locality' => 0,
                'country' => 0,
                'latitude' => 0,
                'longitude' => 0,
                'is_found' => 0
            );
        }
    }

}
