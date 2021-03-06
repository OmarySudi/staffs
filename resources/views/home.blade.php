@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 sidebar">

            <div class="list-group" id="myList" role="tablist">

                @if(Auth::user()->is_admin)
                    <a class="list-group-item list-group-item-action active" data-toggle="list" href="#allStaffs" role="tab">All staffs</a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#requests" role="tab">Activation Requests</a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#departments" role="tab">Departments</a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#categories" role="tab">Account Types</a>
                @else
                    <a class="list-group-item list-group-item-action active" data-toggle="list" href="#personal" role="tab">Personal details</a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#biography" role="tab">Biography</a>
                    @if(Auth::user()->account_type == 'Academician')

                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#publication"  role="tab" id="educationTab">Publications</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#project" role="tab">Projects</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#job" role="tab">Courses</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#areas" role="tab">Areas of research</a>

                    @elseif(Auth::user()->account_type == 'Administrative')

                        
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#project" role="tab">Projects</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#skills" role="tab">Skills</a>
                        
                    @endif
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#accounts" role="tab">Other Accounts</a>
                @endif
               
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9 main">

            @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}" role="alert">
                    {!! session('message.content') !!}
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                </div>
            @endif

            <div class="tab-content">

                @if(Auth::user()->is_admin == false)
                <div class="tab-pane show active" id="personal" role="tabpanel">
                    <div class="card">

                        <div class="card-header">{{ __('Personal details') }}</div>

                        <div class="card-body">

                            @if($staff != '')
                                <input type="hidden" id="account-hidden" value="{{$staff->staff_category}}"></input>
                                <input type="hidden" id="department-hidden" value="{{$staff->department_id}}"></input>
                            @else
                                <input type="hidden" id="account-hidden" value=""></input>
                                <input type="hidden" id="department-hidden" value=""></input>
                            @endif
                            <form method="POST" action="{{ route('staffs.create') }}" enctype="multipart/form-data">
                                @csrf

                                
                                
                              
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                    <div class="col-md-6">

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <select id="name_prefix" name="name_prefix" class="form-control @error('name_prefix') is-invalid @enderror">

                                                            @if($staff != '')

                                                                <option value="{{ $staff->name_prefix }}">{{ $staff->name_prefix }}</option>

                                                                @if($staff->name_prefix != 'Mr')
                                                                    <option value="Mr">Mr</option>
                                                                @endif

                                                                @if($staff->name_prefix != 'Mrs')
                                                                    <option value="Mrs">Mrs</option>
                                                                @endif

                                                                @if($staff->name_prefix != 'Miss')
                                                                    <option value="Miss">Miss</option>
                                                                @endif

                                                                @if($staff->name_prefix != 'Ms')
                                                                    <option value="Ms">Ms</option>
                                                                @endif

                                                                @if($staff->name_prefix != 'Prof')
                                                                    <option value="Prof">Prof</option>
                                                                @endif

                                                                @if($staff->name_prefix != 'Dr')
                                                                    <option value="Dr">Dr</option>
                                                                @endif

                                                            @else
                                                                <option value="Mr">Mr</option>
                                                                <option value="Mrs">Mrs</option>
                                                                <option value="Miss">Miss</option>
                                                                <option value="Ms">Ms</option>
                                                                <option value="Prof">Prof</option>
                                                                <option value="Dr">Dr</option>
                                                            @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <input id="name" type="text" style="height:50px" class="form-control @error('name') is-invalid @enderror" name="name" value="@if($staff != '') {{ $staff->full_name}} @else {{ old('name')}}@endif" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                       
                                    </div>

                                    
                                </div>

                                <div class="form-group row">
                                    <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                                    <div class="col-md-6">
                                        <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="@if($staff != '') {{ $staff->mobile_number}} @else {{ old('number') }}@endif" required autocomplete="number">

                                        @error('number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" value="@if($staff != '') {{ $staff->address}} @else {{ old('address') }}@endif" name="address" required autocomplete="address">

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="job_title">Job Title</label>

                                    <div class="col-md-6">
                                    <input id="job_title" type="text" class="form-control @error('job_title') is-invalid @enderror" value="@if($staff != '') {{ $staff->job_title}} @else {{ old('job_title') }}@endif" name="job_title" required autocomplete="job_title">

                                        @error('job_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="award">Department</strong></label>

                                    <div class="col-md-6">
                                        <select id="department_name" name="department_name" class="form-control @error('department_name') is-invalid @enderror" required>
                                        <option value="">--- Select Department ---</option>
                                           
                                        </select>

                                        @error('department_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                <label for="picture" class="col-md-4 col-form-label text-md-right">{{ __('Profile picture') }}</label> 

                                    <div class="col-md-6">

                                        @if($staff == '')
                                            <div class="input-group">
                                                
                                                    <input type="file" id="picture" name="picture" class="form-control @error('picture') is-invalid @enderror" value="{{ old('picture') }}" required autocomplete="picture" autofocus>

                                                    @error('picture')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                
                                            </div>
                                        @else

                                            <div class="input-group">
                                                
                                                    <input type="file" id="picture" name="picture" class="form-control @error('picture') is-invalid @enderror" value="{{ old('picture') }}" autocomplete="picture" autofocus>

                                            </div>

                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif

                <div class="tab-pane" id="biography" role="tabpanel">
                    <div class="card">
                        <div class="card-header">{{ __('Biography') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('staffs.add-biography') }}">
                                @csrf

                                <div class="form-group row">
                                   
                                    <div class="col-sm-12">

                                        <div class="form-group">
                                            <textarea rows="15" id="biography" class="form-control @error('biography') is-invalid @enderror" name="biography" value="{{ old('biography') }}" required autocomplete="biography" autofocus>
                                                @if($staff != '') {{ $staff->biography }} @endif
                                            </textarea>
                                        </div>

                                        @error('biography')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-5">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="accounts" role="tabpanel">
                    <div class="card">
                        <div class="card-header">{{ __('Other Accounts') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('staffs.add-accounts') }}">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="linkedin">LinkedIn account(If you have)</label>

                                    <div class="col-md-6">
                                        <input id="linkedin" type="text" class="form-control" value="@if($staff != '' && $staff->linkedin != null) {{ $staff->linkedin}} @else {{ old('linkedin') }}@endif" name="linkedin" autocomplete="linkedin">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="scholar">Google scholar account(If you have)</label>

                                    <div class="col-md-6">
                                        <input id="scholar" type="text" class="form-control" value="@if($staff != '' && $staff->scholar != null) {{ $staff->scholar}} @else {{ old('scholar') }}@endif" name="scholar" autocomplete="scholar">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="gate">ResearchGate account(If you have)</label>

                                    <div class="col-md-6">
                                        <input id="gate" type="text" class="form-control" value="@if($staff != '' && $staff->gate != null) {{ $staff->gate}} @else {{ old('gate') }}@endif" name="gate" autocomplete="gate">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="academia">Academia account(If you have)</label>

                                    <div class="col-md-6">
                                        <input id="academia" type="text" class="form-control" value="@if($staff != '' && $staff->academia != null) {{ $staff->academia}} @else {{ old('academia') }}@endif" name="academia" autocomplete="academia">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="twitter">Twitter account(If you have)</label>

                                    <div class="col-md-6">
                                        <input id="twitter" type="text" class="form-control" value="@if($staff != '' && $staff->twitter != null) {{ $staff->twitter}} @else {{ old('twitter') }}@endif" name="twitter" autocomplete="twitter">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-5">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal" id="staffDeleteModal" tabindex="-1" role="dialog" aria-labelledby="staffDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-header">{{__('Are you sure you want to delete this staff?') }}</div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('staffs.delete') }}">
                                        @csrf

                                        <input type="hidden" id="staff_ondelete_id" name="staff_ondelete_id">

                                        <div class="form-group">
                                            <div class="pull-right">

                                                <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                    {{ __('No') }}
                                                </button>

                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Yes') }}
                                                </button>

                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(Auth::user()->is_admin)
                    <div class="tab-pane show active" id="allStaffs" role="tabpanel">

                    <center>
                        <div class="input-group mb-3" style="width:50%; height: 40px">
                            <input type="text" class="form-control" style="height:40px" id="staff-search" name="search" placeholder="Search by staff name" arial-label="Search by staff name" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </center>

                        <div class="table-responsive">
                            <table id="staffsTable" class="table table-hover table-bordered">
                                <caption>List of staffs</caption>
                                <thead >
                                    <tr>
                                        <th scope="col" style="background:rgba(16,124,229,0.7); color:white">Full Name</th>
                                        <th scope="col" style="background:rgba(16,124,229,0.7); color:white">Email</th>
                                        <th scope="col" style="background:rgba(16,124,229,0.7); color:white">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="StaffTableBody">
                                   @foreach($all_staffs as $staff)
                                    <tr>
                                        <td>{{ $staff->full_name }}</td>
                                        <td>{{ $staff->email }}</td>
                                        <td>
                                            <a href="{{ route('staffs.staff-info',['id' => $staff->id])}}">
                                                <button 
                                                    type="button"
                                                    class="btn btn-sm btn-primary ml-5">
                                                    <i class="fa fa-eye" aria-hidden="true">&nbsp;View</i>
                                                </button>
                                            </a>

                                            <button 

                                                type="button" 
                                                data-toggle="modal"
                                                data-target = "#staffDeleteModal"
                                                onclick="getStaff({{ $staff->id}})";
                                                class="btn  btn-sm btn-danger ml-5">
                                                <i class="fa fa-trash" aria-hidden="true">&nbsp;Delete</i>
                                            </button>

                                        </td> 
                                    </tr>
                                   @endforeach
                                </tbody>
                                <tr >
                                    <td style="border-right-style:hidden;"></td>
                                    <td style="border-right-style:hidden;"></td>
                                    <td align="right" style="border-right-style:hidden;"><a href="#" id="staff-previous" class="page-links">Previous</a> | <a href="#" id="staff-next" class="page-links">Next</a></td>
                                </tr>
                            </table>
                        </div>
                    
                        
                    </div>

                    <div class="modal" id="RequestDenyModal" tabindex="-1" role="dialog" aria-labelledby="RequestDenyModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-header">{{__('Are you sure you want to deny verification?') }}</div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('users.deny') }}">
                                        @csrf

                                        <input type="hidden" id="user_ondeny_id" name="user_ondeny_id">

                                        <div class="form-group">
                                            <div class="pull-right">

                                                <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                    {{ __('No') }}
                                                </button>

                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Yes') }}
                                                </button>

                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal" id="RequestVerifyModal" tabindex="-1" role="dialog" aria-labelledby="RequestVerifyModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-header">{{__('Are you sure you want to verify this user?') }}</div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('users.verify') }}">
                                        @csrf

                                        <input type="hidden" id="user_onverify_id" name="user_onverify_id">

                                        <div class="form-group">
                                            <div class="pull-right">

                                                <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                    {{ __('No') }}
                                                </button>

                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Yes') }}
                                                </button>

                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="tab-pane show" id="requests" role="tabpanel">

                    <center>
                        <div class="input-group mb-3" style="width:50%; height: 40px">
                            <input type="text" class="form-control" style="height:40px" id="request-search" name="search" placeholder="Search by name" arial-label="Search by name" aria-describedby="basic-addon3">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon3">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </center>

                        <div class="table-responsive">
                            <table id="requestsTable" class="table table-hover table-bordered">
                                <caption>List of registered users</caption>
                                <thead>
                                    <tr>
                                        <th scope="col" style="background:rgba(16,124,229,0.7); color:white">Full Name</th>
                                        <th scope="col" style="background:rgba(16,124,229,0.7); color:white">Email</th>
                                        <th scope="col" style="background:rgba(16,124,229,0.7); color:white">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="RequestTableBody">
                                   @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <button 
                                                type="button" 
                                                data-toggle="modal"
                                                data-target = "#RequestVerifyModal"
                                                onclick="getUser({{ $user->id}})";
                                                class="btn  btn-sm btn-success ml-5">
                                                <i class="fa fa-check" aria-hidden="true">&nbsp;Verify</i>
                                            </button>

                                            
                                        </td> 
                                    </tr>
                                   @endforeach
                                </tbody>
                                <tr >
                                    <td style="border-right-style:hidden;"></td>
                                    <td style="border-right-style:hidden;"></td>
                                    <td align="right" style="border-right-style:hidden;"><a href="#" id="request-previous" class="page-links">Previous</a> | <a href="#" id="request-next" class="page-links">Next</a></td>
                                </tr>
                            </table>
                        </div>
                    
                       
                    </div>

                    <div class="tab-pane" id="departments" role="tabpanel">
                    
                        <p>
                            <span class="mr-3">Click Add button to add department</span>

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#DepartmentModal">
                                ADD
                            </button>
                        </p>
                    
                        <div class="modal fade" id="DepartmentModal" tabindex="-1" role="dialog" aria-labelledby="DepartmentModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                   
                                                <div class="card">

                                                    <div class="card-header">{{ __('Department') }}</div>

                                                    <div class="card-body">
                                                        <div class="control-group" id="department-fields">
                                                            
                                                            <div class="department-controls"> 

                                                            <form method="POST" action="{{ route('departments.add') }}">
                                                                @csrf

                                                                <div class="department-entry input-group col-xs-3 mt-2">
                                                                    <input class="form-control" name="fields[]" type="text" placeholder="Type something" />
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-success department-btn-add" type="button">
                                                                            <span class="glyphicon glyphicon-plus"></span>
                                                                            <i class="mdi mdi-plus-thick" aria-hidden="true"></i>
                                                                        </button>
                                                                    </span>
                                                                </div>

                                                                <div class="form-group row mt-5" id="departmentSave">
                                                                    <div class="col-md-6 offset-md-5">
                                                                        <button type="submit" class="btn btn-primary">
                                                                            {{ __('Save') }}
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                                <br>
                                                                <small>Press <i class="mdi mdi-plus-thick" aria-hidden="true"></i> to add another form field</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="departmentEditModal" tabindex="-1" role="dialog" aria-labelledby="departmentEditModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                   
                                                <div class="card">

                                                    <div class="card-header">{{ __('Edit Department') }}</div>

                                                    <div class="card-body">
                                                        <form method="POST" action="{{ route('departments.update') }}">
                                                            @csrf

                                                            <input type="hidden" id="edited_department_id" name="edited_department_id">

                                                            <div class="form-group row">
                                                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="edited_department_name" type="text" class="form-control @error('edited_department_name') is-invalid @enderror" name="edited_department_name" value="{{ old('edited_department_name') }}" required autocomplete="edited_department_name" autofocus>

                                                                    @error('edited_department_name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row mb-0">
                                                                <div class="col-md-6 offset-md-5">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        {{ __('Save') }}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            
                                </div>
                            </div>
                        </div>

                        <div class="modal" id="departmentDeleteModal" tabindex="-1" role="dialog" aria-labelledby="departmentDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="card">
                                        <div class="card-header">{{__('Are you sure you want to delete this record?') }}</div>
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('departments.delete') }}">
                                                @csrf

                                                <input type="hidden" id="department_ondelete_id" name="department_ondelete_id">

                                                <div class="form-group">
                                                    <div class="pull-right">

                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                            {{ __('No') }}
                                                        </button>

                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Yes') }}
                                                        </button>

                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="table-responsive">

                            
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                    <th scope="col" style="background:rgba(16,124,229,0.7); color:white">Name</th>
                                    <th colspan="2" style="background:rgba(16,124,229,0.7); color:white">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="DepartmentTableBody">
                                @if($departments != '')
                                    @foreach($departments as $department)
                                        <tr>
                                        <td>{{ $department->name}}</td>
                                        <td>
                                            <button 
                                                type="button"
                                                data-toggle="modal"
                                                data-target = "#departmentEditModal"
                                                onclick="getDepartment({{ $department->id}})"
                                                class="btn btn-sm btn-success ml-5">
                                                <i class="fa fa-pencil" aria-hidden="true">&nbsp;Edit</i>
                                            </button>
                                        </td>
                                        <td>
                                            <button 

                                            type="button" 
                                            data-toggle="modal"
                                            data-target = "#departmentDeleteModal"
                                            onclick="getDepartment({{ $department->id}})"
                                            class="btn  btn-sm btn-danger ml-5">
                                            <i class="fa fa-trash" aria-hidden="true">&nbsp;Delete</i>
                                            </button>
                                        </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tr >
                                    <td style="border-right-style:hidden;"></td>
                                    <td style="border-right-style:hidden;"></td>
                                    <td align="right" style="border-right-style:hidden;"><a href="#" id="department-previous" class="page-links">Previous</a> | <a href="#" id="department-next" class="page-links">Next</a></td>
                                </tr>

                            </table>
                        </div>
                    </div>


                    <div class="tab-pane" id="categories" role="tabpanel">
                    
                        <p>
                            <span class="mr-3">Click Add button to add account type</span>

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CategoryModal">
                                ADD
                            </button>
                        </p>
                    
                        <div class="modal fade" id="CategoryModal" tabindex="-1" role="dialog" aria-labelledby="CategoryModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                   
                                                <div class="card">

                                                    <div class="card-header">{{ __('Account Type') }}</div>

                                                    <div class="card-body">
                                                        <div class="control-group" id="category-fields">
                                                           
                                                            <div class="category-controls"> 

                                                            <form method="POST" action="{{ route('categories.add') }}">
                                                                @csrf

                                                                <div class="category-entry input-group col-xs-3 mt-2">
                                                                    <input class="form-control" name="fields[]" type="text" placeholder="Type something" />
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-success category-btn-add" type="button">
                                                                            <span class="glyphicon glyphicon-plus"></span>
                                                                            <i class="mdi mdi-plus-thick" aria-hidden="true"></i>
                                                                        </button>
                                                                    </span>
                                                                </div>

                                                                <div class="form-group row mt-5" id="categorySave">
                                                                    <div class="col-md-6 offset-md-5">
                                                                        <button type="submit" class="btn btn-primary">
                                                                            {{ __('Save') }}
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                                <br>
                                                                <small>Press <i class="mdi mdi-plus-thick" aria-hidden="true"></i> to add another form field</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="categoryEditModal" tabindex="-1" role="dialog" aria-labelledby="categoryEditModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                   
                                                <div class="card">

                                                    <div class="card-header">{{ __('Edit Account Type') }}</div>

                                                    <div class="card-body">
                                                        <form method="POST" action="{{ route('categories.update') }}">
                                                            @csrf

                                                            <input type="hidden" id="edited_category_id" name="edited_category_id">

                                                            <div class="form-group row">
                                                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="edited_category_name" type="text" class="form-control @error('edited_category_name') is-invalid @enderror" name="edited_category_name" value="{{ old('edited_category_name') }}" required autocomplete="edited_category_name" autofocus>

                                                                    @error('edited_category_name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row mb-0">
                                                                <div class="col-md-6 offset-md-5">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        {{ __('Save') }}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            
                                </div>
                            </div>
                        </div>

                        <div class="modal" id="categoryDeleteModal" tabindex="-1" role="dialog" aria-labelledby="categoryDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="card">
                                        <div class="card-header">{{__('Are you sure you want to delete this record?') }}</div>
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('categories.delete') }}">
                                                @csrf

                                                <input type="hidden" id="category_ondelete_id" name="category_ondelete_id">

                                                <div class="form-group">
                                                    <div class="pull-right">

                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                            {{ __('No') }}
                                                        </button>

                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Yes') }}
                                                        </button>

                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="table-responsive">

                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                    <th scope="col" style="background:rgba(16,124,229,0.7); color:white">Name</th>
                                    <th colspan="2" style="background:rgba(16,124,229,0.7); color:white">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($categories != '')
                                    @foreach($categories as $category)
                                        <tr>
                                        <td>{{ $category->name}}</td>
                                        <td>
                                            <button 
                                                type="button"
                                                data-toggle="modal"
                                                data-target = "#categoryEditModal"
                                                onclick="getCategory({{ $category->id}})"
                                                class="btn btn-sm btn-success ml-5">
                                                <i class="fa fa-pencil" aria-hidden="true">&nbsp;Edit</i>
                                            </button>
                                        </td>
                                        <td>
                                            <button 

                                            type="button" 
                                            data-toggle="modal"
                                            data-target = "#categoryDeleteModal"
                                            onclick="getCategory({{ $category->id}})"
                                            class="btn  btn-sm btn-danger ml-5">
                                            <i class="fa fa-trash" aria-hidden="true">&nbsp;Delete</i>
                                            </button>
                                        </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <div class="tab-pane" id="areas" role="tabpanel">
                    
                    <p>
                        <span class="mr-3">Click Add button to add areas of research</span>

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AreaOfResearchModal">
                            ADD
                        </button>
                    </p>
                    

                    <div class="modal fade" id="AreaOfResearchModal" tabindex="-1" role="dialog" aria-labelledby="AreaOfResearchModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                
                                            <div class="card">

                                                <div class="card-header">{{ __('Areas of research') }}</div>

                                                <div class="card-body">
                                                    <div class="control-group" id="fields">
                                                       
                                                        <div class="controls"> 

                                                        <form method="POST" action="{{ route('staffs.add-areas') }}">
                                                            @csrf

                                                            <div class="entry input-group col-xs-3">
                                                                <input class="form-control" name="fields[]" type="text" placeholder="Type something" />
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-success btn-add" type="button">
                                                                        <span class="glyphicon glyphicon-plus"></span>
                                                                        <i class="mdi mdi-plus-thick" aria-hidden="true"></i>
                                                                    </button>
                                                                </span>
                                                            </div>

                                                            <div class="form-group row mt-5" id="areaSave">
                                                                <div class="col-md-6 offset-md-5">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        {{ __('Save') }}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                            <br>
                                                            <small>Press <i class="mdi mdi-plus-thick" aria-hidden="true"></i> to add another form field</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="areaEditModal" tabindex="-1" role="dialog" aria-labelledby="areaEditModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                
                                            <div class="card">

                                                <div class="card-header">{{ __('Edit Areas') }}</div>

                                                <div class="card-body">
                                                    <form method="POST" action="{{ route('area.update') }}">
                                                        @csrf

                                                        <input type="hidden" id="area_id" name="area_id">

                                                        <div class="form-group row">
                                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="edited_area_name" type="text" class="form-control @error('edited_area_name') is-invalid @enderror" name="edited_area_name" value="{{ old('edited_area_name') }}" required autocomplete="edited_area_name" autofocus>

                                                                @error('edited_area_name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-6 offset-md-5">
                                                                <button type="submit" class="btn btn-primary">
                                                                    {{ __('Save') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        
                            </div>
                        </div>
                    </div>

                    <div class="modal" id="areaDeleteModal" tabindex="-1" role="dialog" aria-labelledby="areaDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="card">
                                    <div class="card-header">{{__('Are you sure you want to delete this record?') }}</div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('area.delete') }}">
                                            @csrf

                                            <input type="hidden" id="area_ondelete_id" name="area_ondelete_id">

                                            <div class="form-group">
                                                <div class="pull-right">

                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                        {{ __('No') }}
                                                    </button>

                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Yes') }}
                                                    </button>

                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">Name</th>
                                <th colspan="2"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($areas != '')
                                @foreach($areas as $area)
                                    <tr>
                                    <td>{{ $area->name}}</td>
                                    <td>
                                        <button 
                                            type="button"
                                            data-toggle="modal"
                                            data-target = "#areaEditModal"
                                            onclick="getArea({{ $area->id}})"
                                            class="btn btn-sm btn-success ml-5">
                                            <i class="fa fa-pencil" aria-hidden="true">&nbsp;Edit</i>
                                        </button>
                                    </td>
                                    <td>
                                        <button 

                                        type="button" 
                                        data-toggle="modal"
                                        data-target = "#areaDeleteModal"
                                        onclick="getArea({{ $area->id}})"
                                        class="btn  btn-sm btn-danger ml-5">
                                        <i class="fa fa-trash" aria-hidden="true">&nbsp;Delete</i>
                                        </button>
                                    </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane" id="skills" role="tabpanel">
                    
                
                    <p>
                        <span class="mr-3">Click Add button to add Skills</span>

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#SkillsModal">
                            ADD
                        </button>
                    </p>
                    
                    <div class="modal fade" id="SkillsModal" tabindex="-1" role="dialog" aria-labelledby="SkillsModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                
                                            <div class="card">

                                                <div class="card-header">{{ __('Skills') }}</div>

                                                <div class="card-body">
                                                    <div class="control-group" id="skill-fields">
                                                        
                                                        <div class="skill-controls"> 

                                                        <form method="POST" action="{{ route('staffs.add-skills') }}">
                                                            @csrf

                                                            <div class="skill-entry input-group col-xs-3">
                                                                <input class="form-control" name="fields[]" type="text" placeholder="Type something" />
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-success skill-btn-add" type="button">
                                                                        <i class="mdi mdi-plus-thick" aria-hidden="true"></i>
                                                                    </button>
                                                                </span>
                                                            </div>

                                                            <div class="form-group row mt-5" id="skillSave">
                                                                <div class="col-md-6 offset-md-5">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        {{ __('Save') }}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                            <br>
                                                            <small>Press <i class="mdi mdi-plus-thick" aria-hidden="true"></i> to add another form field</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="skillEditModal" tabindex="-1" role="dialog" aria-labelledby="skillEditModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                
                                            <div class="card">

                                                <div class="card-header">{{ __('Edit Skills') }}</div>

                                                <div class="card-body">
                                                    <form method="POST" action="{{ route('skill.update') }}">
                                                        @csrf

                                                        <input type="hidden" id="skill_id" name="skill_id">

                                                        <div class="form-group row">
                                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="edited_skill_name" type="text" class="form-control @error('edited_skill_name') is-invalid @enderror" name="edited_skill_name" value="{{ old('edited_skill_name') }}" required autocomplete="edited_skill_name" autofocus>

                                                                @error('edited_skill_name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-6 offset-md-5">
                                                                <button type="submit" class="btn btn-primary">
                                                                    {{ __('Save') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        
                            </div>
                        </div>
                    </div>

                    <div class="modal" id="skillDeleteModal" tabindex="-1" role="dialog" aria-labelledby="skillDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="card">
                                    <div class="card-header">{{__('Are you sure you want to delete this record?') }}</div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('skill.delete') }}">
                                            @csrf

                                            <input type="hidden" id="skill_ondelete_id" name="skill_ondelete_id">

                                            <div class="form-group">
                                                <div class="pull-right">

                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                        {{ __('No') }}
                                                    </button>

                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Yes') }}
                                                    </button>

                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">Name</th>
                                <th colspan="2"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($skills != '')
                                @foreach($skills as $skill)
                                    <tr>
                                    <td>{{ $skill->name}}</td>
                                    <td>
                                        <button 
                                            type="button"
                                            data-toggle="modal"
                                            data-target = "#skillEditModal"
                                            onclick="getSkill({{ $skill->id}})"
                                            class="btn btn-sm btn-success ml-5">
                                            <i class="fa fa-pencil" aria-hidden="true">&nbsp;Edit</i>
                                        </button>
                                    </td>
                                    <td>
                                        <button 

                                        type="button" 
                                        data-toggle="modal"
                                        data-target = "#skillDeleteModal"
                                        onclick="getSkill({{ $skill->id}})"
                                        class="btn  btn-sm btn-danger ml-5">
                                        <i class="fa fa-trash" aria-hidden="true">&nbsp;Delete</i>
                                        </button>
                                    </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal" id="projectDeleteModal" tabindex="-1" role="dialog" aria-labelledby="projectDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-header">{{__('Are you sure you want to delete this record?') }}</div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('project.deleteProject') }}">
                                        @csrf

                                        <input type="hidden" id="project_ondelete_id" name="project_ondelete_id">

                                        <div class="form-group">
                                            <div class="pull-right">

                                                <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                    {{ __('No') }}
                                                </button>

                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Yes') }}
                                                </button>

                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="projectEditModal" tabindex="-1" role="dialog" aria-labelledby="projectEditModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            
                            <div class="card">
                                <div class="card-header">{{__('Edit Project')}}</div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('project.update') }}">
                                        @csrf

                                        <input type="hidden" id="project_id" name="project_id">

                                        <div class="form-group row">
                                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>

                                            <div class="col-md-6">
                                                <input id="edited_project_title" type="text" class="form-control @error('edited_project_title') is-invalid @enderror" name="edited_project_title" value="{{ old('edited_project_title') }}" required autocomplete="edited_project_title" autofocus>

                                                @error('edited_project_title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                            <div class="col-md-6">
                                                <textarea rows="7" id="edited_project_description" class="form-control @error('edited_project_description') is-invalid @enderror" name="edited_project_description" value="{{ old('edited_project_description') }}" required autocomplete="edited_project_description" autofocus>
                                                    
                                                </textarea>

                                                @error('edited_project_description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('Year') }}</label>

                                            <div class="col-md-6">
                                                
                                                <select id="edited_project_year" name="edited_project_year" class="form-control @error('edited_project_year') is-invalid @enderror">
                                                   
                                                    <?php 
                                                        for($startYear=1950;$startYear <= date("Y"); $startYear++){

                                                            echo '<option id="'.$startYear.'" value="'.$startYear.'">'.$startYear.'</option>';
                                                        }
                                                    ?>
                                                </select>

                                                @error('edited_project_year')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="client" class="col-md-4 col-form-label text-md-right">{{ __('Client') }}</label>

                                            <div class="col-md-6">
                                                <input id="edited_project_client" type="text" class="form-control @error('edited_project_client') is-invalid @enderror" name="edited_project_client" value="{{ old('edited_project_client') }}" required autocomplete="edited_project_client" autofocus>

                                                @error('edited_project_client')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="link" class="col-md-4 col-form-label text-md-right">{{ __('Link') }}</label>

                                            <div class="col-md-6">
                                                <textarea rows="7" id="edited_project_link" class="form-control @error('edited_project_link') is-invalid @enderror" name="edited_project_link" value="{{ old('edited_project_link') }}" required autocomplete="edited_project_link" autofocus>
                                                    
                                                </textarea>

                                                @error('edited_project_link')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-5">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="project" role="tabpanel">
                
                    <p>
                        <span class="mr-3">Click Add button to add new project</span>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#projectModal">
                           ADD
                        </button>
                    </p>

                    <!-- Modal -->
                    <div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-header">{{__('New Project')}}</div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('project.create') }}">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="project_title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                            <div class="col-md-6">
                                                <input id="project_title" type="text" class="form-control @error('project_title') is-invalid @enderror" name="project_title" value="{{ old('project_title') }}" required autocomplete="project_title" autofocus>

                                                @error('project_title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="project_description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                            <div class="col-md-6">

                                                <textarea rows="7" id="project_description" class="form-control @error('project_description') is-invalid @enderror" name="project_description" value="{{ old('project_description') }}" required autocomplete="project_description" autofocus>
                                                    
                                                </textarea>

                                                @error('project_description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="project_year" class="col-md-4 col-form-label text-md-right">{{ __('Year') }}</label>

                                            <div class="col-md-6">

                                                <select id="project_year" name="project_year" class="form-control @error('project_year') is-invalid @enderror">
                                                    <option value="1950">1950</option>
                                                    <?php 
                                                        for($startYear=1951;$startYear <= date("Y"); $startYear++){

                                                            echo '<option id="'.$startYear.'" value="'.$startYear.'">'.$startYear.'</option>';
                                                        }
                                                    ?>
                                                </select>

                                                @error('project_year')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="project_client" class="col-md-4 col-form-label text-md-right">{{ __('Client') }}</label>

                                            <div class="col-md-6">
                                                <input id="project_client" type="text" class="form-control @error('project_client') is-invalid @enderror" name="project_client" value="{{ old('project_client') }}" required autocomplete="project_client" autofocus>

                                                @error('project_client')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="project_link" class="col-md-4 col-form-label text-md-right">{{ __('Link') }}</label>

                                            <div class="col-md-6">

                                                <textarea rows="3" id="project_link" class="form-control @error('project_link') is-invalid @enderror" name="project_link" value="{{ old('project_link') }}" required autocomplete="project_link" autofocus>
                                                    
                                                </textarea>

                                                @error('project_link')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-5">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            @if($projects != '')
                                @foreach($projects as $project)
                                    <div class="card mr-2 mb-2" style="width:32%;">
                                        <div class="card-body">
                                           
                                            <p><span style="font-weight:bold">Project title: </span>{{ $project->title}}</p>
                                            <p><span style="font-weight:bold">Description: </span>{{ $project->description}}</p>
                                            <p><span style="font-weight:bold">Year: </span>{{ $project->year}}</p>
                                            <p><span style="font-weight:bold">Client: </span>{{ $project->client}}</p>
                                            <p><span style="font-weight:bold">Link: </span>{{ $project->link}}</p>
                                          
                                            <div style="position:absolute; bottom:1px; left:0px" class="action-div">
                                                
                                                <div style="float:left">
                                                    <button 
                                                        type="button"
                                                        data-toggle="modal"
                                                        data-target = "#projectEditModal"
                                                        onclick="getProject({{ $project->id}})"
                                                        class="btn btn-sm btn-success ml-5">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                               
                                                <div style="float:right">
                                                    <button 
                                                        type="button" 
                                                        data-toggle="modal"
                                                        data-target = "#projectDeleteModal"
                                                        onclick="getProject({{ $project->id}})"
                                                        class="btn  btn-sm btn-danger ml-5">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    
                </div>


                <div class="modal" id="publicationDeleteModal" tabindex="-1" role="dialog" aria-labelledby="publicationDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-header">{{__('Are you sure you want to delete this record?') }}</div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('publication.deletePublication') }}">
                                        @csrf

                                        <input type="hidden" id="ondelete_publication_id" name="publication_id">

                                        <div class="form-group">
                                            <div class="pull-right">

                                                <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                    {{ __('No') }}
                                                </button>

                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Yes') }}
                                                </button>

                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="publicationJournalEditModal" tabindex="-1" role="dialog" aria-labelledby="publicationJournalEditModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            
                            <div class="card">
                                <div class="card-header">{{__('Edit Publication')}}</div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('publication.update-journal') }}">
                                        @csrf

                                        <input type="hidden" id="journal_publication_id" name="publication_id">

                                        <div id="edited_journal-name-row" class="form-group row">

                                            <label for="edited_journal_name" class="col-md-4 col-form-label text-md-right">{{ __('Title of publication') }}</label>

                                            <div class="col-md-6">
                                                <input id="edited_journal_name" type="text" required class="form-control @error('edited_journal_name') is-invalid @enderror" name="edited_journal_name" value="{{ old('edited_journal_name') }}" autocomplete="edited_journal_name" autofocus>

                                                @error('edited_jounal_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div id="edited_publisher-row" class="form-group row">
                                            <label for="edited_publisher" class="col-md-4 col-form-label text-md-right">{{ __('Publisher') }}</label>

                                            <div class="col-md-6">
                                                <input id="journal_edited_publisher" type="text" required class="form-control @error('journal_edited_publisher') is-invalid @enderror" name="journal_edited_publisher" value="{{ old('journal_edited_publisher') }}" autocomplete="journal_edited_publisher" autofocus>

                                                @error('journal_edited_publisher')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div id="edited_year-row" class="form-group row">
                                            <label for="edited_year" class="col-md-4 col-form-label text-md-right">{{ __('Year') }}</label>

                                            <div class="col-md-6">
                                                
                                                <select id="journal_edited_year" name="journal_edited_year" class="form-control @error('journal_edited_year') is-invalid @enderror">
                                                   
                                                   <?php 
                                                       for($startYear=1950;$startYear <= date("Y"); $startYear++){
                                                           echo '<option id="'.$startYear.'" value="'.$startYear.'">'.$startYear.'</option>';
                                                       }
                                                   ?>
                                               </select>
                                                @error('journal_edited_year')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div id="edited_link-row" class="form-group row">
                                            <label for="journal_edited_link" class="col-md-4 col-form-label text-md-right">{{ __('Accessibility(link)') }}</label>

                                            <div class="col-md-6">
                                                <input id="journal_edited_link" type="text" required class="form-control @error('journal_edited_link') is-invalid @enderror" name="journal_edited_link" value="{{ old('journal_edited_link') }}" autocomplete="journal_edited_link" autofocus>

                                                @error('journal_edited_link')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-5">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="publicationBookEditModal" tabindex="-1" role="dialog" aria-labelledby="publicationBookEditModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            
                            <div class="card">
                                <div class="card-header">{{__('Edit Publication')}}</div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('publication.update-book') }}">
                                        @csrf

                                        <input type="hidden" id="book_publication_id" name="publication_id">

                                        <div class="form-group row">
                                            <label for="publisher" class="col-md-4 col-form-label text-md-right">{{ __('Publisher') }}</label>

                                            <div class="col-md-6">
                                                <input id="book_edited_publisher" required type="text" class="form-control @error('book_edited_publisher') is-invalid @enderror" name="book_edited_publisher" value="{{ old('book_edited_publisher') }}" autocomplete="book_edited_publisher" autofocus>

                                                @error('book_edited_publisher')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="page" class="col-md-4 col-form-label text-md-right">{{ __('Page') }}</label>

                                            <div class="col-md-6">
                                                <input id="edited_page" type="text" required class="form-control @error('edited_page') is-invalid @enderror" name="edited_page" value="{{ old('edited_page') }}" autocomplete="edited_page" autofocus>

                                                @error('edited_page')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="volume" class="col-md-4 col-form-label text-md-right">{{ __('Volume') }}</label>

                                            <div class="col-md-6">
                                                <input id="edited_volume" type="text" required class="form-control @error('edited_volume') is-invalid @enderror" name="edited_volume" value="{{ old('edited_volume') }}" autocomplete="edited_volume" autofocus>

                                                @error('edited_volume')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="issue" class="col-md-4 col-form-label text-md-right">{{ __('Issue') }}</label>

                                            <div class="col-md-6">
                                                <input id="edited_issue" type="text" required class="form-control @error('edited_issue') is-invalid @enderror" name="edited_issue" value="{{ old('edited_issue') }}" autocomplete="edited_issue" autofocus>

                                                @error('edited_issue')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="link" class="col-md-4 col-form-label text-md-right">{{ __('Accessibility(link)') }}</label>

                                            <div class="col-md-6">
                                                <input id="book_edited_link" required type="text" class="form-control @error('book_edited_link') is-invalid @enderror" name="book_edited_link" value="{{ old('book_edited_link') }}" autocomplete="book_edited_link" autofocus>

                                                @error('book_edited_link')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-5">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="publicationComferenceEditModal" tabindex="-1" role="dialog" aria-labelledby="publicationComferenceEditLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            
                            <div class="card">
                                <div class="card-header">{{__('Edit Publication')}}</div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('publication.update-comference') }}">
                                        @csrf

                                        <input type="hidden" id="comference_publication_id" name="publication_id">

                                       
                                        <div class="form-group row">
                                            <label for="publication_name" class="col-md-4 col-form-label text-md-right">{{ __('Publication Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="edited_publication_name" required type="text" class="form-control @error('edited_publication_name') is-invalid @enderror" name="edited_publication_name" value="{{ old('edited_publication_name') }}" autocomplete="edited_publication_name" autofocus>

                                                @error('edited_publication_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                                            <div class="col-md-6">
                                                <input id="edited_city" required type="text" class="form-control @error('edited_city') is-invalid @enderror" name="edited_city" value="{{ old('edited_city') }}"autocomplete="edited_city" autofocus>

                                                @error('edited_city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('Year') }}</label>

                                            <div class="col-md-6">
                                                
                                                <select id="comference_year" name="comference_year" class="form-control @error('comference_year') is-invalid @enderror">
                                                   
                                                    <?php 
                                                        for($startYear=1950;$startYear <= date("Y"); $startYear++){

                                                            echo '<option id="'.$startYear.'" value="'.$startYear.'">'.$startYear.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                                @error('comference_year')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                       

                                        <div class="form-group row">
                                            <label for="link" class="col-md-4 col-form-label text-md-right">{{ __('Accessibility(link)') }}</label>

                                            <div class="col-md-6">
                                                <input id="comference_link" required type="text" class="form-control @error('comference_link') is-invalid @enderror" name="comference_link" value="{{ old('comference_link') }}" autocomplete="comference_link" autofocus>

                                                @error('comference_link')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-5">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="publication" role="tabpanel">
                
                    <p>
                        <span class="mr-3">Click Add button to add new publication</span>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#publicationModal">
                           ADD
                        </button>
                    </p>

                    <!-- Modal -->
                    <div class="modal fade" id="publicationModal" tabindex="-1" role="dialog" aria-labelledby="publicationModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-header">{{__('Publication')}}</div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('publication.create') }}">
                                        @csrf

                                        <div class="form-group row">
                            
                                            <label class="col-md-4 col-form-label text-md-right" for="publication_type">Publication Type</label>

                                            <div class="col-md-6">

                                                <select id="publication_type" name="publication_type" class="form-control @error('publication_type') is-invalid @enderror">
                                                    <option>--- Select Publication Type ---</option>
                                                </select>

                                                @error('publication_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>

                                        <div id="journal-name-row" class="form-group row">

                                            <label for="jounal_name" class="col-md-4 col-form-label text-md-right">{{ __('Title of publication') }}</label>

                                            <div class="col-md-6">
                                                <input id="journal_name" type="text" class="form-control @error('journal_name') is-invalid @enderror" name="journal_name" value="{{ old('journal_name') }}" autocomplete="journal_name" autofocus>

                                                @error('journal_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div id="publisher-row" class="form-group row">
                                            <label for="publisher" class="col-md-4 col-form-label text-md-right">{{ __('Publisher') }}</label>

                                            <div class="col-md-6">
                                                <input id="publisher" type="text" class="form-control @error('publisher') is-invalid @enderror" name="publisher" value="{{ old('publisher') }}" autocomplete="publisher" autofocus>

                                                @error('publisher')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div id="comference-row" class="form-group row">
                                            <label for="publication_name" class="col-md-4 col-form-label text-md-right">{{ __('Publication Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="publication_name" type="text" class="form-control @error('publication_name') is-invalid @enderror" name="publication_name" value="{{ old('publication_name') }}" autocomplete="publication_name" autofocus>

                                                @error('publication_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div id="city-row" class="form-group row">
                                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                                            <div class="col-md-6">
                                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}"autocomplete="city" autofocus>

                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div id="year-row" class="form-group row">
                                            <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('Year') }}</label>

                                            <div class="col-md-6">
                                                
                                                <select id="year" name="year" class="form-control @error('year') is-invalid @enderror">
                                                    <option value="1950" selected>1950</option>

                                                    <?php 
                                                        for($startYear=1951;$startYear <= date("Y"); $startYear++){
                                                            echo '<option value="'.$startYear.'">'.$startYear.'</option>';
                                                        }
                                                    ?>
                                                </select>

                                                @error('year')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div id="page-row" class="form-group row">
                                            <label for="page" class="col-md-4 col-form-label text-md-right">{{ __('Page') }}</label>

                                            <div class="col-md-6">
                                                <input id="page" type="text" class="form-control @error('page') is-invalid @enderror" name="page" value="{{ old('page') }}" autocomplete="page" autofocus>

                                                @error('page')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div id="volume-row" class="form-group row">
                                            <label for="volume" class="col-md-4 col-form-label text-md-right">{{ __('Volume') }}</label>

                                            <div class="col-md-6">
                                                <input id="volume" type="text" class="form-control @error('volume') is-invalid @enderror" name="volume" value="{{ old('volume') }}" autocomplete="volume" autofocus>

                                                @error('volume')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div id="issue-row" class="form-group row">
                                            <label for="issue" class="col-md-4 col-form-label text-md-right">{{ __('Issue') }}</label>

                                            <div class="col-md-6">
                                                <input id="issue" type="text" class="form-control @error('issue') is-invalid @enderror" name="issue" value="{{ old('issue') }}" autocomplete="issue" autofocus>

                                                @error('issue')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div id="link-row" class="form-group row">
                                            <label for="link" class="col-md-4 col-form-label text-md-right">{{ __('Accessibility(link)') }}</label>

                                            <div class="col-md-6">
                                                <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link') }}" autocomplete="link" autofocus>

                                                @error('link')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-5">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            @if($publications != '')
                                @foreach($publications as $publication)
                                    <div class="card mr-2 mb-2" style="width:32%;">
                                        <div class="card-body">
                                            @if($publication->name == "Journal Article")
                                                <p><span style="font-weight:bold">Title of publication: </span>{{ $publication->journal_name}}</p>
                                                <p><span style="font-weight:bold">Publisher: </span>{{ $publication->publisher}}</p>
                                                <p><span style="font-weight:bold">Year: </span>{{ $publication->year}}</p>
                                                <p><span style="font-weight:bold">Link: </span>{{ $publication->link}}</p>
                                            @elseif(($publication->name == "Book") || ($publication->name == "Book Chapter") )
                                                <p><span style="font-weight:bold">Publisher: </span>{{ $publication->publisher}}</p>
                                                <p><span style="font-weight:bold">Page: </span>{{ $publication->page}}</p>
                                                <p><span style="font-weight:bold">Volume: </span>{{ $publication->volume}}</p>
                                                <p><span style="font-weight:bold">Issue: </span>{{ $publication->issue}}</p>
                                                <p><span style="font-weight:bold">Link: </span>{{ $publication->link}}</p>
                                            @elseif($publication->name == "Comference preceedings")
                                                <p><span style="font-weight:bold">Publication name: </span>{{ $publication->conference_publication_name}}</p>
                                                <p><span style="font-weight:bold">City: </span>{{ $publication->city}}</p>
                                                <p><span style="font-weight:bold">Year: </span>{{ $publication->year}}</p>
                                                <p><span style="font-weight:bold">Link: </span>{{ $publication->link}}</p>
                                            @endif
                                            <div style="position:absolute; bottom:1px; left:0px" class="action-div">
                                                
                                                <div style="float:left">
                                                    @if($publication->name == "Journal Article")
                                                        <button 
                                                            type="button"
                                                            data-toggle="modal"
                                                            data-target = "#publicationJournalEditModal"
                                                            onclick="getPublication({{$publication->id}})"
                                                            class="btn btn-sm btn-success ml-5">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                                                        </button>
                                                    @elseif(($publication->name == "Book") || ($publication->name == "Book Chapter"))
                                                        <button 
                                                            type="button"
                                                            data-toggle="modal"
                                                            data-target = "#publicationBookEditModal"
                                                            onclick="getPublication({{ $publication->id}})"
                                                            class="btn btn-sm btn-success ml-5">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                                                        </button>
                                                    @elseif($publication->name == "Comference preceedings")
                                                        <button 
                                                            type="button"
                                                            data-toggle="modal"
                                                            data-target = "#publicationComferenceEditModal"
                                                            onclick="getPublication({{ $publication->id}})"
                                                            class="btn btn-sm btn-success ml-5">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                                                        </button>
                                                    @endif
                                                   
                                                </div>
                                               
                                                <div style="float:right">
                                                    <button 

                                                        type="button" 
                                                        data-toggle="modal"
                                                        data-target = "#publicationDeleteModal"
                                                        onclick="setPublication({{ $publication->id}})"
                                                        class="btn  btn-sm btn-danger ml-5">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                                    </button>
                                                </div>
                                                
                                            </div>
                                           
                                        </div>
                                        
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    
                  
                </div>

                <div class="tab-pane" id="attachments" role="tabpanel">
                    <div class="card">
                        <div class="card-header">{{ __('Attachments')}}</div>
                        <div class="card-body">
                        <form method="POST" action="{{ route('staffs.add-cv') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="curriculum" class="col-md-4 col-form-label text-md-right">{{ __('Curriculum Vitae') }}</label> 

                                <div class="col-md-6">

                                    @if($staff == '')
                                        <div class="input-group">
                                            <div class="">
                                                <input type="file" id="curriculum" class="form-control @error('curriculum') is-invalid @enderror" name="curriculum" value="{{ old('curriculum') }}" required autocomplete="curriculum" autofocus>

                                                @error('curriculum')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @else
                                        <div class="input-group">
                                            <div class="">
                                                <input type="file" id="curriculum" class="form-control" name="curriculum" value="{{ old('curriculum') }}" required autocomplete="curriculum" autofocus>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>  

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-5">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div> 
       
                        </form>
                        </div>
                    </div>

                </div>

                <div class="tab-pane" id="job" role="tabpanel">

                    <p>
                        <span class="mr-3">Click Add button to add current courses</span>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#courseModal">
                            ADD
                        </button>
                    </p>
                    
                    <div class="modal fade" id="courseModal" tabindex="-1" role="dialog" aria-labelledby="courseModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                
                                            <div class="card">

                                                <div class="card-header">{{ __('Current courses') }}</div>

                                                <div class="card-body">
                                                    <div class="control-group" id="course-fields">
                                                       
                                                        <div class="course-controls"> 

                                                        <form method="POST" action="{{ route('staffs.add-job-details') }}">
                                                            @csrf

                                                            <div class="course-entry input-group col-xs-3 mt-2">
                                                                <input class="form-control" name="fields[]" type="text" placeholder="Type something" />
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-success course-btn-add" type="button">
                                                                        <i class="mdi mdi-plus-thick" aria-hidden="true"></i>
                                                                    </button>
                                                                </span>
                                                            </div>

                                                            <div class="form-group row mt-5" id="courseSave">
                                                                <div class="col-md-6 offset-md-5">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        {{ __('Save') }}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                            <br>
                                                            <small>Press <i class="mdi mdi-plus-thick" aria-hidden="true"></i> to add another form field</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="courseEditModal" tabindex="-1" role="dialog" aria-labelledby="courseEditModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                
                                            <div class="card">

                                                <div class="card-header">{{ __('Edit Courses') }}</div>

                                                <div class="card-body">
                                                    <form method="POST" action="{{ route('course.update') }}">
                                                        @csrf

                                                        <input type="hidden" id="course_id" name="course_id">

                                                        <div class="form-group row">
                                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="edited_course_name" type="text" class="form-control @error('edited_course_name') is-invalid @enderror" name="edited_course_name" value="{{ old('edited_course_name') }}" required autocomplete="edited_course_name" autofocus>

                                                                @error('edited_course_name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-6 offset-md-5">
                                                                <button type="submit" class="btn btn-primary">
                                                                    {{ __('Save') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        
                            </div>
                        </div>
                    </div>

                    <div class="modal" id="courseDeleteModal" tabindex="-1" role="dialog" aria-labelledby="courseDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="card">
                                    <div class="card-header">{{__('Are you sure you want to delete this record?') }}</div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('course.delete') }}">
                                            @csrf

                                            <input type="hidden" id="course_ondelete_id" name="course_ondelete_id">

                                            <div class="form-group">
                                                <div class="pull-right">

                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                        {{ __('No') }}
                                                    </button>

                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Yes') }}
                                                    </button>

                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">Name</th>
                                <th colspan="2"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($courses != '')
                                @foreach($courses as $course)
                                    <tr>
                                    <td>{{ $course->name}}</td>
                                    <td>
                                        <button 
                                            type="button"
                                            data-toggle="modal"
                                            data-target = "#courseEditModal"
                                            onclick="getCourse({{ $course->id}})"
                                            class="btn btn-sm btn-success ml-5">
                                            <i class="fa fa-pencil" aria-hidden="true">&nbsp;Edit</i>
                                        </button>
                                    </td>
                                    <td>
                                        <button 

                                        type="button" 
                                        data-toggle="modal"
                                        data-target = "#courseDeleteModal"
                                        onclick="getCourse({{ $course->id}})"
                                        class="btn  btn-sm btn-danger ml-5">
                                        <i class="fa fa-trash" aria-hidden="true">&nbsp;Delete</i>
                                        </button>
                                    </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
                
            
</div>
@endsection
