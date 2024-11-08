@extends('backend.master')
@section('content')
@section('title') Class Report @endsection
@section('report-of-class') active @endsection
@section('report-of-class') active @endsection
@section('styles')
<style>
  @media print {

    body {
      visibility: hidden;
    }

    body * {
      visibility: hidden;
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
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Class Report</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Class Report
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


  <div class="print-conatiner">

    <div class="col s12 m6">
      <div class="card">
        <div class="card-content-datatable table-responsive">
          <h6>Class Information</h6><br>
          <table id="" class="display custom-table custom-table-border dt-responsive nowrap table-responsive">


            <tbody>
              <tr>
                <th>Class: </th>
                <th>{{$sectionData->classData->class_name}}</th>
              </tr>

              <tr>
                <th>Section: </th>
                <th>{{$sectionData->section_name}}</th>
              </tr>

              <tr>
                <th>Total Student: </th>
                <th>{{$studentCount}}</th>
              </tr>

              <tr>
                <th>Total Subject: </th>
                <th>{{$totalSubject}}</th>
              </tr>


              <tr>
                <th>Fees: </th>
                <th>{{$fees->fees_amount}} tk</th>
              </tr>


            </tbody>
          </table>
        </div>
      </div>
    </div>



    <div class="col s12 m6">
      <div class="card">
        <div class="card-content-datatable table-responsive">
          <h6>Subject Teacher</h6><br>
          <table id="" class="display custom-table custom-table-border dt-responsive nowrap table-responsive">

            <thead>
              <tr>
                <th class="custom-border-right">Subject</th>
                <th class="custom-border-right">Teacher</th>
              </tr>
            </thead>

            <tbody>

              @foreach($teacherAssign as $teacher)
              <tr>
                <td>{{$teacher->subjectData->subject_name}}</td>
                <td>{{$teacher->teacherData->teacher_name}}</td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>


    <div class="float-right mb-2">
        <form class="col s12" method="post" action="{{route('report-of-class-invoice')}}" enctype="multipart/form-data">
        @csrf
          <input type="hidden" name="classId" value="{{$sectionData->classData->id}}">
          <input type="hidden" name="sectionId" value="{{$sectionData->id}}">
          <button class="btn btn-primary" style="margin-right: 20px;">Print</button>
       </form>
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