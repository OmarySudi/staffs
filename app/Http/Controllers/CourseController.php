<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Course;

class CourseController extends Controller
{
    //
    public function getCourses($id){

        $department = Department::find($id);

        return $department->courses;
    }


    public function getCourse($id){

    
        $course = Course::where('id',$id)->first();

        if($course != null){

            return $course;
        }
        else 
        {
            return null;
        }
    }

    public function updateCourse(Request $request)
    {
        $course = Course::where('id',$request->course_id)->first();

        if($course !== null)
        {
            $course->name = $request->edited_course_name;
        
            if($course->save()){

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'course has been updated');

                return redirect()->route('home');

            } else {

                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Update failed, please try again');

                return redirect()->route('home');
            };
        } else {

                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Error, You are trying to update non existent record');

                return redirect()->route('home');
        }
        
    }

    public function deleteCourse(Request $request){

        $course =Course::where('id',$request->course_ondelete_id)->first();
        
        if($course !== null){

            if(DB::table('staff_courses')->where('id',$request->course_ondelete_id)->delete()){

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Record has been deleted');

                return redirect()->route('home');

            } else {

                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'The delete of record has failed, please try again');
    
                return redirect()->route('home');
            }

        } else {

            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Error you are trying to delete non existent field');

            return redirect()->route('home');
        }

    }
}
