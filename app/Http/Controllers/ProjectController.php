<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Project;
use App\Staff;

class ProjectController extends Controller
{
    //

    public function create(Request $request){

        $this->validate($request,[
                'project_title' => 'required',
                'project_year' => 'required',
            ]);

            $project = new Project();

            $staff = Staff::where('email',$request->user()->email)->first();

            $project->staff_id = $staff->id;
            $project->title = $request->project_title;
            $project->description = $request->project_description;
            $project->year = $request->project_year;
           
            if($project->save()){

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Project has been added');

                return redirect()->route('home');

            } else {

                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'The addition of project has failed, please try again');

                return redirect()->route('home');
            };

       } 

       public function getProject($id){

    
        $project = Project::where('id',$id)->first();

        if($project != null){

            return $project;
        }
        else 
        {
            return null;
        }
    }

    public function updateProject(Request $request)
    {
        $project = Project::where('id',$request->project_id)->first();

        if($project !== null)
        {
            $project->title = $request->edited_project_title;
            $project->description = $request->edited_project_description;
            $project->year = $request->edited_project_year;
          
            if($project->save()){

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Project has been updated');

                return redirect()->route('home');

            } else {

                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Project update ailed, please try again');

                return redirect()->route('home');
            };
        } else {

                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Error, You are trying to update non existent record');

                return redirect()->route('home');
        }
        
    }

    public function deleteProject(Request $request){

        $project = Project::where('id',$request->project_ondelete_id)->first();

        if($project !== null){

            if(DB::table('projects')->where('id',$request->project_ondelete_id)->delete()){

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
