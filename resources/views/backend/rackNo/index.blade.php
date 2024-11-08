@extends('backend.master')
@section('content')
@section('title') Rack No @endsection
@section('rackNo') active @endsection
@section('rackNo.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Rack No List</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Rack No</a>
            </li>
            <li class="breadcrumb-item active">Rack No List
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

        <div class="card-content custom-card-content custom-card-content-for-datatable">
          <h2 class="card-title">Rack No Record List</h2>
          <div class="float-right justify-content-end">
            @if(Auth::user()->can('library-rack-create'))
            <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button" href="{{route('rackNo.create')}}">
              <i class="material-icons dp48">add_circle_outline</i>Add Rack No
            </a>
            @endif
          </div>
        </div>

            <div class="card-content-datatable table-responsive">
            <table id="classTable" class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">

              <thead>
                <tr>
                  <th class="custom-border-right">SL</th>
                  <th class="custom-border-right">Rack No</th>
                  <th class="custom-border-right">Action</th>
                </tr>
              </thead>

              <tbody>

                @foreach($rackNoData as $rackNo)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{$rackNo->rack_no}}</td>
                  <td class=" text-center">
                    <!-- Dropdown Trigger -->
                    <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$rackNo->id}}'>
                      <i class="material-icons float-right">more_vert</i>
                    </a>
                    <!-- Dropdown Structure -->
                    <ul id='dropdown1{{$rackNo->id}}' class='dropdown-content custom-dropdown-for-action'>
                      <li>
                        @if(Auth::user()->can('library-rack-edit'))
                        <a href="{{ route('rackNo.edit',$rackNo->id) }}"><i class="material-icons">edit</i>Edit</a>
                        @endif
                      </li>
                      <li>
                        @if(Auth::user()->can('library-rack-delete'))
                        <form id="delete-form" action="{{ route('rackNo.destroy', $rackNo->id) }}" method="POST"
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