<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StaffCategory;

class StaffCategoryController extends Controller
{
    //

    public function index(){

        $categories = StaffCategory::all();

        return response()->json($categories);

    }
}
