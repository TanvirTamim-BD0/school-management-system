@extends('backend.master')
@section('content')
@section('title') Subject Create @endsection
@section('subject') active @endsection
@section('subject.create') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Subject Create</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Subject</a>
            </li>
            <li class="breadcrumb-item active">Subject Create
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

          @if(Auth::user()->can('subject-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('subject.index')}}">
            <i class="material-icons dp48">list</i> Subject List
          </a>
          @endif

        </div>


        <div class="row">

          <form class="col s12" method="post" action="{{route('subject.store')}}">
            @csrf
            <div class="row">
              <div class="input-field col s12 m6">
                <input id="icon_prefix" type="text" class="validate" name="subject_name" required
                  value="{{ old('subject_name') }}">
                <label for="icon_prefix">Subject Name <span class="custom-text-danger">*</span></label>

                @error('subject_name')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <select class="select2 browser-default" name="class_id" id="role" required>
                  <option value="" disabled selected>Select Class <span class="custom-text-danger">*</span></option>
                  @foreach($classes as $class)
                  <option value="{{$class->id}}" class="left circle">{{$class->class_name}}</option>
                  @endforeach

                </select>

                <div class="input-field">
                </div>
                @error('class_id')
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