@extends('backend.master')
@section('content')
@section('title') Author Create @endsection
@section('author') active @endsection
@section('author.create') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Author Create</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Author</a>
            </li>
            <li class="breadcrumb-item active">Author Create
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
          @if(Auth::user()->can('author-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('author.index')}}">
            <i class="material-icons dp48">list</i> Author List
          </a>
          @endif
        </div>

        <div class="row">

          <form class="col s12" method="post" action="{{route('author.store')}}">
            @csrf
            <div class="row">
              <div class="input-field col s12 m8">
                <input id="icon_prefix" type="text" class="validate" name="author_name" required
                  value="{{ old('author_name') }}" placeholder="Author Name">
                <label for="icon_prefix">Author Name <span class="custom-text-danger">*</span></label>

                @error('author_name')
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