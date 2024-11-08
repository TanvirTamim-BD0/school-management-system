@extends('backend.master')
@section('content')
@section('title') Library Book Report @endsection
@section('report-of-library-book') Library Book Report @endsection
@section('report-of-library-book') active @endsection
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
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Library Book Report</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Library Book Report
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


  <div class="float-right"><a onclick="window.print();" class="btn btn-primary" style="margin-right: 20px;">Print</a>
  </div>

  <div class="print-conatiner">


    <div class="col s12">
      <div class="card">


        <div class="card-content custom-card-content custom-card-content-for-datatable">
          <h2 class="card-title">Library Book Report</h2>
          <div class="float-right justify-content-end">


          </div>
        </div>


        <div class="card-content-datatable table-responsive">
          <table id="" class="display custom-table custom-table-border dt-responsive nowrap table-responsive">

            <thead>
              <tr>
                <th class="custom-border-right">SL</th>
                <th class="custom-border-right">Subject Name</th>
                <th class="custom-border-right">Subject Code</th>
                <th class="custom-border-right">Rack No</th>
                <th class="custom-border-right">Author</th>
                <th class="custom-border-right">Quantity</th>
              </tr>
            </thead>

            <tbody>

              @foreach($libraryBooks as $libraryBook)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$libraryBook->subject_name}}</td>
                <td>{{$libraryBook->subject_code}}</td>
                <td>{{$libraryBook->RackData->rack_no}}</td>
                <td>{{$libraryBook->subject_author}}</td>
                <td>{{$libraryBook->quantity}}</td>


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