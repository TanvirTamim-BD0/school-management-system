@extends('frontend.master')
@section('content')
@section('styles')
@endsection

	
   <!-- Page Header section start here -->
    <div class="pageheader-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader-content text-center">
                        <h2>এডমিশন ফর্ম</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">হোম</a></li>
                                <li class="breadcrumb-item active" aria-current="page">এডমিশন ফর্ম</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header section ending here -->


     <!-- Feature Section Start Here -->
    <section class="feature-section style-3 padding-tb">
        <div class="feature-shape one"><img src="{{ asset('frontend') }}/assets/images/shape-img/icon/03.png" alt="education"></div>
        <div class="feature-shape two"><img src="{{ asset('frontend') }}/assets/images/shape-img/09.png" alt="education"></div>
        <div class="container">
            <div class="section-wrapper">
                <div class="row g-4 justify-content-center">

                    <div class="col-lg-4 col-12">
                        <div class="feature-items">
                            <div class="row g-4 row-cols-sm-12 row-cols-1">
                                <div class="col">
                                    <div class="course-item">
                                        <div class="course-inner">
                                            <div class="course-content">
                                                <div class="course-price" style="width: 80px;">{{$admission->fees}} Tk</div><br>
                                                <a href="{{route('addmission-form',$admission->id)}}"><h5>{{$admission->admission_name}}</h5></a>
                                                <div class="course-details">
                                                    <div class="couse-topic"><i class="icofont-signal"></i> {{$admission->classData->class_name}} </div>
                                                </div>
                                                <div class="course-footer">
                                                    
                                                    <div class="course-btn">
                                                        <a href="course-single.html" class="lab-btn-text"> <i class="icofont-external-link"></i> {{$admission->available_days}} Days</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
 
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-12">
                        <div class="feature-register">
                            <h3>Addmission Now</h3>
                            <form class="col s12" method="post" action="{{route('addmission-form-submit')}}" enctype="multipart/form-data">
                            @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="student_name" placeholder="Student Name *" required>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="text" name="student_email" placeholder="Student Email *" required>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="text" name="student_phone" placeholder="Student Phone *" required>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="select-item">
                                            <select class="reg-input"  required name="class_id">
                                               <option value="" selected disabled>Select Class *</option>
                                               @foreach($classData as $class)
                                               <option value="{{$class->id}}">{{$class->class_name}}</option>
                                               @endforeach
                                            </select>
                                        <div class="select-icon">
                                           <i class="icofont-rounded-down"></i>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="text" name="address" placeholder="Address *" required>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="date" name="date_of_birth" required>
                                    </div>

                                    <div class="col-md-6">
                                         <div class="select-item">
                                            <select class="reg-input" name="blood_group">
                                               <option value="" selected disabled >Select Blood Group</option>
                                               @foreach($getBloodGroup as $bloodGroup)
                                               <option value="{{$bloodGroup}}">{{$bloodGroup}}</option>
                                               @endforeach
                                            </select>
                                        <div class="select-icon">
                                           <i class="icofont-rounded-down"></i>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                         <div class="select-item">
                                            <select name="gender">
                                               <option value="" selected disabled>Select Gender</option>
                                               <option value="male">Male</option>
                                               <option value="female">Female</option>
                                               <option value="others">Others</option>
                                            </select>
                                        <div class="select-icon">
                                           <i class="icofont-rounded-down"></i>
                                        </div>
                                      </div>
                                    </div>


                                    <div class="col-md-6">
                                        <input type="text" name="religion" placeholder="Religion">
                                    </div>

                                    <div class="col-md-6">
                                        <input type="file" name="student_photo" required>
                                    </div>
                                    
                                </div>

                               
                                <button class="lab-btn" type="submit"><span>Send</span></button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Feature section Ending here -->


@endsection
