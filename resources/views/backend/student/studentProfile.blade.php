@extends('backend.master')
@section('content')
@section('title') Student Profile @endsection
@section('student') active @endsection
@section('student.index') active @endsection
@section('styles')
<style>
    @media (max-width: 1500px) and (min-width: 992px) {
        /* Custom responsive css start... */
        .custom-data-table-for-student {
            display: inline-block !important;
            overflow-x: scroll !important;
        }

        .custom-user-payment-tab .tab{
            width: 32.5%;
        }
    }
</style>
@endsection
@section('content')

<div class="row">

    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Student Profile</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Student Profile</a>
                        </li>
                        <li class="breadcrumb-item active">Student Profile
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col s12">
        <div class="card mb-0">
            <div class="card-content custom-card-content">
                <h2 class="card-title">Student Profile</h2>
                <div class="float-right justify-content-end">
                </div>
            </div>
        </div>

        <section class="">

            <div class="row">
                <div class="col l3 s12 mt-1">

                    <!-- tabs  -->
                    <div class="card-panel">
                        <div class="sidebar-left sidebar-fixed mt-2">
                            <div class="sidebar">
                                <div class="sidebar-content">
                                    <div class="sidebar-header">
                                        <div class="sidebar-details">
                                            
                                            <div class="row valign-wrapper pt-2 animate fadeLeft">
                                                <div class="col s12 media-image text-center">

                                                    @if(isset($student->student_photo) && $student->student_photo !=
                                                    null)
                                                    <img src="{{ asset('/uploads/student_photo/'.$student->student_photo) }}"
                                                        width="75" height="65">
                                                    @else
                                                    @if($student->gender == 'male')
                                                    <img src="{{ asset('backend/app-assets/images/user/male.png') }}"
                                                        width="75" height="65">
                                                    @else
                                                    <img src="{{ asset('backend/app-assets/images/user/female.png') }}"
                                                        width="75" height="65">
                                                    @endif
                                                    @endif

                                                    <!-- notice the "circle" class -->
                                                </div>
                                            

                                            </div>

                                            <div class="card-content custom-student-account-profile mt-10">

                                                <p>
                                                    <i class="material-icons profile-card-i">account_circle</i>
                                                    <span
                                                        class="custom-student-account-profile-content">{{$student->student_name}}</span>
                                                </p>

                                                <p>
                                                    <i class="material-icons profile-card-i">format_list_numbered</i>
                                                    <span
                                                        class="custom-student-account-profile-content">{{$student->roll_no}}</span>
                                                </p>

                                                <p>
                                                    <i class="material-icons profile-card-i">call</i>
                                                    <span
                                                        class="custom-student-account-profile-content">{{$student->student_phone}}</span>
                                                </p>


                                                <p><i class="material-icons profile-card-i">import_contacts</i>
                                                    <span class="custom-student-account-profile-content">
                                                        {{$student->classData->class_name}} <span
                                                            class="custom-text-info">( @if($student->section_id)
                                                            {{$student->sectionData->section_name}} @else @endif )
                                                        </span>
                                                    </span>
                                                </p>
                                                <p>
                                                    <i class="material-icons profile-card-i">email</i>
                                                    <span
                                                        class="custom-student-account-profile-content">{{$student->student_email}}</span>
                                                </p>
                                                <p><i class="material-icons profile-card-i">person_outline</i>
                                                    <span class="custom-student-account-profile-content">
                                                        {{Str::title($student->gender)}} <span
                                                            class="custom-text-info">({{$student->blood_group}})</span>
                                                    </span>
                                                </p>
                                                <p><i class="material-icons profile-card-i">eject</i>
                                                    <span class="custom-student-account-profile-content">
                                                        {{$student->religion}}
                                                    </span>
                                                </p>
                                                <p>
                                                    <i class="material-icons profile-card-i">directions</i>
                                                    <span
                                                        class="custom-student-account-profile-content">{{$student->address}}</span>
                                                </p>

                                                <!-- <p>
                                                    <i class="material-icons profile-card-i">directions</i> 
                                                    <span class="custom-student-account-profile-content">{{$student->addmission_date}}</span>
                                                </p> -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('student.edit',$student->id) }}" class="btn waves-effect waves-light purple lightrn-1 editbutton mt-5">edit</a>
                    </div>
                </div>


                <div class="col l9 s12">
                    <div class="container">
                        <!-- users edit start -->
                        <div class="section users-edit">
                            <div class="card">
                                <div class="card-content">
                                    <!-- <div class="card-body"> -->
                                    <ul class="tabs mb-2 row custom-student-payment-tab">

                                        <li class="tab">
                                            <a class="display-flex align-items-center active" id="account-tab"
                                                href="#attendenceHistory">
                                                <i class="material-icons mr-1">assignment_turned_in</i><span>Attendence
                                                    History</span>
                                            </a>
                                        </li>

                                        <li class="tab">
                                            <a class="display-flex align-items-center" id="information-tab"
                                                href="#paymentHistory">
                                                <i class="material-icons mr-2">error_outline</i><span>Payment
                                                    History</span>
                                            </a>
                                        </li>
                                        
                                        <li class="tab">
                                            <a class="display-flex align-items-center" id="information-tab"
                                                href="#guardianProfile">
                                                <i class="material-icons mr-2">account_circle</i><span>Guardian
                                                    Profile</span>
                                            </a>
                                        </li>

                                    </ul>
                                    <div class="divider mb-1"></div>
                                    <div class="row">


                                        <div class="col s12" id="attendenceHistory" class="">
                                            <h2 class="card-title custom-payment-title mt-1">Month Wise Attendance History</h2>
                                            <div class="divider"></div>

                                            <div id="courseAttendanceWitMonth">
                                                <table
                                                    class="table table-striped text-center table-bordered dt-responsive nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Month</th>
                                                            <th>Present</th>
                                                            <th>Absence</th>
                                                            <th>Late</th>
                                                            <th>Leave</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($monthNames as $key => $month)
                                                        @if (isset($month) && $month != null)

                                                        @php
                                                        $presentData =
                                                        App\Models\StudentAttendance::presentDataWithMonth($month,
                                                        $student->class_id, $student->section_id, $student->id);
                                                        $absenceData =
                                                        App\Models\StudentAttendance::absenceDataWithMonth($month,
                                                        $student->class_id, $student->section_id, $student->id);
                                                        $lateData =
                                                        App\Models\StudentAttendance::lateDataWithMonth($month,
                                                        $student->class_id, $student->section_id, $student->id);
                                                        $leaveData =
                                                        App\Models\StudentAttendance::leaveDataWithMonth($month,
                                                        $student->class_id, $student->section_id, $student->id);
                                                        @endphp

                                                        <tr>
                                                            <td class="font-weight-bold text-left"
                                                                style="color: #00CFE8 !important;">
                                                                <a href="#" onclick="studentMonthAttendense({{$student->class_id}},{{$student->section_id}},{{$student->id}},'{{$month}}')">
                                                                    {{ $month }}
                                                                </a>
                                                            </td>


                                                            <td><span style="color: #00FF00">{{ $presentData }}</span>
                                                            </td>
                                                            <td><span style="color: red;">{{ $absenceData }}</span></td>
                                                            <td><span style="color: #F4A460;">{{ $lateData }}</span>
                                                            </td>
                                                            <td><span style="color: #1E90FF;">{{ $leaveData }}</span>
                                                            </td>
                                                        </tr>

                                                        @endif
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>


                                        <div class="col s12" id="paymentHistory" class="">
                                            <h2 class="card-title custom-payment-title mt-1">Student Payment
                                                History</h2>
                                            <div class="divider"></div>
                                            
                                            <div class="card-content-datatable table-responsive">
                                                <table id="studentPH"
                                                    class="display custom-table custom-data-table custom-data-table-for-student 
                                                    custom-table-border dt-responsive nowrap table-responsive">
                                            
                                                    <thead>
                                                        <tr>
                                                            <th class="custom-border-right custom-sl-no">SL</th>
                                                            <th class="custom-border-right">Invoice</th>
                                                            <th class="custom-border-right">Total Pay</th>
                                                            <th class="custom-border-right">Total Fine</th>
                                                            <th class="custom-border-right">Total Collection</th>
                                                            <th class="custom-border-right">Date</th>
                                                            <th class="custom-border-right">Action</th>
                                                        </tr>
                                                    </thead>
                                                    
                                                    <tbody>
                                                    
                                                        @foreach($stdentPaymentData as $item)
                                                        @if(isset($item) && $item != null)
                                                        <tr>
                                                            <td>{{ $item['serial_no'] }}</td>
                                                            <td>{{$item['invoice_id']}}</td>
                                                            <td>{{$item['total_paid_amount']}}</td>
                                                            <td>{{$item['total_fine_amount']}}</td>
                                                            <td>{{$item['total_collection_amount']}}</td>
                                                            <td>
                                                                {{Carbon\Carbon::createFromFormat('Y-m-d', $item['payment_date'])->format('d-m-Y')}}
                                                            </td>
                                                            <td class=" text-center">
                                                                <!-- Dropdown Trigger -->
                                                                <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown{{$item['id']}}'>
                                                                    <i class="material-icons float-right">more_vert</i>
                                                                </a>
                                                                <!-- Dropdown Structure -->
                                                                <ul id='dropdown{{$item['id']}}' class='dropdown-content custom-dropdown-for-action'>
                                                                    <li>
                                                                        @if(Auth::user()->can('payment-of-student-create'))
                                                                        <a href="{{route('get-student-payment-invoice', $item['id'])}}"><i class="material-icons">print</i>Invoice</a>
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        @endforeach
                                                    
                                                    </tbody>
                                                    
                                                    <tfoot>
                                                        <tr>
                                                            <th class="custom-border-right custom-sl-no custom-text-black custom-fw-bold">Total</th>
                                                            <th class="custom-border-right custom-text-black custom-fw-bold">=</th>
                                                            <th class="custom-border-right custom-text-black custom-fw-bold">{{ $studentTotalPaidAmount }}tk</th>
                                                            <th class="custom-border-right custom-text-black custom-fw-bold">{{ $studentTotalFineAmount }}tk</th>
                                                            <th class="custom-border-right custom-text-black custom-fw-bold">{{ $studentTotalCollectionAmount }}tk</th>
                                                            <th class="custom-border-right custom-text-black custom-fw-bold"></th>
                                                            <th class="custom-border-right custom-text-black custom-fw-bold"></th>
                                                        </tr>
                                                    </tfoot>
                                            
                                                </table>
                                            </div>

                                        </div>

                                        <div class="col s12" id="guardianProfile" class="">
                                            <h2 class="card-title custom-payment-title mt-1">Student Guardian
                                                Profile</h2>
                                            <div class="divider"></div>
                                        
                                            <div class="card-content-datatable table-responsive">
                                                <table id="classTable"
                                                    class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">
                                                
                                                   <thead>
                                                    <tr>
                                                        <th class="custom-border-right">Photo</th>
                                                        <th class="custom-border-right">Name</th>
                                                        <th class="custom-border-right">Phone</th>
                                                        <th class="custom-border-right">Email</th>
                                                        <th class="custom-border-right">Address</th>
                                                    </tr>
                                                    </thead>
                                                    
                                                    <tbody>
                                                    
                                                        @if($gurdianData != null)
                                                        <tr>
                                                            <td>
                                                                @if(isset($gurdianData->photo) && $gurdianData->photo != null)
                                                                <img src="{{ asset('/uploads/guardian_photo/'.$gurdianData->photo) }}" width="75" height="65">
                                                                @else
                                                                <img src="{{ asset('backend/app-assets/images/user/male.png') }}" width="75" height="65">
                                                                @endif
                                                            </td>
                                                    
                                                            <td>{{$gurdianData->guardian_name}}</td>
                                                            <td>{{$gurdianData->phone}}</td>
                                                            <td>{{$gurdianData->email}}</td>
                                                            <td>{{$gurdianData->address}}</td>
                                                    
                                                    
                                                        </tr>
                                                        @else
                                                        @endif
                                                    
                                                    
                                                    </tbody>
                                                    
                                                </table>
                                            </div>
                                        
                                        </div>

                                    </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- users edit ends -->
                    </div>
                </div>
            </div>
        </section><!-- START RIGHT SIDEBAR NAV -->
    </div>

</div>

@endsection

@section('scripts')
<script>
    //To fetch the course days attendance with month...
            function studentMonthAttendense(classId, sectionId, studentId, monthName) {

                var url = "{{ route('student.daysAttendanceWithMonth') }}";
                if(classId != ''){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: url,
                        data: {
                            classId: classId,
                            sectionId: sectionId,
                            studentId: studentId,
                            monthName: monthName
                        },
                        success: function (data) {
                            $("#attendenceHistory").html(data);
                        }
                    });
                }
            }
</script>

<script>
    $( document ).ready(function() {
    $("#student_id").select2();
  });
</script>

<script>
    $(document).ready(function() {
        $('#studentPH').DataTable({
            "responsive": false,
            "searching": true,
            "scrollX": false,
        });

        $('#studentGP').DataTable();
    });
</script>
@endsection