@extends('backend.master')
@section('content')
@section('title') Fees Assign Update @endsection
@section('fees-assign') active @endsection
@section('fees-assign.update') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Fees Assign Update</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Fees Assign</a>
            </li>
            <li class="breadcrumb-item active">Fees Assign Update
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
          @if(Auth::user()->can('fees-assign-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('fees-assign.index')}}">
            <i class="material-icons dp48">list</i>
            <span>
              Fees Assign List
            </span>
          </a>
          @endif
        </div>

        <div class="row">

          <form class="col s12" method="post" action="{{route('fees-assign.update', $singleFeesAssignData->id)}}">
            @csrf
            @method('put')
            <div class="row">

              <div class="col m6  s12">
                <div class="input-field">
                  <select class="select2 browser-default" id="class_id" name="class_id" required>
                    <option value="" selected disabled>Select Class <span class="custom-text-danger">*</span></option>

                    @foreach($classData as $singleClassData)
                    @if(isset($singleClassData) && $singleClassData != null)
                    <option value="{{ $singleClassData->id }}"
                      {{ $singleClassData->id == $singleFeesAssignData->class_id ? 'selected' : '' }}>
                      {{ $singleClassData->class_name }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col m6  s12">
                <div class="input-field">
                  <select class="select2 browser-default" id="fees_type_id" name="fees_type_id" required>
                    <option value="" selected disabled>Select Fees Type <span class="custom-text-danger">*</span></option>

                    @foreach($feesTypeData as $singleFeesTypeData)
                    @if(isset($singleFeesTypeData) && $singleFeesTypeData != null)
                    <option value="{{ $singleFeesTypeData->id }}"
                      {{ in_array($singleFeesTypeData->id, $selectedFeesTypeIds) ? 'disabled' : ''}}
                      {{ $singleFeesTypeData->id == $singleFeesAssignData->fees_type_id ? 'selected' : '' }}>
                      {{ $singleFeesTypeData->fees_type }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col m12  s12">
                <div class="input-field">
                  <input id="icon_prefix" type="number" class="validate" name="fees_amount"
                    value="{{ $singleFeesAssignData->fees_amount }}" required>
                  <label for="icon_prefix">Fees Amount <span class="custom-text-danger">*</span></label>

                  @error('fees_amount')
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

@section('scripts')
@include('backend.feesAssign.partial.script')
@endsection