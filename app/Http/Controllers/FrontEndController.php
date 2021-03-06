<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Staff;
use App\Department;

class FrontEndController extends Controller
{
    //
    private $page_limit = 15;

    public function index(){

        $staffs = DB::table('staffs')
                    ->leftJoin('departments','staffs.department_id','departments.id')
                    ->select('staffs.*','departments.name as department_name')
                    ->limit($this->page_limit)
                    ->get();

        $departments = Department::all();

        return view('welcome',[
                'staffs' => $staffs,
                'departments' => $departments,
                ]);
    }

    public function getTotalPages(){

        $all_staffs = DB::table('staffs')
            ->leftJoin('departments','staffs.department_id','departments.id')
            ->select('staffs.*','departments.name as department_name')
            ->get();

        $total_pages = (int) ceil($all_staffs->count()/$this->page_limit);

        return response($total_pages);
    }

    public function getPage(Request $request){

        $output = "";

        $all_staffs = DB::table('staffs')
            ->leftJoin('departments','staffs.department_id','departments.id')
            ->select('staffs.*','departments.name as department_name')
            ->offset($request->page_offset)
            ->limit($this->page_limit)
            ->get();

            foreach($all_staffs as $key => $staff){

                $output.=
                // '<div class="card mr-4 mb-4 staff-card" style="width: 10rem;">'.
                //     '<a href="'.route( "staffs.staff-info",["id" => $staff->id]).'">'.
                //         '<img class="card-img-top" style="height:120px" src="images/'.$staff->profile_picture_path.'" alt="Card image cap">'.
                //         '<div class="card-body pl-1">'.
                //             '<h5 class="font-weight-bold">'.$staff->full_name.'</h5>'.
                //             '<h6 class="margin-top:-1">'.$staff->job_title.'</h6>'.
                //         '</div>'.
                //     '</a>'.
                // '</div>';

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
