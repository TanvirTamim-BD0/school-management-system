@extends('backend.master')
@section('content')
@section('title') Event Update @endsection
@section('event') active @endsection
@section('event.update') active @endsection
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
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Event Update</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Event</a>
            </li>
            <li class="breadcrumb-item active">Event Update
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
          @if(Auth::user()->can('event-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('event.index')}}">
            <i class="material-icons dp48">list</i>
            <span>
              Event List
            </span>
          </a>
          @endif
        </div>

        <div class="row">

          <form class="col s12" method="post" action="{{route('event.update', $singleEventData->id)}}"
            enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="row">

              <div class="col m6  s12">
                <div class="input-field" id="view-date-picker">
                  <label for="start_date">Start Date <span class="custom-text-danger">*</span></label>
                  <input type="text" class="datepicker" name="start_date" id="start_date"
                    value="{{$singleEventFormatStartDate}}" required>

                  @error('start_date')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
              </div>

              <div class="col m6  s12">
                <div class="input-field" id="view-date-picker">
                  <label for="end_date">End Date <span class="custom-text-danger">*</span></label>
                  <input type="text" class="datepicker" name="end_date" id="end_date"
                    value="{{$singleEventFormatEndDate}}" required>

                  @error('end_date')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
              </div>

              <div class="col m12  s12">
                <div class="input-field">
                  <input id="icon_prefix" type="text" class="validate" name="title"
                    value="{{ $singleEventData->title }}" required>
                  <label for="icon_prefix">Title <span class="custom-text-danger">*</span></label>

                  @error('title')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
              </div>

              <div class="input-field col s12 m12 custom-texarea-body">
                <label for="description" class="mb10">Desciption <span class="custom-text-danger">*</span></label>
                <textarea name="description" id="description" class="validate" cols="20" rows="40"
                  placeholder="Description">{{$singleEventData->description}}</textarea>
              
                @error('description')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

            </div>

            <div class="row section">
              <div class="input-field col s12 m12">
                <div class="col s12 m4 l2 mb-1">
                  <p>Event File </p>
                </div>
              
                @if(isset($singleEventData->event_file) && $singleEventData->event_file != null)
                <input type="file" id="event_file" name="event_file" class="dropify"
                  data-default-file="{{asset('/backend/uploads/eventFile/'.$singleEventData->event_file)}}" />
                @else
                <input type="file" id="event_file" name="event_file" class="dropify" data-default-file="" />
                @endif
              
                @error('event_file')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>
            </div>

            <div class="row section">
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
<script src="{{ asset('backend') }}/app-assets/vendors/dropify/js/dropify.min.js"></script>
<script src="{{ asset('backend') }}/app-assets/js/scripts/form-file-uploads.js"></script>
@endsection