@extends('backend.master')
@section('content')
@section('title') Accountent @endsection
@section('accountent') active @endsection
@section('accountent.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Accountent List</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Accountent</a>
            </li>
            <li class="breadcrumb-item active">Accountent List
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Accountent Record List</h2>
        <div class="float-right justify-content-end">
          @if(Auth::user()->can('accountent-create'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('accountent.create')}}">
            <i class="material-icons dp48">add_circle_outline</i> Add Accountent
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
              <th class="custom-border-right">Photo</th>
              <th class="custom-border-right">Accountent Details</th>
              <th class="custom-border-right">Academic</th>
              <th class="custom-border-right">Action</th>
            </tr>
          </thead>

          <tbody>

            @foreach($accountentData as $key=>$item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>

                @if(isset($item->accountent_photo) && $item->accountent_photo != null)
                <img src="{{ asset('/uploads/accountent_photo/'.$item->accountent_photo) }}" width="75" height="65">
                @else
                @if($item->gender == 'male')
                <img src="{{ asset('backend/app-assets/images/user/male.png') }}" width="75" height="65">
                @else
                <img src="{{ asset('backend/app-assets/images/user/female.png') }}" width="75" height="65">
                @endif
                @endif
              </td>

              <td>
                Name : {{$item->accountent_name}} <br>
                Phone : {{$item->accountent_phone}} <br>
                Email : {{$item->accountent_email}} <br>
                address : {{$item->address}} <br>
              </td>

              <td>
                Joining Date : {{Carbon\Carbon::createFromFormat('Y-m-d', $item->joining_date)->format('d-m-Y')}}<br>
                Designation : {{$item->designation}} <br>
              </td>

              <td class=" text-center">
                <!-- Dropdown Trigger -->
                <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$item->id}}'>
                  <i class="material-icons float-right">more_vert</i>
                </a>
                <!-- Dropdown Structure -->
                <ul id='dropdown1{{$item->id}}' class='dropdown-content custom-dropdown-for-action'>

                  <li>
                    <a href="{{ route('accountent-profile',$item->id) }}"><i class="material-icons">visibility</i>Accountent
                      Profile</a>
                  </li>

                  @if(Auth::user()->can('accountent-edit'))
                  <li>
                    <a href="{{ route('accountent.edit',$item->id) }}"><i class="material-icons">edit</i>Edit</a>
                  </li>
                  @endif

                  @if(Auth::user()->can('accountent-delete'))
                  <li>
                    <a href="{{ route('accountent.destroy', $item->id) }}" onclick="event.preventDefault();
                          document.getElementById('delete-form').submit();"><i
                        class="material-icons">delete</i>Delete</a>
                  </li>
                  @endif

                </ul>

                <form id="delete-form" action="{{ route('accountent.destroy', $item->id) }}" method="POST"
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