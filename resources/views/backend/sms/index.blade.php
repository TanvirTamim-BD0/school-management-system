@extends('backend.master')
@section('content')
@section('title') SMS @endsection
@section('sms') active @endsection
@section('sms.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>SMS List</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">SMS</a>
            </li>
            <li class="breadcrumb-item active">SMS List
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">SMS Record List</h2>
        <div class="float-right justify-content-end">
          @if(Auth::user()->can('sms-list'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('sms.create')}}">
            <i class="material-icons dp48">add_circle_outline</i> Send SMS
          </a>
          @endif
        </div>
      </div>

      <div class="card-content-datatable">
        <div class="table-responsive custom-table-modify">
          <table id="myTable" class="table table-bordered custom-table-border">
            <thead>
            <tr>
              <th class="custom-border-right">SL</th>
              <th class="custom-border-right">User</th>
              <th class="custom-border-right">Message</th>
              <th class="custom-border-right">Status</th>
              <th class="custom-border-right custom-action-border-right">Action</th>
            </tr>
          </thead>

          <tbody>

            @foreach($notificationData as $notification)
            <tr>
              <td>{{ $loop->iteration }}</td>

              <td>
                {{ $notification->userData->name }}
              </td>

              <td>{{$notification->title}}</td>

              <td class=" text-left">
                @if($notification->status == true)
                <span class="badge gradient-45deg-light-blue-cyan gradient-shadow">Done</span>
                @else
                <span class="badge gradient-45deg-amber-amber gradient-shadow">Pending</span>
                @endif
              </td>

              <td class=" text-center">
                <!-- Dropdown Trigger -->
                <a class='dropdown-trigger btn custom-dropdown-btn' href='#'
                  data-target='dropdown1{{$notification->id}}'>
                  <i class="material-icons float-right">more_vert</i>
                </a>
                <!-- Dropdown Structure -->
                <ul id='dropdown1{{$notification->id}}' class='dropdown-content custom-dropdown-for-action'>
                  <li>
                    <a href="{{ route('sms.destroy', $notification->id) }}" onclick="event.preventDefault();
                          document.getElementById('delete-form').submit();"><i
                        class="material-icons">delete</i>Delete</a>
                  </li>
                </ul>

                <form id="delete-form" action="{{ route('sms.destroy', $notification->id) }}" method="POST"
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
@endsection