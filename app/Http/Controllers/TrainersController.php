<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trainer;
use App\Course;
use App\TrainerCourse;
use Session;
use App\Role;
use App\User;
use App\Profile;
use App\Booking;
use App\Customer;
use App\Venue;
use App\BookingDetail;
use App\Fee;

class TrainersController extends Controller {

    public function index() {
        $get_trainers = Trainer::all();
        return view('trainers.index', array('trainers' => $get_trainers));
    }

    public function create() {
        $get_courses = Course::all();

        // \DB::enableQueryLog();
        $get_fees = Fee::get();
        //dd(\DB::getQueryLog());
        return view('trainers.add_trainer', array('courses' => $get_courses, 'get_fees' => $get_fees));
    }

    public function requestedBookings() {
        $user = auth()->user();

        $userId = auth()->user()->id;
        $trainer = Trainer::where('login_id', '=', $userId)->firstOrFail();
        $trainerId = $trainer->id;
//      \DB::enableQueryLog();
        $get_bookings = \DB::table('bookings')->join('trainers', 'bookings.trainer_id', '=', 'trainers.id')->join('courses', 'bookings.course_id', '=', 'courses.id')->join('customers', 'bookings.customer_id', '=', 'customers.id')->join('venues', 'bookings.venue', '=', 'venues.id')->select('bookings.*', 'venues.name as venue_name', 'venues.address as venue_address', 'venues.landline as venue_contact', 'courses.title as course_title', 'customers.name as customer_name', 'trainers.name as trainer_name')
                ->where('bookings.trainer_id', '=', $trainerId)
                ->where('bookings.status', 0)
                ->get();
//      dd(\DB::getQueryLog());
        return view('trainer-dashboard.requested-bookings', array('bookings' => $get_bookings));
    }

    public function acceptBooking(Request $request) {

        $update_booking = Booking::find($request->id);
        $update_booking->status = '1';
        $update_booking->save();
        #email part
        $customer_id = $update_booking->customer_id;
        $trainer_id = $update_booking->trainer_id;
        $venue_id = $update_booking->venue_id;
        $course_id = $update_booking->course_id;
        $get_customer = Customer::find($customer_id);
        $get_trainer = Trainer::find($trainer_id);
        $get_venue = Venue::find($venue_id);
        $get_course = Course::find($course_id);
        $email = $get_customer->email;
        $data = array();
        $data['customer'] = $get_customer->name;
        $data['venue'] = $get_venue->name;
        $data['trainer'] = $get_trainer->name;
        $data['course'] = $get_course->title;
        $key = 'customer_confirm_booking';
        $subject = 'Confirm Booking';
        $send_mail = new MailController();
        $send_mail->sendMail($email, $subject, $key, $data);
        # end email part
        Session::flash('heading', 'Success!');
        Session::flash('message', 'Your booking has been confirmed.');
        Session::flash('icon', 'success');
        return back();
    }

    public function currentBookings() {
        $user = auth()->user();

        $userId = auth()->user()->id;
        $trainer = Trainer::where('login_id', '=', $userId)->firstOrFail();
        $trainerId = $trainer->id;
//      \DB::enableQueryLog();
        $get_bookings = \DB::table('bookings')->join('trainers', 'bookings.trainer_id', '=', 'trainers.id')->join('courses', 'bookings.course_id', '=', 'courses.id')->join('customers', 'bookings.customer_id', '=', 'customers.id')->join('venues', 'bookings.venue', '=', 'venues.id')->select('bookings.*', 'venues.name as venue_name', 'venues.address as venue_address', 'venues.landline as venue_contact', 'courses.title as course_title', 'customers.name as customer_name', 'trainers.name as trainer_name')
                ->where('bookings.trainer_id', '=', $trainerId)
                ->where('bookings.status', 1)
                ->get();
//      dd(\DB::getQueryLog());
        return view('trainer-dashboard.current-bookings', array('bookings' => $get_bookings));
    }

    public function completeCourse(Request $request) {
        $userId = auth()->user()->id;
        $trainer = Trainer::where('login_id', '=', $userId)->firstOrFail();
        $trainerId = $trainer->id;
        $get_bookings = \DB::table('bookings')->join('trainers', 'bookings.trainer_id', '=', 'trainers.id')->join('courses', 'bookings.course_id', '=', 'courses.id')->join('customers', 'bookings.customer_id', '=', 'customers.id')->join('venues', 'bookings.venue', '=', 'venues.id')->select('bookings.*', 'venues.name as venue_name', 'venues.address as venue_address', 'venues.landline as venue_contact', 'courses.title as course_title', 'customers.name as customer_name', 'trainers.name as trainer_name')
                ->where('bookings.trainer_id', '=', $trainerId)
                ->where('bookings.id', '=', $request->id)
                ->first();
        return view('trainer-dashboard.complete-course', ['bookings' => $get_bookings]);
    }

    public function addAdminMaterial(Request $request) {
        $get_bookings = \DB::table('bookings')->join('courses', 'bookings.course_id', '=', 'courses.id')->join('customers', 'bookings.customer_id', '=', 'customers.id')->join('venues', 'bookings.venue', '=', 'venues.id')->select('bookings.*', 'venues.name as venue_name', 'venues.address as venue_address', 'venues.landline as venue_contact', 'courses.title as course_title', 'customers.name as customer_name')
                ->where('bookings.id', '=', $request->id)
                ->first();
        return view('trainer-dashboard.admin-add-course-material', ['bookings' => $get_bookings]);
    }

    public function addMaterial(Request $request) {
        $userId = auth()->user()->id;
        $trainer = Trainer::where('login_id', '=', $userId)->first();
        $trainerId = $trainer->id;
        $get_bookings = \DB::table('bookings')->join('trainers', 'bookings.trainer_id', '=', 'trainers.id')->join('courses', 'bookings.course_id', '=', 'courses.id')->join('customers', 'bookings.customer_id', '=', 'customers.id')->join('venues', 'bookings.venue', '=', 'venues.id')->select('bookings.*', 'venues.name as venue_name', 'venues.address as venue_address', 'venues.landline as venue_contact', 'courses.title as course_title', 'customers.name as customer_name', 'trainers.name as trainer_name')
                ->where('bookings.trainer_id', '=', $trainerId)
                ->where('bookings.id', '=', $request->id)
                ->first();

//dd($get_bookings);
        return view('trainer-dashboard.add-course-material', ['bookings' => $get_bookings]);
    }

    public function completeCourseLifeCycle(Request $request) {
        try {
            $complete_courses_cycle = Booking::find($request->booking_id);
            $complete_courses_cycle->behaviour_issue = $request->behavior_issues;
            $complete_courses_cycle->course_issue = $request->course_material_issues;
            $complete_courses_cycle->venue_issue = $request->venue_issues;
            $complete_courses_cycle->course_audited = $request->course_edited;
            $complete_courses_cycle->notes = $request->notes;
            $complete_courses_cycle->status = '3';
            if ($request->delegates_information) {
                $complete_courses_cycle->delegates_information = '1';
            }
            if ($request->client_issues_closed) {
                $complete_courses_cycle->client_issues_closed = '1';
            }
            if ($request->certificates_emailed) {
                $complete_courses_cycle->certificates_emailed = '1';
            }
            if ($request->invoice_paid) {
                $complete_courses_cycle->invoice_paid = '1';
            }
            if ($request->kpis_updated) {
                $complete_courses_cycle->kpis_updated = '1';
            }
//   dd($request->booking_id,$request->behavior_issues);
            $complete_courses_cycle->save();

            #email trainer part
            $trainer_id = $complete_courses_cycle->trainer_id;
            $get_trainer = Trainer::find($trainer_id);
            $email = $get_trainer->email;
            $data = $get_trainer->name;
            $key = 'trainer_complete_booking';
            $subject = 'Complete Booking';
            $send_mail = new MailController();
            $send_mail->sendMail($email, $subject, $key, $data);
            # end email trainer part
            # 
            # 
            #email customer part
            $customer_id = $complete_courses_cycle->customer_id;
            $get_customer = Customer::find($customer_id);
            $customer_email = $get_customer->email;
            $customer_data = $get_customer->name;
            $key_customer = 'customer_complete_booking';
            $send_mail->sendMail($customer_email, $subject, $key_customer, $customer_data);

            # end email customer part
            Session::flash('heading', 'Success!');
            Session::flash('heading', 'Success!');
            Session::flash('message', 'Course life cycle completed successfully');
            Session::flash('icon', 'success');
            return redirect('current-bookings');
        } catch (\Exception $e) {
            Session::flash('heading', 'Error!');
            Session::flash('message', $e->getMessage());
            Session::flash('icon', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function completeBookings() {
        $user = auth()->user();

        $userId = auth()->user()->id;
        $trainer = Trainer::where('login_id', '=', $userId)->firstOrFail();
        $trainerId = $trainer->id;
        $get_bookings = \DB::table('bookings')->join('trainers', 'bookings.trainer_id', '=', 'trainers.id')->join('courses', 'bookings.course_id', '=', 'courses.id')->join('customers', 'bookings.customer_id', '=', 'customers.id')->join('venues', 'bookings.venue', '=', 'venues.id')->select('bookings.*', 'venues.name as venue_name', 'venues.address as venue_address', 'venues.landline as venue_contact', 'courses.title as course_title', 'customers.name as customer_name', 'trainers.name as trainer_name')
                ->where('bookings.trainer_id', '=', $trainerId)
                ->where('bookings.status', 3)
                ->get();
        return view('trainer-dashboard.complete-bookings', array('bookings' => $get_bookings));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'trainer_name' => 'required',
            'trainer_fees' => 'required',
            'trainer_email' => 'required',
            'trainer_password' => 'required',
            'trainer_address' => 'required',
            'trainer_region' => 'required',
            'trainer_post_code' => 'required',
            'trainer_contact' => 'required',
            'trainer_mobile' => 'required',
            'trainer_courses' => 'required',
            'trainer_level' => 'required',
        ]);
        try {
            $booking_controller = new BookingsController();
            $location_details = $booking_controller->search_location($request->trainer_address . ' ' . $request->trainer_post_code);

            if (!is_array($location_details) || $location_details['latitude'] == 0 || $location_details['longitude'] == 0 && $location_details['is_found'] == 0) {
                Session::flash('heading', 'Error!');
                Session::flash('message', 'Postal Code or Address is invalid');
                Session::flash('icon', 'error');
                return redirect()->back()->withInput();
            }
            $user = User::firstOrCreate(['name' => $request->trainer_name, 'email' => $request->trainer_email]);
            $user->status = 1;
            $user->password = bcrypt($request->trainer_password);
            $user->save();

            if ($file = $request->file('pic_file')) {
                $extension = $file->extension() ?: 'png';
                $destinationPath = public_path() . '/storage/uploads/users/';
                $safeName = str_random(10) . '.' . $extension;
                $file->move($destinationPath, $safeName);
                $request['pic'] = $safeName;
            } else {
                $request['pic'] = 'no_avatar.jpg';
            }
            $profile = $user->profile;
            if ($user->profile == null) {
                $profile = new Profile();
            }
            $profile->user_id = $user->id;
            $profile->pic = $request['pic'];
            $profile->save();
            $role = 'user';
            $user->assignRole($role);


            $store_trainer = new Trainer;
            if ($request->trainer_induction_training !== NULL) {
                $induction_date = date('Y-m-d', strtotime($request->trainer_induction_training));
                $store_trainer->induction_training = $induction_date;
            } if ($request->trainer_last_cpt !== NULL) {
                $trainer_last_cpt = date('Y-m-d', strtotime($request->trainer_last_cpt));
                $store_trainer->last_cpd_training = $trainer_last_cpt;
            }

            $store_trainer->login_id = $user->id;
            if (!empty($request->trainer_name)) {
                $store_trainer->name = $request->trainer_name;
            }
            if (!empty($request->trainer_email)) {
                $store_trainer->email = $request->trainer_email;
            }
            if (!empty($request->trainer_fees)) {
                $store_trainer->fees = $request->trainer_fees;
            }
            if (!empty($request->trainer_address)) {
                $store_trainer->address = $request->trainer_address;
            }
            if (!empty($request->trainer_region)) {
                $store_trainer->region = $request->trainer_region;
            }
            if (!empty($request->trainer_post_code)) {
                $store_trainer->post_code = $request->trainer_post_code;
            }
            if (!empty($request->trainer_contact)) {
                $store_trainer->home_contact = $request->trainer_contact;
            }
            if (!empty($request->trainer_mobile)) {
                $store_trainer->mobile = $request->trainer_mobile;
            }
            if (!empty($request->trainer_note)) {
                $store_trainer->notes = $request->trainer_note;
            }
            if (!empty($request->trainer_level)) {
                $store_trainer->level = $request->trainer_level;
            }
            $store_trainer->lat = $location_details['latitude'];
            $store_trainer->lng = $location_details['longitude'];
            $store_trainer->save();
            $trainer_id = $store_trainer->id;
            $courses = $request->trainer_courses;
            foreach ($courses as $course) {
                $data_insert[] = [
                    'course_id' => $course,
                    'trainer_id' => $trainer_id,
                ];
            }
            TrainerCourse::insert($data_insert);
            #email Part
            $email = $request->trainer_email;
            $data = array();
            $data['trainer'] = $request->trainer_name;
          //  dd($data);
            $key = 'trainer_registration';
            $subject = 'Confirm Registeration';
            $send_mail = new MailController();
            $send_mail->sendMail($email, $subject, $key, $data);
            # end email part
            Session::flash('heading', 'Success!');
            Session::flash('message', 'Trainer has been added.');
            Session::flash('icon', 'success');
            return redirect('trainers');
        } catch (\Exception $e) {
            Session::flash('heading', 'Error!');
            Session::flash('message', $e->getMessage());
            Session::flash('icon', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function delete(Request $request) {
//  dd($user);
        try {
            $user = \DB::table('users')->where('id', $request->id);
            if ($user) {
                $user->delete();
            }
            $trainer = Trainer::where('login_id', $request->id)->first();
            if ($trainer) {
                $trainer->delete();
            }
            Session::flash('heading', 'Success!');
            Session::flash('message', 'Trainer has been deleted.');
            Session::flash('icon', 'success');
            return redirect('trainers');
        } catch (\Exception $e) {
            Session::flash('heading', 'Error!');
            Session::flash('message', $e->getMessage());
            Session::flash('icon', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request) {
        $trainer = Trainer::find($request->id);
        $get_courses = Course::all();
        $get_fees = Fee::get();
        $trainer_courses = TrainerCourse::where('trainer_id', '=', $request->id)->get();
        return view('trainers.edit_trainer', ['trainer' => $trainer], array('courses' => $get_courses, 'trainer_courses' => $trainer_courses, 'get_fees' => $get_fees));
    }

    public function cancelBooking(Request $request) {
        $update_booking = Booking::find($request->id);
        $update_booking->status = '2';
        $update_booking->save();

        #email trainer part
        $get_trainer = Trainer::find($trainer_id);
        $email = $get_trainer->email;
        $data = array();
        $data['trainer'] = $get_trainer->name;
        $key = 'trainer_cancel_booking';
        $subject = 'Cancel Booking';
        $send_mail = new MailController();
        $send_mail->sendMail($email, $subject, $key, $data);
        # end email trainer part
        # 
        Session::flash('heading', 'Success!');
        Session::flash('message', 'Your booking has been canceled.');
        Session::flash('icon', 'success');
        return back();
    }

    public function edit(Request $request) {
        $this->validate($request, [
            'trainer_name' => 'required',
            'trainer_fees' => 'required',
            'trainer_address' => 'required',
            'trainer_region' => 'required',
            'trainer_post_code' => 'required',
            'trainer_contact' => 'required',
            'trainer_mobile' => 'required',
            'trainer_courses' => 'required',
            'trainer_level' => 'required',
        ]);
        try {

            $update_trainer = Trainer::find($request->trainer_id);
            if (!$update_trainer) {
                Session::flash('heading', 'Error!');
                Session::flash('message', 'Uhh!.. don\'t cheat us.');
                Session::flash('icon', 'error');
            }
            $booking_controller = new BookingsController();
            $location_details = $booking_controller->search_location($request->trainer_address . ' ' . $request->trainer_post_code);

            if (!is_array($location_details) || $location_details['latitude'] == 0 || $location_details['longitude'] == 0 && $location_details['is_found'] == 0) {
                Session::flash('heading', 'Error!');
                Session::flash('message', 'Postal Code or Address is invalid');
                Session::flash('icon', 'error');
                return redirect()->back()->withInput();
            }
            $trainer_last_cpt = NULL;
            $induction_date = NULL;
            if ($request->trainer_induction_training) {
                $induction_date = date('Y-m-d', strtotime($request->trainer_induction_training));
            } if ($request->trainer_last_cpt) {
                $trainer_last_cpt = date('Y-m-d', strtotime($request->trainer_last_cpt));
            }
            if (!empty($request->trainer_name)) {
                $update_trainer->name = $request->trainer_name;
            }
            if (!empty($request->trainer_fees)) {
                $update_trainer->fees = $request->trainer_fees;
            }
            if (!empty($request->trainer_address)) {
                $update_trainer->address = $request->trainer_address;
            }
            if (!empty($request->trainer_region)) {
                $update_trainer->region = $request->trainer_region;
            }
            if (!empty($request->trainer_post_code)) {
                $update_trainer->post_code = $request->trainer_post_code;
            }
            if (!empty($request->trainer_contact)) {
                $update_trainer->home_contact = $request->trainer_contact;
            }
            if (!empty($request->trainer_mobile)) {
                $update_trainer->mobile = $request->trainer_mobile;
            }
            if (!empty($request->trainer_note)) {
                $update_trainer->notes = $request->trainer_note;
            }
            if (!empty($request->trainer_level)) {
                $update_trainer->level = $request->trainer_level;
            }

            $update_trainer->induction_training = $induction_date;
            $update_trainer->last_cpd_training = $trainer_last_cpt;
            $update_trainer->lat = $location_details['latitude'];
            $update_trainer->lng = $location_details['longitude'];
            $update_trainer->save();

            $trainer_courses = TrainerCourse::where('trainer_id', '=', $request->trainer_id)->get();
            if ($trainer_courses) {
                foreach ($trainer_courses as $course_delete) {
                    $course_delete->delete();
                }
            }
            $trainer_id = $request->trainer_id;
            $courses = $request->trainer_courses;
            foreach ($courses as $course) {
                $data[] = [
                    'course_id' => $course,
                    'trainer_id' => $trainer_id,
                ];
            }
            TrainerCourse::insert($data);

            #email Part
            $email = $request->trainer_name;
            $data = array();
            $data = $request->trainer_email;
            $key = 'trainer_new_course_registeration';
            $subject = 'Information Update';
            $send_mail = new MailController();
            $send_mail->sendMail($email, $subject, $key, $data);
            # end email part

            Session::flash('heading', 'Success!');
            Session::flash('message', 'Trainer has been updated.');
            Session::flash('icon', 'success');
            return redirect('trainers');
        } catch (\Exception $e) {
            Session::flash('heading', 'Error!');
            Session::flash('message', $e->getMessage());
            Session::flash('icon', 'error');
            return redirect()->back()->withInput();
        }
    }

}
