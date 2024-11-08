@extends('frontend.master')
@section('content')
@section('styles')
@endsection

	@if(isset($assistantHeadTeacher) && $assistantHeadTeacher != null)
	<section class="main-body">
        <div class="container">
            <div class="row mt-2 mb-4">
            	<div class="col-md-2">
            	</div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-body-content dialog">
                                <div class="dialog-header custom-dialog-bg-color">
                                    <h2 class="msg text-white">সহকারী প্রধান শিক্ষক</h2>
                                </div>
                                <div class="row mt-2">

                                	<div class="col-md-4">
                                        <div class="school-info-img">
                                            
                                             @if(isset($assistantHeadTeacher->teacher_photo) && $assistantHeadTeacher->teacher_photo != null)
						                      <img src="{{ asset('/uploads/teacher_photo/'.$assistantHeadTeacher->teacher_photo) }}" style="height: 210px;" >
						                      @else
						                        @if($assistantHeadTeacher->gender == 'male')
						                          <img src="{{asset('frontend')}}/school/assets/img/male.png" class="img-fluid" style="height: 210px;">
						                        @else
						                          <img src="{{asset('frontend')}}/school/assets/img/male.png" class="img-fluid" style="height: 210px;">
						                        @endif
						                      @endif

                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="card">
                                        	
                                        	<div class="card-content">
                                        		<p>নাম : {{$assistantHeadTeacher->teacher_name}} </p>
                                        		<p>পদবী : {{$assistantHeadTeacher->designation}}</p>
                                        		<p>শিক্ষাগত যোগ্যতা : {{$assistantHeadTeacher->traning_and_qualification}} </p>
                                        		<p>রক্তের গ্রুপ : {{$assistantHeadTeacher->blood_group}} </p>

                                        	</div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                  
    
                </div>
               
            </div>
        </div>
    </section>
    @else
    @endif


@endsection