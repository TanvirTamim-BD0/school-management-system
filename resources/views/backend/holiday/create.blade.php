@extends('backend.master')
@section('content')
@section('title') Holiday Create @endsection
@section('holiday') active @endsection
@section('holiday.create') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Holiday Create</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Holiday</a>
            </li>
            <li class="breadcrumb-item active">Holiday Create
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
          @if(Auth::user()->can('holiday-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('holiday.index')}}">
            <i class="material-icons dp48">list</i>
            <span>
              Holiday List
            </span>
          </a>
          @endif
        </div>

        <div class="row">

          <form class="col s12" method="post" action="{{route('holiday.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">

              <div class="col m6  s12">
                <div class="input-field" id="view-date-picker">
                  <label for="start_date">Start Date <span class="custom-text-danger">*</span></label>
                  <input type="text" class="datepicker" name="start_date" id="start_date" value="" required>

                  @error('start_date')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
              </div>

              <div class="col m6  s12">
                <div class="input-field" id="view-date-picker">
                  <label for="end_date">End Date <span class="custom-text-danger">*</span></label>
                  <input type="text" class="datepicker" name="end_date" id="end_date" value="" required>

                  @error('end_date')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
              </div>

              <div class="col m12  s12">
                <div class="input-field">
                  <input id="icon_prefix" type="text" class="validate" name="title" required>
                  <label for="icon_prefix">Title <span class="custom-text-danger">*</span></label>

                  @error('title')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
              </div>

              <div class="input-field col s12 m12 custom-texarea-body">
                <label for="description" class="mb10">Desciption <span class="custom-text-danger">*</span></label>
                <textarea id="description" name="description" class="materialize-textarea" placeholder="Description" cols="20"
                  rows="40"></textarea>
              
                @error('description')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>
            </div>

            <div class="row section">
              <div class="input-field col s12 m12">
                <div class="col s12 m4 l2 mb-1">
                  <p>Holiday File </p>
                </div>
            
                <input type="file" id="holiday_file" name="holiday_file" class="dropify" data-default-file="" />
            
                @error('holiday_file')
                <span class="custom-text-danger custom-text-danger-position mt-1">{{$message}}</span>
                @enderror
              </div>
            
            </div>

            <div class="row section">
              <div class="col s12 mb-3 mt-3">
                <button class="mb-6 btn waves-effect waves-light purple lightrn-1" type="submit">
                  Submit
                </button>
              </div>
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
@endsection