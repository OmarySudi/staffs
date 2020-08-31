<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class CourseController extends Controller
{
    //
    public function getCourses($id){

        $department = Department::find($id);

        return $department->courses;
    }
}
