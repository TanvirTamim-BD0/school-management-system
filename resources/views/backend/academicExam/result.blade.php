@extends('backend.master')
@section('content')
@section('title') Result @endsection
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
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Result Submit</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Result</a>
            </li>
            <li class="breadcrumb-item active">Result Submit
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">

      <div class="card-content custom-card-content custom-card-content-for-datatable">
        <h2 class="card-title">Exam Result</h2>

      </div>

      <div class="card-content-datatable table-responsive">

        <form action="{{ route('results.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <table id="sectionTable"
            class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">

            <thead>
              <tr>
                <th class="custom-border-right">SL</th>
                <th class="custom-border-right">Photo</th>
                <th class="custom-border-right">Academic</th>
                <th class="custom-border-right">Mark</th>
                <th class="custom-border-right">Result</th>
              </tr>
            </thead>

            <tbody>

              @foreach($studentData as $student)
                @if(isset($student) && $student != null)
                  <tr>
                    <td>{{ $loop->iteration }}</td>

                    <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                    <input type="hidden" name="exam_id" value="{{ $examData->id }}">

                    <td>
                      @if(isset($student->student_photo) && $student->student_photo != null)
                      <img src="{{ asset('/uploads/student_photo/'.$student->student_photo) }}" width="75" height="65">
                      @else
                      @if($student->gender == 'male')
                      <img src="{{ asset('backend/app-assets/images/user/male.png') }}" width="75" height="65">
                      @else
                      <img src="{{ asset('backend/app-assets/images/user/female.png') }}" width="75" height="65">
                      @endif
                      @endif
                    </td>

                    <td>
                      Name : {{$student->student_name}} <br>
                      Roll : {{$student->roll_no}} <br>
                      Class : {{$student->classData->class_name}} <br>
                      Section : {{$student->sectionData->section_name}} <br>
                      Subject : {{$examData->subjectData->subject_name}} <br>
                    </td>

                    <td>
                      Total Mark : {{$examData->total_mark}} <br>
                      Pass Mark : {{$examData->pass_mark}} <br>
                    </td>

                    <td>
                      <input type="number" name="marks[{{ $student->id }}]">
                    </td>

                  </tr>
                @else
                  <tr>
                    <td>
                      <td></td>
                      <td></td>
                      <p>There have no data</p>
                      <td></td>
                      <td></td>
                    </td>
                  </tr>
                @endif
              @endforeach

            </tbody>

          </table>

          <button class="mb-6 mt-2 btn waves-effect waves-light purple lightrn-1" type="submit">
            Submit
          </button>
        </form>

      </div>
    </div>
  </div>

</div>

@endsection