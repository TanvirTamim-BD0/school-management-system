@extends('backend.master')
@section('content')
@section('title') Contact Form List @endsection
@section('contact-form') active @endsection
@section('contact-form') active @endsection
@section('styles')
@endsection
@section('content')

	 <div class="row">

	 	<div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>Contact Form List</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Contact Form</a>
                  </li>
                  <li class="breadcrumb-item active">Contact Form List
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>

    <div class="col s12">
      <div class="card">

        <div class="card-content custom-card-content custom-card-content-for-datatable">
          <h2 class="card-title">Contact Form Record List</h2>
        </div>

          <div class="card-content-datatable table-responsive">
            <table id="sectionTable" class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">

                <thead>
                  <tr>
                    <th class="custom-border-right">SL</th>
                    <th class="custom-border-right">Name</th>
                    <th class="custom-border-right">Phone</th>
                    <th class="custom-border-right">Email</th>
                    <th class="custom-border-right">Subject</th>
                    <th class="custom-border-right">Message</th>
                    <th class="custom-border-right">Action</th>
                  </tr>
                </thead>

                <tbody>

                  @foreach($contactForm as $contact)
                  <tr>
                  	<td>{{ $loop->iteration }}</td>
                    <td>{{$contact->name}}</td>
                    <td>{{$contact->phone}}</td>
                    <td>{{$contact->email}}</td>
                    <td>{{$contact->subject}}</td>
                    <td>{{$contact->message}}</td>

                   <td class=" text-center">
                      <!-- Dropdown Trigger -->
                      <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$contact->id}}'>
                        <i class="material-icons float-right">more_vert</i>
                      </a>
                      <!-- Dropdown Structure -->
                      <ul id='dropdown1{{$contact->id}}' class='dropdown-content custom-dropdown-for-action'>

                        <li>
                          @if(Auth::user()->can('contact-form-delete'))
                          <a href="{{ route('contactForm.destroy', $contact->id) }}"><i
                          class="material-icons">delete</i>Delete</a>
                          @endif
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

                                                                    
