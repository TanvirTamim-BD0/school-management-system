@extends('backend.master')
@section('content')
@section('title') Student Report @endsection
@section('report-of-student') active @endsection
@section('report-of-student') active @endsection
@section('styles')
<style>
    @media print {
  
      body {
        visibility: hidden;
      }
  
      body * {
        visibility: hidden;
      }
  
      .brand-sidebar {
        display: none;
      }
  
      .brand-sidebar * {
        display: none;
      }
  
      .print-conatiner,
      .print-conatiner * {
        visibility: visible;
      }
  
    }
  </style>
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Student Report</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Student Report
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

 <div class="float-right ">
        <form class="col s12" method="post" action="{{route('report-of-student-invoice')}}" enctype="multipart/form-data">
        @csrf
          <input type="hidden" name="class_id" value="{{ $student->classData->id }}">
          <input type="hidden" name="section_id" value="{{ $student->sectionData->id }} ">
          <button class="btn btn-primary" style="margin-right: 20px;">Print</button>
       </form>
      </div>

  <div class="print-conatiner">

    <div class="col s12 m12">

      <div class="card">
        <div class="card-content custom-card-content custom-table-filtering-header custom-attendance-academic-header">
          <div class="custom-class-section">
            <div class="float-left justify-content-end">
              <h5>Class: <span class="custom-text-gray">{{ $student->classData->class_name }}</span></h5>
              <h5>Section: <span class="custom-text-gray">{{ $student->sectionData->section_name }} </span></h5>
            </div>
          </div>

        </div>

      </div>


      <div class="card">
        <div class="card-content-datatable table-responsive">
          <h6>Student Information</h6><br>
          <table id="" class="display custom-table custom-table-border dt-responsive nowrap table-responsive">

            <thead>
              <tr>
                <th class="custom-border-right">SL</th>
                <th class="custom-border-right">Photo</th>
                <th class="custom-border-right">Student Details</th>
                <th class="custom-border-right">Academic</th>
              </tr>
            </thead>

            <tbody>
              
               @foreach($studentData as $student)
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

</div>

@endsection

@section('scripts')
<script>
  $(document).ready(function() {
      $('#classTable').DataTable({
        "responsive": false,
        "searching": true,
        "scrollX": false,
      });
    });
</script>
@endsection