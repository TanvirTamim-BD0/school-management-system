@extends('backend.master')
@section('content')
@section('title') Admission @endsection
@section('admission') active @endsection
@section('admission.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Admission List</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Admission</a>
            </li>
            <li class="breadcrumb-item active">Admission List
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Admission Record List</h2>
        <div class="float-right justify-content-end">
          @if(Auth::user()->can('admission-create'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('admission.create')}}">
            <i class="material-icons dp48">add_circle_outline</i> Add Admission
          </a>
          @endif
        </div>
      </div>

      <div class="card-content-datatable table-responsive">
        <table id="sectionTable"
          class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">

          <thead>
            <tr>
              <th class="custom-border-right">SL</th>
              <th class="custom-border-right">Addmission Name</th>
              <th class="custom-border-right">Class</th>
              <th class="custom-border-right">Fees</th>
              <th class="custom-border-right">Available Days</th>
              <th class="custom-border-right">Action</th>
            </tr>
          </thead>

          <tbody>

            @foreach($admissions as $admission)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{$admission->admission_name}}</td>
              <td>{{$admission->classData->class_name}}</td>
              <td>{{$admission->fees}}</td>
              <td>{{$admission->available_days}} Day</td>

              <td class=" text-center">
                <!-- Dropdown Trigger -->
                <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$admission->id}}'>
                  <i class="material-icons float-right">more_vert</i>
                </a>
                <!-- Dropdown Structure -->
                <ul id='dropdown1{{$admission->id}}' class='dropdown-content custom-dropdown-for-action'>

                  @if(Auth::user()->can('admission-edit'))
                  <li>
                    <a href="{{ route('admission.edit',$admission->id) }}"><i class="material-icons">edit</i>Edit</a>
                  </li>
                  @endif


                  @if(Auth::user()->can('admission-delete'))
                  <li>
                    <a href="{{ route('admission.destroy', $admission->id) }}" onclick="event.preventDefault();
                          document.getElementById('delete-form').submit();"><i
                        class="material-icons">delete</i>Delete</a>
                  </li>
                  @endif

                </ul>

                <form id="delete-form" action="{{ route('admission.destroy', $admission->id) }}" method="POST"
                  style="display: none;">
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