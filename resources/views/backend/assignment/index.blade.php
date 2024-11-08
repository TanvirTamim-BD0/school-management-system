@extends('backend.master')
@section('content')
@section('title') Assignment @endsection
@section('assignment') active @endsection
@section('assignment.index') active @endsection
@section('styles')

@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Assignment List</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Assignment</a>
            </li>
            <li class="breadcrumb-item active">Assignment List
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">
      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Assignment Record List</h2>
        <div class="float-right justify-content-end">
          @if(Auth::user()->can('assignment-create'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('assignment.create')}}">
            <i class="material-icons dp48">add_circle_outline</i> Add Assignment
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
              <th class="custom-border-right">ClassName</th>
              <th class="custom-border-right">Section</th>
              <th class="custom-border-right">Subject</th>
              <th class="custom-border-right">Assignment</th>
              <th class="custom-border-right">File</th>
              <th class="custom-border-right custom-action-border-right">Action</th>
            </tr>
          </thead>
          <tbody>

            @foreach($assignmentData as $key => $item)
            @if(isset($item) && $item != null)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{$item->classData->class_name}}</td>

              @php
              //To get all the section data with assignmentsId wise...
              $getAllSectionData = App\Models\Assignment::getAllSectionDataWithAssignmentIdWise($item->id);
              // dd($getAllSectionData);
              @endphp

              <td>
                @foreach ($getAllSectionData as $singleSectionData)
                <span class="custom-text-primary">{{$singleSectionData->section_name}}</span>,
                @endforeach

              </td>

              <td>
                {{$item->subjectData->subject_name}}
              </td>

              <td>
                Title: <span class="text-info">{{$item->title}}</span> <br>
                Description: <span class="text-info">{!! Str::limit($item->description, 250) !!}</span>,
              </td>

              <td>
                <a href="{{route('assignment-file-download', $item->id)}}">
                  {{$item->assignment_file}}
                </a>
              </td>

              <td class=" text-center">
                <!-- Dropdown Trigger -->
                <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$item->id}}'>
                  <i class="material-icons float-right">more_vert</i>
                </a>
                <!-- Dropdown Structure -->
                <ul id='dropdown1{{$item->id}}' class='dropdown-content custom-dropdown-for-action'>
                  <li>
                    @if(Auth::user()->can('assignment-edit'))
                    <a href="{{ route('assignment.edit',$item->id) }}"><i class="material-icons">edit</i>Edit</a>
                    @endif
                  </li>
                  <li>
                    @if(Auth::user()->can('assignment-delete'))
                    <form id="delete-form" action="{{ route('assignment.destroy', $item->id) }}" method="POST"
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
@endsection