@extends('backend.master')
@section('content')
@section('title') Leaven Category Update @endsection
@section('leave-category') active @endsection
@section('leave-category.update') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Leaven Category Update</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Leaven Category</a>
            </li>
            <li class="breadcrumb-item active">Leaven Category Update
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
          @if(Auth::user()->can('leave-category-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('leave-category.index')}}">
            <i class="material-icons dp48">list</i>
            <span>
              Leaven Category List
            </span>
          </a>
          @endif
        </div>

        <div class="row">

          <form class="col s12" method="post" action="{{route('leave-category.update', $singleLeaveCategoryData->id)}}">
            @csrf
            @method('put')
            <div class="row">

              <div class="col m8  s12">
                <div class="input-field">
                  <input id="icon_prefix" type="text" class="validate" name="leave_category"
                    value="{{ $singleLeaveCategoryData->leave_category }}" required>
                  <label for="icon_prefix">Leave Category <span class="custom-text-danger">*</span></label>

                  @error('leave_category')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
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