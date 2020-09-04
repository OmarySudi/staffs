<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\EducationHistory;
use App\Department;
use App\Role;
use App\EmploymentHistory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = auth()->user();

        $staff = Staff::where('email',$user->email)->first();

        if($staff){

            $staff_roles = $staff->roles;

            $staff_courses = $staff->courses;

            if($staff->department_id != null){

                $department = Department::where('id',$staff->department_id)->value('name');
    
            } else 
            {
                $department = '';
            }
        }
      

       

       

        $departments = Department::all();

        $roles = Role::all();

        if($staff !== null){

            $staff_roles = $staff->roles;

            $staff_courses = $staff->courses;

            if($staff->department_id != null){

                $department = Department::where('id',$staff->department_id)->value('name');
    
            } else 
            {
                $department = '';
            }

            $education_histories = Staff::find($staff->id)->educationHistories;

            $employment_histories = Staff::find($staff->id)->employmentHistories;

            return view('home',[
                'employment_histories' => $employment_histories,
                'education_histories'=>$education_histories,
                'departments' => $departments,
                'roles' => $roles,
                'department' => $department,
                'staff_roles' => $staff_roles,
                'staff_courses' => $staff_courses,
                'staff' => $staff,
                'education' => '',
                'employment' => '',
                ]);

        }
        else {

            // $staff = { };
            // $employment_histories = [];
            // $education_histories = [];

            $staff_roles = [];

            $staff_courses = [];

            $department = '';

            return view('home',[
                'employment_histories' => '',
                'education_histories'=>'',
                'departments' => $departments,
                'roles' => $roles,
                'department' => $department,
                'staff_roles' => $staff_roles,
                'staff_courses' => $staff_courses,
                'staff' => '',
                'education' => '',
                'employment' => '',
                ]);
        }

    }
}
