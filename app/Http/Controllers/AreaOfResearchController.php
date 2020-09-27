<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\AreaOfResearch;

class AreaOfResearchController extends Controller
{
    //

    public function getArea($id){

    
        $area = AreaOfResearch::where('id',$id)->first();

        if($area != null){

            return $area;
        }
        else 
        {
            return null;
        }
    }

    public function updateArea(Request $request)
    {
        $area = AreaOfResearch::where('id',$request->area_id)->first();

        if($area !== null)
        {
            $area->name = $request->edited_area_name;
        
            if($area->save()){

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Area of research has been updated');

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

    public function deleteArea(Request $request){

        $area =AreaOfResearch::where('id',$request->area_ondelete_id)->first();

        if($area !== null){

            if(DB::table('areas_of_researches')->where('id',$request->area_ondelete_id)->delete()){

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
