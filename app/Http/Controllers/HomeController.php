<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use Illuminate\Support\Facades\DB;
use App\EducationHistory;
use App\Department;
use App\Role;
use App\EmploymentHistory;
use App\StaffCategory;

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

        $page_limit = 15;

        $user = auth()->user();

        $staff = Staff::where('email',$user->email)->first();

        $all_staffs = DB::table('staffs')
            ->leftJoin('departments','staffs.department_id','departments.id')
            ->select('staffs.*','departments.name as department_name')
            ->limit($page_limit)
            ->get();

        $users = DB::table('users')
                ->select('users.*')
                ->where(['users.verified'=>0])
                ->limit($page_limit)
                ->get();

        // if($staff){

        //     $staff_roles = $staff->roles;

        //     $staff_courses = $staff->courses;

        //     if($staff->department_id != null){

        //         $department = Department::where('id',$staff->department_id)->value('name');
    
        //     } else 
        //     {
        //         $department = '';
        //     }
        // }
      
        $departments = DB::table('departments')
                    ->select('departments.*')
                    ->limit($page_limit)
                    ->get();

        $categories = StaffCategory::all();

        $roles = Role::all();

        if($staff !== null){

            $staff_roles = $staff->roles;

            $staff_skills = $staff->user_skills;

            $staff_areas = $staff->areas;

            $staff_courses = $staff->courses;

            if($staff->department_id != null){

                $department = Department::where('id',$staff->department_id)->value('name');
    
            } else 
            {
                $department = '';
            }

            $education_histories = Staff::find($staff->id)->educationHistories;

            $employment_histories = Staff::find($staff->id)->employmentHistories;

            $projects = Staff::find($staff->id)->projects;

            $publications = DB::table('publications')
                        ->join('staffs','publications.staff_id','staffs.id')
                        ->join('publication_types','publications.type_id','publication_types.id')
                        ->select('publications.*','publication_types.name')
                        ->where('publications.staff_id',$staff->id)
                        ->get();

            return view('home',[
                'employment_histories' => $employment_histories,
                'education_histories'=>$education_histories,
                'departments' => $departments,
                'publications' => $publications,
                'projects' => $projects,
                'roles' => $roles,
                'skills' => $staff_skills,
                'categories' => $categories,
                'areas' => $staff_areas,
                'all_staffs' =>$all_staffs,
                'users' =>$users,
                'department' => $department,
                'staff_roles' => $staff_roles,
                'courses' => $staff_courses,
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

            $staff_courses = '';

            $staff_skills = '';

            $staff_areas = '';

            $department = '';

            //$departments = '';

            //$categories = '';

            return view('home',[
                'employment_histories' => '',
                'education_histories'=>'',
                'projects'=>'',
                'publications'=>'',
                'departments' => $departments,
                'roles' => $roles,
                'skills' => $staff_skills,
                'categories' => $categories,
                'areas' => $staff_areas,
                'department' => $department,
                'all_staffs' =>$all_staffs,
                'users' =>$users,
                'staff_roles' => $staff_roles,
                'courses' => $staff_courses,
                'staff' => '',
                'education' => '',
                'employment' => '',
                ]);
        }

    }
}
