<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Staff;
use App\RoleStaff;
use App\Department;
use App\CourseStaff;
use App\AreaOfResearch;
use App\Skill;
use App\Course;

class StaffController extends Controller
{
    
    private $page_limit = 15;

    public function create(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'address' => 'required',
            'number' => 'required',
            'account_type' => 'required',
            'job_title' => 'required',
            'department_name' => 'required'
        ]);

        $checkedStaff = Staff::where('email',$request->user()->email)->first();

        if($checkedStaff != null){
            $checkedStaff->full_name = ucwords($request->name);
            $checkedStaff->address = $request->address;
            $checkedStaff->mobile_number = $request->number;
            $checkedStaff->staff_category = $request->account_type;
            $checkedStaff->job_title = $request->job_title;
            $checkedStaff->department_id = $request->department_name;

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
            $staff->full_name = ucwords($request->name);
            $staff->address = $request->address;
            $staff->mobile_number = $request->number;
            $staff->staff_category = $request->account_type;
            $staff->job_title = $request->job_title;
            $staff->department_id = $request->department_name;


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

       if($staff->department_id === null)
       {
            $department = '';
       }
       else
        $department = Department::where('id',$staff->department_id)->get();

       $roles = $staff->roles;

       $courses = $staff->courses;

       $projects = $staff->projects;

       $areas = $staff->areas;

       $skills = $staff->user_skills;

    //    $publications = $staff->publications;

       $publications = DB::table('publications')
                            ->join('publication_types','publications.type_id','publication_types.id')
                            ->select('publications.*','publication_types.name as category')
                            ->where('publications.staff_id',$request->id)
                            ->get();

       $education_histories = $staff->educationHistories;

       $employment_histories = $staff->employmentHistories;


       return view('staff',[
        'staff' => $staff,
        'department'=>$department,
        'education' => $education_histories,
        'employment' => $employment_histories,
        'projects' => $projects,
        'skills' => $skills,
        'areas' => $areas,
        'publications' => $publications,
        'roles' => $roles,
        'courses' => $courses
        ]);
    }

    public function addJobDetails(Request $request){

        $staff = Staff::where('email',$request->user()->email)->first();

        if(count($request->fields) > 0)
        {
            foreach($request->fields as $field){

                $skill = new Course();
                $skill->staff_id = $staff->id;
                $skill->name = $field;

                $skill->save();
            }

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Courses have been added successfully');

            return redirect()->route('home');
        } 
        else {

            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'You need to send at least one field, please try again');
    
            return redirect()->route('home');
        }
    }

    public function searchByDepartment($id){

        $output="";

        // if($request->search == "")
        // {
        //     $staffs = DB::table('staffs')
        //         ->leftJoin('departments','staffs.department_id','departments.id')
        //         ->select('staffs.*','departments.name as department_name')
        //         ->limit($this->page_limit)
        //         ->get();
        // }
        // else {

        // $staffs = DB::table('staffs')
        //     ->leftJoin('departments','staffs.department_id','departments.id')
        //     ->select('staffs.*','departments.name as department_name')
        //     ->where('staffs.full_name','LIKE',$request->search.'%')
        //     ->get();
        // }

        $department = Department::find($id);

        $staffs = $department->staffs;
        
        foreach($staffs as $key => $staff){

            $output.=
            '<div style="width: 11em;" class="mr-1 mb-4">'.
                '<div class="row">'.
                    '<div class="card mr-4 mb-4 staff-card" style="width: 9rem;">'.
                        '<a href="'.route( "staffs.staff-info",["id" => $staff->id]).'">'.
                            '<img class="card-img-top" style="height:150px" src="images/'.$staff->profile_picture_path.'" alt="Card image cap">'.
                        '</a>'.
                    '</div>'.
                '</div>'.

                '<div class="row">'.
                    '<div style="width: 9rem;">'.
                        '<h5 class="font-weight-bold">'.$staff->full_name.'</h5>'.
                        '<h6 class="margin-top:-1">'.$staff->job_title.'</h6>'.
                    '</div>'.
                '</div>'.
            '</div>';
    
        }

        return Response($output);
        
    }

    public function addSkills(Request $request){

        $staff = Staff::where('email',$request->user()->email)->first();

        if(count($request->fields) > 0)
        {
            foreach($request->fields as $field){

                $skill = new Skill();
                $skill->staff_id = $staff->id;
                $skill->name = $field;

                $skill->save();
            }

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Skills have been added successfully');

            return redirect()->route('home');
        } 
        else {

            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'You need to send at least one field, please try again');
    
            return redirect()->route('home');
        }
    }

    public function addAreasOfResearch(Request $request){

        $staff = Staff::where('email',$request->user()->email)->first();

        // if($staff){

        //     if(count($request->fields) > 0)
        //         $staff->areas_of_research = implode(",",$request->fields);
        //     else
        //         $staff->areas_of_research = $request->fields[0];
            
        //     if($staff->save()){
    
        //         $request->session()->flash('message.level', 'success');
        //         $request->session()->flash('message.content', ' Areas of research have been updated successfully');
    
        //         return redirect()->route('home');
    
        //     } else {
    
        //         $request->session()->flash('message.level', 'danger');
        //         $request->session()->flash('message.content', 'There is problem, please try again');
    
        //         return redirect()->route('home');
        //     };
        // }
        // else {

        //     $staff->areas_of_research = $request->areas;

        //     if($staff->save()){
    
        //         $request->session()->flash('message.level', 'success');
        //         $request->session()->flash('message.content', 'Areas have been added successfully');
    
        //         return redirect()->route('home');
    
        //     } else {
    
        //         $request->session()->flash('message.level', 'danger');
        //         $request->session()->flash('message.content', 'There is problem in addition of Areas of research, please try again');
    
        //         return redirect()->route('home');
        //     };
        // }

        if(count($request->fields) > 0)
        {
            foreach($request->fields as $field){

                $area_of_research = new AreaOfResearch();
                $area_of_research->staff_id = $staff->id;
                $area_of_research->name = $field;

                $area_of_research->save();
            }

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Areas have been added successfully');

            return redirect()->route('home');
        } 
        else {

            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'You need to send at least one field, please try again');
    
            return redirect()->route('home');
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

            if($request->search == "")
            {
                $staffs = DB::table('staffs')
                    ->leftJoin('departments','staffs.department_id','departments.id')
                    ->select('staffs.*','departments.name as department_name')
                    ->limit($this->page_limit)
                    ->get();
            }
            else {

            $staffs = DB::table('staffs')
                ->leftJoin('departments','staffs.department_id','departments.id')
                ->select('staffs.*','departments.name as department_name')
                ->where('staffs.full_name','LIKE',$request->search.'%')
                ->get();
            }
            
            foreach($staffs as $key => $staff){

                $output.=
                '<div style="width: 11em;" class="mr-1 mb-4">'.
                    '<div class="row">'.
                        '<div class="card mr-4 mb-4 staff-card" style="width: 9rem;">'.
                            '<a href="'.route( "staffs.staff-info",["id" => $staff->id]).'">'.
                                '<img class="card-img-top" style="height:150px" src="images/'.$staff->profile_picture_path.'" alt="Card image cap">'.
                            '</a>'.
                        '</div>'.
                    '</div>'.

                    '<div class="row">'.
                        '<div style="width: 9rem;">'.
                            '<h5 class="font-weight-bold">'.$staff->full_name.'</h5>'.
                            '<h6 class="margin-top:-1">'.$staff->job_title.'</h6>'.
                        '</div>'.
                    '</div>'.
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

    public function getAllStaffs(){

        $output="";

        $staffs = DB::table('staffs')
                ->leftJoin('departments','staffs.department_id','departments.id')
                ->select('staffs.*','departments.name as department_name')
                ->limit($this->page_limit)
                ->get();

        foreach($staffs as $key => $staff){

            $output.=
            '<div style="width: 11em;" class="mr-1 mb-4">'.
                '<div class="row">'.
                    '<div class="card mr-4 mb-4 staff-card" style="width: 9rem;">'.
                        '<a href="'.route( "staffs.staff-info",["id" => $staff->id]).'">'.
                            '<img class="card-img-top" style="height:150px" src="images/'.$staff->profile_picture_path.'" alt="Card image cap">'.
                        '</a>'.
                    '</div>'.
                '</div>'.

                '<div class="row">'.
                    '<div style="width: 9rem;">'.
                        '<h5 class="font-weight-bold">'.$staff->full_name.'</h5>'.
                        '<h6 class="margin-top:-1">'.$staff->job_title.'</h6>'.
                    '</div>'.
                '</div>'.
            '</div>';
    
        }
    
        return Response($output);
    }
}
