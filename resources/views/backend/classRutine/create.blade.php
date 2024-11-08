@extends('backend.master')
@section('content')
@section('title') Class Routine Create @endsection
@section('classRoutine') active @endsection
@section('classRoutine.create') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Class Routine Create</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Class Routine</a>
            </li>
            <li class="breadcrumb-item active">Class Routine Create
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">
      <div class="card-content custom-card-content">
        <h2 class="card-title">Class Routine Record Create</h2>
        <div class="float-right">
          @if(Auth::user()->can('class-routine-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('classRoutine.index')}}">
            <i class="material-icons dp48">list</i> Class Routine List
          </a>
          @endif
        </div>
      </div>

      <div class="card-content">

        <div class="row">

          <form class="col s12" method="post" action="{{route('classRoutine.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">

              <div class="col m6 s12">
                <div class="input-field">
                  <select class="select2 browser-default" id="class_id" name="class_id" required>
                    <option value="" selected disabled>Select Class <span class="custom-text-danger">*</span> </option>
                    @foreach($classData as $singleClassData)
                    @if(isset($singleClassData) && $singleClassData != null)
                    <option value="{{ $singleClassData->id }}">{{ $singleClassData->class_name }}</option>
                    @endif
                    @endforeach
                  </select>

                  @error('class_id')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror

                </div>
              </div>

              <div class="col m6 s12">
                <div class="input-field">
                  <select class="select2 browser-default" name="section_id" id="section_id"
                     required>
                    <option value="" selected disabled>Select Section <span class="custom-text-danger">*</span>
                    </option>


                  </select>

                  @error('section_id')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col m6 s12">
                <div class="input-field">
                  <select class="select2 browser-default" name="subject_id" id="subject_id"
                    required>
                    <option value="" selected disabled>Select Subject <span class="custom-text-danger">*</span>
                    </option>

                  </select>

                  @error('subject_id')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
              </div>

              <div class="col m6 s12">
                <div class="input-field">
                  <select class="select2 browser-default" id="teacher_id" name="teacher_id" required>
                    <option value="" selected disabled>Select Teacher <span class="custom-text-danger">*</span>
                    </option>
                    
                    @foreach($teacherData as $singleTeacherData)
                    @if(isset($singleTeacherData) && $singleTeacherData != null)
                    <option value="{{ $singleTeacherData->id }}">{{ $singleTeacherData->teacher_name }}</option>
                    @endif
                    @endforeach
                  </select>

                  @error('teacher_id')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
              </div>

            </div>

            <div class="row">

              <div class="col m4 s12">
                <div class="input-field">
                  <select class="select2 browser-default" id="room_id" name="room_id" required>
                    <option value="" selected disabled>Select Room <span class="custom-text-danger">*</span></option>
                    @foreach($roomData as $singleRoomData)
                    @if(isset($singleRoomData) && $singleRoomData != null)
                    <option value="{{ $singleRoomData->id }}">{{ $singleRoomData->room_no }}</option>
                    @endif
                    @endforeach
                  </select>

                  @error('room_id')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>
              </div>

              <div class="col m4 s12">
                <div class="input-field">
                  <select class="select2 browser-default" id="year" name="year" required>

                    <option value="#" selected disabled>Select Year <span class="custom-text-danger">*</span></option>
                    @foreach($yearData as $singleYear)
                    @if(isset($singleYear) && $singleYear != null)
                    <option value="{{$singleYear}}" {{ $singleYear == $currentYear ? 'selected' : '' }}>{{ $singleYear }}</option>
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
                    <option value="saturday">Saturday</option>
                    <option value="sunday">Sunday</option>
                    <option value="monday">Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
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
                <input id="starting_time" type="text" class="validate timepicker" name="starting_time" required
                  value="{{ old('starting_time') }}">

                @error('starting_time')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="col m6 s12">
                <label for="ending_time">Ending Time <span class="custom-text-danger">*</span> </label>
                <input id="ending_time" type="text" class="validate timepicker" name="ending_time" required
                  value="{{ old('ending_time') }}">

                @error('ending_time')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

            </div>

            <div class="row mt-5">

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

@section('scripts')
@include('backend.assignment.partial.script')

@endsection