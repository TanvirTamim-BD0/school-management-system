@extends('backend.master')
@section('content')
@section('title') Librarian Attendance @endsection
@section('attendace-of-librarian') active @endsection
@section('attendace-of-librarian.index') active @endsection
@section('styles')
@endsection

@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Librarian Attendance List</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Librarian Attendance</a>
            </li>
            <li class="breadcrumb-item active">Librarian Attendance List
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">

    <div class="card">

      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Librarian Record List</h2>
        <div class="float-right justify-content-end">
          @if(Auth::user()->can('attendace-of-librarian-create'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button" href="{{route('attendace-of-librarian.create')}}">
            <i class="material-icons dp48">add_circle_outline</i>
            <span>
              Add Librarian Attendace
            </span>
          </a>
          @endif
        </div>
      </div>

      <div class="card-content-datatable table-responsive custom-filter-content-datatable">
        <table id="librarianTable" class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">
          <thead>
            <tr>
              <th class="custom-border-right custom-sl-no">SL</th>
              <th class="custom-border-right custom-attendance-image-th">Photo</th>
              <th class="custom-border-right custom-attendance-details-th">Librarian Details</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          
            @foreach($librarianData as $key => $item)
              @if(isset($item) && $item != null)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td class="custom-attendance-image">
                    @if(isset($item->librarian_photo) && $item->librarian_photo != null)
                      <img src="{{ asset('/uploads/librarian_photo/'.$item->librarian_photo) }}" width="75" height="65">
                      @else
                        @if($item->gender == 'male')
                          <img src="{{ asset('backend/app-assets/images/user/male.png') }}" width="75" height="65">
                        @else
                          <img src="{{ asset('backend/app-assets/images/user/female.png') }}" width="75" height="65">
                        @endif
                      @endif
                  </td>
                  <td>
                    Name: {{$item->librarian_name}} <br>
                    Phone: {{$item->librarian_phone}}
                  </td>
              
                  <td class=" text-center">
                    <!-- Dropdown Trigger -->
                    <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$item->id}}'>
                      <i class="material-icons float-right">more_vert</i>
                    </a>
                    <!-- Dropdown Structure -->
                    <ul id='dropdown1{{$item->id}}' class='dropdown-content custom-dropdown-for-action'>
                      <li>
                        @if(Auth::user()->can('attendace-of-librarian-list'))
                        <a href="{{ route('librarian-profile',$item->id) }}"><i class="material-icons">visibility</i>Librarian Profile</a>
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
@include('backend.assignment.partial.script')

  <script>
    $(document).ready(function() {
      $('#librarianTable').DataTable({
        "responsive": false,
        "searching": true,
        "scrollX": false,
      });
    });
  </script>
@endsection