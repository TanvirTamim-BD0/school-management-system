@extends('backend.master')
@section('content')
@section('title') Notice @endsection

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
      </div>

      <div class="card-content-datatable">
        <div class="table-responsive custom-table-modify">
          <table id="myTable" class="table table-bordered custom-table-border">
            <thead>
            <tr>
              <th class="custom-border-right custom-sl-no">SL</th>
              <th class="custom-border-right">Title</th>
              <th class="custom-border-right">Description</th>
            </tr>
          </thead>

          <tbody>

            @foreach($noticeData as $item)
            @if(isset($item) && $item != null)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{$item->title}}</td>
              <td>{!!Str::limit($item->description, 250)!!}</td>
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