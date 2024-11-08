@extends('backend.master')
@section('content')
@section('title') Leave Assign Create @endsection
@section('leave-assign') active @endsection
@section('leave-assign.create') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Leave Assign Create</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Leave Assign</a>
            </li>
            <li class="breadcrumb-item active">Leave Assign Create
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
          @if(Auth::user()->can('leave-assign-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('leave-assign.index')}}">
            <i class="material-icons dp48">list</i>
            <span>
              Leave Assign List
            </span>
          </a>
          @endif
        </div>

        <div class="row" id="html-view-validations">

          <form class="col s12" method="post" action="{{route('leave-assign.store')}}" lass="formValidate0"
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

              <div class="col m12  s12">
                <div class="input-field">
                  <input id="icon_prefix" type="number" class="validate" name="no_of_days" required>
                  <label for="icon_prefix">No Of Days <span class="custom-text-danger">*</span></label>

                  @error('no_of_days')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
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