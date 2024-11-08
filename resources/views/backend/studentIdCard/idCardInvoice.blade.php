@extends('backend.master')
@section('content')
@section('title') Id Card Invoice @endsection
@section('make-payment') active @endsection
@section('make-payment-for-teacher') active @endsection
@section('styles')
<style>
  .card {
    max-width: 27%;
    margin: auto;
  }

  .details p {
    font-size: 17px;
  }

  .header .name h6 {
    font-weight: bold;
    font-size: 19px;
  }

  .header .address h6 {
    font-weight: bold;
    font-size: 17px;
  }

  .border {
    border: 1px solid black;
  }

  .button-print {
    margin-right: 20px;
    margin-top: -80px;
  }

  .print-conatiner,
  .print-conatiner * {
    visibility: visible;
  }

  .custom-id-card {
    margin-top: 120px;
  }

  @media print {

    .custom-page-header {
    display: none;
    }
    
    .page-footer {
    display: none;
    }
    
    .sidenav-main {
    display: none;
    }

    .card {
      max-width: 34%;
      margin: auto;
      border: 1px solid rgba(0, 0, 0, 0.103);
    }

    .custom-id-card .card-content{
      box-shadow: 2px 2px 2px 2px transparent !important;
      border-radius: 0 0 2px 2px !important;
      padding: 24px !important;
    }
  }

</style>
@endsection

@section('content')

<div class="breadcrumbs-dark pb-0 pt-4 mb-4" id="breadcrumbs-wrapper">
  <!-- Search for small screen-->
  <div class="container">
    <div class="row">
      <div class="col s10 m6 l6">
        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Student Id Card Generate</span></h5>
        <ol class="breadcrumbs mb-0">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
          </li>
          <li class="breadcrumb-item active">Student Id Card Generate
          </li>
        </ol>
      </div>
    </div>
  </div>
</div>


<div class="print-conatiner">
  <div class="card mb-2 custom-id-card">

      <div class="card-content">
        <div class="header text-center mb-2">
          <div class="logo">
            @if(isset($invoiceData['school_logo']) && $invoiceData['school_logo'] != null)
            <img src="{{ asset('/uploads/logo_image/'.$invoiceData['school_logo']) }}" alt="logo" height="25"
              width="174">
            @else
            <img src="{{ asset('uploads/logo_image/default/logo.png') }}" alt="logo" height="25" width="174">
            @endif
          </div>

          <div class="name">
            <h6>{{$invoiceData['name']}}</h6>
          </div>

          <div class="address">
            <p>{{$invoiceData['address']}}</p>
          </div>

          <div class="address">
            <h6>Student Identy Card</h6>
          </div>

        </div>

        <div class="content text-center">

          <div class="image">
            @if(isset($studentData->student_photo) && $studentData->student_photo != null)
            <img src="{{ asset('/uploads/student_photo/'.$studentData->student_photo) }}" width="85" height="95">
            @else
            @if($student->gender == 'male')
            <img src="{{ asset('backend/app-assets/images/user/male.png') }}" width="95" height="85">
            @else
            <img src="{{ asset('backend/app-assets/images/user/female.png') }}" width="75" height="65">
            @endif
            @endif
          </div>

          <div class="details">
            <p><b>Name :</b> {{$studentData->student_name}}</p>
            <p><b>Class :</b> {{$studentData->classData->class_name}}</p>
            <p><b>Section :</b> {{$studentData->sectionData->section_name}}</p>
            <p><b>Roll :</b> {{$studentData->roll_no}}</p>
            <p><b>Gender :</b> {{$studentData->gender}}</p>
            <p><b>Blood :</b> {{$studentData->blood_group}}</p>
          </div>

        </div>

      </div>
      
  </div>
</div>

@endsection
@section('scripts')
<script>
  $( document ).ready(function() {
        $(function () {
            'use strict';
            window.print();
        });
    });
</script>
@endsection