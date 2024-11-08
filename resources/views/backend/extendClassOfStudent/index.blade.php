@extends('backend.master')
@section('content')
@section('title') Class Report Filter @endsection
@section('extend-class-of-student') active @endsection
@section('styles')
@endsection

@section('content')

<div class="row">

    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Class Extend Of Students</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Class Extend Of Students
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col s12">
        <div class="card">

            <div class="card-content custom-table-filtering-header">

                <form method="post" action="{{route('filter-students-for-extend-class')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col s12 m6">
                            <div class="input-field">
                                <select class="select2 browser-default" id="class_id" name="class_id" required>
                                    <option value="" selected disabled>Select Class <span
                                            class="custom-text-danger">*</span></option>

                                    @foreach($classData as $item)
                                    @if(isset($item) && $item != null)
                                    <option value="{{ $item->id }}" {{ $singleClassData->id == $item->id ? 'selected' : '' }}>{{ $item->class_name }}
                                    </option>
                                    @endif
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col s12 m6">
                            <div class="input-field">
                                <select class="select2 browser-default" name="section_id" id="section_id" required>
                                    <option value="" selected disabled>Select Section <span
                                            class="custom-text-danger">*</span></option>
                                    
                                    @foreach($sectionData as $item)
                                        @if(isset($item) && $item != null)
                                        <option value="{{ $item->id }}" {{ $singleSectionData->id == $item->id ? 'selected' : '' }}>{{ $item->section_name }}</option>
                                        @endif
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col m12  s12 custom-text-center">
                            <button class="mb-1 btn waves-effect waves-light purple lightrn-1 custom-filter-button"
                                type="submit">
                                <span>Filter</span>
                            </button>
                        </div>

                    </div>
                </form>
            </div>

        </div>

        <div class="card">
        
            <div class="card-content custom-card-content custom-card-content-for-datatable">
                <h2 class="card-title">Student Record List</h2>
                <div class="float-right justify-content-end">
                    @if(Auth::user()->can('student-create'))
                    <a class="modal-trigger waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
                        href="#classExtend">
                        <i class="material-icons dp48">keyboard_backspace</i> Class Extend
                    </a>
                    @endif
                </div>
            </div>

            <!-- Modal Structure -->

            <div id="classExtend" class="modal modal-fixed-footer">
                <form method="post" action="{{route('shift-students-to-upper-class')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-content">
                        <div class="modal-header custom-modal-header">
                            <h5>Class Extend Of Students</h5>
                        </div>

                        <div class="row mt-5">
                        
                            <div class="input-field col s12 m6">
                                <label for="class_id" class="custom-label-class">From Class <span class="custom-text-danger">*</span></label>
                                <select name="class_id" id="class_id" required>
                                    <option value="{{ $singleClassData->id }}" selected>{{ $singleClassData->class_name }}</option>
                                </select>
                        
                                @error('class_id')
                                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                                @enderror
                        
                            </div>
                        
                            <div class="input-field col s12 m6">
                                <label for="section_id" class="custom-label-class">Section <span class="custom-text-danger">*</span></label>

                                <select name="section_id" id="section_id" required>
                                    <option value="{{ $singleSectionData->id }}" selected>{{ $singleSectionData->section_name }}</option>
                                </select>
                        
                                @error('section_id')
                                <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                                @enderror
                        
                            </div>
                        
                            <div class="input-field col s12 m6">
                                <label for="" class="custom-label-class">To Class <span class="custom-text-danger">*</span></label>


                                <select class="select2 browser-default" id="to_class_id" name="to_class_id" required>
                                    <option value="" selected disabled>Select To Class</option>
                                    <option value="Out Of The School">Out Of The School</option>

                                    @foreach($classData as $item)
                                    @if(isset($item) && $item != null)
                                    <option value="{{ $item->id }}">{{ $item->class_name }}
                                    </option>
                                    @endif
                                    @endforeach

                                </select>
                        
                            </div>
                        
                            <div class="input-field col s12 m6">
                                <label for="" class="custom-label-class">To Section <span class="custom-text-danger">*</span></label>


                                <select class="select2 browser-default" id="to_section_id" name="to_section_id" required>
                                    <option value="" selected disabled>Select To Section</option>
                                
                                </select>
                        
                            </div>
                        
                        </div>

                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Disagree</a>
                        <button class="btn waves-effect waves-light purple lightrn-1" type="submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        
            <div class="card-content-datatable table-responsive">
                <table id="sectionTable"
                    class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">
        
                    <thead>
                        <tr>
                            <th class="custom-border-right">SL</th>
                            <th class="custom-border-right">Photo</th>
                            <th class="custom-border-right">Student Details</th>
                            <th class="custom-border-right">Academic</th>
                            <th class="custom-border-right">Session Year</th>
                        </tr>
                    </thead>
        
                    <tbody>
        
                        @foreach($studentData as $student)
                        @if(isset($student) && $student != null)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if(isset($student->student_photo) && $student->student_photo != null)
                                <img src="{{ asset('/uploads/student_photo/'.$student->student_photo) }}" width="55"
                                    height="45">
                                @else
                                @if($student->gender == 'male')
                                <img src="{{ asset('backend/app-assets/images/user/male.png') }}" width="55" height="45">
                                @else
                                <img src="{{ asset('backend/app-assets/images/user/female.png') }}" width="55" height="45">
                                @endif
                                @endif
                            </td>
        
                            <td>
                                Name : {{$student->student_name}} <br>
                                Phone : {{$student->student_phone}} <br>
                            </td>
        
                            <td>
                                Roll No : {{$student->roll_no}} <br>
                                Registration No : {{$student->registration_no}} <br>
                            </td>
                            
                            <td>
                                Year : <span class="custom-year-color" > {{$student->session_year}} </span><br>
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
@include('backend.extendClassOfStudent.partial.script')

<script>
    $(document).ready(function() {

        $('#to_class_id').select2({
            dropdownParent: $('#classExtend')
        });
        
        $('#to_section_id').select2({
            dropdownParent: $('#classExtend')
        });

        $('#sectionTable').DataTable({
            "responsive": false,
            "searching": true,
            "scrollX": false,
        });
    });
</script>
@endsection