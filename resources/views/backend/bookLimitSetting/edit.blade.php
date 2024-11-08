@extends('backend.master')
@section('content')
@section('title') Book Limit Edit @endsection
@section('section') active @endsection
@section('section.index') active @endsection
@section('styles')
@endsection
@section('content')
  
  <div class="row">

    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>Book Limit Edit</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Book Limit</a>
                  </li>
                  <li class="breadcrumb-item active">Book Limit Edit
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

              @if(Auth::user()->can('section-list'))
              <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button" href="{{route('book-limit-setting.index')}}">
                 <i class="material-icons dp48">list</i>  Book Limit List
              </a>
              @endif
              
            </div>


        <div class="row">

          <form class="col s12" method="post" action="{{route('book-limit-setting.update',$bookLimitSetting->id)}}">
          @csrf
          @method('put')
           <div class="row">


              <div class="input-field col s12 m6">
                <select class="select2 browser-default" name="role" required>
                  <option value="" disabled selected>Select Role <span class="custom-text-danger">*</span></option>
                  @foreach($roles as $role)
                  <option value="{{$role->name}}" class="left circle" {{ $role->name == $bookLimitSetting->role ? "selected":"" }} >{{$role->name}}</option>
                  @endforeach

                </select>

                @error('class_id')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror

              </div>

              <div class="input-field col s12 m6">
                <input id="icon_prefix" type="text" class="validate" name="number" required
                  value="{{ $bookLimitSetting->number }}">
                <label for="icon_prefix">Number <span class="custom-text-danger">*</span></label>

                @error('number')
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