@extends('backend.master')
@section('content')
@section('title') Section @endsection
@section('section') active @endsection
@section('section.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Section List</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Section</a>
            </li>
            <li class="breadcrumb-item active">Section List
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Section Record List</h2>
        <div class="float-right justify-content-end">
          @if(Auth::user()->can('section-create'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('section.create')}}">
            <i class="material-icons dp48">add_circle_outline</i> Add Section
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
              <th class="custom-border-right">Name</th>
              <th class="custom-border-right">Class</th>
              <th class="custom-border-right">Action</th>
            </tr>
          </thead>

          <tbody>

            @foreach($sections as $section)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{$section->section_name}}</td>
              <td>{{$section->classData->class_name}}</td>

              <td class=" text-center">
                <!-- Dropdown Trigger -->
                <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$section->id}}'>
                  <i class="material-icons float-right">more_vert</i>
                </a>
                <!-- Dropdown Structure -->
                <ul id='dropdown1{{$section->id}}' class='dropdown-content custom-dropdown-for-action'>

                  @if(Auth::user()->can('section-edit'))
                  <li>
                    <a href="{{ route('section.edit',$section->id) }}"><i class="material-icons">edit</i>Edit</a>
                  </li>
                  @endif

                  @if(Auth::user()->can('section-delete'))
                  <li>
                    <a href="{{ route('section.destroy', $section->id) }}" onclick="event.preventDefault();
                          document.getElementById('delete-form').submit();"><i
                        class="material-icons">delete</i>Delete</a>
                  </li>
                  @endif

                </ul>

                <form id="delete-form" action="{{ route('section.destroy', $section->id) }}" method="POST"
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