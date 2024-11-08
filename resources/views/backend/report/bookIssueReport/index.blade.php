@extends('backend.master')
@section('content')
@section('title') Book Issue Report @endsection
@section('report-of-library-book-issue') Book Issue Report @endsection
@section('report-of-library-book-issue') active @endsection
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
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Book Issue Report</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Book Issue</a>
            </li>
            <li class="breadcrumb-item active">Student Book Issue Report
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

   <div class="float-right ">
        <form class="col s12" method="post" action="{{route('report-of-library-book-issue-invoice')}}" enctype="multipart/form-data">
        @csrf
          <input type="hidden" name="startDate" value="{{$startDate}}">
          <input type="hidden" name="endDate" value="{{$endDate}}">
          <button class="btn btn-primary" style="margin-right: 20px;">Print</button>
       </form>
      </div>
      

  <div class="print-conatiner">

    <div class="col s12">

      <div class="card">

        <div class="card-content custom-card-content custom-card-content-for-datatable">
          <h2 class="card-title">Filter Book Issue Report</h2>
        </div>

        <div class="card-content-datatable table-responsive">
            <div class="row">
            <form class="col s12" method="post" action="{{route('report-of-library-book-issue')}}" enctype="multipart/form-data">
              @csrf

              <div class="input-field col s12 m6">
                  <input id="start_date" type="text" class="datepicker" name="start_date" required
                    value="{{ old('start_date') }}">
                  <label for="start_date">Start Date</label>

                  @error('start_date')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
              </div>

              <div class="input-field col s12 m6">
                  <input id="end_date" type="text" class="datepicker" name="end_date" required
                    value="{{ old('end_date') }}">
                  <label for="end_date">End Date</label>

                  @error('end_date')
                  <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                  @enderror
              </div>

               <div class="col m12  s12 custom-text-center">
                <button class="mb-1 btn waves-effect waves-light purple lightrn-1 custom-filter-button" type="submit">
                  <i class="material-icons">search</i>
                     <span>Filter</span>
                </button>
              </div>

            </form>
          </div>
        </div>
      </div>


      <div class="card">

        <div class="card-content custom-card-content custom-card-content-for-datatable">
          <h2 class="card-title">Student Book Issue Report</h2>

        </div>

        <div class="card-content-datatable table-responsive">
          <table id="" class="display custom-table custom-table-border dt-responsive nowrap table-responsive">

            <thead>
              <tr>
                <th class="custom-border-right">SL</th>
                <th class="custom-border-right">Student</th>
                <th class="custom-border-right">Book</th>
                <th class="custom-border-right">Start Date</th>
                <th class="custom-border-right">End Date</th>
                <th class="custom-border-right">Note</th>
              </tr>
            </thead>

            <tbody>

              @foreach($studentBookIssueData as $studentBookIssue)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$studentBookIssue->studentData->student_name}}</td>
                <td>{{$studentBookIssue->LibraryBookData->subject_name}}</td>
                <td>{{$studentBookIssue->start_date}}</td>
                <td>{{$studentBookIssue->end_date}}</td>
                <td>{{$studentBookIssue->note}}</td>

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