<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;

class FrontEndController extends Controller
{
    //
    public function index(){

        $staffs = Staff::All();

        return view('welcome',['staffs' => $staffs]);
    }
}
