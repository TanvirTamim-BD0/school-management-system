@extends('backend.master')
@section('content')
@section('title') Teacher Assign Create @endsection
@section('assign-teacher') active @endsection
@section('assign-teacher.create') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Teacher Assign Create</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Teacher Assign</a>
            </li>
            <li class="breadcrumb-item active">Teacher Assign Create
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

          @if(Auth::user()->can('teacher-assign-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('assign-teacher.index')}}">
            <i class="material-icons dp48">list</i> Teacher Assign List
          </a>
          @endif

        </div>


        <div class="row">

          <form class="col s12" method="post" action="{{route('assign-teacher.store')}}">
            @csrf
            <div class="row">

              <div class="input-field col s12 m6">
                <select class="select2 browser-default" name="teacher_id" required>
                  <option value="" disabled selected>Select Teacher <span class="custom-text-danger">*</span></option>
                  @foreach($teachers as $teacher)
                  <option value="{{$teacher->id}}" class="left circle">{{$teacher->teacher_name}}</option>
                  @endforeach

                </select>

                @error('teacher_id')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror

              </div>


              <div class="input-field col s12 m6">
                <select class="select2 browser-default" name="class_id" id="class_id" required>
                  <option value="" disabled selected>Select Class <span class="custom-text-danger">*</span></option>
                  @foreach($classes as $class)
                  <option value="{{$class->id}}" class="left circle">{{$class->class_name}}</option>
                  @endforeach

                </select>

                @error('class_id')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror

              </div>
              
              <div class="input-field col s12 m6">
                <select class="select2 browser-default" name="section_id" id="section_id" required>
                  <option value="" disabled selected>Select Section <span class="custom-text-danger">*</span></option>
                 

                </select>

                @error('section_id')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror

              </div>


              <div class="input-field col s12 m6">
                <select class="select2 browser-default" name="subject_id" id="subject_id" required>
                  <option value="" disabled selected>Select Subject <span class="custom-text-danger">*</span></option>

                </select>

                @error('subject_id')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror

              </div>

              <div class="col s12 mb-3">
                <button class="mb-6 btn waves-effect waves-light purple lightrn-1" type="submit">
                  Submit
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

@section('scripts')
@include('backend.teacherAssign.partial.script')
@endsection