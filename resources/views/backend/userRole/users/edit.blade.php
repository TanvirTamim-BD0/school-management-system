@extends('backend.master')
@section('content')
@section('title') User Edit @endsection
@section('users') active @endsection
@section('users.create') active @endsection
@section('styles')
@endsection
@section('content')
    
    <div class="row">

        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>User Edit</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">User</a>
                  </li>
                  <li class="breadcrumb-item active">User Edit
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
            @if(Auth::user()->can('user-list'))
              <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button" href="{{route('users.index')}}">
                <i class="material-icons dp48">list</i>  User List
              </a>
            @endif
            </div>


        <div class="row">

            <form class="col s12" method="post" action="{{route('users.update',$userData->id)}}">
            @csrf
            @method('put')
            <div class="row">

                <div class="input-field col s12 m6">
                    <input id="name" type="text" class="validate" name="name" required value="{{$userData->name}}">
                    <label for="name">Name <span class="custom-text-danger">*</span></label>

                @error('name')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
                </div>


                <div class="input-field col s12 m6">
                    <input id="email" type="text" class="validate" name="email" required value="{{$userData->email}}">
                    <label for="email">Email <span class="custom-text-danger">*</span></label>

                @error('email')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
                </div>


                <div class="input-field col s12 m6">
                    <input id="mobile" type="text" class="validate" name="mobile" required value="{{$userData->mobile}}" >
                    <label for="mobile">Mobile <span class="custom-text-danger">*</span></label>

                @error('mobile')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
                </div>



               <div class="input-field col s12 m6">
                <select class="select2 browser-default" name="roles" required>
                  <option value="" disabled selected>Select Role <span class="custom-text-danger">*</span></option>
                  @foreach($roles as $role)
                  <option value="{{$role->id}}" class="left circle" {{ $role->name == $userData->role ? "selected":"" }} >{{$role->name}}</option>
                  @endforeach

                </select>

                @error('roles')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror

              </div>



              <div class="col s12 mb-3">
                <button class="mb-6 btn waves-effect waves-light purple lightrn-1" type="submit">
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