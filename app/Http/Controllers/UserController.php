<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
    //
    private $page_limit = 20;

    public function verifyUser(Request $request){

        $user =User::where('id',$request->user_onverify_id)->first();

        if($user !== null){

            $user->verified = 1;

            if($user->save()){

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'User has been successfully verified');

                return redirect()->route('home');
            }
            else {

                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'The verifying of user has failed, please try again');
    
                return redirect()->route('home');
            }

        } else {

            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Error you are trying to verify non existent field');

            return redirect()->route('home');
        }
    }

    public function denyVerification($id){

    }

    public function getUser($id){

        $user = User::where('id',$id)->first();

        if($user != null){

            return $user;
        }
        else 
        {
            return null;
        }
    }

    public function getTotalPages(){

        $users = DB::table('users')
                    ->select('users.*')
                    ->where(['users.verified'=>0])
                    ->get();

        $total_pages = (int) ceil($users->count()/$this->page_limit);

        return response($total_pages);
    }


    public function searchByName(Request $request){

        if($request->ajax()){

            $output="";

            if($request->search == "")
            {
                $users = DB::table('users')
                    ->select('users.*')
                    ->where(['users.verified'=>0])
                    ->limit($this->page_limit)
                    ->get();
            }
            else {

                $users = DB::table('users')
                    ->select('users.*')
                    ->where(['users.verified'=>0])
                    ->where('users.name','LIKE',$request->search.'%')
                    ->get();
                }
            
                foreach($users as $key => $user){

                    $output.=
                    '<tr>'.
                     '<td>'.$user->name.'</td>'. 
                      '<td>'.$user->email.'</td>'.
                        '<td>
                            <button 
                                type="button" 
                                data-toggle="modal"
                                data-target = "#RequestVerifyModal"
                                onclick="getUser('.$user->id.')";
                                class="btn  btn-sm btn-success ml-5">
                                <i class="fa fa-check" aria-hidden="true">&nbsp;Verify</i>
                            </button>
    
                        </td>'.
                    '</tr>';
                }

            return Response($output);
        }
    }

    public function getPage(Request $request){

        $output = "";

        $users = DB::table('users')
            ->select('users.*')
            ->where(['users.verified'=>0])
            ->offset($request->page_offset)
            ->limit($this->page_limit)
            ->get();

        foreach($users as $key => $user){

                $output.=
                '<tr>'.
                 '<td>'.$user->name.'</td>'. 
                  '<td>'.$user->email.'</td>'.
                    '<td>
                        <button 
                            type="button" 
                            data-toggle="modal"
                            data-target = "#RequestVerifyModal"
                            onclick="getUser('.$user->id.')";
                            class="btn  btn-sm btn-success ml-5">
                            <i class="fa fa-check" aria-hidden="true">&nbsp;Verify</i>
                        </button>

                    </td>'.
                '</tr>';
            }

        return Response($output);
    }
}
