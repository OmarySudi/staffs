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
use App\User;

class StaffController extends Controller
{
    
    private $page_limit = 15;

    private $staff_page_limit = 15;

    public function create(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'address' => 'required',
            'number' => 'required',
            'job_title' => 'required',
            'department_name' => 'required',
            'name_prefix' => 'required'
        ]);

        $signed_user = auth()->user();

        $checkedStaff = Staff::where('email',$request->user()->email)->first();

        if($checkedStaff != null){

            $checkedStaff->full_name = ucwords($request->name);
            $checkedStaff->address = $request->address;
            $checkedStaff->mobile_number = $request->number;
            $checkedStaff->job_title = $request->job_title;
            $checkedStaff->department_id = $request->department_name;

            $checkedStaff->name_prefix = $request->name_prefix;

           

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
            $staff->staff_category = $signed_user->account_type;
            $staff->mobile_number = $request->number;
            $staff->job_title = $request->job_title;
            $staff->department_id = $request->department_name;
            $staff->name_prefix = $request->name_prefix;

           

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
            '<div style="width: 11em;" class="staff">'.
                '<div class="row">'.
                    '<div class="card staff-card" style="width: 9rem;">'.
                        '<a href="'.route( "staffs.staff-info",["id" => $staff->id]).'">'.
                            '<img class="card-img-top" style="height:150px" src="images/'.$staff->profile_picture_path.'" alt="Card image cap">'.
                        '</a>'.
                    '</div>'.
                '</div>'.

                '<div class="row mt-3">'.
                    '<div style="width: 9rem;">'.
                        '<h6 class="font-weight-bold">'.$staff->name_prefix.'.'.$staff->full_name.'</h6>'.
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

    public function addAccounts(Request $request){

        $staff = Staff::where('email',$request->user()->email)->first();

        if($staff != null){

            if($request->has('linkedin'))
                $staff->linkedin = $request->linkedin;

            if($request->has('scholar'))
                $staff->scholar = $request->scholar;

            if($request->has('gate'))
                $staff->gate = $request->gate;

            if($request->has('academia'))
                $staff->academia = $request->academia;

            if($request->has('twitter'))
                $staff->twitter = $request->twitter;

            if($staff->save()){

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Accounts have been added successfully');

                return redirect()->route('home');
            }else {

                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'There is a problem , please try again');
        
                return redirect()->route('home');

            }

        } else {

            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'You need to fill personal details first');
    
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
                '<div style="width: 11em;" class="staff">'.
                    '<div class="row">'.
                        '<div class="card staff-card" style="width: 9rem;">'.
                            '<a href="'.route( "staffs.staff-info",["id" => $staff->id]).'">'.
                                '<img class="card-img-top" style="height:150px" src="images/'.$staff->profile_picture_path.'" alt="Card image cap">'.
                            '</a>'.
                        '</div>'.
                    '</div>'.

                    '<div class="row mt-3">'.
                        '<div style="width: 9rem;">'.
                            '<h6 class="font-weight-bold">'.$staff->name_prefix.'.'.$staff->full_name.'</h6>'.
                            '<h6 class="margin-top:-1">'.$staff->job_title.'</h6>'.
                        '</div>'.
                    '</div>'.
                '</div>';
        
            }

            return Response($output);
        }
    }

    public function searchByName(Request $request){

        if($request->ajax()){

            $output="";

            if($request->search == "")
            {
                $staffs = DB::table('staffs')
                    ->leftJoin('departments','staffs.department_id','departments.id')
                    ->select('staffs.*','departments.name as department_name')
                    ->limit($this->staff_page_limit)
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
                '<tr>'.
                '<td>'.$staff->full_name.'</td>'. 
                 '<td>'.$staff->email.'</td>'.
                   '<td>
                       <a href="'.route( "staffs.staff-info",["id" => $staff->id]).'">
                       <button 
                           type="button"
                           class="btn btn-sm btn-primary ml-5">
                           <i class="fa fa-eye" aria-hidden="true">&nbsp;View</i>
                       </button>
                       </a>

                       <button 
                           type="button" 
                           data-toggle="modal"
                           data-target = "#staffDeleteModal"
                           onclick="getStaff('.$staff->id.')";
                           class="btn  btn-sm btn-danger ml-5">
                           <i class="fa fa-trash" aria-hidden="true">&nbsp;Delete</i>
                       </button>

                   </td>'.
               '</tr>';
        
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
            '<div style="width: 11em;" class="staff">'.
                '<div class="row">'.
                    '<div class="card staff-card" style="width: 9rem;">'.
                        '<a href="'.route( "staffs.staff-info",["id" => $staff->id]).'">'.
                            '<img class="card-img-top" style="height:150px" src="images/'.$staff->profile_picture_path.'" alt="Card image cap">'.
                        '</a>'.
                    '</div>'.
                '</div>'.

                '<div class="row mt-3">'.
                    '<div style="width: 9rem;">'.
                        '<h6 class="font-weight-bold">'.$staff->name_prefix.'.'.$staff->full_name.'</h6>'.
                        '<h6 class="margin-top:-1">'.$staff->job_title.'</h6>'.
                    '</div>'.
                '</div>'.
            '</div>';
    
        }
    
        return Response($output);
    }

    public function getStaffs(Request $request){

        $staffs = DB::table('staffs')
            ->leftJoin('departments','staffs.department_id','departments.id')
            ->select('staffs.*','departments.name as department_name')
            ->limit($this->staff_page_limit)
            ->get();

        return Response($staffs);
    }

    public function deleteStaff(Request $request){

        $staff = Staff::where('id',$request->staff_ondelete_id)->first();

        $user = User::where('email',$staff->email)->first();

        if($staff !== null && $user !== null){

            if(DB::table('staffs')->where('id',$request->staff_ondelete_id)->delete() 
                && DB::table('users')->where('email',$user->email)->delete())
            {

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

    public function getStaffInfo($id){

        $staff = Staff::where('id',$id)->first();

        if($staff != null){

            return $staff;
        }
        else 
        {
            return null;
        }
    }
    
    public function getTotalPages(){

        $all_staffs = DB::table('staffs')
            ->leftJoin('departments','staffs.department_id','departments.id')
            ->select('staffs.*','departments.name as department_name')
            ->get();

        $total_pages = (int) ceil($all_staffs->count()/$this->staff_page_limit);

        return response($total_pages);
    }

    public function getPage(Request $request){

        $output = "";

        $all_staffs = DB::table('staffs')
            ->leftJoin('departments','staffs.department_id','departments.id')
            ->select('staffs.*','departments.name as department_name')
            ->offset($request->page_offset)
            ->limit($this->staff_page_limit)
            ->get();

            foreach($all_staffs as $key => $staff){

                $output.=
                '<tr>'.
                 '<td>'.$staff->full_name.'</td>'. 
                  '<td>'.$staff->email.'</td>'.
                    '<td>
                        <a href="'.route( "staffs.staff-info",["id" => $staff->id]).'">
                        <button 
                            type="button"
                            class="btn btn-sm btn-primary ml-5">
                            <i class="fa fa-eye" aria-hidden="true">&nbsp;View</i>
                        </button>
                        </a>

                        <button 
                            type="button" 
                            data-toggle="modal"
                            data-target = "#staffDeleteModal"
                            onclick="getStaff('.$staff->id.')";
                            class="btn  btn-sm btn-danger ml-5">
                            <i class="fa fa-trash" aria-hidden="true">&nbsp;Delete</i>
                        </button>

                    </td>'.
                '</tr>';
            }

        return Response($output);
    }
    
}
