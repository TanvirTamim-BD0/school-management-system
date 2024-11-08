@extends('backend.master')
@section('content')
@section('title') Syllabus Update @endsection
@section('syllabus') active @endsection
@section('syllabus.update') active @endsection
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
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Syllabus Update</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Syllabus</a>
            </li>
            <li class="breadcrumb-item active">Syllabus Update
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">
      <div class="card-content custom-card-content">
        <h2 class="card-title">Syllabus Record Update</h2>
        <div class="float-right">
          @if(Auth::user()->can('syllabus-list'))
          <a class="waves-effect waves dark btn btn-primary next-step" href="{{route('syllabus.index')}}">
            Syllabus List
          </a>
          @endif
        </div>
      </div>

      <div class="card-content">

        <div class="row">

          <form class="col s12" method="post" action="{{route('syllabus.update', $singleSyllabusData->id)}}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">

              <div class="col m6 s12">
                <div class="input-field">
                  <select class="select2 browser-default" id="class_id" name="class_id" required>
                    <option value="#" selected disabled>Select Section</option>
                    @foreach($classData as $singleClassData)
                      @if(isset($singleClassData) && $singleClassData != null)
                        <option value="{{ $singleClassData->id }}" {{$singleSyllabusData->class_id == $singleClassData->id ? 'selected' : ''}}>{{ $singleClassData->class_name }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col m6  s12">
                <div class="input-field">
                  <input id="title" type="text" name="title" data-length="10" value="{{$singleSyllabusData->title}}" required>
                  <label for="title">Syllabus Title</label>
                </div>
              </div>

            </div>


            <div class="row">

              <div class="col m12  s12">
                <div class="input-field">
                  <textarea id="description" name="description" class="materialize-textarea">{{$singleSyllabusData->description}}</textarea>
                  <label for="description">Textarea</label>
                </div>
              </div>
            </div>

            <div class="row section">
              <div class="col s12 m4 l2">
                <p>Syllabus File</p>
              </div>
              <div class="col s12 m8 l10">
                <input type="file" id="syllabus_file" name="syllabus_file" class="dropify" value="{{$singleSyllabusData->syllabus_file}}" data-default-file="" />
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