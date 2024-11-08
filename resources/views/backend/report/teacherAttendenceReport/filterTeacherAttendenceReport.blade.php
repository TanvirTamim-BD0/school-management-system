@extends('backend.master')
@section('content')
@section('title') Teacher Attendence Report Filter @endsection
@section('report-of-attendence-teacher') active @endsection
@section('report-of-attendence-teacher') active @endsection
@section('styles')
@endsection

@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Teacher Attendence Report Filter</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Teacher Attendence Report Filter
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-table-filtering-header">
        <form method="post" action="{{route('report-of-attendence-teacher')}}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col m12 s12">
              <div class="input-field">
                <select class="select2 browser-default" id="teacher_id" name="teacher_id" required>
                  <option value="#" selected disabled>Select Teacher</option>
                  @foreach($teacherData as $singleTeacherData)
                  @if(isset($singleTeacherData) && $singleTeacherData != null)
                  <option value="{{ $singleTeacherData->id }}">{{ $singleTeacherData->teacher_name }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>


            <div class="col m12  s12 custom-text-center">
              <button class="mb-1 btn waves-effect waves-light purple lightrn-1 custom-filter-button" type="submit">
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