@extends('backend.master')
@section('content')
@section('title') Rollback @endsection
@section('rollback') active @endsection
@section('rollback') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Rollback</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Rollback</a>
            </li>
            <li class="breadcrumb-item active">Rollback
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

        <div class="card-content custom-card-content custom-card-content-for-datatable">
          <h2 class="card-title">Rollback Click And Clean All Data </h2>

          <div class="float-right justify-content-center">
            @if(Auth::user()->can('class-create'))
            <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button" href="{{route('rollback-clean-data')}}">
             <i class="material-icons dp48">keyboard_backspace</i>  Rollback
            </a>
            @endif
          </div><br><br><br>
        </div>

    </div>
  </div>

</div>

@endsection
