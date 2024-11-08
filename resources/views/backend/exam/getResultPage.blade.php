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
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Student Filter</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Result</a>
                        </li>
                        <li class="breadcrumb-item active">Student Filter
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col s12">
        <div class="card">

            <div class="card-content custom-table-filtering-header">
                <h2 class="card-title">Student Exam Record Filter</h2>
                <form method="post" action="{{route('get-student-with-calass-section')}}"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="exam_id" value="{{$examData->id}}">
                    
                    <div class="row">
                        <div class="col m6  s12">
                            <div class="input-field">
                                <select class="select2 browser-default" id="class_id" name="class_id" required>
                                    <option value="" selected disabled>Select Class</option>
                                    <option value="{{ $examData->class_id }}">{{ $examData->classData->class_name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col m6  s12">
                            <div class="input-field">
                                <select class="select2 browser-default" name="section_id" id="section_id"
                                    data-placeholder="Select Section" required>
                                    <option value="" selected disabled>Select Section <span class="custom-text-danger">*</span></option>

                                    @foreach($sectionData as $singleSectionData)
                                    @if(isset($singleSectionData) && $singleSectionData != null)
                                    <option value="{{ $singleSectionData->id }}">{{ $singleSectionData->section_name }}</option>
                                    @endif
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col m12  s12 custom-text-center">
                            <button class="mb-1 btn waves-effect waves-light purple lightrn-1 custom-filter-button"
                                type="submit">
                                <i class="material-icons">search</i>
                                <span>Filter</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>

@endsection
