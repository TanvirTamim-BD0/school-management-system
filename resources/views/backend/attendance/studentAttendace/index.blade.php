@extends('backend.master')
@section('content')
@section('title') Student Attendance @endsection
@section('attendace-of-student') active @endsection
@section('attendace-of-student.index') active @endsection
@section('styles')
@endsection

@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Student Attendance List</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Student Attendance</a>
            </li>
            <li class="breadcrumb-item active">Student Attendance List
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-table-filtering-header">
        <h2 class="card-title">Student Record Filter</h2>
        <form method="post" action="{{route('get-student-filter-data')}}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col m6  s12">
              <div class="input-field">
                <select class="select2 browser-default" id="class_id" name="class_id" required>
                  <option value="#" selected disabled>Select Class</option>
                    @foreach($classData as $singleClassData)
                      @if(isset($singleClassData) && $singleClassData != null)
                        <option value="{{ $singleClassData->id }}">{{ $singleClassData->class_name }}</option>
                      @endif
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col m6  s12">
              <div class="input-field">
                <select class="select2 browser-default" name="section_id" id="section_id"
                  data-placeholder="Select Section" required>
              
                </select>
              </div>
            </div>
            <div class="col m12  s12 custom-text-center">
              <button class="mb-1 btn waves-effect waves-light purple lightrn-1 custom-filter-button" type="submit">
                <i class="material-icons">search</i>
                <span>Filter</span>
              </button>
            </div>
          </div>
        </form>
      </div>
    
    </div>

    <div class="card">

      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Student Record List</h2>
        <div class="float-right justify-content-end">
          @if(Auth::user()->can('attendace-of-student-create'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button" href="{{route('attendace-of-student.create')}}">
            <i class="material-icons dp48">add_circle_outline</i>
            <span>
              Add Student Attendace
            </span>
          </a>
          @endif
        </div>
      </div>

      <div class="card-content-datatable table-responsive custom-filter-content-datatable">
        <table id="studentTable" class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">
          <thead>
            <tr>
              <th class="custom-border-right custom-sl-no">SL</th>
              <th class="custom-border-right custom-attendance-image-th">Photo</th>
              <th class="custom-border-right custom-attendance-details-th">Student Details</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          
            @foreach($studentData as $key => $item)
              @if(isset($item) && $item != null)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                    @if(isset($item->student_photo) && $item->student_photo != null)
                      <img src="{{ asset('/uploads/student_photo/'.$item->student_photo) }}" width="75" height="65">
                      @else
                        @if($item->gender == 'male')
                          <img src="{{ asset('backend/app-assets/images/user/male.png') }}" width="75" height="65">
                        @else
                          <img src="{{ asset('backend/app-assets/images/user/female.png') }}" width="75" height="65">
                        @endif
                      @endif
                  </td>
                  <td>
                    Name: {{$item->student_name}} <br>
                    Roll: {{$item->roll_no}} <br>
                    Phone: {{$item->student_phone}}
                  </td>
              
                  <td class=" text-center">
                    <!-- Dropdown Trigger -->
                    <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$item->id}}'>
                      <i class="material-icons float-right">more_vert</i>
                    </a>
                    <!-- Dropdown Structure -->
                    <ul id='dropdown1{{$item->id}}' class='dropdown-content custom-dropdown-for-action'>
                      <li>
                        @if(Auth::user()->can('syllabus-edit'))
                        <a href="{{ route('student-profile',$item->id) }}"><i class="material-icons">visibility</i>Student Profile</a>
                        @endif
                      </li>
                      
                      <!-- <li>
                        @if(Auth::user()->can('syllabus-edit'))
                        <a href="{{ route('syllabus.edit',$item->id) }}"><i class="material-icons">visibility</i>Attendace History</a>
                        @endif
                      </li> -->
                      
                    </ul>
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
@include('backend.assignment.partial.script')

  <script>
    $(document).ready(function() {
      $('#studentTable').DataTable({
        "responsive": false,
        "searching": true,
        "scrollX": false,
      });
    });
  </script>
@endsection