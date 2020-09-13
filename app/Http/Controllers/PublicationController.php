<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publication;
use Illuminate\Support\Facades\DB;
use App\Staff;

class PublicationController extends Controller
{
    //
    public function create(Request $request){

        $publication = new Publication();

        $staff = Staff::where('email',$request->user()->email)->first();

        $publication->staff_id = $staff->id;
        $publication->type_id = $request->publication_type;

        if($request->has("year"))
            $publication->year = $request->year;

        if($request->has("city"))
            $publication->city = $request->city;
        
        if($request->has("link"))
            $publication->link = $request->link;

        if($request->has("publication_name"))
            $publication->conference_publication_name = $request->publication_name;

        if($request->has("journal_name"))
            $publication->journal_name = $request->journal_name;

        if($request->has("issue"))
            $publication->issue = $request->issue;

        if($request->has("volume"))
            $publication->volume = $request->volume;

        if($request->has("page"))
            $publication->page = $request->page;

        if($request->has("publisher"))
            $publication->publisher = $request->publisher;
        
        if($publication->save()){

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Publication has been added');

            return redirect()->route('home');

        } else {

            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Publication has failed, please try again');

            return redirect()->route('home');
        };

       } 

       public function getPublication($id){

        // $publication = Publication::where('id',$id)->first();

        $publication = DB::table('publications')
                    ->join('publication_types','publications.type_id','publication_types.id')
                    ->select('publications.*','publication_types.name')
                    ->where('publications.id',$id)
                    ->get();

        if($publication != null){

            return $publication;
        }
        else 
        {
            return null;
        }
    }

    public function updatePublication(Request $request)
    {
        $publication = Publication::where('id',$request->publication_id)->first();

        if($publication !== null)
        {
            $employment_history->position = $request->position;
            $employment_history->place = $request->place;
            $employment_history->start_year = $request->start_year;
            $employment_history->end_year = $request->end_year;


            if($request->has)

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

    public function updateJournalPublication(Request $request){

        $publication = Publication::where('id',$request->publication_id)->first();

        if($publication !== null)
        {
            $publication->journal_name = $request->edited_journal_name;
            $publication->publisher = $request->journal_edited_publisher;
            $publication->year = $request->journal_edited_year;
            $publication->link = $request->journal_edited_link;

            if($publication->save()){

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Publication has been updated');

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

    public function updateBookPublication(Request $request){

      

        $publication = Publication::where('id',$request->publication_id)->first();

        if($publication !== null)
        {
            $publication->publisher = $request->book_edited_publisher;
            $publication->page = $request->edited_page;
            $publication->volume = $request->edited_volume;
            $publication->issue = $request->edited_issue;
            $publication->link = $request->book_edited_link;

            if($publication->save()){

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Publication has been updated');

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
        
    public function updateComferencePublication(Request $request){

        $publication = Publication::where('id',$request->publication_id)->first();

        if($publication !== null)
        {
            $publication->conference_publication_name = $request->edited_publication_name;
            $publication->city = $request->edited_city;
            $publication->year = $request->comference_year;
            $publication->link = $request->comference_link;

            if($publication->save()){

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Publication has been updated');

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

    public function deletePublication(Request $request){

        $publication = Publication::where('id',$request->publication_id)->first();

        if($publication !== null){

            if(DB::table('publications')->where('id',$request->publication_id)->delete()){

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
