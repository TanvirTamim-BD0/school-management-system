@extends('backend.master')
@section('content')
@section('title') Assignment Update @endsection
@section('assignment') active @endsection
@section('assignment.update') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Assignment Update</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Assignment</a>
            </li>
            <li class="breadcrumb-item active">Assignment Update
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">
      <div class="card-content custom-card-content">
        <h2 class="card-title">Assignment Record Update</h2>
        <div class="float-right">
          @if(Auth::user()->can('assignment-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('assignment.index')}}">
            <i class="material-icons dp48">list</i> Assignment List
          </a>
          @endif
        </div>
      </div>

      <div class="card-content">

        <div class="row">

          <form class="col s12" method="post" action="{{route('assignment.update', $singleAssignmentData->id)}}"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">

              <div class="col m6 s12">
                <div class="input-field">
                  <select class="select2 browser-default" id="class_id" name="class_id" required>
                    <option value="#" selected>Select Section <span class="custom-text-danger">*</span></option>
                    @foreach($classData as $singleClassData)
                    @if(isset($singleClassData) && $singleClassData != null)
                    <option value="{{ $singleClassData->id }}"
                      {{$singleAssignmentData->class_id == $singleClassData->id ? 'selected' : ''}}>
                      {{ $singleClassData->class_name }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>

              @php
              //To decode section ids...
              $arraySectionIds = json_decode($singleAssignmentData->section_id);
              @endphp
              <div class="col m6 s12">
                <div class="input-field">
                  <select class="select2 browser-default" name="section_id[]" id="section_id" multiple="multiple"
                    data-placeholder="Select Section *" required>

                    @foreach($sectionData as $singleSectionData)
                    @if(isset($singleSectionData) && $singleSectionData != null)
                    <option value="{{ $singleSectionData->id }}"
                      {{ in_array($singleSectionData->id, $arraySectionIds) ? 'selected' : ''}}>
                      {{ $singleSectionData->section_name }}
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
                    required>
                    <option value="" selected disabled>Select Subject <span class="custom-text-danger">*</span></option>
                    
                    @foreach($subjectData as $singleSubjectData)
                    @if(isset($singleSubjectData) && $singleSubjectData != null)
                    <option value="{{ $singleSubjectData->id }}"
                      {{$singleAssignmentData->subject_id == $singleSubjectData->id ? 'selected' : ''}}>
                      {{ $singleSubjectData->subject_name }}
                    </option>
                    @endif
                    @endforeach

                  </select>
                </div>
              </div>

              <div class="col m6 s12">

                <div class="input-field">
                  <input type="text" class="validate datepicker" name="deadline" id="deadline"
                    value="{{$singleDeadline}}" onkeyup="deadLine()" required>
                  <label for="deadline">Deadline <span class="custom-text-danger">*</span></label>

                  @error('deadline')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
                </div>

              </div>
            </div>

            <div class="row">
              <div class="col m12  s12">
                <div class="input-field">
                  <input id="title" type="text" name="title" data-length="10" value="{{$singleAssignmentData->title}}"
                    required>
                  <label for="title">Assignment Title <span class="custom-text-danger">*</span></label>
                </div>
              </div>

              <div class="input-field col s12 m12 custom-texarea-body">
                <label for="description" class="mb10">Desciption <span class="custom-text-danger">*</span></label>
                <textarea name="description" id="description" class="validate" cols="20" rows="40"
                  placeholder="Description">{{$singleAssignmentData->description}}</textarea>
              
                @error('description')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>
            </div>

            <div class="input-field col s12 m12">
              <div class="col s12 m4 l2 mb-1">
                <p>Assignment File </p>
              </div>
            
              @if(isset($singleAssignmentData->assignment_file) && $singleAssignmentData->assignment_file != null)
              <input type="file" id="assignment_file" name="assignment_file" class="dropify"
                data-default-file="{{asset('/backend/uploads/assignmentFile/'.$singleAssignmentData->assignment_file)}}" />
              @else
              <input type="file" id="assignment_file" name="assignment_file" class="dropify" data-default-file="" />
              @endif
            
              @error('assignment_file')
              <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
              @enderror
            </div>

            <div class="row mt-5">

              <div class="col s12 mb-3 mt-3">
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
@include('backend.assignment.partial.script')

@endsection