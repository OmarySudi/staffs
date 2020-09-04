<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Staff;

class FrontEndController extends Controller
{
    //
    public function index(){

        //$staffs = Staff::All();

        $staffs = DB::table('staffs')
                    ->join('departments','staffs.department_id','departments.id')
                    ->select('staffs.*','departments.name as department_name')
                    ->get();

        return view('welcome',['staffs' => $staffs]);
    }
}
