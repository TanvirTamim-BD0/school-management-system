@extends('backend.master')
@section('content')
@section('title') Leaven Assign Update @endsection
@section('leave-assign') active @endsection
@section('leave-assign.update') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Leaven Assign Update</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Leaven Assign</a>
            </li>
            <li class="breadcrumb-item active">Leaven Assign Update
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
          @if(Auth::user()->can('leave-assign-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('leave-assign.index')}}">
            <i class="material-icons dp48">list</i>
            <span>
              Leaven Assign List
            </span>
          </a>
          @endif
        </div>

        <div class="row">

          <form class="col s12" method="post" action="{{route('leave-assign.update', $singleLeaveAssignData->id)}}">
            @csrf
            @method('put')
            <div class="row">

              <div class="col m6  s12">
                <div class="input-field">
                  <select class="select2 browser-default" id="role_id" name="role_id" required>
                    <option value="#" selected disabled>Select Role <span class="custom-text-danger">*</span></option>

                    @foreach($roleData as $singleRoleData)
                    @if(isset($singleRoleData) && $singleRoleData != null)
                    <option value="{{ $singleRoleData->id }}"
                      {{ $singleRoleData->id == $singleLeaveAssignData->role_id ? 'selected' : '' }}>
                      {{ Str::title($singleRoleData->name) }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col m6  s12">
                <div class="input-field">
                  <select class="select2 browser-default" id="leave_category_id" name="leave_category_id" required>
                    <option value="#" selected disabled>Select Leave Category <span class="custom-text-danger">*</span></option>

                    @foreach($leaveCategoryData as $singleCategoryData)
                    @if(isset($singleCategoryData) && $singleCategoryData != null)
                    <option value="{{ $singleCategoryData->id }}"
                      {{ $singleCategoryData->id == $singleLeaveAssignData->leave_category_id ? 'selected' : '' }}>
                      {{ ucfirst($singleCategoryData->leave_category) }}</option>
                    @endif

                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col m12  s12">
                <div class="input-field">
                  <input id="icon_prefix" type="number" class="validate" name="no_of_days"
                    value="{{ $singleLeaveAssignData->no_of_days }}" required>
                  <label for="icon_prefix">No Of Days <span class="custom-text-danger">*</span></label>

                  @error('no_of_days')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
              </div>

              <div class="col s12 mb-3">
                <button class="mb-6 btn waves-effect waves-light purple lightrn-1 gradient-45deg-light-blue-cyan" type="submit">
                  Update
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