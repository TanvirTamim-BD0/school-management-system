@extends('backend.master')
@section('content')
@section('title') Exam Create @endsection
@section('exam') active @endsection
@section('exam') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Exam Create</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Exam</a>
            </li>
            <li class="breadcrumb-item active">Exam Create
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">
      <div class="card-content">

        <div class="float-right">

          @if(Auth::user()->can('exam-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('exam.index')}}">
            <i class="material-icons dp48">list</i> Exam List
          </a>
          @endif

        </div>


        <div class="row">

          <form class="col s12" method="post" action="{{route('exam.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">

              <div class="col s12 m6">
                <div class="input-field">
                  <select class="select2 browser-default" id="class_id" name="class_id" required>
                    <option value="" selected disabled>Select Class <span class="custom-text-danger">*</span></option>
                    @foreach($classData as $singleClassData)
                    @if(isset($singleClassData) && $singleClassData != null)
                    <option value="{{ $singleClassData->id }}">{{ $singleClassData->class_name }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col m6 s12">
                <div class="input-field">
                  <select class="select2 browser-default custom-school-multiple-select" name="section_id[]" id="section_id"
                    id="section_id" multiple="multiple" data-placeholder="Select Section *" required>
              
                  </select>
                </div>
              </div>

              <div class="col m6 s12">
                <div class="input-field">
                  <select class="select2 browser-default" name="subject_id" id="subject_id" required>
                    <option value="" selected disabled>Select Subject <span class="custom-text-danger">*</span></option>
              
                  </select>
                </div>
              </div>


              <div class="input-field col s12 m6">
                <input id="exam_name" type="text" class="validate" name="exam_name" required
                  value="{{ old('exam_name') }}">
                <label for="exam_name"> Exam Name <span class="custom-text-danger">*</span> </label>

                @error('exam_name')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m6">
                <input id="exam_date" type="text" class="datepicker" name="exam_date" required
                  value="{{ old('exam_date') }}">
                <label for="exam_date"> Exam Date <span class="custom-text-danger">*</span> </label>

                @error('exam_date')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m6">
                <input id="total_mark" type="text" class="validate" name="total_mark" value="{{ old('total_mark') }}" required>
                <label for="total_mark"> Total Mark <span class="custom-text-danger">*</span> </label>

                @error('total_mark')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="pass_mark" type="text" class="validate" name="pass_mark" value="{{ old('pass_mark') }}" required>
                <label for="pass_mark"> Pass Mark <span class="custom-text-danger">*</span> </label>

                @error('pass_mark')
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
  </div>

</div>

<script>
  // Small
    $('.select2-size-sm').select2({
        dropdownAutoWidth: true,
        width: '100%',
        containerCssClass: 'select-sm'
    });
</script>

@endsection

@section('scripts')
@include('backend.exam.partial.script')

@endsection