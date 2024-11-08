@extends('backend.master')
@section('content')
@section('title') Queue @endsection
@section('queue') active @endsection
@section('queue') active @endsection
@section('styles')
@endsection
@section('content')

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Queue</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            </li>
            <li class="breadcrumb-item active">Queue
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


 <div class="col s12">
    <div class="card">
      <div class="card-content">
        <h2 class="card-title">Queue List</h2>

        <div class="row">
	        <div class="col-s3">
	        	<img src="{{ asset('backend/app-assets/images/user/male.png') }}" width="75" height="65">
	        </div>
	        <div class="col-s3" style="margin-top: -15px;">
	        	Tanvir Tamim (Librarian)
	        </div>

	        <div class="col-s6 mt-1">
	        	Queue  Queue  Queue  Queue
	        </div>

          <input type="text" name="reply_text">

	        <div class="col-s3">
	        	<button class="btn btn-sm">Reply</button>
	        </div>
        </div>

        <div class="row mt-1">
	        <div class="col-s3">
	        	<img src="{{ asset('backend/app-assets/images/user/male.png') }}" width="75" height="65">
	        </div>
	        <div class="col-s3" style="margin-top: -15px;">
	        	Tanvir Tamim (Librarian)
	        </div>

	        <div class="col-s6 mt-1">
	        	Queue  Queue  Queue  Queue
	        </div>

           <input type="text" name="reply_text">

	        <div class="col-s3">
	        	<button class="btn btn-sm">Reply</button>
	        </div>
        </div>


        <form action="{{route('queue-add')}}" method="post">
          @csrf
        <div class="row mt-3">
        	<div class="input-field col s12 m12 custom-texarea-body">
                <label for="description" class="mb10">Queue Text <span class="custom-text-danger">*</span></label>
                <textarea id="description" name="queue_text" class="materialize-textarea" placeholder="Description" cols="20"
                  rows="40"></textarea>
              
                @error('queue_text')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="col s12">
                <button class="mb-6 btn waves-effect waves-light purple lightrn-1" type="submit">
                  Submit
                </button>
              </div>
        </div>
        </form>


       </div>
    </div>
       
 </div>


@endsection