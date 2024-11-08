@extends('backend.master')
@section('content')
@section('title') Push Notification Create @endsection
@section('push-notification') active @endsection
@section('push-notification.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Timely Push Notification Create</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Push Notification </a>
            </li>
            <li class="breadcrumb-item active">Push Notification Create
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
          @if(Auth::user()->can('class-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('push-notification.index')}}">
            <i class="material-icons dp48">list</i> Push Notification List
          </a>
          @endif
        </div>

        <div class="row">

          <form class="col s12" method="post" action="{{route('push-notification.store')}}">
            @csrf
            <div class="row">

                <div class="input-field col m6  s12" id="view-date-picker">
                  <label for="sending_date">Sending Date <span class="custom-text-danger">*</span></label>
                  <input type="text" class="datepicker" name="sending_date" id="sending_date" value="{{ old('sending_date') }}" required>
              
                  @error('sending_date')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
                
                <div class="input-field col m6  s12" id="view-date-picker">
                  <label for="sending_time">Sending Time <span class="custom-text-danger">*</span></label>
                  <input id="sending_time" type="text" class="timepicker" name="sending_time" required value="{{ old('sending_time') }}">
                  
                  @error('sending_time')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>

              <div class="input-field col s12 m12">
                <input id="icon_prefix" type="text" class="validate" name="notification_title" required
                  value="{{ old('notification_title') }}">
                <label for="icon_prefix">Title <span class="custom-text-danger">*</span></label>

                @error('notification_title')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m12">
                <input id="icon_prefix" type="text" class="validate" name="notification_message" required
                  value="{{ old('notification_message') }}">
                <label for="icon_prefix">Message <span class="custom-text-danger">*</span></label>

                @error('notification_message')
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