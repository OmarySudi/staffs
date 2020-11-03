
@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">

        <div class="container">

            <center>
                <div class="input-group mb-3" style="width:50%; height: 50px">
                    <input type="text" class="form-control" style="height:50px" id="search" name="search" placeholder="Search by staff name" arial-label="Search by staff name" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
            </center>
        
           
             <div class="row">

                <div class="col-12 align-self-end mb-2">

                    <div style="float:right">
                        <a href="#" id="previous" class="page-links">Previous</a><span> | </span><a href="#" class="page-links" id="next">Next</a>
                    </div>
                </div>
            </div>
                    
            <div class="row">

                <div class="col-12 col-sm-5 col-md-3">
                
                    <div class="form-group row">

                        <div class="col-12">

                            <select id="select-department" name="select-department" class="form-control">
                                <option value="all">All Departments</option>

                                @foreach($departments as $department)
                                    <option value="<?php echo $department->id?>">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-sm-7 col-md-9" >
                   
                    <div class="container-fluid">
                        <div class="row" id="staffs-row">

                            @foreach($staffs as $staff)
                                <div style="width: 11em;" class="mr-1 mb-4">
                                    <div class="row">
                                        <div class="card staff-card" style="width: 9rem;">
                                            <a href="{{ route('staffs.staff-info',['id' => $staff->id])}}">
                                                <img class="card-img-top" style="height:150px" src="<?php echo asset("images/$staff->profile_picture_path")?>" alt="Card image cap">
                                            </a>
                                        </div> 
                                    </div>
                                    <div class="row mt-3">
                                        <div style="width: 9rem;">
                                            <h6 class="font-weight-bold">{{ $staff->name_prefix}}. {{ $staff->full_name}}</h6>
                                            <h6 style="margin-top:-1">{{ $staff->job_title}}</h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
