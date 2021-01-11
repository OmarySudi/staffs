@extends('layouts.app')

@section('content')

<div class="container" style="width: 70%">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-9 mt-5">
            <!-- <div class="row"> -->
                <div class="staff-left-column">
                 
                    <h3>{{ $staff->name_prefix }}. {{ $staff->full_name }}</h3>
                    
                     <h4>{{ $staff->job_title}} </h4>

                     <div id="tabbed-content">

                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                          
                            @if($staff->staff_category == 'Academician')
                                <li class="nav-item" role="presentation" >
                                    <a class="nav-link active" id="pills-about-tab" data-toggle="pill" href="#pills-about" role="tab" aria-controls="pills-about" aria-selected="true">About</a>
                                </li>
                            @elseif($staff->staff_category == 'Administrative')
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-about-tab" data-toggle="pill" href="#pills-about" role="tab" aria-controls="pills-about" aria-selected="true">About</a>
                                </li>
                            @else
                                <li class="nav-item" role="presentation" >
                                    <a class="nav-link active" id="pills-about-tab" data-toggle="pill" href="#pills-about" role="tab" aria-controls="pills-about" aria-selected="true">About</a>
                                </li>
                            @endif

                            @if($staff->staff_category == 'Academician')
                                <li class="nav-item" role="presentation" >
                                    <a class="nav-link" id="pills-courses-tab" data-toggle="pill" href="#pills-courses" role="tab" aria-controls="pills-courses" aria-selected="false">Courses</a>
                                </li>
                                <li class="nav-item" role="presentation" >
                                    <a class="nav-link" id="pills-publications-tab" data-toggle="pill" href="#pills-publications" role="tab" aria-controls="pills-publications" aria-selected="false">Publications</a>
                                </li>
                                <li class="nav-item" role="presentation" >
                                    <a class="nav-link" id="pills-areas-tab" data-toggle="pill" href="#pills-areas" role="tab" aria-controls="pills-areas" aria-selected="false">Areas of research</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-projects-tab" data-toggle="pill" href="#pills-projects" role="tab" aria-controls="pills-projects" aria-selected="false">Projects</a>
                                </li>
                            @elseif($staff->staff_category == 'Administrative')
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-projects-tab" data-toggle="pill" href="#pills-projects" role="tab" aria-controls="pills-projects" aria-selected="false">Projects</a>
                                </li>
                              
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-skills-tab" data-toggle="pill" href="#pills-skills" role="tab" aria-controls="pills-skills" aria-selected="false">Skills</a>
                                </li>
                            @endif



                        </ul>
            
                        <div class="tab-content staff-dir" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-about" role="tabpanel" aria-labelledby="pills-about-tab">
                               
                                
                                <h2>Biography</h2>
                                {{ $staff->biography}}
                            </div>
                            <div class="tab-pane fade" id="pills-courses" role="tabpanel" aria-labelledby="pills-courses-tab">
                                <h2>Current Courses</h2>
                                <ul>

                                  @foreach($courses as $course)
                                    <li class="mt-3">{{ $course->name}}</li>
                                  @endforeach
                                </ul>
                              
                            </div>

                            <div class="tab-pane fade" id="pills-publications" role="tabpanel" aria-labelledby="pills-publications-tab">
    
                                @foreach($publications as $publication)
                                    <div class="card">
                                        <div class="card-body mb-4">
                                            <div class="row">
                                                @switch($publication->category)
                                                    @case("Journal Article")
                                                        <h5>
                                                            <span class="font-weight-bold">Publisher:</span> {{ $publication->publisher}} , 
                                                            <span class="font-weight-bold">Journal Name:</span> {{ $publication->journal_name}} ,
                                                            <span class="font-weight-bold">Year:</span> {{ $publication->year}}
                                                        </h5>
                                                    @break

                                                    @case("Book")
                                                        <h5>
                                                            <span class="font-weight-bold">Publisher:</span> {{ $publication->publisher}} , 
                                                            <span class="font-weight-bold">Pages:</span> {{ $publication->page}} ,
                                                            <span class="font-weight-bold">Volume:</span> {{ $publication->volume}} ,
                                                            <span class="font-weight-bold">Issue:</span> {{ $publication->issue}} ,

                                                        </h5>
                                                    @break

                                                    @case("Book Chapter")
                                                        <h5>
                                                            <span class="font-weight-bold">Publisher:</span> {{ $publication->publisher}} , 
                                                            <span class="font-weight-bold">Pages:</span> {{ $publication->page}} ,
                                                            <span class="font-weight-bold">Volume:</span> {{ $publication->volume}} ,
                                                            <span class="font-weight-bold">Issue:</span> {{ $publication->issue}} ,
                                                        </h5>
                                                    @break

                                                    @case("Comference preceedings")
                                                        <h5>
                                                            <span class="font-weight-bold">Publication name:</span> {{ $publication->conference_publication_name}} , 
                                                            <span class="font-weight-bold">City:</span> {{ $publication->city}} ,
                                                            <span class="font-weight-bold">year:</span> {{ $publication->year}} ,
                                                        </h5>
                                                    @break
                                                @endswitch
                                            </div>

                                            <div class="row mt-2">
                                              <div class="col-12">
                                                <h5><span class="font-weight-bold">Link: </span> <a style="color:red" href="{{$publication->link}}" target="_blank">{{ $publication->link}}</a><h5> 
                                              </div>
                                              
                                            </div>

                                            <div class="mt-3" style="float:right">
                                                <h5><span class="font-weight-bold">Type: </span> {{ $publication->category}}<h5>
                                            </div>
                                            
                                        </div>
                                    </div>
                                @endforeach
                              
                            </div>
                           
                            <div class="tab-pane fade" id="pills-skills" role="tabpanel" aria-labelledby="pills-skills-tab">
                                <h2>Skills</h2>

                                <ul>
                                    @foreach($skills as $skill)
                                    <li>{{ $skill->name }}</li>
                                    @endforeach
                                </ul>
                              
                            </div>
                            <div class="tab-pane fade" id="pills-projects" role="tabpanel" aria-labelledby="pills-projects-tab">
                                
                                @foreach($projects as $project)
                                    <div class="card">
                                        <div class="card-body mb-4">
                                            <div class="row">
                                                <ul style="list-style-type:none">
                                                    <li><h5><span class="font-weight-bold">Project title:</span> {{ $project->title}}</h5></li>
                                                    <li><h5><span class="font-weight-bold">Description:</span> {{ $project->description}}</h5></li>
                                                    <li><h5><span class="font-weight-bold">Year:</span> {{ $project->year}}</h5></li>
                                                    <li><h5><span class="font-weight-bold">Client:</span> {{ $project->client}}</h5></li>
                                                </ul>
                                            </div>

                                            <div class="row mt-2">
                                              <div class="col-12">
                                                <h5><span class="font-weight-bold">Link: </span> <a style="color:red" href="{{$project->link}}" target="_blank">{{ $project->link}}</a><h5> 
                                              </div>
                                              
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                              
                            </div>
                            <div class="tab-pane fade" id="pills-areas" role="tabpanel" aria-labelledby="pills-areas-tab">
                                <h2>Areas of research</h2>

                                <ul>
                                    @foreach($areas as $area)
                                    <li>{{ $area->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                     </div>
                </div>
            <!-- </div> -->
        </div>

        <div class="col-sm-12 col-md-3 mt-5">
            <div class="card-transparent mr-5 staff-card">
                
                <img class="card-img-top mb-4" style="height:200px" src="<?php echo asset("images/$staff->profile_picture_path")?>" alt="Card image cap">
                <div class="card-body">
                    
                    <p>{{ $staff->email}}</P>

                    <p>{{ $staff->mobile_number}}</p>

                    <p>{{ $staff->address }}</p>

                   

                    <p class="mt-4">

                    @if($staff->linkedin !== null)
                    <a href="{{ $staff->linkedin}}" target="_blank"> 
                        <i class="fa fa-linkedin-square fa-2x mr-2" aria-hidden="true"></i>
                    </a>
                    @endif
                    

                    @if($staff->scholar !== null)
                    <a href="{{ $staff->scholar }}" target="_blank">
                        <i class="ai ai-google-scholar-square ai-2x mr-2"></i>
                    </a>
                    @endif

                    @if($staff->twitter !== null)
                    <a href="{{ $staff->twitter }}" target="_blank">
                        <i class="fa fa-twitter-square fa-2x mr-2"></i>
                    </a>
                    @endif
                    
                    </p>


                    <p class="mt-4">

                    @if($staff->academia !== null)
                    <a href="{{ $staff->academia }}" target="_blank">
                        <i class="ai ai-academia-square ai-2x mr-2"></i>
                    </a>
                    @endif

                    @if($staff->gate !== null)
                    <a href="{{ $staff->gate}}" target="_blank"> 
                        <i class="ai ai-researchgate-square ai-2x mr-2" aria-hidden="true"></i>
                    </a>
                    @endif
                    
                    </p>

                </div>
            
        </div>
        </div>
    </div>
</div>

@endsection