@extends('backend.master')
@section('content')
@section('title') Income Edit @endsection
@section('income') active @endsection
@section('income.create') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Income Edit</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Income</a>
            </li>
            <li class="breadcrumb-item active">Income Edit
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
          @if(Auth::user()->can('income-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button" href="{{route('income.index')}}">
             <i class="material-icons dp48">list</i> Income List
          </a>
          @endif
        </div>

        <div class="row">

          <form class="col s12" method="post" action="{{route('income.update',$income->id)}}">
            @csrf
            @method('put')
            <div class="row">

              <div class="input-field col s12 m6">
                <input id="income_title" type="text" class="validate" name="income_title" value="{{$income->income_title}}" required>
                <label for="income_title">Income Title <span class="custom-text-danger">*</span> </label>

                @error('income_title')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="income_date" type="text" class="datepicker" name="income_date" required value="{{$singleDate}}" >
                <label for="income_date">Income Date <span class="custom-text-danger">*</span> </label>

                @error('income_date')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="income_amount" type="number" class="validate" name="income_amount" required value="{{$income->income_amount}}" >
                <label for="income_amount">Income Amount <span class="custom-text-danger">*</span> </label>

                @error('income_amount')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="income_note" type="text" class="validate" name="income_note" required value="{{$income->income_note}}" >
                <label for="income_note">Income Note <span class="custom-text-danger">*</span> </label>

                @error('income_note')
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