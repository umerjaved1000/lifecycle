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

class ScheduleController extends Controller {

    public function index(Request $request) {
        return view('trainer-dashboard.schedule', [
        ]);
    }

    public function add_schedule(Request $request) {
        return view('trainer-dashboard.add_schedule', [
        ]);
    }

    public function submit_schedule(Request $request) {
        try {
            $this->validate($request, [
                'start_date' => 'required',
                'end_date' => 'required'
            ]);
            $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date = date('Y-m-d', strtotime($request->end_date));
            $schedules = \App\TrainerSchedules::whereBetween('start_date', [$start_date, $end_date])
                    ->orWhereBetween('end_date', [$start_date, $end_date])
                    ->first();
            if ($schedules) {
                Session::flash('heading', 'Error!');
                Session::flash('message', 'Current Schedule is overlapping with other schedule');
                Session::flash('icon', 'error');
                return redirect()->back()->withInput();
            }
            $store_schedule = new \App\TrainerSchedules();
            $store_schedule->start_date = $start_date;
            $store_schedule->end_date = $end_date;
            $store_schedule->trainer_id = \Illuminate\Support\Facades\Auth::id();
            $store_schedule->save();
            Session::flash('heading', 'Success!');
            Session::flash('message', 'Schedule has been added.');
            Session::flash('icon', 'success');
            return redirect('schedule');
        } catch (\Exception $e) {
            Session::flash('heading', 'Error!');
            Session::flash('message', $e->getMessage());
            Session::flash('icon', 'error');
            return redirect()->back()->withInput();
        }
    }

    function schedule_calender(Request $request) {
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
        $schedules = \App\TrainerSchedules::where('trainer_id', \Illuminate\Support\Facades\Auth::id())
                ->get();
        if ($schedules->count() > 0) {
            foreach ($schedules as $schedule) {
                $start = date('Y-m-d 00:00:00', strtotime($schedule->start_date));
                $end = date('Y-m-d 23:59:59', strtotime($schedule->end_date));
                $title = date('d-m-Y', strtotime($schedule->start_date)) . ' ' . date('d-m-Y', strtotime($schedule->end_date));
                $response[] = array(
                    'title' => substr($title, 0, 20),
                    'popover_title' => substr($title, 0, 300) . '...',
                    'start' => $start,
                    'end' => $end,
                    'allDay' => false,
                    'editable' => false,
                    'backgroundColor' => '#0078bc',
                    'borderColor' => '#0078bc',
                    'color' => 'white',
                    'data' => array(
                        'start' => $start,
                        'end' => $end,
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
        return $response;
    }

}
