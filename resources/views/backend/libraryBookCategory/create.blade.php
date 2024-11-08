@extends('backend.master')
@section('content')
@section('title') Book Category Create @endsection
@section('author') active @endsection
@section('book-category-of-library.create') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Book Category Create</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Book Category</a>
            </li>
            <li class="breadcrumb-item active">Book Category Create
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
          @if(Auth::user()->can('book-category-of-library-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('book-category-of-library.index')}}">
            <i class="material-icons dp48">list</i> Book Category List
          </a>
          @endif
        </div>

        <div class="row">

          <form class="col s12" method="post" action="{{route('book-category-of-library.store')}}">
            @csrf
            <div class="row">
              <div class="input-field col s12 m8">
                <input id="icon_prefix" type="text" class="validate" name="book_category_name" required
                  value="{{ old('book_category_name') }}" placeholder="Book Category Name">
                <label for="icon_prefix">Book Category Name <span class="custom-text-danger">*</span></label>

                @error('book_category_name')
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