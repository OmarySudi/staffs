@extends('layouts.app')

@section('content')

<div class="container" style="width: 70%">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-9 mt-5">
            <!-- <div class="row"> -->
                <div class="staff-left-column">
                 
                    <h3>{{ $staff->full_name }}</h3>

                    
                     @foreach($roles as $role)
                        @if($loop->last)
                            <h4 class="role">{{ $role->name}}</h4>
                        @else
                            <h4 class="role">{{ $role->name}} ,</h4>
                        @endif
                     @endforeach
                    

                     <h4> Faculty: {{ $department[0]->name }} </h4>

                     <div id="tabbed-content">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                            @if($staff->staff_category == 'Academician')
                                <li class="nav-item" role="presentation" style="width: 20%">
                                    <a class="nav-link active" id="pills-about-tab" data-toggle="pill" href="#pills-about" role="tab" aria-controls="pills-about" aria-selected="true">About</a>
                                </li>
                            @elseif($staff->staff_category == 'Administrative')
                                <li class="nav-item" role="presentation" style="width: 30%">
                                    <a class="nav-link active" id="pills-about-tab" data-toggle="pill" href="#pills-about" role="tab" aria-controls="pills-about" aria-selected="true">About</a>
                                </li>
                            @endif

                            @if($staff->staff_category == 'Academician')
                                <li class="nav-item" role="presentation" style="width: 20%">
                                    <a class="nav-link" id="pills-courses-tab" data-toggle="pill" href="#pills-courses" role="tab" aria-controls="pills-courses" aria-selected="false">Courses</a>
                                </li>
                                <li class="nav-item" role="presentation" style="width: 20%">
                                    <a class="nav-link" id="pills-publications-tab" data-toggle="pill" href="#pills-publications" role="tab" aria-controls="pills-publications" aria-selected="false">Publications</a>
                                </li>
                                <li class="nav-item" role="presentation" style="width: 25%">
                                    <a class="nav-link" id="pills-areas-tab" data-toggle="pill" href="#pills-areas" role="tab" aria-controls="pills-areas" aria-selected="false">Areas of research</a>
                                </li>
                            @elseif($staff->staff_category == 'Administrative')
                                <li class="nav-item" role="presentation" style="width: 30%">
                                    <a class="nav-link" id="pills-projects-tab" data-toggle="pill" href="#pills-projects" role="tab" aria-controls="pills-projects" aria-selected="false">Projects</a>
                                </li>
                                <li class="nav-item" role="presentation" style="width: 30%">
                                    <a class="nav-link" id="pills-skills-tab" data-toggle="pill" href="#pills-skills" role="tab" aria-controls="pills-skills" aria-selected="false">Skills</a>
                                </li>
                            @endif

                            <!-- @foreach($roles as $role)
                                @if($role->name == 'Lecturer') -->
                            <!-- <li class="nav-item" role="presentation" style="width: 30%">
                                <a class="nav-link" id="pills-courses-tab" data-toggle="pill" href="#pills-courses" role="tab" aria-controls="pills-courses" aria-selected="false">Courses</a>
                            </li> -->
                                    <!-- @break
                                @endif
                            @endforeach -->
                            <!-- <li class="nav-item" role="presentation" style="width: 30%">
                                <a  class="nav-link" id="pills-background-tab" data-toggle="pill" href="#pills-background" role="tab" aria-controls="pills-background" aria-selected="false">Background</a>
                            </li> -->
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
                                <h2>Publications</h2>
                                <ul>

                                  @foreach($publications as $publication)
                                    
                                    <li class="mt-3">{{ $publication->id}}</li>
                                  @endforeach
                                </ul>
                              
                            </div>
                            <!-- <div class="tab-pane fade" id="pills-background" role="tabpanel" aria-labelledby="pills-background-tab">
                                
                                <h2>Education History</h2>

                                <ul>
                                    @foreach($education as $history)
                                    
                                        <li class="mt-3">
                                            <span style="font-weight:bold">{{ $history->award_acronym }}. {{ $history->course }} </span>{{ $history->university}} , {{ $history->year}}
                                        </li>
                                    @endforeach
                                </ul>


                                <h2>Employment History</h2>
                                   
                                    <ul>
                                        <li class="mt-3">
                                            @foreach($employment as $history)
                                                {{ $history->position }} at {{ $history->place }} from {{ $history->start_year}}-{{ $history->end_year}}
                                            @endforeach
                                        </li>
                                    </ul>
                            </div> -->
                            <div class="tab-pane fade" id="pills-skills" role="tabpanel" aria-labelledby="pills-skills-tab">
                                <h2>Skills</h2>

                                <p> {{ $staff->skills }}</p>
                              
                            </div>
                            <div class="tab-pane fade" id="pills-projects" role="tabpanel" aria-labelledby="pills-projects-tab">
                                <h2>Projects</h2>
                                <ul>

                                  @foreach($projects as $project)
                                    <li class="mt-3">{{ $project->title}}, {{ $project->description}} , {{ $project->year}}</li>
                                  @endforeach
                                </ul>
                              
                            </div>
                            <div class="tab-pane fade" id="pills-areas" role="tabpanel" aria-labelledby="pills-areas-tab">
                                <h2>Areas of research</h2>
                                 <p>{{ $staff->areas_of_research}}</p>
                              
                            </div>
                        </div>
                     </div>
                </div>
            <!-- </div> -->
        </div>

        <div class="col-sm-12 col-md-3 mt-5">
            <div class="card-transparent mr-5 staff-card">
                
                <img class="card-img-top" style="height:120px" src="<?php echo asset("images/$staff->profile_picture_path")?>" alt="Card image cap">
                <div class="card-body" style="margin-top: 100px">
                    
                    <p>{{ $staff->email}}</P>

                    <p>{{ $staff->mobile_number}}</p>

                    <p>{{ $staff->address }}</p>
                </div>
            
        </div>
        </div>
    </div>
</div>

@endsection