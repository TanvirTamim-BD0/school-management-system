@extends('backend.master')
@section('content')
@section('title') Result Filter @endsection
@section('result-filter') active @endsection
@section('result-filter') active @endsection
@section('styles')
@endsection

@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Result Filter</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Result Filter
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Exam Result Filter</h2>
      </div>

      <div class="card-content custom-table-filtering-header">
        <div class="row">
        <form method="post" action="{{route('get-single-student-result')}}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col m6  s12">
              <div class="input-field">
                <select class="select2 browser-default" id="class_id" name="class_id" required>
                  <option value="" selected disabled>Select Class <span class="custom-text-danger">*</span></option>
                  @foreach($classData as $singleClassData)
                  @if(isset($singleClassData) && $singleClassData != null)
                  <option value="{{ $singleClassData->id }}">{{ $singleClassData->class_name }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col m6  s12">
              <div class="input-field">
                <select class="select2 browser-default" name="section_id" id="section_id"
                   required>
                <option value="" selected disabled>Select Section <span class="custom-text-danger">*</span></option>

                </select>
              </div>
            </div>
            
            <div class="col m6  s12">
              <div class="input-field">
                <select class="select2 browser-default" name="subject_id" id="subject_id"
                   required>
                <option value="" selected disabled>Select Subject <span class="custom-text-danger">*</span></option>

                </select>
              </div>
            </div>

            <div class="col m6  s12">
              <div class="input-field">
                <select class="select2 browser-default" id="exam_id" name="exam_id" required>
                  <option value="" selected disabled>Select Exam <span class="custom-text-danger">*</span></option>
            
                </select>
              </div>
            </div>

            <div class="col m12  s12">
              <div class="input-field">
                <select class="select2 browser-default" name="student_id" id="student_id"
                   required>
                  <option value="" selected disabled>Select Student <span class="custom-text-danger">*</span></option>

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

</div>

@endsection
@section('scripts')
@include('backend.result.partial.script')
@endsection