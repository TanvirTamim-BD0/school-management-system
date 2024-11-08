@extends('backend.master')
@section('content')
@section('title') Group @endsection
@section('group') active @endsection
@section('group.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Group List</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Group</a>
            </li>
            <li class="breadcrumb-item active">Group List
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Group Record List</h2>
        <div class="float-right justify-content-end">
          @if(Auth::user()->can('group-create'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('group.create')}}">
            <i class="material-icons dp48">add_circle_outline</i> Add Group
          </a>
          @endif
        </div>
      </div>

      <div class="card-content-datatable table-responsive">
        <table id="groupTable"
          class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">

          <thead>
            <tr>
              <th class="custom-border-right">SL</th>
              <th class="custom-border-right">Name</th>
              <th class="custom-border-right">Action</th>
            </tr>
          </thead>

          <tbody>

            @foreach($groups as $group)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{$group->group_name}}</td>

              <td class=" text-center">
                <!-- Dropdown Trigger -->
                <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$group->id}}'>
                  <i class="material-icons float-right">more_vert</i>
                </a>
                <!-- Dropdown Structure -->
                <ul id='dropdown1{{$group->id}}' class='dropdown-content custom-dropdown-for-action'>

                  @if(Auth::user()->can('group-edit'))
                  <li>
                    <a href="{{ route('group.edit',$group->id) }}"><i class="material-icons">edit</i>Edit</a>
                  </li>
                  @endif


                  @if(Auth::user()->can('group-delete'))
                  <li>
                    <a href="{{ route('group.destroy', $group->id) }}" onclick="event.preventDefault();
                          document.getElementById('delete-form').submit();"><i
                        class="material-icons">delete</i>Delete</a>
                  </li>
                  @endif

                </ul>

                <form id="delete-form" action="{{ route('group.destroy', $group->id) }}" method="POST"
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
      $('#groupTable').DataTable({
        "responsive": false,
        "searching": true,
        "scrollX": false,
      });
    });
</script>
@endsection