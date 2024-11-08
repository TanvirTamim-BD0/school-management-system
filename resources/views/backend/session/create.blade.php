@extends('backend.master')
@section('content')
@section('title') Session Create @endsection
@section('session') active @endsection
@section('session.create') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Session Create</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Session</a>
            </li>
            <li class="breadcrumb-item active">Session Create
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
            href="{{route('session.index')}}">
            <i class="material-icons dp48">list</i> Session List
          </a>
          @endif
        </div>

        <div class="row">

          <form class="col s12" method="post" action="{{route('session.store')}}">
            @csrf
            <div class="row">
              <div class="input-field col s12 m8">
                <input id="icon_prefix" type="text" class="validate" name="session_name" required
                  value="{{ old('session_name') }}">
                <label for="icon_prefix">Session<span class="custom-text-danger">*</span></label>

                @error('session_name')
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