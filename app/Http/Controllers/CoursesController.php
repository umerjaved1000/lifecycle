<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use Session;
use App\CourseFile;

class CoursesController extends Controller {

    public function index() {
        $get_courses = Course::all();
        return view('courses.index', array('courses' => $get_courses));
    }

    public function create() {
        return view('courses.add_courses');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'course_title' => 'required',
            'course_description' => 'required',
        ]);
        try {
            $store_courses = new Course;
            if (!empty($request->course_title)) {
                $store_courses->title = $request->course_title;
            }
            if (!empty($request->course_description)) {
                $store_courses->description = $request->course_description;
            }
            if (!empty($request->course_note)) {
                $store_courses->notes = $request->course_note;
            }
            $store_courses->save();
            $course_id = $store_courses->id;
            //     dd($course_id);
            $files = $request->file('course_material');
            if ($request->hasFile('course_material')) {
                foreach ($files as $file) {
                    $file_name = time() . $file->getClientOriginalName();
                    $file->move(base_path() . '/public/upload/', $file_name);
                    $data[] = [
                        'course_id' => $course_id,
                        'file' => $file_name,
                    ];
                }
                CourseFile::insert($data);
            }
            Session::flash('heading', 'Success!');
            Session::flash('message', 'Course has been added.');
            Session::flash('icon', 'success');
            return redirect('courses');
        } catch (\Exception $e) {
            Session::flash('heading', 'Error!');
            Session::flash('message', $e->getMessage());
            Session::flash('icon', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function delete(Request $request) {
        $course_id = Course::find($request->id);
        $course_id->delete();
        Session::flash('heading', 'Success!');
        Session::flash('message', 'Course has been deleted.');
        Session::flash('icon', 'success');
        return redirect('courses');
    }

    public function update(Request $request) {
        $course = Course::find($request->id);
        return view('courses.edit_course', ['course' => $course]);
    }

    public function edit(Request $request) {
        $update_courses = Course::find($request->course_id);

        $this->validate($request, [
            'course_title' => 'required',
            'course_description' => 'required',
        ]);
        try {
            if (!empty($request->course_title)) {
                $update_courses->title = $request->course_title;
            }
            if (!empty($request->course_description)) {
                $update_courses->description = $request->course_description;
            }
            if (!empty($request->course_note)) {
                $update_courses->notes = $request->course_note;
            }
            $course_id = $request->course_id;
            $files = $request->file('course_material');
            if ($request->hasFile('course_material')) {
                foreach ($files as $file) {
                    $file_name = time() . $file->getClientOriginalName();
                    $file->move(base_path() . '/public/upload/', $file_name);
                    $data[] = [
                        'course_id' => $course_id,
                        'file' => $file_name,
                    ];
                }
                CourseFile::insert($data);
            }
            $update_courses->save();
            Session::flash('heading', 'Success!');
            Session::flash('message', 'Course has been updated.');
            Session::flash('icon', 'success');
            return redirect('courses');
        } catch (\Exception $e) {
            Session::flash('heading', 'Error!');
            Session::flash('message', $e->getMessage());
            Session::flash('icon', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function course_files(Request $request) {
        $course = Course::find($request->id);
        $course_files = CourseFile::where('course_id', '=', $request->id)->get();
        //dd($course_files);
        return view('courses.course_files', array('course_files' => $course_files, 'course' => $course));
    }

    public function delete_file(Request $request) {
        $course_id = CourseFile::find($request->id);
        $course_id->delete();
        Session::flash('heading', 'Success!');
        Session::flash('message', 'File has been deleted.');
        Session::flash('icon', 'success');
        return back();
    }

}
