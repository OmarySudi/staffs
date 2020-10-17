<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\StaffCategory;

class StaffCategoryController extends Controller
{
    //

    public function index(){

        $categories = StaffCategory::all();

        return response()->json($categories);

    }

    public function create(Request $request){

        if(count($request->fields) > 0 && $request->fields[0] != null)
        {
            foreach($request->fields as $field){

                $category = new StaffCategory();
                $category->name = $field;

                $category->save();
            }

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Category(s) have been added successfully');

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
        $category = StaffCategory::where('id',$request->edited_category_id)->first();

        if($category !== null)
        {
            $category->name = $request->edited_category_name;
        
            if($category->save()){

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Account type has been updated');

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

    public function getCategory($id)
    {

        $category = StaffCategory::where('id',$id)->first();

        if($category != null){

            return $category;
        }
        else 
        {
            return null;
        }
    }

    public function delete(Request $request){

        $category =StaffCategory::where('id',$request->category_ondelete_id)->first();

        if($category !== null){

            if(DB::table('staff_categories')->where('id',$request->category_ondelete_id)->delete()){

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
