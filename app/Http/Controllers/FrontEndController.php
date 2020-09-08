<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Staff;

class FrontEndController extends Controller
{
    //

    public function index(){

        $page_limit = 4;

        $staffs = DB::table('staffs')
                    ->join('departments','staffs.department_id','departments.id')
                    ->select('staffs.*','departments.name as department_name')
                    ->limit($page_limit)
                    ->get();

        return view('welcome',[
                'staffs' => $staffs
                ]);
    }

    public function getTotalPages(){

        $page_limit = 4;

        $all_staffs = DB::table('staffs')
            ->join('departments','staffs.department_id','departments.id')
            ->select('staffs.*','departments.name as department_name')
            ->get();

        $total_pages = (int) ceil($all_staffs->count()/$page_limit);

        return response($total_pages);
    }
}
