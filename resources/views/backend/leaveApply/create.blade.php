@extends('backend.master')
@section('content')
@section('title') Leave Apply Create @endsection
@section('leave-apply') active @endsection
@section('leave-apply.create') active @endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/dropify/css/dropify.min.css">
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Leave Apply Create</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Leave Apply</a>
            </li>
            <li class="breadcrumb-item active">Leave Apply Create
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">
      <div class="card-content " id="html-validations">
        <div class="float-right">
          @if(Auth::user()->can('leave-apply-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('leave-assign.index')}}">
            <i class="material-icons dp48">list</i>
            <span>
              Leave Apply List
            </span>
          </a>
          @endif
        </div>

        <div class="row" id="html-view-validations">

          <form class="col s12" method="post" action="{{route('leave-apply.store')}}" lass="formValidate0"
            id="formValidate0" enctype="multipart/form-data">
            @csrf
            <div class="row">

              <div class="col m6  s12">
                <div class="input-field">
                  <select class="select2 browser-default error validate" id="role_id" name="role_id" required>
                    <option value="" selected disabled>Select Role <span class="custom-text-danger">*</span></option>

                    @foreach($roleData as $singleRoleData)
                    @if(isset($singleRoleData) && $singleRoleData != null)
                    <option value="{{ $singleRoleData->id }}">{{ Str::title($singleRoleData->name) }}</option>
                    @endif

                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col m6  s12">
                <div class="input-field">
                  <select class="select2 browser-default error validate" id="leave_application_to"
                    name="leave_application_to" required>
                    <option value="" selected disabled>Leave Application To <span class="custom-text-danger">*</span></option>
                  </select>
                </div>
              </div>

              <div class="col m6  s6">
                <div class="input-field">
                  <select class="select2 browser-default error validate" id="leave_category_id" name="leave_category_id"
                    required>
                    <option value="" selected disabled>Select Leave Category <span class="custom-text-danger">*</span></option>

                    @foreach($leaveCategoryData as $singleCategoryData)
                    @if(isset($singleCategoryData) && $singleCategoryData != null)
                    <option value="{{ $singleCategoryData->id }}">{{ ucfirst($singleCategoryData->leave_category) }}
                    </option>
                    @endif

                    @endforeach
                  </select>
                </div>
              </div>


              <div class="col m6 s6">
                <div class="input-field" id="view-date-picker">
                  <label for="reason">Subject <span class="custom-text-danger">*</span></label>
                  <input type="text" class="validate" name="reason" id="reason" value="" required>

                  @error('reason')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
              </div>

            </div>

            <div class="row">

              <div class="col m6  s12">
                <div class="input-field" id="view-date-picker">
                  <label for="start_date">From Date <span class="custom-text-danger">*</span></label>
                  <input type="text" class="datepicker" name="start_date" id="start_date" value="" required>

                  @error('start_date')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
              </div>

              <div class="col m6  s12">
                <div class="input-field" id="view-date-picker">
                  <label for="end_date">Till Date <span class="custom-text-danger">*</span></label>
                  <input type="text" class="datepicker" name="end_date" id="end_date" value="" required>

                  @error('end_date')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
              </div>

              

              <div class="col m12  s12">
                <div class="input-field col s12 m12 custom-texarea-body">
                  <label for="description" class="mb10">Desciption <span class="custom-text-danger">*</span></label>
                  <textarea id="description" name="description" class="materialize-textarea" placeholder="Description" cols="20"
                    rows="40"></textarea>
                
                  @error('description')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
              </div>

              <div class="input-field col s12 m12">
                <div class="col s12 m4 l2 mb-1">
                  <p>Document File </p>
                </div>
              
                <input type="file" id="attachment_file" name="attachment_file" class="dropify" data-default-file="" />
              
                @error('attachment_file')
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
@include('backend.leaveApply.partial.script')
<script src="{{ asset('backend') }}/app-assets/vendors/dropify/js/dropify.min.js"></script>
<script src="{{ asset('backend') }}/app-assets/js/scripts/form-file-uploads.js"></script>
@endsection