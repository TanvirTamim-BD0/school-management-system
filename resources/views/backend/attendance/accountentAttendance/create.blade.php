@extends('backend.master')
@section('content')
@section('title') Accountent Attendance @endsection
@section('attendace-of-accountent') active @endsection
@section('attendace-of-accountent.create') active @endsection
@section('styles')
@endsection

@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Accountent Attendance Filter</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Accountent Attendance</a>
            </li>
            <li class="breadcrumb-item active">Accountent Attendance Filter
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-table-filtering-header">
        <h2 class="card-title">Accountent Record Filter For Attendance</h2>
        <div class="row">
          <form method="post" action="{{route('get-accountent-filter-data-for-attendance')}}"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col m12  s12">
                <div class="input-field" id="view-date-picker">
                  <label for="date">Date</label>
                  <input type="text" class="datepicker" name="date" id="date" value="{{$todayDate}}" required>

                  @error('date')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
              </div>
              <div class="col m12  s12 custom-text-center">
                <button class="mb-1 btn waves-effect waves-light purple lightrn-1 custom-filter-button" type="submit">
                  <i class="material-icons">search</i>
                  <span>Filter</span>
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
@include('backend.assignment.partial.script')
@endsection