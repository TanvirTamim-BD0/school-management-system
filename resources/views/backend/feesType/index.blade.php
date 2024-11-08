@extends('backend.master')
@section('content')
@section('title') Fees Type @endsection
@section('fees-type') active @endsection
@section('fees-type.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Fees Type List</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Fees Type</a>
            </li>
            <li class="breadcrumb-item active">Fees Type List
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Fees Type Record List</h2>
        <div class="float-right justify-content-end">
          @if(Auth::user()->can('fees-type-create'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('fees-type.create')}}">
            <i class="material-icons dp48">add_circle_outline</i>
            <span>
              Add Fees Type
            </span>
          </a>
          @endif
        </div>
      </div>

      <div class="card-content-datatable table-responsive">
        <table id="feesTypeTable"
          class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">

          <thead>
            <tr>
              <th class="custom-border-right custom-sl-no">SL</th>
              <th class="custom-border-right">Fees Type</th>
              <th class="custom-border-right">Action</th>
            </tr>
          </thead>

          <tbody>

            @foreach($feesTypeData as $item)
            @if(isset($item) && $item != null)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{$item->fees_type}}</td>

              <td class=" text-center">
                <!-- Dropdown Trigger -->
                <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1'>
                  <i class="material-icons float-right">more_vert</i>
                </a>
                <!-- Dropdown Structure -->
                <ul id='dropdown1' class='dropdown-content custom-dropdown-for-action'>
                  <li>
                    @if(Auth::user()->can('fees-type-edit'))
                    <a href="{{ route('fees-type.edit',$item->id) }}"><i class="material-icons">edit</i>Edit</a>
                    @endif
                  </li>
                  <li>
                    @if(Auth::user()->can('fees-type-delete'))
                    <form id="delete-form" action="{{ route('fees-type.destroy', $item->id) }}" method="POST"
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
      $('#feesTypeTable').DataTable({
        "responsive": false,
        "searching": true,
        "scrollX": false,
      });
    });
</script>
@endsection