@extends('backend.master')
@section('content')
@section('title') Student Edit @endsection
@section('student') active @endsection
@section('student.create') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Student Edit</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Student</a>
            </li>
            <li class="breadcrumb-item active">Student Edit
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
          @if(Auth::user()->can('student-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('student.index')}}">
            <i class="material-icons dp48">list</i> Student List
          </a>
          @endif
        </div>


        <div class="row">

          <form class="col s12" method="post" action="{{route('student.update',$student->id)}}"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">

              <div class="input-field col s12 m4">
                <input id="student_name" type="text" class="validate" name="student_name" required
                  value="{{$student->student_name}}">
                <label for="student_name">Name <span class="custom-text-danger">*</span> </label>

                @error('student_name')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m4">
                <input id="student_phone" type="number" class="validate" name="student_phone" required
                  value="{{$student->student_phone}}" onblur="checkPhoneNumber()">
                <label for="student_phone">Phone <span class="custom-text-danger">*</span></label>

                @error('student_phone')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m4">
                <input id="student_email" type="email" class="validate" name="student_email"
                  value="{{$student->student_email}}">
                <label for="student_email">Email </label>

                @error('student_email')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m4">
                <input id="father_name" type="text" class="validate" name="father_name" required value="{{$student->guardianData->father_name}}">
                <label for="father_name"> Father Name <span class="custom-text-danger">*</span> </label>
              
                @error('father_name')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>
              
              
              <div class="input-field col s12 m4">
                <input id="phone" type="number" class="validate" name="phone" value="{{$student->guardianData->phone}}" onblur="checkPhoneNumber()"
                  required>
                <label for="phone"> Father Phone <span class="custom-text-danger">*</span> </label>
              
                @error('phone')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>
              
              
              <div class="input-field col s12 m4">
                <input id="father_profession" type="text" class="validate" name="father_profession"
                  value="{{$student->guardianData->father_profession}}">
                <label for="father_profession"> Father Profession </label>
              
                @error('father_profession')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>
              
              <div class="input-field col s12 m4">
                <input id="mother_name" type="text" class="validate" name="mother_name" required value="{{$student->guardianData->mother_name}}">
                <label for="mother_name"> Mother Name <span class="custom-text-danger">*</span> </label>
              
                @error('mother_name')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>
              
              
              <div class="input-field col s12 m4">
                <input id="mother_phone" type="number" class="validate" name="mother_phone" value="{{$student->guardianData->mother_phone}}">
                <label for="mother_phone"> Mother Phone </label>
              
                @error('mother_phone')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>
              
              
              <div class="input-field col s12 m4">
                <input id="mother_profession" type="text" class="validate" name="mother_profession"
                  value="{{$student->guardianData->mother_profession}}">
                <label for="mother_profession"> Mother Profession </label>
              
                @error('mother_profession')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m4">
                <select class="select2 browser-default" name="gender">
                  <option value="" disabled selected>Select Gender</option>
                  <option value="male" class="left circle" {{ $student->gender == 'male' ? 'selected' : '' }}>Male
                  </option>
                  <option value="female" class="left circle" {{ $student->gender == 'female' ? 'selected' : '' }}>Female
                  </option>
                  <option value="others" class="left circle" {{ $student->gender == 'others' ? 'selected' : '' }}>Others
                  </option>
                </select>
              
                @error('gender')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m4">
                <select class="select2 browser-default" name="blood_group" id="blood_group" required>
                  <option value="" disabled selected>Select Blood Group <span class="custom-text-danger">*</span>
                  </option>
                  @foreach($getBloodGroup as $getBlood)
                  <option value="{{$getBlood}}" {{$student->blood_group == $getBlood ? 'selected' : ''}}>{{$getBlood}}
                  </option>
                  @endforeach
              
                </select>
              
                @error('blood_group')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m4">
                <select class="select2 browser-default" name="session_year" required>
                  <option value="" disabled selected>Select Session Year <span class="custom-text-danger">*</span> </option>
              
                  @foreach($sessionData as $session)
                  <option value="{{$session->session_name}}" class="left circle"
                      {{ $session->session_name == $student->session_year ? 'selected' : '' }}>{{$session->session_name}}</option>
                  @endforeach
              
                </select>
              
                @error('session_year')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m4">
                <select class="select2 browser-default" name="class_id" id="class_id" required>
                  <option value="" disabled selected>Select Class <span class="custom-text-danger">*</span> </option>
                  @foreach($classes as $class)
                  <option value="{{$class->id}}" class="left circle"
                    {{ $class->id == $student->class_id ? 'selected' : '' }}>{{$class->class_name}}</option>
                  @endforeach

                </select>

                @error('class_id')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m4">
                <select class="select2 browser-default" name="section_id" id="section_id" required>
                  <option value="" disabled selected>Select Section <span class="custom-text-danger">*</span> </option>
                  @foreach($sections as $section)
                  <option value="{{$section->id}}" class="left circle"
                    {{ $section->id == $student->section_id ? 'selected' : '' }}>{{$section->section_name}}</option>
                  @endforeach

                </select>

                @error('section_id')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m4">
                <select class="select2 browser-default" name="group_id" id="group_id" required>
                  <option value="" disabled selected>Select Group <span class="custom-text-danger">*</span> </option>
                  @foreach($groups as $group)
                  <option value="{{$group->id}}" class="left circle"
                    {{ $group->id == $student->group_id ? 'selected' : '' }}>{{$group->group_name}}</option>
                  @endforeach

                </select>

                @error('group_id')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m4">
                <input id="address" type="text" class="validate" name="address" required value="{{$student->address}}">
                <label for="address">Address <span class="custom-text-danger">*</span> </label>
                
                @error('address')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m4">
                <input id="date_of_birth" type="text" class="datepicker" name="date_of_birth" value="{{$singleDOB}}">
                <label for="date_of_birth">Date Of Birth <span class="custom-text-danger">*</span> </label>

                @error('date_of_birth')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


              <div class="input-field col s12 m4">
                <input id="addmission_date" type="text" class="datepicker" name="addmission_date"
                  value="{{$singleAddmissionDate}}">
                <label for="addmission_date">Addmission Date <span class="custom-text-danger">*</span> </label>

                @error('addmission_date')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="religion" type="text" class="validate" name="religion" value="{{$student->religion}}">
                <label for="religion">Religion</label>

                @error('religion')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>

              <div class="input-field col s12 m6">
                <input id="roll_no" type="number" class="validate" name="roll_no" value="{{$student->roll_no}}" onblur="checkRollNo()">
                <label for="roll_no">Roll No <span class="custom-text-danger">*</span> </label>
              
                @error('roll_no')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>
              
              <div class="input-field col s12 m12">
                <div class="col s12 m4 l2 mb-1">
                  <p>Photo </p>
                </div>

                @if(isset($student->student_photo) && $student->student_photo != null)
                <input type="file" id="student_photo" name="student_photo" class="dropify"
                  data-default-file="{{asset('/uploads/student_photo/'.$student->student_photo)}}" />
                @else
                <input type="file" id="student_photo" name="student_photo" class="dropify" data-default-file="" />
                @endif

                @error('student_photo')
                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                @enderror
              </div>


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
@include('backend.guardian.partial.script')

<script>
  //To check phone number student with father phone...
  function checkPhoneNumber(){
    var studentPhone = $("#student_phone").val();
    var fatherPhone = $("#phone").val();

    if(fatherPhone != ''){
      if(studentPhone == fatherPhone){
        $("#phone").val('');
        toastr.error('Student phone & father phone number must be unique.!');
      }
    }
  }

  //To check roll no is unique or not...
  function checkRollNo() {
    var classId = $("#class_id").val();
    var sectionId = $("#section_id").val();
    var groupId = $("#group_id").val();
    var rollNo = $("#roll_no").val();

    //To check class, section & group...
    if(classId == null){
      $("#roll_no").val('');
      toastr.error('First select class.!');
    }else if(sectionId == null){
      $("#roll_no").val('');
      toastr.error('First select section.!');
    }else if(groupId == null){
      $("#roll_no").val('');
      toastr.error('First select group.!');
    }else{
      var url = "{{ route('check-student-roll-id') }}";
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: 'post',
          url: url,
          data: {
              class_id: classId,
              section_id: sectionId,
              group_id: groupId,
              roll_no: rollNo
          },
          success: function (data) {
              //For checking roll_id is unique...
              if(data.error){
                $("#roll_no").val('');
                toastr.error(data.error);
              }
          }

      });
    }
  }
</script>

@endsection