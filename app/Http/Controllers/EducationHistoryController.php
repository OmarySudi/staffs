<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\EducationHistory;
use App\Staff;

class EducationHistoryController extends Controller
{
    //

    public function create(Request $request)
    {
        // $this->validate($request,[
        //     'facult' => 'required',
        //     'college' => 'required',
        //     'year' => 'required',
        //     'award' => 'required'
        // ]);

        // $this->validate($request,[
        //     'facult'=> 'required',
        // ]);

            
      
        $education_history = new EducationHistory();

        $staff = Staff::where('email',$request->user()->email)->first();

        $education_history->staff_id = $staff->id;
        $education_history->course = $request->faculty;
        $education_history->award = $request->award;

        switch($request->award){

            case 'Bachelor of Arts Degree':
                    $education_history->award_acronym = 'B.A';
                break;

            case 'Masters of Science Degree':
                    $education_history->award_acronym = 'M.Sc';
                break;

            case 'Bachelor of Science Degree':
                    $education_history->award_acronym = 'B.Sc';
                break;

            case 'Masters of Arts Degree':
                    $education_history->award_acronym = 'M.A';
                break;
        }

        $education_history->university = $request->college;
        $education_history->year = $request->year;

        if($education_history->save()){

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Education history has been added');

            return redirect()->route('home');

        } else {

            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'The addition of education history has failed, please try again');

            return redirect()->route('home');
        };
    }


    public function deleteHistory(Request $request){

        $education_history = EducationHistory::where('id',$request->ondelete_id)->first();

        if($education_history !== null){

            if(DB::table('education_histories')->where('id',$request->ondelete_id)->delete()){

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

    public function updateHistory(Request $request)
    {
        $education_history = EducationHistory::where('id',$request->education_id)->first();

        if($education_history !== null)
        {

            $education_history->course = $request->faculty;
            $education_history->award = $request->award;

            switch($request->award){

                case 'Bachelor of Arts Degree':
                        $education_history->award_acronym = 'B.A';
                    break;

                case 'Masters of Science Degree':
                        $education_history->award_acronym = 'M.Sc';
                    break;

                case 'Bachelor of Science Degree':
                        $education_history->award_acronym = 'B.Sc';
                    break;

                case 'Masters of Arts Degree':
                        $education_history->award_acronym = 'M.A';
                    break;
            }

            $education_history->university = $request->college;
            $education_history->year = $request->year;

            if($education_history->save()){

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Education history has been updated successfully');

                return redirect()->route('home');

            } else {

                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Update failed, please try again');

                return redirect()->route('home');
            };
        } else {

                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Error, You are trying to update non existence record');

                return redirect()->route('home');
        }
        
    }


    public function getStaffEducationHistory($email){

    
        $staff = Staff::where('email',$email)->first();

        if($staff !== null){

            $histories = Staff::find($staff->id)->educationHistories;

            
            return $histories;
        }
        else 
        {
            return response()->json("There is no staff data with id of ".$id);
        }
    }

    public function getEducationHistory($id){

    
        $education = EducationHistory::where('id',$id)->first();

        if($education != null){

            // return view('home',['education'=>$education]);
            return $education;
        }
        else 
        {
            return null;
        }
    }
}
