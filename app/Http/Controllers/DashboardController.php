<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trainer;
use App\Course;
use Session;
use App\Role;
use App\User;
use App\Booking;
use App\Customer;
use App\TrainerCourse;

class DashboardController extends Controller {

    public function admin_dashboard(Request $request) {

        $get_bookings = Booking::get()->count();
        $get_trainers = Trainer::get()->count();
        $get_courses = Course::get()->count();
        $get_customers = Customer::get()->count();
        $top_courses = \DB::table('bookings')->join('courses', 'bookings.course_id', '=', 'courses.id')->select('courses.*', 'bookings.course_id', \DB::raw('count(bookings.course_id) as count'))->groupBy('id')->orderBy('count', 'DESC')->take(5)->get();
        $top_trainers = \DB::table('bookings')->join('trainers', 'bookings.trainer_id', '=', 'trainers.id')->select('trainers.*', 'bookings.trainer_id', \DB::raw('count(bookings.trainer_id) as count'))->groupBy('trainer_id')->orderBy('count', 'DESC')->take(5)->get();
        return view('dashboard.dashboard', [
            'get_bookings' => $get_bookings,
            'get_trainers' => $get_trainers,
            'get_courses' => $get_courses,
            'get_customers' => $get_customers,
            'top_courses' => $top_courses,
            'top_trainers' => $top_trainers,
        ]);
    }

    public function trainer_dashboard(Request $request) {
        $trainer_id = \Illuminate\Support\Facades\Auth::id();
        $trainer = Trainer::where('login_id', $trainer_id)->first();
        $trainerId = $trainer->id;
        $trainer_booking_count = Booking::where('trainer_id', $trainerId)->count();
        $trainer_completed_bookings = Booking::where('trainer_id', $trainerId)
                ->where('status', 3)
                ->count();
        $trainer_accepted_bookings = Booking::where('trainer_id', $trainerId)
                ->where('status', 1)
                ->count();
        $trainer_courses = TrainerCourse::where('trainer_id', $trainerId)
                ->count();
        return view('dashboard.trainer_dashboard', [
            'trainer_booking_count' => $trainer_booking_count,
            'trainer_accepted_bookings' => $trainer_accepted_bookings,
            'trainer_completed_bookings' => $trainer_completed_bookings,
            'trainer_courses' => $trainer_courses,
        ]);
    }

    function bookings_calender(Request $request) {
        $response = array();
        $start_date = date('Y-m-1');
        $start_month = date('Y-m-1');
        $end_date = date('Y-m-t');
        $end_month = date('Y-m-t');
        if (isset($request->start_render_view) && $request->render_view_status == 1) {
            $start_date = $request->start_render_view;
            $end_date = $request->end_render_view;
        } else {
            $start_date = $request->start_month;
            $end_date = date('Y-m-t', strtotime($request->start_month));
        }
        $start_date = date('Y-m-d 00:00:00', strtotime($start_date));
        $end_date = date('Y-m-d 23:59:59', strtotime($end_date));
        $bookings = Booking::where([
                    ['start_date', '>=', $start_date],
                    ['start_date', '<=', $end_date],
                ])
                ->get();
        if ($bookings->count() > 0) {

            foreach ($bookings as $booking) {
                $trainer_details = Trainer::find($booking->trainer_id);
                if (!$trainer_details) {
                    continue;
                }
                $course_details = Course::find($booking->course_id);
                if (!$course_details) {
                    continue;
                }
                $customer_details = Customer::find($booking->customer_id);
                if (!$customer_details) {
                    continue;
                }
                $venue_details = \App\Venue::find($booking->venue);
                if (!$venue_details) {
                    continue;
                }
                $trainer_name = $trainer_details->name . ' ' . $trainer_details->last_name;
                $trainer_address = $trainer_details->address . ' ' . $trainer_details->region . ' ' . $trainer_details->post_code;
                $customer_name = $customer_details->name;
                $customer_postal_code = $customer_details->post_code;
                $course_name = $course_details->title;
                $venue_name = $venue_details->name;
                $venue_address = $venue_details->address . ' ' . $venue_details->region . ' ' . $venue_details->post_code;
                $start = date('Y-m-d H:i:s', strtotime($booking->start_date));
                $end = date('Y-m-d H:i:s', strtotime($booking->end_date));
                $response[] = array(
                    'title' => substr($trainer_name, 0, 20),
                    'popover_title' => substr($trainer_name, 0, 300) . '...',
                    'start' => $start,
                    'end' => $end,
                    'allDay' => false,
                    'editable' => false,
                    'backgroundColor' => '#0078bc',
                    'borderColor' => '#0078bc',
                    'color' => 'white',
                    'data' => array(
                        'trainer_name' => $trainer_name,
                        'trainer_address' => $trainer_address,
                        'customer_name' => $customer_name,
                        'customer_postal_code' => $customer_postal_code,
                        'course_name' => $course_name,
                        'venue_name' => $venue_name,
                        'venue_address' => $venue_address,
                        'start' => $start,
                        'end' => $end,
                        'booking_status' => $booking->status,
                    )
                );
            }
        } else {
            $response['data'][] = array(
                'post_content' => 'No Data Available',
                'time' => ''
            );
        }
        return $response;
    }

    function calendar_event_details(Request $request) {
        $data = $request->data;
        ob_start();
        ?>
        <div class="modal-header">
            <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
            <h4 class="modal-title">Booking Details</h4>
        </div>
        <div class="modal-body">

            <div class="table-responsive">

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="padding:10px" colspan="2">Trainer</th>
                        </tr>
                        <tr>
                            <td style="padding:10px">Name</th>
                            <td class="text-left text-info" style="padding:10px 30px;"><?php echo $data['trainer_name']; ?></td>
                        </tr>
                        <tr>
                            <td style="padding:10px">Address</th>
                            <td class="text-left text-info" style="padding:10px 30px;"><?php echo $data['trainer_address']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="padding:10px" colspan="2">Customer</th>
                        </tr>
                        <tr>
                            <td style="padding:10px">Name</th>
                            <td class="text-left text-info" style="padding:10px 30px;"><?php echo $data['customer_name']; ?></td>
                        </tr>
                        <tr>
                            <td style="padding:10px">Postal Code</th>
                            <td class="text-left text-info" style="padding:10px 30px;"><?php echo $data['customer_postal_code']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="padding:10px" colspan="2">Venue</th>
                        </tr>
                        <tr>
                            <td style="padding:10px">Name</th>
                            <td class="text-left text-info" style="padding:10px 30px;"><?php echo $data['venue_name']; ?></td>
                        </tr>
                        <tr>
                            <td style="padding:10px">Address</th>
                            <td class="text-left text-info" style="padding:10px 30px;"><?php echo $data['venue_address']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="padding:10px" colspan="2">Other Details</th>
                        </tr>
                        <tr>
                            <td style="padding:10px">Course</th>
                            <td class="text-left text-info" style="padding:10px 30px;"><?php echo $data['course_name']; ?></td>
                        </tr>
                        <tr>
                            <td style="padding:10px">Start</th>
                            <td class="text-left text-info" style="padding:10px 30px;"><?php echo date('d-m-Y', strtotime($data['start'])); ?></td>
                        </tr>
                        <tr>
                            <td style="padding:10px">End</th>
                            <td class="text-left text-info" style="padding:10px 30px;"><?php echo date('d-m-Y', strtotime($data['end'])); ?></td>
                        </tr>
                        <tr>
                            <td style="padding:10px">Status</th>
                            <td class="text-left text-info" style="padding:10px 30px;"><?php
                                if ($data['booking_status'] == 0) {
                                    echo 'Waiting for approval';
                                } elseif ($data['booking_status'] == 1) {
                                    echo 'Accepted';
                                } elseif ($data['booking_status'] == 2) {
                                    echo 'Rejected';
                                } elseif ($data['booking_status'] == 3) {
                                    echo 'Completed';
                                } else {
                                    echo 'Unknown';
                                }
                                ?></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <?php
        $response = ob_get_clean();
        return $response;
    }

    function trainer_bookings_calender(Request $request) {
        $response = array();
        $booking_found = FALSE;
        $start_date = date('Y-m-1');
        $start_month = date('Y-m-1');
        $end_date = date('Y-m-t');
        $end_month = date('Y-m-t');
        if (isset($request->start_render_view) && $request->render_view_status == 1) {
            $start_date = $request->start_render_view;
            $end_date = $request->end_render_view;
        } else {
            $start_date = $request->start_month;
            $end_date = date('Y-m-t', strtotime($request->start_month));
        }
        $trainer_id = \Illuminate\Support\Facades\Auth::id();
        $trainer = Trainer::where('login_id', $trainer_id)->first();
        $trainerId = $trainer->id;
        $start_date = date('Y-m-d 00:00:00', strtotime($start_date));
        $end_date = date('Y-m-d 23:59:59', strtotime($end_date));
        $bookings = Booking::where([
                    ['start_date', '>=', $start_date],
                    ['start_date', '<=', $end_date],
                    ['trainer_id', $trainerId],
                ])
                ->get();
        if ($bookings->count() > 0) {
            $booking_found = TRUE;
            foreach ($bookings as $booking) {
                $trainer_details = Trainer::find($booking->trainer_id);
                if (!$trainer_details) {
                    continue;
                }
                $course_details = Course::find($booking->course_id);
                if (!$course_details) {
                    continue;
                }
                $customer_details = Customer::find($booking->customer_id);
                if (!$customer_details) {
                    continue;
                }
                $venue_details = \App\Venue::find($booking->venue);
                if (!$venue_details) {
                    continue;
                }
                $trainer_name = $trainer_details->name . ' ' . $trainer_details->last_name;
                $trainer_address = $trainer_details->address . ' ' . $trainer_details->region . ' ' . $trainer_details->post_code;
                $customer_name = $customer_details->name;
                $customer_postal_code = $customer_details->post_code;
                $course_name = $course_details->title;
                $venue_name = $venue_details->name;
                $venue_address = $venue_details->address . ' ' . $venue_details->region . ' ' . $venue_details->post_code;
                $start = date('Y-m-d H:i:s', strtotime($booking->start_date));
                $end = date('Y-m-d H:i:s', strtotime($booking->end_date));
                $response[] = array(
                    'title' => substr('Booking: ' . $trainer_name, 0, 20),
                    'popover_title' => substr('Booking: ' . $trainer_name, 0, 300) . '...',
                    'start' => $start,
                    'end' => $end,
                    'allDay' => false,
                    'editable' => false,
                    'backgroundColor' => '#0078bc',
                    'borderColor' => '#0078bc',
                    'color' => 'white',
                    'data' => array(
                        'trainer_name' => $trainer_name,
                        'trainer_address' => $trainer_address,
                        'customer_name' => $customer_name,
                        'customer_postal_code' => $customer_postal_code,
                        'course_name' => $course_name,
                        'venue_name' => $venue_name,
                        'venue_address' => $venue_address,
                        'start' => $start,
                        'end' => $end,
                        'booking_status' => $booking->status,
                        'status' => 1,
                    )
                );
            }
        }
        $schedules = \App\TrainerSchedules::where('trainer_id', \Illuminate\Support\Facades\Auth::id())
                ->get();
        if ($schedules->count() > 0) {
            $booking_found = TRUE;
            foreach ($schedules as $schedule) {
                $start = date('Y-m-d 00:00:00', strtotime($schedule->start_date));
                $end = date('Y-m-d 23:59:59', strtotime($schedule->end_date));
                $title = 'Schedule: ' . date('d-m-Y', strtotime($schedule->start_date)) . ' ' . date('d-m-Y', strtotime($schedule->end_date));
                $response[] = array(
                    'title' => substr($title, 0, 20),
                    'popover_title' => substr($title, 0, 300) . '...',
                    'start' => $start,
                    'end' => $end,
                    'allDay' => false,
                    'editable' => false,
                    'backgroundColor' => '#c8232c',
                    'borderColor' => '#c8232c',
                    'color' => 'white',
                    'data' => array(
                        'start' => $start,
                        'end' => $end,
                        'status' => 2,
                    )
                );
            }
        }
        if (!$booking_found) {
            $response['data'][] = array(
                'post_content' => 'No Data Available',
                'time' => ''
            );
        }
        return $response;
    }

    function trainer_calendar_event_details(Request $request) {
        $data = $request->data;
        if ($data['status'] == 1) {
            ob_start();
            ?>
            <div class="modal-header">
                <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                <h4 class="modal-title">Booking Details</h4>
            </div>
            <div class="modal-body">

                <div class="table-responsive">

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="padding:10px" colspan="2">Trainer</th>
                            </tr>
                            <tr>
                                <td style="padding:10px">Name</th>
                                <td class="text-left text-info" style="padding:10px 30px;"><?php echo $data['trainer_name']; ?></td>
                            </tr>
                            <tr>
                                <td style="padding:10px">Address</th>
                                <td class="text-left text-info" style="padding:10px 30px;"><?php echo $data['trainer_address']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="padding:10px" colspan="2">Customer</th>
                            </tr>
                            <tr>
                                <td style="padding:10px">Name</th>
                                <td class="text-left text-info" style="padding:10px 30px;"><?php echo $data['customer_name']; ?></td>
                            </tr>
                            <tr>
                                <td style="padding:10px">Postal Code</th>
                                <td class="text-left text-info" style="padding:10px 30px;"><?php echo $data['customer_postal_code']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="padding:10px" colspan="2">Venue</th>
                            </tr>
                            <tr>
                                <td style="padding:10px">Name</th>
                                <td class="text-left text-info" style="padding:10px 30px;"><?php echo $data['venue_name']; ?></td>
                            </tr>
                            <tr>
                                <td style="padding:10px">Address</th>
                                <td class="text-left text-info" style="padding:10px 30px;"><?php echo $data['venue_address']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="padding:10px" colspan="2">Other Details</th>
                            </tr>
                            <tr>
                                <td style="padding:10px">Course</th>
                                <td class="text-left text-info" style="padding:10px 30px;"><?php echo $data['course_name']; ?></td>
                            </tr>
                            <tr>
                                <td style="padding:10px">Start</th>
                                <td class="text-left text-info" style="padding:10px 30px;"><?php echo date('d-m-Y', strtotime($data['start'])); ?></td>
                            </tr>
                            <tr>
                                <td style="padding:10px">End</th>
                                <td class="text-left text-info" style="padding:10px 30px;"><?php echo date('d-m-Y', strtotime($data['end'])); ?></td>
                            </tr>
                            <tr>
                                <td style="padding:10px">Status</th>
                                <td class="text-left text-info" style="padding:10px 30px;"><?php
                                    if ($data['booking_status'] == 0) {
                                        echo 'Waiting for approval';
                                    } elseif ($data['booking_status'] == 1) {
                                        echo 'Accepted';
                                    } elseif ($data['booking_status'] == 2) {
                                        echo 'Rejected';
                                    } elseif ($data['booking_status'] == 3) {
                                        echo 'Completed';
                                    } else {
                                        echo 'Unknown';
                                    }
                                    ?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <?php
            $response = ob_get_clean();
        } elseif ($data['status'] == 2) {
            ob_start();
            ?>
            <div class="modal-header">
                <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                <h4 class="modal-title">Schedule Details</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="padding:10px" colspan="2">Schedule</th>
                            </tr>
                            <tr>
                                <td style="padding:10px">Start</th>
                                <td class="text-left text-info" style="padding:10px 30px;"><?php echo date('d-m-Y', strtotime($data['start'])); ?></td>
                            </tr>
                            <tr>
                                <td style="padding:10px">End</th>
                                <td class="text-left text-info" style="padding:10px 30px;"><?php echo date('d-m-Y', strtotime($data['end'])); ?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <?php
            $response = ob_get_clean();
        } else {
            ob_start();
            ?>
            <div class="modal-header">
                <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                <h4 class="modal-title">Event Details</h4>
            </div>
            <div class="modal-body">
                <h2>Don't Try to Cheat Us.</h2>
            </div>
            <?php
            $response = ob_get_clean();
        }

        return $response;
    }

    function index() {
        if (\Illuminate\Support\Facades\Auth::check()) {
            $user = User::find(\Illuminate\Support\Facades\Auth::id());
            if ($user->hasRole('admin')) {
                return redirect('/dashboard');
            } elseif ($user->hasRole('user')) {
                return redirect('/trainer-dashboard');
            }
        }
        return redirect('/login');
    }

}
