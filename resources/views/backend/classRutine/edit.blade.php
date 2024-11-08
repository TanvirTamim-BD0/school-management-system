@extends('backend.master')
@section('content')
@section('title') Class Routine Update @endsection
@section('classRoutine') active @endsection
@section('classRoutine.update') active @endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/dropify/css/dropify.min.css">
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Class Routine Update</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Class Routine</a>
            </li>
            <li class="breadcrumb-item active">Class Routine Update
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">
      <div class="card-content custom-card-content">
        <h2 class="card-title">Class Routine Record Update</h2>
        <div class="float-right">
          @if(Auth::user()->can('class-routine-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button" href="{{route('classRoutine.index')}}">
            <i class="material-icons dp48">list</i> Class Routine List
          </a>
          @endif
        </div>
      </div>

      <div class="card-content">

        <div class="row">

          <form class="col s12" method="post" action="{{route('classRoutine.update', $singleClassRutineData->id)}}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">

              <div class="col m6 s12">
                <div class="input-field">
                  <select class="select2 browser-default" id="class_id" name="class_id" required>
                    <option value="#" selected>Select Section</option>
                    @foreach($classData as $singleClassData)
                    @if(isset($singleClassData) && $singleClassData != null)
                    <option value="{{ $singleClassData->id }}" {{$singleClassRutineData->class_id == $singleClassData->id ? 'selected' : ''}}>{{ $singleClassData->class_name }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>

            
              <div class="col m6 s12">
                <div class="input-field">
                  <select class="select2 browser-default" name="section_id" id="section_id"
                    data-placeholder="Select Section" required>

                    @foreach($sectionData as $singleSectionData)
                      @if(isset($singleSectionData) && $singleSectionData != null)
                        <option value="{{ $singleSectionData->id }}"
                          {{$singleClassRutineData->section_id == $singleSectionData->id ? 'selected' : ''}} >{{ $singleSectionData->section_name }}
                        </option>
                      @endif
                    @endforeach
                    
                  </select>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col m6 s12">
                <div class="input-field">
                  <select class="select2 browser-default" name="subject_id" id="subject_id"
                    data-placeholder="Select Subject" required>

                    @foreach($subjectData as $singleSubjectData)
                      @if(isset($singleSubjectData) && $singleSubjectData != null)
                        <option value="{{ $singleSubjectData->id }}"
                          {{$singleClassRutineData->subject_id == $singleSubjectData->id ? 'selected' : ''}}>{{ $singleSubjectData->subject_name }}
                        </option>
                      @endif
                    @endforeach

                  </select>
                </div>
              </div>

              
              <div class="col m6 s12">
                <div class="input-field">
                  <select class="select2 browser-default" name="teacher_id" id="teacher_id"
                    data-placeholder="Select Teacher" required>

                    @foreach($teacherData as $singleTeacherData)
                      @if(isset($singleTeacherData) && $singleTeacherData != null)
                        <option value="{{ $singleTeacherData->id }}"
                          {{$singleClassRutineData->section_id == $singleTeacherData->id ? 'selected' : ''}} >{{ $singleTeacherData->teacher_name }}
                        </option>
                      @endif
                    @endforeach
                    
                  </select>
                </div>
              </div>

            </div>


            <div class="row">

              <div class="col m4 s12">
                <div class="input-field">
                  <select class="select2 browser-default" name="room_id" id="room_id"
                    data-placeholder="Select Room" required>

                    @foreach($roomData as $singleRoomData)
                      @if(isset($singleRoomData) && $singleRoomData != null)
                        <option value="{{ $singleRoomData->id }}"
                          {{$singleClassRutineData->subject_id == $singleRoomData->id ? 'selected' : ''}}>{{ $singleRoomData->room_no }}
                        </option>
                      @endif
                    @endforeach

                  </select>
                </div>
              </div>

              
              <div class="col m4 s12">
                <div class="input-field">
                  <select class="select2 browser-default" id="year" name="year" required>

                        <option value="#" selected disabled>Select Year <span class="custom-text-danger">*</span></option>
                        @foreach($yearData as $singleYear)
                        @if(isset($singleYear) && $singleYear != null)
                        <option value="{{$singleYear}}" {{ $singleYear == $singleClassRutineData->year ? 'selected' : '' }}>{{ $singleYear }}</option>
                        @endif
                        @endforeach


                  </select>

                   @error('year')
                    <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
              </div>


              <div class="col m4 s12">
                <div class="input-field">
                  <select class="select2 browser-default" id="day" name="day" required>

                        <option value="#" selected disabled>Select Day <span class="custom-text-danger">*</span></option>
                        <option value="saturday" {{$singleClassRutineData->day == 'saturday' ? 'selected' : ''}}>Saturday</option>
                        <option value="sunday" {{$singleClassRutineData->day == 'sunday' ? 'selected' : ''}}>Sunday</option>
                        <option value="monday" {{$singleClassRutineData->day == 'monday' ? 'selected' : ''}}>Monday</option>
                        <option value="tuesday" {{$singleClassRutineData->day == 'tuesday' ? 'selected' : ''}}>Tuesday</option>
                        <option value="wednesday" {{$singleClassRutineData->day == 'wednesday' ? 'selected' : ''}}>Wednesday</option>
                        <option value="thursday" {{$singleClassRutineData->day == 'thursday' ? 'selected' : ''}}>Thursday</option>
                  </select>

                   @error('day')
                    <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
              </div>

            </div>


            <div class="row">

               <div class="col m6 s12">
                <label for="starting_time">Starting Time <span class="custom-text-danger">*</span> </label>
                <input id="starting_time" type="text" class="validate timepicker" name="starting_time" required value="{{$formateStartTime}}">

                 @error('starting_time')
                    <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
              </div>


              <div class="col m6 s12">
                <label for="ending_time">Ending Time <span class="custom-text-danger">*</span> </label>
                <input id="ending_time" type="text" class="validate timepicker" name="ending_time" required value="{{$formateEndTime}}">

                 @error('ending_time')
                    <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
              </div>
             
            </div>

            <div class="row mt-5">

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

@section('scripts')
<script src="{{ asset('backend') }}/app-assets/vendors/dropify/js/dropify.min.js"></script>
<script src="{{ asset('backend') }}/app-assets/js/scripts/form-file-uploads.js"></script>

@include('backend.assignment.partial.script')

@endsection