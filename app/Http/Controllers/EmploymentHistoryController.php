<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\EmploymentHistory;
use App\Staff;

class EmploymentHistoryController extends Controller
{
    

       public function create(Request $request){

        $this->validate($request,[
                'position' => 'required',
                'place' => 'required',
                'start_year' => 'required',
                'end_year' => 'required'
            ]);

            $employment_history = new EmploymentHistory();

            $staff = Staff::where('email',$request->user()->email)->first();

            $employment_history->staff_id = $staff->id;
            $employment_history->position = $request->position;
            $employment_history->place = $request->place;
            $employment_history->start_year = $request->start_year;
            $employment_history->end_year = $request->end_year;

            if($employment_history->save()){

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Employment history has been added');

                return redirect()->route('home');

            } else {

                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'The addition of employment history has failed, please try again');

                return redirect()->route('home');
            };

       }   

       public function getStaffEmploymentHistory($email){

    
        $staff = Staff::where('email',$email)->first();

        if($staff !== null){

            $histories = Staff::find($staff->id)->employmentHistories;

            return $histories;
        }
        else 
        {
            return response()->json("There is no staff data with id of ".$id);
        }
    }

    public function getEmploymentHistory($id){

    
        $employment = EmploymentHistory::where('id',$id)->first();

        if($employment != null){

            return $employment;
        }
        else 
        {
            return null;
        }
    }

    public function updateHistory(Request $request)
    {
        $employment_history = EmploymentHistory::where('id',$request->employment_id)->first();

        if($employment_history !== null)
        {
            $employment_history->position = $request->position;
            $employment_history->place = $request->place;
            $employment_history->start_year = $request->start_year;
            $employment_history->end_year = $request->end_year;

            if($employment_history->save()){

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Employment history has been updated');

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

    public function deleteHistory(Request $request){

        $employment_history = EmploymentHistory::where('id',$request->employment_ondelete_id)->first();

        if($employment_history !== null){

            if(DB::table('employment_histories')->where('id',$request->employment_ondelete_id)->delete()){

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
