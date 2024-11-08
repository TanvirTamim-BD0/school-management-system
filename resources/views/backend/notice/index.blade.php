@extends('backend.master')
@section('content')
@section('title') Notice @endsection
@section('notice') active @endsection
@section('notice.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Notice List</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Notice</a>
            </li>
            <li class="breadcrumb-item active">Notice List
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Notice Record List</h2>
        <div class="float-right justify-content-end">
          @if(Auth::user()->can('notice-create'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('notice.create')}}">
            <i class="material-icons dp48">add_circle_outline</i>
            <span>
              Add Notice
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
              <th class="custom-border-right custom-action-border-right">Action</th>
            </tr>
          </thead>

          <tbody>

            @foreach($noticeData as $item)
            @if(isset($item) && $item != null)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{$item->title}}</td>
              <td>{!!Str::limit($item->description, 250)!!}</td>
              <td class=" text-center">
                <!-- Dropdown Trigger -->
                <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$item->id}}'>
                  <i class="material-icons float-right">more_vert</i>
                </a>
                <!-- Dropdown Structure -->
                <ul id='dropdown1{{$item->id}}' class='dropdown-content custom-dropdown-for-action'>
                  <li>
                    @if(Auth::user()->can('notice-edit'))
                    <a href="{{ route('notice.edit',$item->id) }}"><i class="material-icons">edit</i>Edit</a>
                    @endif
                  </li>
                  <li>
                    @if(Auth::user()->can('notice-delete'))
                    <form id="delete-form" action="{{ route('notice.destroy', $item->id) }}" method="POST"
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