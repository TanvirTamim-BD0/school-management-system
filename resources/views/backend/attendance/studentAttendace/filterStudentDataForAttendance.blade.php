@extends('backend.master')
@section('content')
@section('title') Student Attendance @endsection
@section('attendace-of-student') active @endsection
@section('attendace-of-student.index') active @endsection
@section('styles')
@endsection

@section('content')

<div class="row">

    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Student Attendance</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Student Attendanc Create
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col s12">
        <div class="card">

            <div class="card-content custom-card-content custom-table-filtering-header custom-attendance-academic-header">
                <div class="custom-class-section">
                    <div class="float-left justify-content-end">
                        <h5>Class: <span class="custom-text-gray">{{ $singleClassData->class_name }}</span></h5>
                        <h5>Section: <span class="custom-text-gray">{{ $singleSectionData->section_name }}</span></h5>
                    </div>
                </div>
                <div class="float-right justify-content-end">
                    <div class="float-right justify-content-end custom-class-date">
                        <h5>Date: <span class="custom-text-gray">{{ $selectedDate }}</span></h5>
                        <h5>Students: <span class="custom-text-gray">{{ $studentData->count() }}</span></h5>
                    </div>
                </div>
            </div>

        </div>

        <div class="card">

            <div class="card-content custom-card-content custom-card-content-for-datatable pb10">
                <h2 class="card-title">Student Record List</h2>
                <div class="float-right justify-content-end">
                </div>
            </div>

            <div class="card-content-datatable table-responsive custom-filter-content-datatable custom-attendance-table">
                <form method="POST" action="{{ route('attendace-of-student.store') }}" class="d-inline">
                    @csrf

                    <table id=""
                        class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">
                        <thead>
                            <tr>
                                <th class="custom-border-right">SL</th>
                                <th class="custom-border-right">Photo</th>
                                <th class="custom-border-right">Student Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($studentData as $key => $item)
                            @if(isset($item) && $item != null)
                            <tr>
                                <input type="hidden" name="student_id[]" value="{{ $item->id }}">
                                <input type="hidden" name="class_id" value="{{ $classId }}">
                                <input type="hidden" name="section_id" value="{{ $sectionId }}">
                                <input type="hidden" name="date" value="{{ $selectedDate }}">

                                <td>{{ $loop->iteration }}</td>
                                <td class="custom-attendance-image">
                                    @if(isset($item->student_photo) && $item->student_photo != null)
                                    <img src="{{ asset('/uploads/student_photo/'.$item->student_photo) }}" width="75"
                                        height="65">
                                    @else
                                        @if($item->gender == 'male')
                                            <img src="{{ asset('backend/app-assets/images/user/1.jpg') }}" width="75" height="65">
                                        @else
                                            <img src="{{ asset('backend/app-assets/images/user/12.jpg') }}" width="75" height="65">
                                        @endif
                                    @endif
                                </td>
                                <td class="custom-academic-details">
                                    Name: {{$item->student_name}} <br>
                                    Class: {{$item->classData->class_name}} <br>
                                    Section: {{$item->sectionData->section_name}}
                                </td>

                                <td class="custom-attendance-action-button">
                                    <div class="btn-group">
                                
                                        <div class="form-check form-check-inline">
                                            <label>
                                                <input class="with-gap" type="radio" id="present{{ $item->id }}" name="attendance[{{ $item->id }}]"
                                                value="present" checked />
                                                <span class="present">Present</span>
                                            </label>
                                        </div>
                                
                                        <div class="form-check form-check-inline">
                                            <label>
                                                <input class="with-gap" type="radio" id="absence{{ $item->id }}" name="attendance[{{ $item->id }}]" value="absence" />
                                                <span class="absence">Absence</span>
                                            </label>
                                        </div>
                                
                                        <div class="form-check form-check-inline">
                                            <label>
                                                <input class="with-gap" type="radio" id="late{{ $item->id }}" name="attendance[{{ $item->id }}]" value="late" />
                                                <span class="late">Late</span>
                                            </label>
                                        </div>
                                
                                        <div class="form-check form-check-inline">
                                            <label>
                                                <input class="with-gap" type="radio" id="leave{{ $item->id }}" name="attendance[{{ $item->id }}]" value="leave" />
                                                <span class="leave">Leave</span>
                                            </label>
                                        </div>
                                
                                
                                    </div>
                                </td>

                            </tr>
                            @endif
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="custom-border-right">SL</th>
                                <th class="custom-border-right">Photo</th>
                                <th class="custom-border-right">Student Details</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="form-submit-section text-center custom-attendance-footer-button">
                        <a class="btn btn-danger back-button" href="{{ route('attendace-of-student.index') }}">
                            <i class="fa fa-lg fa-trash"></i>Back
                        </a>
                        
                        <button type="submit" class="btn btn-primary attendance-submit-button">
                            <i class="fa fa-lg fa-trash"></i>Submit Attendance
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>

@endsection
@section('scripts')
@include('backend.assignment.partial.script')

<script>
    $(document).ready(function() {
      $('#studentTable').DataTable({
        "responsive": false,
        "searching": true,
        "scrollX": false,
      });
    });
</script>
@endsection