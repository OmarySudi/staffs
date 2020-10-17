<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Department;

class DepartmentController extends Controller
{
    //
    public function index(){

        $departments = Department::all();

        return response()->json($departments);

    }

    public function create(Request $request){

        if(count($request->fields) > 0 && $request->fields[0] != null)
        {
            foreach($request->fields as $field){

                $department = new Department();
                $department->name = $field;

                $department->save();
            }

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Department(s) have been added successfully');

            return redirect()->route('home');
        } 
        else {

            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'You need to send at least one field, please try again');
    
            return redirect()->route('home');
        }

    }

    public function update(Request $request)
    {
        $department = Department::where('id',$request->edited_department_id)->first();

        if($department !== null)
        {
            $department->name = $request->edited_department_name;
        
            if($department->save()){

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Department has been updated');

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

    public function getDepartment($id){

        $department = Department::where('id',$id)->first();

        if($department != null){

            return $department;
        }
        else 
        {
            return null;
        }
    }

    public function delete(Request $request){

        $department =Department::where('id',$request->department_ondelete_id)->first();

        if($department !== null){

            if(DB::table('departments')->where('id',$request->department_ondelete_id)->delete()){

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
