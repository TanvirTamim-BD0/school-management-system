@extends('backend.master')
@section('content')
@section('title') SMS Create @endsection
@section('sms') active @endsection
@section('sms.create') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>SMS Create</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">SMS</a>
            </li>
            <li class="breadcrumb-item active">SMS Create
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
          @if(Auth::user()->can('sms-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('sms.index')}}">
            <i class="material-icons dp48">list</i> SMS List
          </a>
          @endif
        </div>


        <div class="row">

          <form class="col s12" method="post" action="{{route('sms.store')}}">
            @csrf
            <div class="row">

              <div class="input-field col m12  s12">
                <select class="select2 browser-default error validate" id="role_id" name="role_id" required>
                  <option value="" selected disabled>Select Role <span class="custom-text-danger">*</span></option>

                  @foreach($roleData as $singleRoleData)
                  @if(isset($singleRoleData) && $singleRoleData != null)
                  <option value="{{ $singleRoleData->id }}">{{ Str::title($singleRoleData->name) }}</option>
                  @endif

                  @endforeach
                </select>
              </div>

              <div class="input-field col s12 m12">
                <select class="select2 browser-default error validate custom-school-multiple-select" id="to_account_id" name="to_account_id[]"
                  data-placeholder="SMS to" multiple="multiple" required>
                  <option value="" disabled>SMS To <span class="custom-text-danger">*</span></option>

                </select>

                @error('to_account_id')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror

              </div>


              <div class="input-field col s12 m12">
                <input id="icon_prefix" type="text" class="validate" name="title" required>
                <label for="icon_prefix">Title <span class="custom-text-danger">*</span></label>
              
                @error('title')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>
              
              
              <div class="input-field col s12 m12">
                <input id="icon_prefix" type="text" class="validate" name="description" required>
                <label for="icon_prefix">Message <span class="custom-text-danger">*</span></label>
              
                @error('description')
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
@include('backend.sms.partial.script')
@endsection