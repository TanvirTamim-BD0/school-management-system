@extends('backend.master')
@section('content')
@section('title') Library Book Create @endsection
@section('libraryBook') active @endsection
@section('libraryBook.create') active @endsection
@section('styles')
@endsection
@section('content')
	
	<div class="row">

	 	<div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>Library Book Create</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Library Book</a>
                  </li>
                  <li class="breadcrumb-item active">Library Book Create
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
              @if(Auth::user()->can('library-book-index'))
              <a class="waves-effect waves dark btn btn-primary next-step" href="{{route('libraryBook.index')}}">
                <i class="material-icons dp48">list</i> Library Book List
              </a>
              @endif
            </div>


        <div class="row">

			    <form class="col s12" method="post" action="{{route('libraryBook.store')}}">
			    @csrf
			      <div class="row">

              <div class="input-field col s12 m6">
                <select class="select2 browser-default" name="book_category_id" required>
                  <option value="" disabled selected>Select Book Category <span class="custom-text-danger">*</span> </option>
                  @foreach($libraryBookCategoryData as $singleLBCData)
                  <option value="{{$singleLBCData->id}}" class="left circle">{{$singleLBCData->book_category_name}}</option>
                  @endforeach
              
                </select>
              
                @error('book_category_id')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              
              </div>
              
              <div class="input-field col s12 m6">
                <select class="select2 browser-default" name="author_id" required>
                  <option value="" disabled selected>Select Author <span class="custom-text-danger">*</span> </option>
                  @foreach($authorData as $singleAuthor)
                  <option value="{{$singleAuthor->id}}" class="left circle">{{$singleAuthor->author_name}}</option>
                  @endforeach
              
                </select>
              
                @error('author_id')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              
              </div>

              <div class="input-field col s12 m6">
                <select class="select2 browser-default" name="rack_no_id" required>
                  <option value="" disabled selected>Select Rack No <span class="custom-text-danger">*</span> </option>
                  @foreach($rackNoData as $rackNo)
                  <option value="{{$rackNo->id}}" class="left circle">{{$rackNo->rack_no}}</option>
                  @endforeach
              
                </select>
              
                @error('rack_no_id')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              
              </div>


			        <div class="input-field col s12 m6">
			          <input id="subject_name" type="text" class="validate" name="subject_name" required value="{{ old('subject_name') }}">
			          <label for="subject_name">Subject Name <span class="custom-text-danger">*</span> </label>

                @error('subject_name')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
			        </div>


              <div class="input-field col s12 m6">
                <input id="mrp_price" type="number" class="validate" name="mrp_price" required value="{{ old('mrp_price') }}" >
                <label for="mrp_price">MRP Price <span class="custom-text-danger">*</span> </label>

                @error('mrp_price')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="quantity" type="text" class="validate" name="quantity" required value="{{ old('quantity') }}" >
                <label for="quantity">Quantity <span class="custom-text-danger">*</span> </label>

                @error('quantity')
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