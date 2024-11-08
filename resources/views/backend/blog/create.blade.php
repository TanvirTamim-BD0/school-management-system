@extends('backend.master')
@section('content')
@section('title') Blog Create @endsection
@section('blog-backend') active @endsection
@section('blog-backend.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Blog Create</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Blog</a>
            </li>
            <li class="breadcrumb-item active">Blog Create
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

          @if(Auth::user()->can('blog-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('blog-backend.index')}}">
            <i class="material-icons dp48">list</i> Blog List
          </a>
          @endif
        </div>


        <div class="row">

          <form class="col s12" method="post" action="{{route('blog-backend.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">

              <div class="input-field col s12 m12">
                <input id="title" type="text" class="validate" name="title" required value="{{ old('title') }}">
                <label for="title">Title <span class="custom-text-danger">*</span> </label>

                @error('title')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m12 custom-texarea-body">
                <label for="post" class="mb10">Desciption <span class="custom-text-danger">*</span></label>
                <textarea id="description" name="post" class="materialize-textarea" 
                placeholder="Blog description" cols="20" rows="40"></textarea>

                @error('post')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="row section">
                <div class="col s12 m4 l2">
                  <p>Photo </p>
                </div>
                <div class="col s12 m8 l10">
                  <input type="file" id="photo" name="photo" class="dropify" data-default-file="" />
                </div>
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

@section('scripts')
@include('backend.guardian.partial.script')
@endsection