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

        $departments = Department::all();

        $roles = Role::all();

        if($staff !== null){

            $education_histories = Staff::find($staff->id)->educationHistories;

            $employment_histories = Staff::find($staff->id)->employmentHistories;

            return view('home',[
                'employment_histories' => $employment_histories,
                'education_histories'=>$education_histories,
                'departments' => $departments,
                'roles' => $roles,
                'staff' => $staff,
                'education' => '',
                'employment' => '',
                ]);

        }
        else {

            // $staff = { };
            // $employment_histories = [];
            // $education_histories = [];

            return view('home',[
                'employment_histories' => '',
                'education_histories'=>'',
                'departments' => $departments,
                'roles' => $roles,
                'staff' => '',
                'education' => '',
                'employment' => '',
                ]);
        }

    }
}
