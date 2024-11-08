@extends('backend.master')
@section('content')
@section('title') Leave Application List @endsection
@section('leave-application-list') active @endsection
@section('leave-application-list') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Leave Application List</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Leave Application</a>
            </li>
            <li class="breadcrumb-item active">Leave Application List
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Leave Application Record List</h2>
      </div>

      <div class="card-content-datatable table-responsive">
        <table id="leaveApplyTable"
          class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">

          <thead>
            <tr>
              <th class="custom-border-right custom-sl-no">SL</th>
              <th class="custom-border-right">Role</th>
              <th class="custom-border-right">leave Application To</th>
              <th class="custom-border-right">Category</th>
              <th class="custom-border-right">Start Date</th>
              <th class="custom-border-right">End Date</th>
              <th class="custom-border-right">Reason</th>
              <th class="custom-border-right">File</th>
              <th class="custom-border-right">Status</th>
              <th class="custom-border-right">Action</th>
            </tr>
          </thead>

          <tbody>

            @foreach($leaveApplicationData as $item)
              @if(isset($item) && $item != null)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{Str::title($item->roleData->name)}}</td>
                  <td>{{$item->leave_application_to}}</td>
                  <td>{{$item->leaveCategoryData->leave_category}}</td>
                  <td>
                    {{Carbon\Carbon::createFromFormat('Y-m-d', $item->start_date)->format('d-m-Y')}}
                  </td>
                  <td>
                    {{Carbon\Carbon::createFromFormat('Y-m-d', $item->end_date)->format('d-m-Y')}}
                  </td>
                  <td>{{$item->reason}}</td>

                  <td>
                      {{$item->attachment_file}}
                  </td>

                  <td>
                      @if($item->status == true)
                      <span style="color: green;">Approved</span>
                      @else
                      <span style="color: red;">Declined</span>
                      @endif
                  </td>

                  <td class=" text-center">
                    <!-- Dropdown Trigger -->
                    <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$item->id}}'>
                      <i class="material-icons float-right">more_vert</i>
                    </a>
                    <!-- Dropdown Structure -->
                    <ul id='dropdown1{{$item->id}}' class='dropdown-content custom-dropdown-for-action'>

                      <li>
                      	@if($item->status == true)
                        <a href="{{ route('leave-application-declined',$item->id) }}"><i class="material-icons">arrow_downward</i>Declined</a>
                        @else
                        <a href="{{ route('leave-application-approve',$item->id) }}"><i class="material-icons">arrow_upward</i>Approve</a>
                        @endif
                      </li> 

                      <li>
                        @if(Auth::user()->can('leave-apply-delete'))
                        <form id="delete-form" action="{{ route('leave-apply.destroy', $item->id) }}" method="POST"
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
      $('#leaveApplyTable').DataTable({
        "responsive": false,
        "searching": true,
        "scrollX": false,
      });
    });
</script>
@endsection