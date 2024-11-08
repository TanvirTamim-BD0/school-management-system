@extends('backend.master')
@section('content')
@section('title') Notice Create @endsection
@section('notice') active @endsection
@section('notice.create') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Notice Create</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Notice</a>
            </li>
            <li class="breadcrumb-item active">Notice Create
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
          @if(Auth::user()->can('notice-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('notice.index')}}">
            <i class="material-icons dp48">list</i>
            <span>
              Notice List
            </span>
          </a>
          @endif
        </div>

        <div class="row">

          <form class="col s12" method="post" action="{{route('notice.store')}}">
            @csrf
            <div class="row">

              <div class="col m6  s12">
                <div class="input-field" id="view-date-picker">
                  <label for="date">Date <span class="custom-text-danger">*</span></label>
                  <input type="text" class="datepicker" name="date" id="date" value="" required>

                  @error('date')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
              </div>

              <div class="col m6  s12">
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

              <div class="col s12 mb-3 mt-3">
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