@extends('backend.master')
@section('content')
@section('title') Class Routine @endsection
@section('classRoutine') active @endsection
@section('classRoutine.index') active @endsection
@section('styles')
@endsection

@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Class Routine Filter</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Class Routine</a>
            </li>
            <li class="breadcrumb-item active">Class Routine Filter
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Class Routine Record List</h2>
        <div class="float-right justify-content-end">
          @if(Auth::user()->can('class-routine-create'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('classRoutine.create')}}">
            <i class="material-icons dp48">add_circle_outline</i> Add Class Routine
          </a>
          @endif
        </div>
      </div>


      <div class="card-content custom-table-filtering-header">
        <form method="post" action="{{route('class-rutine-get')}}" enctype="multipart/form-data">
          @csrf
          <div class="row">


            <div class="col m6 s12">
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
          </div>

          <div class="row">
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

@endsection
@section('scripts')
@include('backend.assignment.partial.script')
@endsection