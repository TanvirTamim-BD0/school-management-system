@extends('backend.master')
@section('content')
@section('title') Student @endsection
@section('student') active @endsection
@section('student.index') active @endsection
@section('styles')
@endsection
@section('content')

	 <div class="row">

	 	<div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>Student List</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Student</a>
                  </li>
                  <li class="breadcrumb-item active">Student List
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>

    <div class="col s12">
      <div class="card">

        <div class="card-content custom-card-content custom-card-content-for-datatable">
          <h2 class="card-title">Student Record List</h2>
          <div class="float-right justify-content-end">
            @if(Auth::user()->can('student-create'))
            <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button" href="{{route('student.create')}}">
              <i class="material-icons dp48">add_circle_outline</i> Add Student
            </a>
            @endif
          </div>
        </div>

          <div class="card-content-datatable table-responsive">
            <table id="sectionTable" class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">

                <thead>
                  <tr>
                    <th class="custom-border-right">SL</th>
                    <th class="custom-border-right">Photo</th>
                    <th class="custom-border-right">Student Details</th>
                    <th class="custom-border-right">Academic</th>
                    <th class="custom-border-right">Action</th>
                  </tr>
                </thead>

                <tbody>

                  @foreach($students as $student)
                  @if(isset($student) && $student != null)
                  <tr>
                  	<td>{{ $loop->iteration }}</td>
                    <td>
                      @if(isset($student->student_photo) && $student->student_photo != null)
                      <img src="{{ asset('/uploads/student_photo/'.$student->student_photo) }}" width="75" height="65">
                      @else
                        @if($student->gender == 'male')
                          <img src="{{ asset('backend/app-assets/images/user/male.png') }}" width="75" height="65">
                        @else
                          <img src="{{ asset('backend/app-assets/images/user/female.png') }}" width="75" height="65">
                        @endif
                      @endif
                    </td>
                     
                    <td>
                      Name : {{$student->student_name}} <br>
                      Phone : {{$student->student_phone}} <br>
                      Email : {{$student->student_email}} <br>
                      address : {{$student->address}} <br>
                    </td>

                    <td>
                      Class : {{$student->classData->class_name}} <br>
                      @if($student->section_id) Section : {{$student->sectionData->section_name}} @else  @endif <br>
                      @if($student->group_id) Group : {{$student->groupData->group_name}} @else  @endif <br>
                      Roll No : {{$student->roll_no}} <br>
                      Registration No : {{$student->registration_no}} <br>
                      Session : {{$student->session_year}} <br>
                    </td>

                    <td class=" text-center">
                      <!-- Dropdown Trigger -->
                      <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$student->id}}'>
                        <i class="material-icons float-right">more_vert</i>
                      </a>
                      <!-- Dropdown Structure -->
                      <ul id='dropdown1{{$student->id}}' class='dropdown-content custom-dropdown-for-action'>

                        <li>
                        <a href="{{ route('student-profile',$student->id) }}"><i class="material-icons">visibility</i>Student Profile</a>
                      </li>

                        @if(Auth::user()->can('student-edit'))
                        <li>
                          <a href="{{ route('student.edit',$student->id) }}"><i class="material-icons">edit</i>Edit</a>
                        </li>
                         @endif


                        @if(Auth::user()->can('student-delete'))
                        <li>  
                          <a href="{{ route('student.destroy', $student->id) }}" onclick="event.preventDefault();
                          document.getElementById('delete-form').submit();"><i
                          class="material-icons">delete</i>Delete</a>
                        </li>
                         @endif
                         
                      </ul>

                      <form id="delete-form" action="{{ route('student.destroy', $student->id) }}" method="POST" style="display: none;">
                          @csrf
                          @method('delete')
                      </form>
                    </td>


                  </tr>
                  @endif
                  @endforeach

               </tbody>

              </table>
        </div>
      </div>
    </div>
    
  </div>

@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      $('#sectionTable').DataTable({
        "responsive": false,
        "searching": true,
        "scrollX": false,
      });
    });
  </script>
@endsection
                                                                    
