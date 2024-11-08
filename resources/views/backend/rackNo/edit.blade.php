@extends('backend.master')
@section('content')
@section('title') Rack No Edit @endsection
@section('rackNo') active @endsection
@section('rackNo.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Rack No Edit</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Rack No</a>
            </li>
            <li class="breadcrumb-item active">Rack No Edit
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
          @if(Auth::user()->can('library-rack-list'))
           <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button" href="{{route('rackNo.index')}}">
             <i class="material-icons dp48">list</i> Rack No List
            </a>
          @endif
        </div>


        <div class="row">

          <form class="col s12" method="post" action="{{route('rackNo.update',$rackNo->id)}}">
            @csrf
            @method('put')
            <div class="row">
              <div class="input-field col s12 m8">
                <input id="icon_prefix" type="text" class="validate" name="rack_no" value="{{$rackNo->rack_no}}"
                  required>
                <label for="icon_prefix">Rack No <span class="custom-text-danger">*</span> </label>

                @error('rack_no')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
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