<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Staff;
use App\RoleStaff;
use App\Department;
use App\CourseStaff;

class StaffController extends Controller
{
    
    public function create(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'address' => 'required',
            'number' => 'required',
        ]);

        $checkedStaff = Staff::where('email',$request->user()->email)->first();

        if($checkedStaff != null){

            $checkedStaff->full_name = $request->name;
            $checkedStaff->address = $request->address;
            $checkedStaff->mobile_number = $request->number;

            if($request->has('picture')){

                $path = $request->file('picture')->store('public/images');

                $position = strrpos($path,"/");

                $name = substr($path,$position+1);

                $checkedStaff->profile_picture_path = $name;
            }
            
            if($checkedStaff->save()){

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Personal details has been updated successfully');

                return redirect()->route('home');

            } else {

                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'There is problem, please try again later');

                return redirect()->route('home');
            };

        }
        else {

            $staff = new Staff();

            $staff->email = $request->user()->email;
            $staff->full_name = $request->name;
            $staff->address = $request->address;
            $staff->mobile_number = $request->number;

            if($request->has('picture')){

                $path = $request->file('picture')->store('public/images');

                $position = strrpos($path,"/");

                $name = substr($path,$position+1);

                $staff->profile_picture_path = $name;
            }

            if($staff->save()){

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Personal details has been added successfully');

                return redirect()->route('home');

            } else {

                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'There is problem in addition of personal details, please try again');

                return redirect()->route('home');
            };
        }
    }

    public function getStaff(Request $request){

       $staff =  Staff::find($request->id);

       $department = Department::where('id',$staff->department_id)->get();

       $roles = $staff->roles;

       $courses = $staff->courses;

       $education_histories = $staff->educationHistories;

       $employment_histories = $staff->employmentHistories;


       return view('staff',[
        'staff' => $staff,
        'department'=>$department,
        'education' => $education_histories,
        'employment' => $employment_histories,
        'roles' => $roles,
        'courses' => $courses
        ]);
    }

    public function addJobDetails(Request $request){

        $this->validate($request,[
            'role' => 'required',
            'department' => 'required'
        ]);

        $staff = Staff::where('email',$request->user()->email)->first();

        $courses = $staff->courses;

        $roles = $staff->roles;

        if($staff){


            if(count($roles) > 0)
            {
                DB::table('role_staff')->where('staff_id',$staff->id)->delete();

                for($i=0; $i<count($request->role); $i++)
                {
         
                    $role_staff = new RoleStaff();
    
                    $role_staff->role_id = $request->role[$i];
                    $role_staff->staff_id = $staff->id;
                    $role_staff->save();
                }


            } else {

                for($i=0; $i<count($request->role); $i++)
                {
         
                    $role_staff = new RoleStaff();
    
                    $role_staff->role_id = $request->role[$i];
                    $role_staff->staff_id = $staff->id;
                    $role_staff->save();
                }
            }
           

            if($request->has('courses')){

                if(count($courses) > 0)
                {

                    DB::table('course_staff')->where('staff_id',$staff->id)->delete();

                    for($i=0; $i<count($request->courses); $i++)
                    {
             
                        $course_staff = new CourseStaff();
                        
                        $course_staff->course_id = $request->courses[$i];
                        $course_staff->staff_id = $staff->id;
                        $course_staff->save();
                    }
                    
                } else {

                    for($i=0; $i<count($request->courses); $i++)
                    {
             
                        $course_staff = new CourseStaff();
                        
                        $course_staff->course_id = $request->courses[$i];
                        $course_staff->staff_id = $staff->id;
                        $course_staff->save();
                    }
                }

               
            }

            $staff->department_id = $request->department;

            if($staff->save()){

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Operation completed successfully');
    
                return redirect()->route('home');
    
            } else {
    
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'There is problem, please try again');
    
                return redirect()->route('home');
            }
        }
    }

    public function addBiography(Request $request){

       
        $this->validate($request,[
            'biography' => 'required'
        ]);

        $staff = Staff::where('email',$request->user()->email)->first();

        $staff->biography = $request->biography;

        if($staff->save()){

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Biography has been added successfully');

            return redirect()->route('home');

        } else {

            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'There is problem in addition of biography details, please try again');

            return redirect()->route('home');
        };
    }
    
    public function searchByFacult(Request $request)
    {
        

        if($request->ajax()){

            $output="";

            $staffs = DB::table('staffs')
                ->join('departments','staffs.department_id','departments.id')
                ->select('staffs.*','departments.name as department_name')
                ->where('staffs.full_name','LIKE',$request->search.'%')
                ->get();

            foreach($staffs as $key => $staff){

                $output.=
                '<div class="card mr-5 staff-card" style="width: 10rem;">'.
                    '<a href="'.route( "staffs.staff-info",["id" => $staff->id]).'">'.
                        '<img class="card-img-top" style="height:120px" src="images/'.$staff->profile_picture_path.'" alt="Card image cap">'.
                        '<div class="card-body pl-1">'.
                            '<span class="font-weight-bold">'.$staff->full_name.'</span>'.
                        '</div>'.
                    '</a>'.
                '</div>';
        
            }

            return Response($output);
        }
    }

    public function addCurriculum(Request $request){

        $this->validate($request,[
            'curriculum' => 'required'
        ]);

        $staff = Staff::where('email',$request->user()->email)->first();

        $path = $request->file('curriculum')->store('public/cvs');

        $position = strrpos($path,"/");

        $name = substr($path,$position+1);

        $staff->cv_path = $name;

        if($staff->save()){

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Curriculum has been added successfully');

            return redirect()->route('home');

        } else {

            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'There is problem in addition of curriculum, please try again');

            return redirect()->route('home');
        };
    }
}
