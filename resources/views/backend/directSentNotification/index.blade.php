@extends('backend.master')
@section('content')
@section('title') Push Notification @endsection
@section('push-notification-direct') active @endsection
@section('push-notification-direct') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Push Notification Direct</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Push Notifications</a>
            </li>
            <li class="breadcrumb-item active">Push Notification
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Push Notification Record List</h2>
        <div class="float-right justify-content-end">
          @if(Auth::user()->can('class-create'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('push-notification-direct-create')}}">
            <i class="material-icons dp48">add_circle_outline</i> Add Notification
          </a>
          @endif
        </div>
      </div>

      <div class="card-content-datatable table-responsive">
        <table id="classTable"
          class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">

          <thead>
            <tr>
              <th class="custom-border-right">SL</th>
              <th class="custom-border-right">Title</th>
              <th class="custom-border-right">Message</th>
              <th class="custom-border-right">Status</th>
              <th class="custom-border-right">Action</th>
            </tr>
          </thead>

          <tbody>

            @foreach($data as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{$item->notification_title}}</td>
              <td>{{$item->notification_message}}</td>

              <td class=" text-left">
                @if($item->status == true)
                <span class="badge gradient-45deg-purple-deep-orange gradient-shadow">Send</span>
                @else
                <span class="badge gradient-45deg-purple-deep-orange gradient-shadow">Pending</span>
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
                    @if(Auth::user()->can('class-edit'))
                    <a href="{{ url('push-notification-direct-delete/'.$item->id) }}"><i
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
      $('#classTable').DataTable({
        "responsive": false,
        "searching": true,
        "scrollX": false,
      });
    });
</script>
@endsection