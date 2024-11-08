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
                        <h2>এডমিশন</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">হোম</a></li>
                                <li class="breadcrumb-item active" aria-current="page">এডমিশন</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header section ending here -->


    <!-- course section start here -->
    <div class="course-section padding-tb section-bg">
        <div class="container">
            <div class="section-wrapper">
                

                <div class="row g-4 justify-content-center row-cols-xl-3 row-cols-md-2 row-cols-1">

                    @foreach($admissions as $admission)
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
                    @endforeach


                </div>

            </div>
        </div>
    </div>
    <!-- course section ending here -->

@endsection
