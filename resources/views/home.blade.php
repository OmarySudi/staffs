@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 sidebar">

            <div class="list-group" id="myList" role="tablist">
                <a class="list-group-item list-group-item-action active" data-toggle="list" href="#personal" role="tab">Personal details</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#biography" role="tab">Biography</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#education"  role="tab" id="educationTab">Education History</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#emplyoment" role="tab">Employment History</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#userCategory" role="tab">Position</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#attachments" role="tab">Attachments</a>
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
                            <form method="POST" action="{{ route('staffs.create') }}" enctype="multipart/form-data">
                                @csrf

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

                <div class="tab-pane" id="userCategory" role="tabpanel">
                    <div class="card pt-5">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="staff_position">Choose your position in organization</label>

                            <div class="col-md-6">
                                <select id="staff_position" name="staff_position" class="form-control @error('staff_position') is-invalid @enderror">
                                    <!-- <option selected value="Bachelor of Science Degree">Bachelor of Science Degree</option>
                                    <option value="Bachelor of Arts Degree">Bachelor of Arts Degree</option>
                                    <option value="Masters of Science Degree">Masters of Science Degree</option>
                                    <option value="Masters of Arts Degree">Masters of Arts Degree</option> -->
                                    @if($categories != '')
                                        @foreach($categories as $category)
                                            
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div> 

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
            </div>
        </div>
    </div>
                
            
</div>
@endsection
