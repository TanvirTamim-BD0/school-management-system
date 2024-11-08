@extends('backend.master')
@section('content')
@section('title') Student Attendence Report Filter @endsection
@section('report-of-attendence-student') active @endsection
@section('report-of-attendence-student') active @endsection
@section('styles')
@endsection

@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Student Attendence Report Filter</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Student Attendence Report Filter
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-table-filtering-header">
        <form method="post" action="{{route('report-of-attendence-student')}}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col m4  s12">
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
            <div class="col m4  s12">
              <div class="input-field">
                <select class="select2 browser-default" name="section_id" id="section_id"
                  data-placeholder="Select Section" required>

                </select>
              </div>
            </div>

            <div class="col m4  s12">
              <div class="input-field">
                <select class="select2 browser-default" name="student_id" id="student_id"
                  data-placeholder="Select Student" required>

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
@section('scripts')
@include('backend.paymentStudent.partial.script')
@endsection