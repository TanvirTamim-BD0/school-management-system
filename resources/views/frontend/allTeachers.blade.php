@extends('frontend.master')
@section('content')
@section('styles')
@endsection

	<section class="teacher">
        <div class="container">
            <div class="row teacher-row">

                @foreach($teachers as $teacher)
                @if(isset($teacher) && $teacher != null)
                <div class="col-md-3 col-sm-6 col-8">
                    <div class="single-teacher card">
                        <div class="single-teacher-inner">
                            <div class="t-img card-img">
                                
                                @if(isset($teacher->teacher_photo) && $teacher->teacher_photo != null)
                                    <img src="{{ asset('/uploads/teacher_photo/'.$teacher->teacher_photo) }}" width="228" height="280">
                                @else
                                @if($teacher->gender == 'male')
                                    <img src="{{asset('frontend')}}/school/assets/img/male.png" class="img-fluid" width="228" height="280">>
                                @else
                                    <img src="{{asset('frontend')}}/school/assets/img/male.png" class="img-fluid" width="228" height="280">>
                                @endif
                                @endif
                            </div>
                            <div class="t-content t-content-bg">
                                <a href="#" class="t-name" data-bs-toggle="modal" data-bs-target="#exampleModal"> {{$teacher->teacher_name}}</a>
                                <p class="t-designation"> {{$teacher->designation}}</p>
                            </div>
                        </div>
                    </div>
                     <!-- Modal-Start -->
                     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Teacher introduction</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="tm-img">
                                         @if(isset($teacher->teacher_photo) && $teacher->teacher_photo != null)
                                              <img src="{{ asset('/uploads/teacher_photo/'.$teacher->teacher_photo) }}" >
                                              @else
                                                @if($teacher->gender == 'male')
                                                  <img src="{{asset('frontend')}}/school/assets/img/male.png" class="img-fluid">
                                                @else
                                                  <img src="{{asset('frontend')}}/school/assets/img/male.png" class="img-fluid">
                                                @endif
                                              @endif
                                    </div>
                                    <div class="tm-skill">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="t-skill">
                                                    
                                                    <div class="title-skill">
                                                        <h4> {{$teacher->teacher_name}}</h4>
                                                    </div>
                                                    <div class="title-con ">
                                                        <p>পদবী : {{$teacher->designation}}</p>
                                                        <p>শিক্ষাগত যোগ্যতা : {{$teacher->traning_and_qualification}} </p>
                                                        <p>রক্তের গ্রুপ : {{$teacher->blood_group}} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal-End -->
                </div>
                @endif
                @endforeach


            </div>
        </div>
    </section>


@endsection