@extends('backend.master')
@section('content')
@section('title') Expense Edit @endsection
@section('expense') active @endsection
@section('expense.create') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Expense Edit</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Expense</a>
            </li>
            <li class="breadcrumb-item active">Expense Edit
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
          @if(Auth::user()->can('expense-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button" href="{{route('expense.index')}}">
           <i class="material-icons dp48">list</i> Expense List
          </a>
          @endif
        </div>

        <div class="row">

          <form class="col s12" method="post" action="{{route('expense.update',$expense->id)}}">
            @csrf
            @method('put')
            <div class="row">

              <div class="input-field col s12 m6">
                <input id="expense_title" type="text" class="validate" name="expense_title" value="{{$expense->expense_title}}" required>
                <label for="expense_title">Expense Title <span class="custom-text-danger">*</span> </label>

                @error('expense_title')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="expense_date" type="text" class="datepicker" name="expense_date" required value="{{$singleDate}}" >
                <label for="expense_date">Expense Date <span class="custom-text-danger">*</span> </label>

                @error('expense_date')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="expense_amount" type="number" class="validate" name="expense_amount" required value="{{$expense->expense_amount}}" >
                <label for="expense_amount">Expense Amount <span class="custom-text-danger">*</span> </label>

                @error('expense_amount')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="expense_note" type="text" class="validate" name="expense_note" required value="{{$expense->expense_note}}" >
                <label for="expense_note">Expense Note <span class="custom-text-danger">*</span> </label>

                @error('expense_note')
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