@extends('backend.master')
@section('content')
@section('title') Exam @endsection
@section('exam') active @endsection
@section('exam.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Exam List</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Exam</a>
            </li>
            <li class="breadcrumb-item active">Exam List
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Exam Record List</h2>
        <div class="float-right justify-content-end">
          @if(Auth::user()->can('exam-create'))
          <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
            href="{{route('exam.create')}}">
            <i class="material-icons dp48">add_circle_outline</i> Add Exam
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
              <th class="custom-border-right">Class & Section</th>
              <th class="custom-border-right">Exam Name</th>
              <th class="custom-border-right">Mark</th>
              <th class="custom-border-right">Exam Date</th>
              <th class="custom-border-right">Status</th>
              <th class="custom-border-right">Action</th>
            </tr>
          </thead>

          <tbody>

            @foreach($exams as $exam)
            @if(isset($exam) && $exam != null)
            <tr>
              <td>{{ $loop->iteration }}</td>

              @php
              //To get all the section data with examId wise...
              $getAllSectionData = App\Models\Exam::getAllSectionDataWithExamIdWise($exam->id);
              @endphp

              <td>
                Class : {{$exam->classData->class_name}} <br>
                Section :
                @foreach($getAllSectionData as $singleSectionData)
                @if(isset($singleSectionData) && $singleSectionData != null)
                <span class="custom-text-primary">{{$singleSectionData->section_name}}</span>,
                @endif
                @endforeach
              </td>


              <td>{{$exam->exam_name}}</td>

              <td>
                Total Mark : {{$exam->total_mark}} <br>
                Pass Mark : {{$exam->pass_mark}} <br>
              </td>

              <td>
                {{Carbon\Carbon::createFromFormat('Y-m-d', $exam->exam_date)->format('d-m-Y')}}
              </td>

              <td>
                @if($exam->status == 1)
                <span style="color: green;">Published</span>
                @else
                <span style="color: red;">Pending</span>
                @endif
              </td>

              <td class=" text-center">
                <!-- Dropdown Trigger -->
                <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown1{{$exam->id}}'>
                  <i class="material-icons float-right">more_vert</i>
                </a>
                <!-- Dropdown Structure -->
                <ul id='dropdown1{{$exam->id}}' class='dropdown-content custom-dropdown-for-action'>

                  @if($exam->status == 0)
                  <li>
                    <a href="{{ route('exam.result',$exam->id) }}"><i class="material-icons">checklist</i>Create
                      Result</a>
                  </li>
                  @else
                  @endif

                  @if(Auth::user()->can('exam-edit'))
                  <li>
                    <a href="{{ route('exam.edit',$exam->id) }}"><i class="material-icons">edit</i>Edit</a>
                  </li>
                  @endif

                  @if(Auth::user()->can('exam-delete'))
                  <li>
                    <a href="{{ route('exam.destroy', $exam->id) }}" onclick="event.preventDefault();
                              document.getElementById('delete-form').submit();"><i
                        class="material-icons">delete</i>Delete</a>
                  </li>
                  @endif

                </ul>

                <form id="delete-form" action="{{ route('exam.destroy', $exam->id) }}" method="POST"
                  style="display: none;">
                  @csrf
                  @method('delete')
                </form>
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
      $('#sectionTable').DataTable({
        "responsive": false,
        "searching": true,
        "scrollX": false,
      });
    });
</script>
@endsection