@extends('backend.master')
@section('content')
@section('title') Guardian @endsection
@section('guardian') active @endsection
@section('guardian.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Guardian List</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Guardian</a>
            </li>
            <li class="breadcrumb-item active">Guardian List
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Guardian Record List</h2>
        <div class="float-right justify-content-end">
          {{-- @if(Auth::user()->can('guardian-create'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('guardian.create')}}">
            <i class="material-icons dp48">add_circle_outline</i> Add Guardian
          </a>
          @endif --}}
        </div>
      </div>

      <div class="card-content-datatable table-responsive">
        <table id="sectionTable"
          class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">

          <thead>
            <tr>
              <th class="custom-border-right">SL</th>
              <th class="custom-border-right">Photo</th>
              <th class="custom-border-right">Guardian Details</th>
              <th class="custom-border-right">Student Details</th>
              {{-- <th class="custom-border-right">Action</th> --}}
            </tr>
          </thead>

          <tbody>

            @foreach($guardians as $guardian)
            <tr>
              <td>{{ $loop->iteration }}</td>

              <td>
                @if(isset($guardian->photo) && $guardian->photo != null)
                <img src="{{ asset('/uploads/guardian_photo/'.$guardian->photo) }}" width="75" height="65">
                @else
                <img src="{{ asset('backend/app-assets/images/user/male.png') }}" width="75" height="65">
                @endif
              </td>

              <td>
                Name : {{$guardian->guardian_name}} <br>
                Phone : {{$guardian->phone}} <br>
                Email : {{$guardian->email}} <br>
                address : {{$guardian->address}} <br>
              </td>

              <td>
                Name : {{$guardian->studentData->student_name}} <br>
                Class : {{$guardian->classData->class_name}} <br>
                @if($guardian->section_id) Section : {{$guardian->sectionData->section_name}} @else @endif <br>
                @if($guardian->studentData->group_id) Group : {{$guardian->studentData->groupData->group_name}} @else
                @endif <br>
                Roll No : {{$guardian->studentData->roll_no}} <br>
                Registration No : {{$guardian->studentData->registration_no}} <br>
              </td>

              {{-- <td class=" text-center">
                <!-- Dropdown Trigger -->
                <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$guardian->id}}'>
                  <i class="material-icons float-right">more_vert</i>
                </a>
                <!-- Dropdown Structure -->
                <ul id='dropdown1{{$guardian->id}}' class='dropdown-content custom-dropdown-for-action'>

                  @if(Auth::user()->can('guardian-edit'))
                  <li>
                    <a href="{{ route('guardian.edit',$guardian->id) }}"><i class="material-icons">edit</i>Edit</a>
                  </li>
                  @endif

                  @if(Auth::user()->can('guardian-delete'))
                  <li>
                    <a href="{{ route('guardian.destroy', $guardian->id) }}" onclick="event.preventDefault();
                          document.getElementById('delete-form').submit();"><i
                        class="material-icons">delete</i>Delete</a>
                  </li>
                  @endif

                </ul>

                <form id="delete-form" action="{{ route('guardian.destroy', $guardian->id) }}" method="POST"
                  style="display: none;">
                  @csrf
                  @method('delete')
                </form>
              </td> --}}


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