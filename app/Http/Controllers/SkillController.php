<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Skill;

class SkillController extends Controller
{
    //

    public function getSkill($id){

    
        $skill = Skill::where('id',$id)->first();

        if($skill != null){

            return $skill;
        }
        else 
        {
            return null;
        }
    }

    public function updateSkill(Request $request)
    {
        $skill = Skill::where('id',$request->skill_id)->first();

        if($skill !== null)
        {
            $skill->name = $request->edited_skill_name;
        
            if($skill->save()){

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Skill has been updated');

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

    public function deleteSkill(Request $request){

        $skill =Skill::where('id',$request->skill_ondelete_id)->first();

        if($skill !== null){

            if(DB::table('skills')->where('id',$request->skill_ondelete_id)->delete()){

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
