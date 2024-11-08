@extends('backend.master')
@section('content')
@section('title') Teacher Create @endsection
@section('teacher') active @endsection
@section('teacher.create') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Teacher Create</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Teacher</a>
            </li>
            <li class="breadcrumb-item active">Teacher Create
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">
      <div class="card-content custom-table-filtering-header">
        <div class="float-right">
          @if(Auth::user()->can('teacher-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('teacher.index')}}">
            <i class="material-icons dp48">list</i> Teacher List
          </a>
          @endif
        </div>
      </div>

      <div class="card-content custom-table-filtering-header">
        <div class="row">
          <form method="post" action="{{route('teacher.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">

              <div class="input-field col s12 m6">
                <input id="teacher_name" type="text" class="validate" name="teacher_name" required
                  value="{{ old('teacher_name') }}">
                <label for="teacher_name">Name <span class="custom-text-danger">*</span> </label>

                @error('teacher_name')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m6">
                <input id="teacher_phone" type="number" class="validate" name="teacher_phone" required
                  value="{{ old('teacher_phone') }}">
                <label for="teacher_phone">Phone <span class="custom-text-danger">*</span></label>

                @error('teacher_phone')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m4">
                <select class="select2 browser-default" name="teacher_category">
                  <option value="" disabled selected>Select Teacher Category <span class="custom-text-danger">*</span> </option>
                  <option value="head teacher" class="left circle">Head Teacher</option>
                  <option value="assistant head teacher" class="left circle">Assistant Head Teacher</option>
                  <option value="teacher" class="left circle">Teacher</option>
                </select>

                @error('teacher_category')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m4">
                <input id="teacher_email" type="email" class="validate" name="teacher_email"
                  value="{{ old('teacher_email') }}">
                <label for="teacher_email">Email</label>

                @error('teacher_email')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>



              <div class="input-field col s12 m4">
                <input id="date_of_birth" type="text" class="datepicker" name="date_of_birth"
                  value="{{ old('date_of_birth') }}" required>
                <label for="date_of_birth">Date Of Birth <span class="custom-text-danger">*</span> </label>

                @error('date_of_birth')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m4">
                <input id="designation" type="text" class="validate" name="designation" required
                  value="{{ old('designation') }}">
                <label for="designation">Designation <span class="custom-text-danger">*</span> </label>

                @error('designation')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m4">
                <input id="traning_and_qualification" type="text" class="validate" name="traning_and_qualification" value="{{ old('traning_and_qualification') }}">
                <label for="traning_and_qualification">Traning And Qualification <span class="custom-text-danger">*</span> </label>

                @error('traning_and_qualification')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m4">
                <input id="religion" type="text" class="validate" name="religion" value="{{ old('religion') }}">
                <label for="religion">Religion</label>

                @error('religion')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>



              <div class="input-field col s12 m6">
                <select class="select2 browser-default" name="blood_group" id="blood_group" required>
                  <option value="" disabled selected>Select Blood Group <span class="custom-text-danger">*</span>
                  </option>
                  @foreach($getBloodGroup as $getBlood)
                  <option value="{{$getBlood}}" class="left circle">{{$getBlood}}</option>
                  @endforeach

                </select>

                @error('blood_group')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m6">
                <select class="select2 browser-default" name="gender">
                  <option value="" disabled selected>Select Gender</option>
                  <option value="male" class="left circle">Male</option>
                  <option value="female" class="left circle">Female</option>
                  <option value="others" class="left circle">Others</option>
                </select>

                @error('gender')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="joining_date" type="text" class="datepicker" name="joining_date" required
                  value="{{ old('joining_date') }}">
                <label for="joining_date">Joining Date <span class="custom-text-danger">*</span> </label>

                @error('joining_date')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="salary" type="number" class="validate" name="salary" value="{{ old('salary') }}">
                <label for="salary">Salary</label>

                @error('salary')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="address" type="text" class="validate" name="address" required value="{{ old('address') }}">
                <label for="address">Address <span class="custom-text-danger">*</span> </label>

                @error('address')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="loginPassword" type="text" class="validate" name="loginPassword" required>
                <label for="loginPassword">Login Password <span class="custom-text-danger">*</span> </label>

                @error('loginPassword')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m12">
                <div class="col s12 m4 l2 mb-1">
                  <p>Photo <span class="custom-text-danger">*</span></p>
                </div>

                <input type="file" id="teacher_photo" name="teacher_photo" class="dropify" data-default-file="" />

                @error('teacher_photo')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="col s12 mb-3 mt-3">
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
@endsection