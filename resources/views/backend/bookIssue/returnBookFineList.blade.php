@extends('backend.master')
@section('content')
@section('title') Return Date Expire Fine List @endsection
@section('return-date-expire-fine-list') Return Date Expire Fine List @endsection
@section('return-date-expire-fine-list') active @endsection
@section('styles')
@endsection
@section('content')

	 <div class="row">

	 	<div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span> Date Expire Fine List</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active"> Date Expire Fine List
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>

    <div class="col s12">
      <div class="card">
        
        <div class="card-content custom-card-content custom-card-content-for-datatable">
          <h2 class="card-title">Return Fine Record List</h2>
         
        </div>

          <div class="card-content-datatable table-responsive">
            <table id="sectionTable" class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">

                <thead>
                  <tr>
                    <th class="custom-border-right">SL</th>
                    <th class="custom-border-right">Student</th>
                    <th class="custom-border-right">Book</th>
                    <th class="custom-border-right">Fine Amount</th>
                    <th class="custom-border-right">Action</th>
                  </tr>
                </thead>

                <tbody>

                  @foreach($fineList as $fine)
                  <tr>
                  	<td>{{ $loop->iteration }}</td>
                    <td>{{$fine->studentData->student_name}}</td>
                    <td>{{$fine->LibraryBookData->subject_name}}</td>
                    <td>{{$fine->fine_amount}}</td>

                    <td class=" text-center">
                      <!-- Dropdown Trigger -->
                      <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$fine->id}}'>
                        <i class="material-icons float-right">more_vert</i>
                      </a>
                      <!-- Dropdown Structure -->
                      <ul id='dropdown1{{$fine->id}}' class='dropdown-content custom-dropdown-for-action'>
                         <li>
                            <a href="{{route('fine-amount-invoice',$fine->id)}}"><i class="material-icons">print</i>Invoice</a>
                          </li>
                      </ul>
                    </td>

                  </tr>
                  @endforeach

                </tbody>

              </table>
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

                                                                    
