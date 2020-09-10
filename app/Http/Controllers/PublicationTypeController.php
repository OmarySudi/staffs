<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PublicationType;

class PublicationTypeController extends Controller
{
    //

    public function index(){

        $publication_types = PublicationType::all();

        return response()->json($publication_types);
    }
}
