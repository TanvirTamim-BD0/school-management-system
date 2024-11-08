@extends('backend.master')
@section('content')
@section('title') Admission Form @endsection
@section('form-of-admissions.index') active @endsection
@section('form-of-admissions.index') active @endsection
@section('styles')
@endsection
@section('content')

	 <div class="row">

	 	<div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>Admission Form List</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Admission Form</a>
                  </li>
                  <li class="breadcrumb-item active">Admission Form List
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>

    <div class="col s12">
      <div class="card">

          <div class="card-content-datatable table-responsive">
            <table id="sectionTable" class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">

                <thead>
                  <tr>
                    <th class="custom-border-right">SL</th>
                    <th class="custom-border-right">Photo</th>
                    <th class="custom-border-right">Student Details</th>
                    <th class="custom-border-right">Academic</th>
                    <th class="custom-border-right">Status</th>
                    <th class="custom-border-right">Action</th>
                  </tr>
                </thead>

                <tbody>

                  @foreach($admissionForms as $admissionForm)
                  <tr>
                  	<td>{{ $loop->iteration }}</td>
                    
                    <td>
                      @if(isset($admissionForm->student_photo) && $admissionForm->student_photo != null)
                      <img src="{{ asset('/uploads/student_photo/'.$admissionForm->student_photo) }}" width="75" height="65">
                      @else
                        @if($admissionForm->gender == 'male')
                          <img src="{{ asset('backend/app-assets/images/user/12.jpg') }}" width="75" height="65">
                        @else
                          <img src="{{ asset('backend/app-assets/images/user/1.jpg') }}" width="75" height="65">
                        @endif
                      @endif
                    </td>
                    <td>
                      Name : {{$admissionForm->student_name}} <br>
                      Phone : {{$admissionForm->student_phone}} <br>
                      Email : {{$admissionForm->student_email}} <br>
                      address : {{$admissionForm->address}} <br>
                    </td>

                    <td>
                      Class : {{$admissionForm->classData->class_name}} <br>
                      @if($admissionForm->section_id) Section : {{$admissionForm->sectionData->section_name}} @else  @endif <br>
                      @if($admissionForm->group_id) Group : {{$admissionForm->groupData->group_name}} @else  @endif <br>
                    </td>



                    <td>
                      @if($admissionForm->status == 1)
                        <span style="color: green;">Approved</span>
                      @else
                        <span style="color: red;">InActive</span>
                      @endif
                    </td>

                    <td class=" text-center">
                      <!-- Dropdown Trigger -->
                      <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$admissionForm->id}}'>
                        <i class="material-icons float-right">more_vert</i>
                      </a>
                      <!-- Dropdown Structure -->
                      <ul id='dropdown1{{$admissionForm->id}}' class='dropdown-content custom-dropdown-for-action'>

                        @if($admissionForm->status == 0)
                        <li>
                          <a href="{{ route('approve.student',$admissionForm->id) }}"><i class="material-icons">arrow_upward</i>Approved</a>
                        </li>
                        @else
                        @endif

                        <li>
                          <a href="{{ route('form-of-admissions.destroy', $admissionForm->id) }}" onclick="event.preventDefault();
                          document.getElementById('delete-form').submit();"><i
                          class="material-icons">delete</i>Delete</a>
                        </li>
                      </ul>

                      <form id="delete-form" action="{{ route('form-of-admissions.destroy', $admissionForm->id) }}" method="POST" style="display: none;">
                          @csrf
                          @method('delete')
                      </form>
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
                                                                    
