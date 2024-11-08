@extends('backend.master')
@section('content')
@section('title') Addmission Report @endsection
@section('report-of-addmission') Addmission Report @endsection
@section('report-of-addmission') active @endsection
@section('styles')
@endsection
@section('content')

   <div class="row">

    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>Addmission Report</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Addmission Report</a>
                  </li>
                  <li class="breadcrumb-item active">Addmission Report
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>


    <style>
    @media print{

      body{
        visibility: hidden;
      }

      body * {
        visibility: hidden;
      }

      .brand-sidebar{
        display: none;
      }

      .brand-sidebar * {
        display: none;
      }

      .print-conatiner , .print-conatiner *{
        visibility: visible;
      }

    }
  </style>

 
      <div class="float-right ">
        <form class="col s12" method="post" action="{{route('report-of-addmission-invoice')}}" enctype="multipart/form-data">
        @csrf
          <input type="hidden" name="class_id" value="{{ $classId }}">
          <button class="btn btn-primary" style="margin-right: 20px;">Print</button>
       </form>
      </div>


  <div class="print-conatiner">


    <div class="col s12">
      <div class="card">


        <div class="card-content custom-card-content custom-card-content-for-datatable">
          <h2 class="card-title">Addmission Report</h2>
          <div class="float-right justify-content-end">

            
          </div>
        </div>
        
        
          <div class="card-content-datatable table-responsive">
            <table id="" class="display custom-table custom-table-border dt-responsive nowrap table-responsive">

                <thead>
                  <tr>
                    <th class="custom-border-right">SL</th>
                    <th class="custom-border-right">Class</th>
                    <th class="custom-border-right">Admission Name</th>
                    <th class="custom-border-right">Fees</th>
                  </tr>
                </thead>

                <tbody>

                  @foreach($admissions as $admission)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$admission->classData->class_name}}</td>
                    <td>{{$admission->admission_name}}</td>
                    <td>{{$admission->fees}} tk</td>

                  </tr>
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
      $('#sectionTable').DataTable({
        "responsive": false,
        "searching": true,
        "scrollX": false,
      });
    });
  </script>
@endsection

                                                                    
