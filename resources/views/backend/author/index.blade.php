@extends('backend.master')
@section('content')
@section('title') Author @endsection
@section('author') active @endsection
@section('author.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Author List</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Author</a>
            </li>
            <li class="breadcrumb-item active">Author List
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Author Record List</h2>
        <div class="float-right justify-content-end">
          @if(Auth::user()->can('author-create'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('author.create')}}">
            <i class="material-icons dp48">add_circle_outline</i> Add Author
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
              <th class="custom-border-right">Name</th>
              <th class="custom-border-right">Action</th>
            </tr>
          </thead>

          <tbody>

            @foreach($authorData as $item)
              @if(isset($item) && $item != null)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{$item->author_name}}</td>
                  <td class=" text-center">
                    <!-- Dropdown Trigger -->
                    <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$item->id}}'>
                      <i class="material-icons float-right">more_vert</i>
                    </a>
                    <!-- Dropdown Structure -->
                    <ul id='dropdown1{{$item->id}}' class='dropdown-content custom-dropdown-for-action'>
                      <li>
                        @if(Auth::user()->can('author-edit'))
                        <a href="{{ route('author.edit',$item->id) }}"><i class="material-icons">edit</i>Edit</a>
                        @endif
                      </li>
                      <li>
                        @if(Auth::user()->can('author-delete'))
                        <form id="delete-form" action="{{ route('author.destroy', $item->id) }}" method="POST"
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