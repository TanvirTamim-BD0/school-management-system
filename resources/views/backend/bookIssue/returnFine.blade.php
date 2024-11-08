@extends('backend.master')
@section('content')
@section('title') Library Book Date Expire Fine @endsection
@section('bookIssue') active @endsection
@section('bookIssue.index') active @endsection
@section('styles')
@endsection
@section('content')
	
<div class="row">

    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span> Library Book DateExpire Fine</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Library Book Date Expire Fine
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

                    <a href="{{ route('student.edit',$bookIsuue->studentData->id) }}" class="btn waves-effect waves-light purple lightrn-1 mt-1" style="float: right;">edit</a>

                    <!-- tabs  -->
                    <div class="card-panel">
                        <div class="sidebar-left sidebar-fixed mt-2">
                            <div class="sidebar">
                                <div class="sidebar-content">
                                    <div class="sidebar-header">
                                        <div class="sidebar-details">
                                            
                                            <div class="row valign-wrapper pt-2 animate fadeLeft">
                                                <div class="col s3 media-image">

                                                    @if(isset($bookIsuue->studentData->student_photo) && $bookIsuue->studentData->student_photo !=
                                                    null)
                                                    <img src="{{ asset('/uploads/student_photo/'.$bookIsuue->studentData->student_photo) }}"
                                                        width="75" height="65">
                                                    @else
                                                    @if($bookIsuue->studentData->gender == 'male')
                                                    <img src="{{ asset('backend/app-assets/images/user/male.png') }}"
                                                        width="75" height="65">
                                                    @else
                                                    <img src="{{ asset('backend/app-assets/images/user/female.png') }}"
                                                        width="75" height="65">
                                                    @endif
                                                    @endif

                                                    <!-- notice the "circle" class -->
                                                </div>
                                                <div class="col s9 ml-10 custom-profile-data-15 pad">
                                                    <p class="m-0 subtitle font-weight-700">{{ $bookIsuue->studentData->student_name }}
                                                        <br> {{ $bookIsuue->studentData->roll_no }}</p>
                                                    <p class="m-0 text-muted">{{ $bookIsuue->studentData->student_phone }}</p>
                                                </div>


                                            </div>

                                            <div class="card-content custom-student-account-profile mt-10">
                                                <p><i class="material-icons profile-card-i">import_contacts</i>
                                                    <span class="custom-student-account-profile-content">
                                                        {{$bookIsuue->studentData->classData->class_name}} <span
                                                            class="custom-text-info">( @if($bookIsuue->studentData->section_id)
                                                            {{$bookIsuue->studentData->sectionData->section_name}} @else @endif )
                                                        </span>
                                                    </span>
                                                </p>
                                                <p>
                                                    <i class="material-icons profile-card-i">email</i>
                                                    <span
                                                        class="custom-student-account-profile-content">{{$bookIsuue->studentData->student_email}}</span>
                                                </p>
                                                <p><i class="material-icons profile-card-i">person_outline</i>
                                                    <span class="custom-student-account-profile-content">
                                                        {{Str::title($bookIsuue->studentData->gender)}} <span
                                                            class="custom-text-info">({{$bookIsuue->studentData->blood_group}})</span>
                                                    </span>
                                                </p>
                                                <p><i class="material-icons profile-card-i">eject</i>
                                                    <span class="custom-student-account-profile-content">
                                                        {{$bookIsuue->studentData->religion}}
                                                    </span>
                                                </p>
                                                <p>
                                                    <i class="material-icons profile-card-i">directions</i>
                                                    <span
                                                        class="custom-student-account-profile-content">{{$bookIsuue->studentData->address}}</span>
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
                                    Payment Fine Amount
                                    <div class="row">


                                        <div class="col s12" id="bookIssue" class="">
                                            
                                         <form class="col s12" method="post" action="{{route('library-book-fine')}}">
                                            @csrf
                                            <div class="row">

                                            	<input type="hidden" name="student_id" value="{{$bookIsuue->student_id}}">
                                            	<input type="hidden" name="library_book_id" value="{{$bookIsuue->library_book_id}}">

                                                <h6 class="mt-2">Issue Date : {{$bookIsuue->start_date}}</h6>
                                                <h6>Return Date : {{$bookIsuue->end_date}}</h6>

                                               
                                                  <div class="input-field col s12 m12">
                                                    <input id="fine_amount" type="number" class="validate" name="fine_amount" required>
                                                    <label for="fine_amount">Amount</label>

                                                    @error('fine_amount')
                                                      <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                                                    @enderror
                                                  </div>



                                                   <div class="col s12 mb-3">
                                                    <button class="mb-6 btn waves-effect waves-light purple lightrn-1" type="submit">
                                                      Payment
                                                    </button>
                                                  </div>

                                              </div>

                                            </form>

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


