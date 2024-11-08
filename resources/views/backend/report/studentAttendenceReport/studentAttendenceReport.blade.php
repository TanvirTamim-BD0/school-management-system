@extends('backend.master')
@section('content')
@section('title') Student Attendence Report @endsection
@section('report-of-attendence-student') active @endsection
@section('report-of-attendence-student') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Student Attendence Report</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Student Attendence Report
            </li>
          </ol>
        </div>
      </div>
    </div>
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
          <h4 id="attendenceHistory">Student Attendence Information</h4><br>
          <div id="courseAttendanceWitMonth">

             <div class="float-right mb-2">
              <form class="col s12" method="post" action="{{route('report-of-attendence-student-monthly-invoice')}}" enctype="multipart/form-data">
              @csrf
                <input type="hidden" name="class_id" value="{{ $student->classData->id }}">
                <input type="hidden" name="section_id" value="{{ $student->sectionData->id }} ">
                <input type="hidden" name="student_id" value="{{ $student->id }} ">
                <button class="btn btn-primary" style="margin-right: 20px;">Print</button>
             </form>
            </div>

            <table id="" class="display custom-table custom-table-border dt-responsive nowrap table-responsive">

              <thead>
                <tr>
                  <th class="custom-border-right">Month</th>
                  <th class="custom-border-right">Present</th>
                  <th class="custom-border-right">Absence</th>
                  <th class="custom-border-right">Late</th>
                  <th class="custom-border-right">Leave</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($monthNames as $key => $month)
                @if (isset($month))

                @php
                $presentData = App\Models\StudentAttendance::presentDataWithMonth($month, $student->class_id,
                $student->section_id, $student->id);
                $absenceData = App\Models\StudentAttendance::absenceDataWithMonth($month, $student->class_id,
                $student->section_id, $student->id);
                $lateData = App\Models\StudentAttendance::lateDataWithMonth($month, $student->class_id,
                $student->section_id, $student->id);
                $leaveData = App\Models\StudentAttendance::leaveDataWithMonth($month, $student->class_id,
                $student->section_id, $student->id);
                @endphp

                <tr>
                  <td class="font-weight-bold text-left custom-border-right" style="color: #00CFE8 !important;">
                    <a href="#" onclick="studentMonthAttendense({{$student->class_id}},{{$student->section_id}},{{$student->id}},'{{$month}}')">
                      {{ $month }}
                    </a>
                  </td>


                  <td class="custom-border-right"><span style="color: #00FF00">{{ $presentData }}</span></td>
                  <td class="custom-border-right"><span style="color: red;">{{ $absenceData }}</span></td>
                  <td class="custom-border-right"><span style="color: #F4A460;">{{ $lateData }}</span></td>
                  <td class="custom-border-right"><span style="color: #1E90FF;">{{ $leaveData }}</span></td>
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

</div>

@endsection

@section('scripts')
<script>
  //To fetch the course days attendance with month...
        function studentMonthAttendense(classId, sectionId, studentId, monthName) {

            var url = "{{ route('student-report.daysAttendanceWithMonth') }}";
            if(classId != ''){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        classId: classId,
                        sectionId: sectionId,
                        studentId: studentId,
                        monthName: monthName
                    },
                    success: function (data) {
                        $("#courseAttendanceWitMonth").html(data);
                    }
                });
            }
        }
</script>

@endsection