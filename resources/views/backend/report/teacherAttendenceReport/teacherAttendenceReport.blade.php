@extends('backend.master')
@section('content')
@section('title') Teacher Attendence Report @endsection
@section('report-of-attendence-teacher') active @endsection
@section('report-of-attendence-teacher') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Teacher Attendence Report</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Teacher Attendence Report
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
              <h5>Name : <span class="custom-text-gray">{{ $teacher->teacher_name }}</span></h5>
              <h5>Email : <span class="custom-text-gray">{{ $teacher->teacher_email }} </span></h5>
            </div>
          </div>

        </div>

      </div>


      <div class="card">
        <div class="card-content-datatable table-responsive">
          <h6 id="attendenceHistory">Teacher Attendence Information</h6><br>
          <div id="teacherAttendanceReport">

              <div class="float-right mb-2">
              <form class="col s12" method="post" action="{{route('report-of-attendence-teacher-month-invoice')}}" enctype="multipart/form-data">
              @csrf
                <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
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
                $presentData = App\Models\TeacherAttendance::presentDataWithMonth($month,$teacher->id);
                $absenceData = App\Models\TeacherAttendance::absenceDataWithMonth($month,$teacher->id);
                $lateData = App\Models\TeacherAttendance::lateDataWithMonth($month, $teacher->id);
                $leaveData = App\Models\TeacherAttendance::leaveDataWithMonth($month, $teacher->id);
                @endphp

                <tr>
                  <td class="font-weight-bold text-left custom-border-right" style="color: #00CFE8 !important;">
                    <a href="#" onclick="teacherMonthAttendense({{$teacher->id}},'{{$month}}')">
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
        function teacherMonthAttendense(teacherId, monthName) {

            var url = "{{ route('teacher-report.daysAttendanceWithMonth') }}";
            if(teacherId != ''){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        teacherId: teacherId,
                        monthName: monthName
                    },
                    success: function (data) {
                        $("#teacherAttendanceReport").html(data);
                    }
                });
            }
        }
</script>

@endsection