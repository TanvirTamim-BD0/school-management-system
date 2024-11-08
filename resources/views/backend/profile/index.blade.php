@extends('backend.master')
@section('content')
@section('title') Profile @endsection
@section('profile') active @endsection
@section('profile.index') active @endsection
@section('styles')
@endsection
@section('content')
	
<div class="row">

    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Profile</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active"> Profile
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col s12">
        
        <section class="">
            
            <div class="row">
                <div class="col l3 s12 mt-1">
                    <!-- tabs  -->
                    <div class="card-panel">
                        <div class="sidebar-left sidebar-fixed">
                            <div class="sidebar">
                                <div class="sidebar-content">
                                    <div class="sidebar-header">
                                        <div class="sidebar-details">
                                            <div class="row valign-wrapper pt-2 animate fadeLeft">
                                                <div class="col s3 media-image">
                                                
                                                    @if(isset(Auth::user()->image))
                                                        <img src="{{asset('uploads/user_img/'.Auth::user()->image)}}" alt=""
                                                            class="circle z-depth-2 responsive-img">
                                                    @else
                                                        <img src="{{ asset('backend/app-assets/images/user/male.png') }}" alt=""
                                                            class="circle z-depth-2 responsive-img">
                                                    @endif

                                                    <!-- notice the "circle" class -->
                                                </div>
                                                <div class="col s9">
                                                    <p class="m-0 subtitle font-weight-700">{{ Auth::user()->name }}</p>
                                                    <p class="m-0 text-muted">{{ Auth::user()->mobile }}</p>
                                                </div>
                                            </div>

                                            <div class="card-content custom-student-account-profile mt-10">
                                               
                                                <p>
                                                    <i class="material-icons profile-card-i">email</i>
                                                    <span class="custom-student-account-profile-content">{{Auth::user()->email}}</span>
                                                </p>
                                               

                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col l9 s12">
                    <div class="container">
                        <!-- users edit start -->
                        <div class="section users-edit">
                            <div class="card">
                                <div class="card-content">
                                    <!-- <div class="card-body"> -->
                                    <ul class="tabs mb-2 row custom-user-payment-tab">

                                        <li class="tab">
                                            <a class="display-flex align-items-center active" id="account-tab" href="#attendenceHistory">
                                                <i class="material-icons mr-1">account_circle</i><span>Update Details</span>
                                            </a>
                                        </li>

                                        <li class="tab">
                                            <a class="display-flex align-items-center" id="information-tab" href="#paymentHistory">
                                                <i class="material-icons mr-2">lock</i><span>Password Change</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="divider mb-1"></div>
                                    <div class="row">


                                     <div class="col s12" id="attendenceHistory" class="">
                                            
                                        <div class="row">

							            <form class="col s12" method="post" action="{{route('profile.update')}}" enctype="multipart/form-data">
							            @csrf
							            <div class="row">

							                <div class="input-field col s12 m6">
							                    <input id="name" type="text" class="validate" name="name" required value="{{Auth::user()->name}}">
							                    <label for="name">Name</label>

							                @error('name')
							                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
							                @enderror
							                </div>


							                <div class="input-field col s12 m6">
							                    <input id="email" type="text" class="validate" name="email" required value="{{Auth::user()->email}}" >
							                    <label for="email">Email</label>

							                @error('email')
							                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
							                @enderror
							                </div>


							                <div class="input-field col s12 m6">
							                    <input id="mobile" type="text" class="validate" name="mobile" required value="{{Auth::user()->mobile}}" >
							                    <label for="mobile">Mobile</label>

							                @error('mobile')
							                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
							                @enderror
							                </div>


							            <div class="col m6 s12 file-field input-field">
							                <div class="btn float-right">
							                  <span>Photo </span>
							                  <input type="file" name="image">
							                </div>
							                <div class="file-path-wrapper">
							                  <input class="file-path validate" type="text">
							                </div>
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


                                        <div class="col s12" id="paymentHistory" class="">
                                            <div class="row">

								            <form class="col s12" method="post" action="{{route('profile.security.update')}}">
								            @csrf
								            <div class="row">

								            	<div class="input-field col s12 m4">
								                    <input id="old_password" type="password" class="validate" name="old_password" required>
								                    <label for="old_password">Old Password</label>

								                @error('old_password')
								                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
								                @enderror
								                </div>

								              <div class="input-field col s12 m4">
								                    <input id="new_password" type="password" class="validate" name="new_password" required>
								                    <label for="new_password">Password</label>

								                @error('new_password')
								                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
								                @enderror
								                </div>


								                <div class="input-field col s12 m4">
								                    <input id="confirm_password" type="password" class="validate" name="confirm_password" required>
								                    <label for="confirm_password">Confirm Password</label>

								                @error('confirm_password')
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
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- users edit ends -->
                    </div>
                </div>
            </div>
        </section><!-- START RIGHT SIDEBAR NAV -->
    </div>

</div>

@endsection

@section('scripts')


<script>
    $( document ).ready(function() {
    $("#student_id").select2();
  });
</script>
@endsection