@extends('backend.master')
@section('content')
@section('title') Class Routine Report @endsection
@section('report-of-class-routine') active @endsection
@section('report-of-class-routine') active @endsection
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
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Class Routine Report</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Class Routine Report
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="float-right ">
        <form class="col s12" method="post" action="{{route('report-of-routine-invoice')}}" enctype="multipart/form-data">
        @csrf
          <input type="hidden" name="class_id" value="{{ $singleClassData->id }}">
          <input type="hidden" name="section_id" value="{{ $singleSectionData->id }} ">
          <button class="btn btn-primary" style="margin-right: 20px;">Print</button>
       </form>
      </div>

  <div class="print-conatiner">

    <div class="col s12">
      <div class="card">

        <div class="card-content custom-card-content custom-table-filtering-header custom-attendance-academic-header">
          <div class="custom-class-section">
            <div class="float-left justify-content-end">
              <h5>Class: <span class="custom-text-gray">{{ $singleClassData->class_name }}</span></h5>
              <h5>Section: <span class="custom-text-gray">{{ $singleSectionData->section_name }}</span></h5>
            </div>
          </div>

        </div>

      </div>

      <div class="card">

        <div class="card-content-datatable table-responsive">
          <table id="" class="display custom-table custom-table-border dt-responsive nowrap table-responsive">

            <tbody>
              <tr>
                <td class="custom-border-right">Saturday</td>

                @foreach($saturdayData as $saturday)
                <td class="custom-border-right">
                  {{ $saturday->starting_time }} - {{ $saturday->ending_time }}
                  <br>{{ $saturday->sectionData->section_name }}<br>{{ $saturday->classData->class_name }}<br>{{ $saturday->roomData->room_no }}<br>{{ $saturday->teacherData->teacher_name }}

                </td>
                @endforeach


              </tr>


              <tr>
                <td class="custom-border-right">Sunday</td>

                @foreach($sundayData as $sunday)
                <td class="custom-border-right">
                  {{ $sunday->starting_time }} - {{ $sunday->ending_time }}
                  <br>{{ $sunday->sectionData->section_name }}<br>{{ $sunday->classData->class_name }}<br>{{ $sunday->roomData->room_no }}<br>{{ $sunday->teacherData->teacher_name }}

                </td>
                @endforeach

              </tr>


              <tr>
                <td class="custom-border-right">Monday</td>

                @foreach($mondayData as $monday)
                <td class="custom-border-right">
                  {{ $monday->starting_time }} - {{ $monday->ending_time }}
                  <br>{{ $monday->sectionData->section_name }}<br>{{ $monday->classData->class_name }}<br>{{ $monday->roomData->room_no }}<br>{{ $monday->teacherData->teacher_name }}

                </td>
                @endforeach

              </tr>



              <tr>
                <td class="custom-border-right">Tuesday</td>

                @foreach($tuesdayData as $tuesday)
                <td class="custom-border-right">
                  {{ $tuesday->starting_time }} - {{ $tuesday->ending_time }}
                  <br>{{ $tuesday->sectionData->section_name }}<br>{{ $tuesday->classData->class_name }}<br>{{ $tuesday->roomData->room_no }}<br>{{ $tuesday->teacherData->teacher_name }}

                </td>
                @endforeach

              </tr>



              <tr>
                <td class="custom-border-right">Wednesday</td>

                @foreach($wednesdayData as $wednesday)
                <td class="custom-border-right">
                  {{ $wednesday->starting_time }} - {{ $wednesday->ending_time }}
                  <br>{{ $wednesday->sectionData->section_name }}<br>{{ $wednesday->classData->class_name }}<br>{{ $wednesday->roomData->room_no }}<br>{{ $wednesday->teacherData->teacher_name }}

                </td>
                @endforeach

              </tr>



              <tr>
                <td class="custom-border-right">Thursday</td>

                @foreach($thursdayData as $thursday)
                <td class="custom-border-right">
                  {{ $thursday->starting_time }} - {{ $thursday->ending_time }}
                  <br>{{ $thursday->sectionData->section_name }}<br>{{ $thursday->classData->class_name }}<br>{{ $thursday->roomData->room_no }}<br>{{ $thursday->teacherData->teacher_name }}

                </td>
                @endforeach

              </tr>


            </tbody>

          </table>

        </div>

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