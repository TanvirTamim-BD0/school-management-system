@extends('backend.master')
@section('content')
@section('title') Issue Book @endsection
@section('bookIssue') active @endsection
@section('bookIssue.create') active @endsection
@section('styles')
@endsection
@section('content')
  
  <div class="row">

    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>Issue Book</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Issue Book
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>

    <div class="col s12">
      <div class="card">
        <div class="card-content">

          <div class="float-right">
              @if(Auth::user()->can('student-book-issue-list'))
              <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button" href="{{route('bookIssue.index')}}">
                 <i class="material-icons dp48">list</i> Issue Book List
              </a>
              @endif
            </div>


        <div class="row">

          <form class="col s12" method="post" action="{{route('search.student')}}">
          @csrf
            <div class="row">

              <div class="input-field col s12 m12">
                <select class="select2 browser-default" name="student_id" required>
                  <option value="" disabled selected>Select Student ID</option>
                  @foreach($studentData as $student)
                  <option value="{{$student->id}}" class="left circle">{{$student->roll_no}}</option>
                  @endforeach

                </select>

                @error('student_id')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror

              </div>

             
            <div class="col m12  s12 custom-text-center">
                <button class="mb-1 btn waves-effect waves-light purple lightrn-1 custom-filter-button" type="submit">
                     <span>Filter</span>
                </button>
              </div>

            </div>

          </form>
        </div>
  
        </div>
      </div>
    </div>
    
  </div>
  
@endsection