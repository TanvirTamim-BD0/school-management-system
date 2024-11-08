@extends('backend.master')
@section('content')
@section('title') Teacher @endsection
@section('teacher') active @endsection
@section('teacher.index') active @endsection
@section('styles')
@endsection
@section('content')

	 <div class="row">

	 	<div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>Teacher List</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Teacher</a>
                  </li>
                  <li class="breadcrumb-item active">Teacher List
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>

    <div class="col s12">
      <div class="card">

        <div class="card-content custom-card-content custom-card-content-for-datatable">
          <h2 class="card-title">Teacher Record List</h2>
          <div class="float-right justify-content-end">
            @if(Auth::user()->can('teacher-create'))
            <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button" href="{{route('teacher.create')}}">
             <i class="material-icons dp48">add_circle_outline</i> Add Teacher
            </a>
            @endif
          </div>
        </div>

          <div class="card-content-datatable table-responsive">
            <table id="sectionTable" class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">

                <thead>
                  <tr>
                    <th class="custom-border-right">SL</th>
                    <th class="custom-border-right">Photo</th>
                    <th class="custom-border-right">Teacher Details</th>
                    <th class="custom-border-right">Academic</th>
                    <th class="custom-border-right">Action</th>
                  </tr>
                </thead>

                <tbody>

                  @foreach($teachers as $teacher)
                  <tr>
                  	<td>{{ $loop->iteration }}</td>
                    <td>

                      @if(isset($teacher->teacher_photo) && $teacher->teacher_photo != null)
                      <img src="{{ asset('/uploads/teacher_photo/'.$teacher->teacher_photo) }}" width="75" height="65">
                      @else
                        @if($teacher->gender == 'male')
                          <img src="{{ asset('backend/app-assets/images/user/male.png') }}" width="75" height="65">
                        @else
                          <img src="{{ asset('backend/app-assets/images/user/female.png') }}" width="75" height="65">
                        @endif
                      @endif
                    </td>
                    
                    <td>
                      Name : {{$teacher->teacher_name}} <br>
                      Phone : {{$teacher->teacher_phone}} <br>
                      address : {{$teacher->address}} <br>
                    </td>

                    <td>
                      Category : {{$teacher->teacher_category}} <br>
                      Joining Date : {{Carbon\Carbon::createFromFormat('Y-m-d', $teacher->joining_date)->format('d-m-Y')}} <br>
                      Designation : {{$teacher->designation}} <br>
                    </td>

                    <td class=" text-center">
                      <!-- Dropdown Trigger -->
                      <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$teacher->id}}'>
                        <i class="material-icons float-right">more_vert</i>
                      </a>
                      <!-- Dropdown Structure -->
                      <ul id='dropdown1{{$teacher->id}}' class='dropdown-content custom-dropdown-for-action'>

                        <li>
                        <a href="{{ route('teacher-profile',$teacher->id) }}"><i class="material-icons">visibility</i>Teacher Profile</a>
                      </li>

                        @if(Auth::user()->can('teacher-edit'))
                        <li>
                          <a href="{{ route('teacher.edit',$teacher->id) }}"><i class="material-icons">edit</i>Edit</a>
                        </li>
                        @endif

                        @if(Auth::user()->can('teacher-delete'))
                        <li>
                          <a href="{{ route('teacher.destroy', $teacher->id) }}" onclick="event.preventDefault();
                          document.getElementById('delete-form').submit();"><i
                          class="material-icons">delete</i>Delete</a>
                        </li>
                        @endif

                      </ul>

                      <form id="delete-form" action="{{ route('teacher.destroy', $teacher->id) }}" method="POST" style="display: none;">
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
                                                                    
