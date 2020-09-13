@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 sidebar">

            <div class="list-group" id="myList" role="tablist">

                <a class="list-group-item list-group-item-action active" data-toggle="list" href="#personal" role="tab">Personal details</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#biography" role="tab">Biography</a>
                <!-- <a class="list-group-item list-group-item-action" data-toggle="list" href="#education"  role="tab" id="educationTab">Education History</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#emplyoment" role="tab">Employment History</a> -->
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#publication"  role="tab" id="educationTab">Publications</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#project" role="tab">Projects</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#job" role="tab">Courses</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#areas" role="tab">Areas of research</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#skills" role="tab">Skills</a>
                <!-- <a class="list-group-item list-group-item-action" data-toggle="list" href="#attachments" role="tab">Attachments</a> -->
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
                <div class="tab-pane show active" id="personal" role="tabpanel">
                    <div class="card">

                        <div class="card-header">{{ __('Personal details') }}</div>

                        <div class="card-body">

                            <input type="hidden" id="account-hidden" value="{{$staff->staff_category}}"></input>
                            <form method="POST" action="{{ route('staffs.create') }}" enctype="multipart/form-data">
                                @csrf

                                
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="type">Account type</label>

                                    <div class="col-md-6">
                                        <select id="account_type" name="account_type" class="form-control @error('account_type') is-invalid @enderror">
                                           <option>--- Select Account Type ---</option>
                                        </select>

                                        @error('account_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="@if($staff != '') {{ $staff->full_name}} @else {{ old('name')}}@endif" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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

                <div class="tab-pane" id="areas" role="tabpanel">
                    
                    <!-- @if($staff->areas_of_research != '')
                        <div class="card mb-4">
                            <div class="card-header">Current areas of research</div>
                            <div class="card-body">
                                {{ $staff->areas_of_research}}
                            </div>
                        </div>
                    @endif -->

                    <div class="card">
                        <div class="card-header">@if($staff->areas_of_research == ''){{ __('Add areas of research') }} @else {{ __('Update areas of research') }}@endif</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('staffs.add-areas') }}">
                                @csrf

                                <div class="form-group row">
                                   
                                    <div class="col-sm-12">

                                        <div class="form-group">
                                            <textarea 
                                                rows="3" id="areas" 
                                                class="form-control @error('areas') is-invalid @enderror" 
                                                name="areas" 
                                                value="{{ old('areas') }}" 
                                                placeholder="area one, area two, area three"
                                                required 
                                                autocomplete="areas" 
                                                autofocus
                                            >
                                                @if($staff != '') {{ $staff->areas_of_research }} @endif
                                            </textarea>
                                        </div>

                                        @error('areas')
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

                <div class="tab-pane" id="skills" role="tabpanel">
                    
                    <!-- @if($staff->skills != '')
                        <div class="card mb-4">
                            <div class="card-header">Current Skills</div>
                            <div class="card-body">
                                {{ $staff->skills}}
                            </div>
                        </div>
                    @endif -->

                    <div class="card">
                        <div class="card-header">@if($staff->skills == ''){{ __('Add Skills') }} @else {{ __('Update skills') }}@endif</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('staffs.add-skills') }}">
                                @csrf

                                <div class="form-group row">
                                   
                                    <div class="col-sm-12">

                                        <div class="form-group">
                                            <textarea 
                                                rows="3" id="skills-textarea" 
                                                class="form-control @error('skills') is-invalid @enderror" 
                                                name="skills" 
                                                value="{{ old('skills') }}" 
                                                placeholder="first skill,second skill, third skill"
                                                required 
                                                autocomplete="skills" 
                                                autofocus
                                            >
                                                @if($staff != '') {{ $staff->skills }} @endif
                                            </textarea>
                                        </div>

                                        @error('skills')
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

                <div class="tab-pane" id="education" role="tabpanel">

                    <p>
                        <span class="mr-3">Click Add button to add another history to list</span>

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#educationHistoryModal">
                            ADD
                        </button>
                    </p>

                    <!-- Modal -->
                    <div class="modal fade" id="educationHistoryModal" tabindex="-1" role="dialog" aria-labelledby="educationHistoryModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                               
                                <div class="card">
                                    <div class="card-header">{{_('Education history')}}</div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('education.create') }}">
                                            @csrf

                                            <div class="form-group row">
                                                <label for="college" class="col-md-4 col-form-label text-md-right">{{ __('College/University') }}</label>

                                                <div class="col-md-6">
                                                    <input id="college" type="text" class="form-control @error('college') is-invalid @enderror" name="college" value="{{ old('college') }}" required autocomplete="college" autofocus>

                                                    @error('college')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="award">Award</label>

                                                <div class="col-md-6">
                                                    <select id="award" name="award" class="form-control @error('award') is-invalid @enderror">
                                                        <option selected value="Bachelor of Science Degree">Bachelor of Science Degree</option>
                                                        <option value="Bachelor of Arts Degree">Bachelor of Arts Degree</option>
                                                        <option value="Masters of Science Degree">Masters of Science Degree</option>
                                                        <option value="Masters of Arts Degree">Masters of Arts Degree</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="faculty" class="col-md-4 col-form-label text-md-right">{{ __('Facult') }}</label>

                                                <div class="col-md-6">
                                                    <input id="faculty" type="text" class="form-control @error('faculty') is-invalid @enderror" name="faculty" value="{{ old('faculty') }}" required autocomplete="faculty" autofocus>

                                                    @error('faculty')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('Year Completed') }}</label>

                                                <div class="col-md-6">
                                                    <input id="year" type="text" class="form-control @error('year') is-invalid @enderror" name="year" value="{{ old('year') }}" required autocomplete="year" autofocus>

                                                    @error('year')
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
                    
                    <div class="table-responsive">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">University</th>
                                <th scope="col">Course</th>
                                <th scope="col">Completed Year</th>
                                <th colspan="2"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($education_histories != '')
                                @foreach($education_histories as $history)
                                    <tr>
                                    <td>{{ $history->university}}</td>
                                    <td>{{ $history->course}}</td>
                                    <td>{{ $history->year }}</td>
                                    <td>
                                        <button 
                                            type="button"
                                            data-toggle="modal"
                                            data-target = "#educationEditModal"
                                            onclick="getEducationHistory({{ $history->id}})"
                                            class="btn btn-sm btn-success ml-5">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button 
                                        type="button"
                                        data-toggle="modal"
                                        data-target = "#educationDeleteModal"
                                        onclick="getEducationHistory({{ $history->id}})"
                                        class="btn  btn-sm btn-danger ml-5">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                       
                    </div>

                    <div class="modal" id="educationDeleteModal" tabindex="-1" role="dialog" aria-labelledby="educationDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="card">
                                    <div class="card-header">{{__('Are you sure you want to delete this record?') }}</div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('education.deleteHistory') }}">
                                            @csrf

                                            <input type="hidden" id="ondelete_id" name="ondelete_id">

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

                    <div class="modal fade" id="educationEditModal" tabindex="-1" role="dialog" aria-labelledby="educationEditModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                               
                                <div class="card">
                                    <div class="card-header">{{_('Edit Education history')}}</div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('education.update') }}">
                                            @csrf

                                            <input type="hidden" id="education_id" name="education_id">

                                            <div class="form-group row">
                                                <label for="college" class="col-md-4 col-form-label text-md-right">{{ __('College/University') }}</label>

                                                <div class="col-md-6">
                                                    <input id="editedcollege" type="text" class="form-control @error('college') is-invalid @enderror" name="college" value="{{ old('college') }}" required autocomplete="college" autofocus>

                                                    @error('college')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="award">Award</label>

                                                <div class="col-md-6">
                                                    <select id="editedaward" name="award" class="form-control @error('award') is-invalid @enderror">
                                                        <option value="Bachelor of Science Degree">Bachelor of Science Degree</option>
                                                        <option value="Bachelor of Arts Degree">Bachelor of Arts Degree</option>
                                                        <option value="Masters of Science Degree">Masters of Science Degree</option>
                                                        <option value="Masters of Arts Degree">Masters of Arts Degree</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="faculty" class="col-md-4 col-form-label text-md-right">{{ __('Facult') }}</label>

                                                <div class="col-md-6">
                                                    <input id="editedfaculty" type="text" class="form-control @error('faculty') is-invalid @enderror" name="faculty" value="{{ old('faculty') }}" required autocomplete="faculty" autofocus>

                                                    @error('faculty')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('Year Completed') }}</label>

                                                <div class="col-md-6">
                                                    <input id="editedyear" type="text" class="form-control @error('year') is-invalid @enderror" name="year" value="{{ old('year') }}" required autocomplete="year" autofocus>

                                                    @error('year')
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
                </div>


                <div class="modal" id="employmentDeleteModal" tabindex="-1" role="dialog" aria-labelledby="employmentDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-header">{{__('Are you sure you want to delete this record?') }}</div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('employment.deleteHistory') }}">
                                        @csrf

                                        <input type="hidden" id="employment_ondelete_id" name="employment_ondelete_id">

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

                <div class="modal fade" id="employmentEditModal" tabindex="-1" role="dialog" aria-labelledby="employmentEditModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            
                            <div class="card">
                                <div class="card-header">{{_('Edit Employment history')}}</div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('employment.update') }}">
                                        @csrf

                                        <input type="hidden" id="employment_id" name="employment_id">

                                        <div class="form-group row">
                                            <label for="college" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>

                                            <div class="col-md-6">
                                                <input id="editedposition" type="text" class="form-control @error('position') is-invalid @enderror" name="position" value="{{ old('position') }}" required autocomplete="position" autofocus>

                                                @error('position')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="place" class="col-md-4 col-form-label text-md-right">{{ __('Place of Work') }}</label>

                                            <div class="col-md-6">
                                                <input id="editedplace" type="text" class="form-control @error('place') is-invalid @enderror" name="place" value="{{ old('place') }}" required autocomplete="place" autofocus>

                                                @error('place')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="start_year" class="col-md-4 col-form-label text-md-right">{{ __('Start Year') }}</label>

                                            <div class="col-md-6">
                                                <input id="editedstartyear" type="text" class="form-control @error('start_year') is-invalid @enderror" name="start_year" value="{{ old('start_year') }}" required autocomplete="start_year" autofocus>

                                                @error('start_year')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="end_year" class="col-md-4 col-form-label text-md-right">{{ __('End Year') }}</label>

                                            <div class="col-md-6">
                                                <input id="editedendyear" type="text" class="form-control @error('end_year') is-invalid @enderror" name="end_year" value="{{ old('end_year') }}" required autocomplete="end_year" autofocus>

                                                @error('end_year')
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

                <div class="tab-pane" id="emplyoment" role="tabpanel">
                
                    <p>
                        <span class="mr-3">Click Add button to add employment to list</span>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#employmentHistoryModal">
                           ADD
                        </button>
                    </p>

                    <!-- Modal -->
                    <div class="modal fade" id="employmentHistoryModal" tabindex="-1" role="dialog" aria-labelledby="employmentHistoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-header">{{_('Employment history')}}</div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('employment.create') }}">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>

                                            <div class="col-md-6">
                                                <input id="position" type="text" class="form-control @error('position') is-invalid @enderror" name="position" value="{{ old('position') }}" required autocomplete="position" autofocus>

                                                @error('position')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                        <label for="place" class="col-md-4 col-form-label text-md-right">{{ __('Place of Work') }}</label>

                                            <div class="col-md-6">
                                                <input id="place" type="text" class="form-control @error('place') is-invalid @enderror" name="place" value="{{ old('place') }}" required autocomplete="place" autofocus>

                                                @error('place')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="start_year" class="col-md-4 col-form-label text-md-right">{{ __('Start Year') }}</label>

                                            <div class="col-md-6">
                                                <input id="start_year" type="text" class="form-control @error('start_year') is-invalid @enderror" name="start_year" value="{{ old('start_year') }}" required autocomplete="start_year" autofocus>

                                                @error('start_year')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="end_year" class="col-md-4 col-form-label text-md-right">{{ __('End Year') }}</label>

                                            <div class="col-md-6">
                                                <input id="end_year" type="text" class="form-control @error('end_year') is-invalid @enderror" name="end_year" value="{{ old('end_year') }}" required autocomplete="end_year" autofocus>

                                                @error('end_year')
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

                    <div class="table-responsive">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">Position</th>
                                <th scope="col">Place</th>
                                <th scope="col">Start Year</th>
                                <th scope="col">End Year</th>
                                <th colspan="2"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($employment_histories != '')
                                @foreach($employment_histories as $employment)
                                    <tr>
                                    <td>{{ $employment->position}}</td>
                                    <td>{{ $employment->place}}</td>
                                    <td>{{ $employment->start_year}}</td>
                                    <td>{{ $employment->end_year}}</td>
                                    <td>
                                        <button 
                                            type="button"
                                            data-toggle="modal"
                                            data-target = "#employmentEditModal"
                                            onclick="getEmploymentHistory({{ $employment->id}})"
                                            class="btn btn-sm btn-success ml-5">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button 

                                        type="button" 
                                        data-toggle="modal"
                                        data-target = "#employmentDeleteModal"
                                        onclick="getEmploymentHistory({{ $employment->id}})"
                                        class="btn  btn-sm btn-danger ml-5">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                       
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
                                <div class="card-header">{{_('Edit Publication')}}</div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('publication.update-journal') }}">
                                        @csrf

                                        <input type="hidden" id="journal_publication_id" name="publication_id">

                                        <div id="edited_journal-name-row" class="form-group row">

                                            <label for="edited_journal_name" class="col-md-4 col-form-label text-md-right">{{ __('Jounal name(title)') }}</label>

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
                                                <input id="journal_edited_year" type="text" required class="form-control @error('journal_edited_year') is-invalid @enderror" name="journal_edited_year" value="{{ old('journal_edited_year') }}" autocomplete="journal_edited_year" autofocus>

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
                                <div class="card-header">{{_('Edit Publication')}}</div>
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
                                <div class="card-header">{{_('Edit Publication')}}</div>
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
                                                <input id="comference_year" required type="text" class="form-control @error('comference_year') is-invalid @enderror" name="comference_year" value="{{ old('comference_year') }}" autocomplete="comference_year" autofocus>

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
                                <div class="card-header">{{_('Publication')}}</div>
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

                                            <label for="jounal_name" class="col-md-4 col-form-label text-md-right">{{ __('Jounal name(title)') }}</label>

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
                                                <input id="year" type="text" class="form-control @error('year') is-invalid @enderror" name="year" value="{{ old('year') }}" autocomplete="year" autofocus>

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
                                                <p><span style="font-weight:bold">Jounal Name: </span>{{ $publication->journal_name}}</p>
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
                    
                  
                    
                    <!-- <div class="table-responsive">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">Position</th>
                                <th scope="col">Place</th>
                                <th scope="col">Start Year</th>
                                <th scope="col">End Year</th>
                                <th colspan="2"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($employment_histories != '')
                                @foreach($employment_histories as $employment)
                                    <tr>
                                    <td>{{ $employment->position}}</td>
                                    <td>{{ $employment->place}}</td>
                                    <td>{{ $employment->start_year}}</td>
                                    <td>{{ $employment->end_year}}</td>
                                    <td>
                                        <button 
                                            type="button"
                                            data-toggle="modal"
                                            data-target = "#employmentEditModal"
                                            onclick="getEmploymentHistory({{ $employment->id}})"
                                            class="btn btn-sm btn-success ml-5">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button 

                                        type="button" 
                                        data-toggle="modal"
                                        data-target = "#employmentDeleteModal"
                                        onclick="getEmploymentHistory({{ $employment->id}})"
                                        class="btn  btn-sm btn-danger ml-5">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                       
                    </div> -->

                </div>

                <div class="tab-pane" id="attachments" role="tabpanel">
                    <div class="card">
                        <div class="card-header">{{ __ ('Attachments')}}</div>
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


                    @if(count($staff_roles) > 0)

                    <div class="card">
                            <div class="card-header"><center>{{ __ ('Current courses')}}</center></div>

                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table table-sm table-bordered">
                                        <!-- <tr>
                                            <td>Position: </td>
                                            <td>
                                            @foreach($staff_roles as $staff_role)
                                                <p>{{ $staff_role['name'] }}</p>
                                            @endforeach
                                            </td>
                                        </tr> -->
                                        <tr>
                                            <td>Department: </td>
                                            <td>
                                                {{ $department}}
                                            </td>
                                        </tr>
                                        @if(count($staff_courses) > 0)
                                        
                                            <tr>
                                                <td>Current courses: </td>
                                                <td>
                                                @foreach($staff_courses as $staff_course)
                                                    <p>{{ $staff_course['name'] }}</p>
                                                @endforeach
                                                </td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                    </div>
                    @endif

                   

                    <div class="card mt-5">
                        <div class="card-header">
                        @if(count($staff_roles) > 0)
                            <center>{{ __ ('Update courses')}}</center>
                        @else
                            <center>{{ __ ('Add courses')}}</center>
                        @endif
                        </div>
                        <div class="card-body">

                        <form method="POST" action="{{ route('staffs.add-job-details') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="award">Position<strong class="text-danger">*</strong></label>

                                <div class="col-md-6">
                                    <select id="role" name="role[]" multiple class="form-control @error('role') is-invalid @enderror" required>
                                        <option value="">--- Select Position ---</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> -->

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="award">Department<strong class="text-danger">*</strong></label>

                                <div class="col-md-6">
                                    <select id="department" name="department" class="form-control @error('department') is-invalid @enderror" required>
                                    <option value="">--- Select Department ---</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" id="currentCourse">
                                <label class="col-md-4 col-form-label text-md-right" for="award">Current courses</label>

                                <div class="col-md-8">
                                    <p class="text-danger">(This option is for lecturers)</p>
                                    <select id="courses" name="courses[]" multiple>
                                        <option value="">--- Select Courses ---</option>
                                        <!-- <option selected value="Bachelor of Science Degree">Bachelor of Science Degree</option>
                                        <option value="Bachelor of Arts Degree">Bachelor of Arts Degree</option>
                                        <option value="Masters of Science Degree">Masters of Science Degree</option>
                                        <option value="Masters of Arts Degree">Masters of Arts Degree</option> -->
                                    </select>

                                   
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
    </div>
                
            
</div>
@endsection
