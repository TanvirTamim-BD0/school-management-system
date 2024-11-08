@extends('backend.master')
@section('content')
@section('title') Result @endsection
@section('result') active @endsection
@section('get-all-student-result') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Result</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Result
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col s12">
        <div class="card">

            <div class="card-content custom-card-content custom-card-content-for-datatable">
                <h2 class="card-title">Exam Result List</h2>
                <div class="float-right justify-content-end">
                    @if(Auth::user()->can('exam-list'))
                    <a class="waves-effect waves dark btn gradient-45deg-purple-deep-orange next-step add-attendance-button"
                        href="{{route('result.filter')}}">
                        <i class="material-icons dp48">arrow_back</i> Go Back
                    </a>
                    @endif
                </div>
            </div>

            <div class="card-content-datatable table-responsive mt-5">

                <table id="sectionTable"
                    class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">

                    <thead>
                        <tr>
                            <th class="custom-border-right">Photo</th>
                            <th class="custom-border-right">Academic</th>
                            <th class="custom-border-right">Mark</th>
                            <th class="custom-border-right">Result</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($resultData as $key=>$item)
                        @if(isset($item) && $item != null)
                        <tr>

                            <td class="custom-border-right">
                                @if(isset($item->studentData->student_photo) &&
                                $item->studentData->student_photo != null)
                                <img src="{{ asset('/uploads/student_photo/'.$item->studentData->student_photo) }}"
                                    width="75" height="65">
                                @else
                                @if($item->studentData->gender == 'male')
                                <img src="{{ asset('backend/app-assets/images/user/male.png') }}" width="75"
                                    height="65">
                                @else
                                <img src="{{ asset('backend/app-assets/images/user/female.png') }}" width="75"
                                    height="65">
                                @endif
                                @endif
                            </td>

                            <td class="custom-border-right">
                                Name : {{$item->studentData->student_name}} <br>
                                Roll : {{$item->studentData->roll_no}} <br>
                                Class : {{$item->classData->class_name}} <br>
                                Section : {{$item->sectionData->section_name}} <br>
                            </td>

                            <td class="custom-border-right">
                                Total Mark : <span class="custom-text-primary custom-font-bold">{{$item->examData->total_mark}}</span> <br>
                                Pass Mark : <span class="custom-text-danger custom-font-bold">{{$item->examData->pass_mark}}</span> <br>
                            </td>

                            <td class="custom-border-right">
                                <span class="custom-text-info custom-font-bold"> {{$item->marks}}</span>
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