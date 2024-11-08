@extends('backend.master')
@section('content')
@section('title') Event @endsection
@section('event') active @endsection
@section('event.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Event List</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Event</a>
            </li>
            <li class="breadcrumb-item active">Event List
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Event Record List</h2>
        <div class="float-right justify-content-end">
          @if(Auth::user()->can('event-create'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('event.create')}}">
            <i class="material-icons dp48">add_circle_outline</i>
            <span>
              Add Event
            </span>
          </a>
          @endif
        </div>
      </div>

      <div class="card-content-datatable">
        <div class="table-responsive custom-table-modify">
          <table id="myTable" class="table table-bordered custom-table-border">
            <thead>
            <tr>
              <th class="custom-border-right custom-sl-no">SL</th>
              <th class="custom-border-right">Title</th>
              <th class="custom-border-right">Description</th>
              <th class="custom-border-right">Date</th>
              <th class="custom-border-right">File</th>
              <th class="custom-border-right custom-action-border-right">Action</th>
            </tr>
          </thead>

          <tbody>

            @foreach($eventData as $item)
            @if(isset($item) && $item != null)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{$item->title}}</td>
              <td>{!!  Str::limit($item->description, 250) !!}</td>

              <td>
                Start Date: {{Carbon\Carbon::createFromFormat('Y-m-d', $item->start_date)->format('d-m-Y')}} <br>
                End Date: {{Carbon\Carbon::createFromFormat('Y-m-d', $item->end_date)->format('d-m-Y')}}
              </td>

              <td>
                <a href="{{route('event-file-download', $item->id)}}">
                  {{$item->event_file}}
                </a>
              </td>
              <td class=" text-center">
                <!-- Dropdown Trigger -->
                <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$item->id}}'>
                  <i class="material-icons float-right">more_vert</i>
                </a>
                <!-- Dropdown Structure -->
                <ul id='dropdown1{{$item->id}}' class='dropdown-content custom-dropdown-for-action'>
                  <li>
                    @if(Auth::user()->can('event-edit'))
                    <a href="{{ route('event.edit',$item->id) }}"><i class="material-icons">edit</i>Edit</a>
                    @endif
                  </li>
                  <li>
                    @if(Auth::user()->can('event-delete'))
                    <form id="delete-form" action="{{ route('event.destroy', $item->id) }}" method="POST"
                      style="display: inline;" class="custom-delete-form">
                      @csrf
                      @method('delete')

                      <button type="submit" class="btn custom-delete-button">
                        <i class="material-icons">delete</i>
                        <span>Delete</span>
                      </button>
                    </form>
                    @endif
                  </li>
                </ul>
              </td>
            </tr>
            @endif
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
      $('#classTable').DataTable({
        "responsive": false,
        "searching": true,
        "scrollX": false,
      });
    });
</script>
@endsection