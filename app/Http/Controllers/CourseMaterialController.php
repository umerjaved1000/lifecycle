<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseMaterial;
use Session;
use App\User;
use App\Role;
use Auth;

class CourseMaterialController extends Controller {

    //
    public function saveCourseMaterial(Request $request) {
        try {
            $this->validate($request, [
                'booking_id' => 'required',
                'trainer_id' => 'required',
                'course_id' => 'required',
                'document_name' => 'required',
                'course_material' => 'required',
                'document_description' => 'required',
            ]);
           
            $store_courses_material = new CourseMaterial;
            $store_courses_material->booking_id = $request->booking_id;
            $store_courses_material->trainer_id = $request->trainer_id;
            $store_courses_material->course_id = $request->course_id;
            $store_courses_material->document_name = $request->document_name;
            $store_courses_material->description = $request->document_description;

            $file = \Request::file('course_material');

            if ($file) {
                $file_name = time() . $file->getClientOriginalName();
                $file->move(base_path() . '/public/upload/', $file_name);
                $store_courses_material->document_link = $file_name;
            }
            $store_courses_material->added_by = $request->added_by;
            $store_courses_material->save();
            Session::flash('heading', 'Success!');
            Session::flash('message', 'Course materail has been added');
            Session::flash('icon', 'success');
            return redirect('view-course-material/' . $request->booking_id);
        } catch (\Exception $e) {
            Session::flash('heading', 'Error!');
            Session::flash('message', $e->getMessage());
            Session::flash('icon', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function viewCourseMaterial(Request $request) {
        $get_course_materials = CourseMaterial::where('booking_id', '=', $request->id)->get();
//        dd($get_course_materials);
        return view('trainer-dashboard.view-course-material', ['get_course_materials' => $get_course_materials]);
    }

}
