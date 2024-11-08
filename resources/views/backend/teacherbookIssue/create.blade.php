@extends('backend.master')
@section('content')
@section('title') Teacher Issue Book @endsection
@section('book-issue-teacher') active @endsection
@section('book-issue-teacher.index') active @endsection
@section('styles')
@endsection
@section('content')
  
  <div class="row">

    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>Teacher Issue Book</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Teacher Issue Book
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
              @if(Auth::user()->can('teacher-book-issue-list'))
              <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button" href="{{route('book-issue-teacher.index')}}">
                 <i class="material-icons dp48">list</i> Teacher Issue Book List
              </a>
              @endif
            </div>


        <div class="row">

          <form class="col s12" method="post" action="{{route('search.teacher')}}">
          @csrf
            <div class="row">

              <div class="input-field col s12 m12">
                <select class="select2 browser-default" name="teacher_id" required>
                  <option value="" disabled selected>Select Teacher</option>
                  @foreach($teacherData as $teacher)
                  <option value="{{$teacher->id}}" class="left circle">{{$teacher->teacher_name}}</option>
                  @endforeach

                </select>

                @error('teacher_id')
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