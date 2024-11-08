@extends('backend.master')
@section('content')
@section('title') Student Attendance @endsection
@section('attendace-of-student') active @endsection
@section('attendace-of-student.create') active @endsection
@section('styles')
@endsection

@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Student Attendance Filter</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Student Attendance</a>
            </li>
            <li class="breadcrumb-item active">Student Attendance Filter
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-table-filtering-header">
        <h2 class="card-title">Student Record Filter For Attendance</h2>
        <form method="post" action="{{route('get-student-filter-data-for-attendance')}}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col m3  s12">
              <div class="input-field">
                <select class="select2 browser-default" id="class_id" name="class_id" required>
                  <option value="#" selected disabled>Select Class</option>
                  @foreach($classData as $singleClassData)
                  @if(isset($singleClassData) && $singleClassData != null)
                  <option value="{{ $singleClassData->id }}">{{ $singleClassData->class_name }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col m3  s12">
              <div class="input-field">
                <select class="select2 browser-default" name="section_id" id="section_id"
                  data-placeholder="Select Section" required>

                </select>
              </div>
            </div>
            
            <div class="col m3  s12">
              <div class="input-field" id="view-date-picker">
                <label for="date">Date</label>
                <input type="text" class="datepicker" name="date" id="date" value="{{$todayDate}}" required>
              
                @error('date')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>
            </div>
            <div class="col m3  s12 custom-text-center">
              <button class="mb-6 btn waves-effect waves-light purple lightrn-1" type="submit">
                <i class="material-icons">search</i>
                <span>Filter</span>
              </button>
            </div>
          </div>
        </form>
      </div>

    </div>

  </div>

</div>

@endsection
@section('scripts')
@include('backend.assignment.partial.script')
@endsection