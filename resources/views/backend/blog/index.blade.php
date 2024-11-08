@extends('backend.master')
@section('content')
@section('title') Blog @endsection
@section('blog-backend') active @endsection
@section('blog-backend.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Blog List</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Blog</a>
            </li>
            <li class="breadcrumb-item active">Blog List
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Blog Record List</h2>
        <div class="float-right justify-content-end">
          @if(Auth::user()->can('blog-create'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('blog-backend.create')}}">
            <i class="material-icons dp48">add_circle_outline</i> Add Blog
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
                <th class="custom-border-right">Photo</th>
                <th class="custom-border-right">Title</th>
                <th class="custom-border-right">Post</th>
                <th class="custom-border-right custom-action-border-right">Action</th>
              </tr>
            </thead>

            <tbody>

              @foreach($data as $blog)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                  <img src="{{ asset('uploads/blog_img/'.$blog->photo) }}" width="75" height="65">
                </td>

                <td> {{$blog->title}}</td>
                <td > {!! Str::limit( $blog->post, 150) !!} </td>

                <td class=" text-center">
                  <!-- Dropdown Trigger -->
                  <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$blog->id}}'>
                    <i class="material-icons float-right">more_vert</i>
                  </a>
                  <!-- Dropdown Structure -->
                  <ul id='dropdown1{{$blog->id}}' class='dropdown-content custom-dropdown-for-action'>

                    @if(Auth::user()->can('blog-edit'))
                    <li>
                      <a href="{{ route('blog-backend.edit',$blog->id) }}"><i class="material-icons">edit</i>Edit</a>
                    </li>
                    @endif


                    @if(Auth::user()->can('blog-delete'))
                    <li>
                      <a href="{{ route('blog-backend.destroy', $blog->id) }}" onclick="event.preventDefault();
                          document.getElementById('delete-form').submit();"><i
                          class="material-icons">delete</i>Delete</a>
                    </li>
                    @endif

                  </ul>

                  <form id="delete-form" action="{{ route('blog-backend.destroy', $blog->id) }}" method="POST"
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

</div>

@endsection

@section('scripts')

@endsection