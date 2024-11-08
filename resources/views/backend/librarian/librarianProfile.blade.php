@extends('backend.master')
@section('content')
@section('title') Librarian Profile @endsection
@section('librarian') active @endsection
@section('librarian.index') active @endsection
@section('styles')
<style>
    @media (max-width: 1500px) and (min-width: 992px) {
        /* Custom responsive css start... */
        .custom-data-table {
            display: inline-block !important;
            overflow-x: scroll !important;
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
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Librarian Profile</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Librarian Profile
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col s12">
        <div class="card mb-0">
            <div class="card-content custom-card-content">
                <h2 class="card-title">Librarian Profile</h2>
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
                                                <div class="col s9 media-image text-left">

                                                    @if(isset($singleLibrarian->librarian_photo) &&
                                                    $singleLibrarian->librarian_photo !=
                                                    null)
                                                    <img src="{{ asset('/uploads/librarian_photo/'.$singleLibrarian->librarian_photo) }}"
                                                        width="75" height="65">
                                                    @else
                                                    @if($singleLibrarian->gender == 'male')
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
                                                        class="custom-student-account-profile-content">{{$singleLibrarian->librarian_name}}</span>
                                                </p>

                                                <p>
                                                    <i class="material-icons profile-card-i">call</i>
                                                    <span
                                                        class="custom-student-account-profile-content">{{$singleLibrarian->librarian_phone}}</span>
                                                </p>

                                                <p>
                                                    <i class="material-icons profile-card-i">email</i>
                                                    <span
                                                        class="custom-student-account-profile-content">{{$singleLibrarian->librarian_email}}</span>
                                                </p>
                                                <p><i class="material-icons profile-card-i">person_outline</i>
                                                    <span class="custom-student-account-profile-content"> <span
                                                            class="custom-text-info">({{$singleLibrarian->blood_group}})</span>
                                                    </span>
                                                </p>
                                                <p><i class="material-icons profile-card-i">eject</i>
                                                    <span class="custom-student-account-profile-content">
                                                        {{$singleLibrarian->religion}}
                                                    </span>
                                                </p>
                                                <p>
                                                    <i class="material-icons profile-card-i">directions</i>
                                                    <span
                                                        class="custom-student-account-profile-content">{{$singleLibrarian->address}}</span>
                                                </p>

                                                <p>
                                                    <i class="material-icons profile-card-i">assignment_add</i>
                                                    <span
                                                        class="custom-student-account-profile-content">{{Carbon\Carbon::createFromFormat('Y-m-d', $singleLibrarian->joining_date)->format('d-m-Y')}}</span>
                                                </p>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('librarian.edit',$singleLibrarian->id) }}" class="btn waves-effect waves-light purple lightrn-1 editbutton">edit</a>
                    </div>
                </div>


                <div class="col l9 s12">
                    <div class="container">
                        <!-- users edit start -->
                        <div class="section users-edit">
                            <div class="card">
                                <div class="card-content">
                                    <!-- <div class="card-body"> -->
                                    <ul class="tabs mb-2 row custom-user-payment-tab">

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
                                                <i class="material-icons mr-2">error_outline</i><span>Pyment
                                                    History</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="divider mb-1"></div>
                                    <div class="row">


                                        <div class="col s12" id="attendenceHistory" class="">
                                            <h2 class="card-title custom-payment-title mt-1">Month Wise Attendance
                                                History</h2>
                                            <div class="divider"></div>

                                            <div id="attendanceWitMonth">
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
                                                        @if (isset($month))

                                                        @php
                                                        $presentData =
                                                        App\Models\LibrarianAttendance::presentDataWithMonth($month,$singleLibrarian->id);
                                                        $absenceData =
                                                        App\Models\LibrarianAttendance::absenceDataWithMonth($month,$singleLibrarian->id);
                                                        $lateData =
                                                        App\Models\LibrarianAttendance::lateDataWithMonth($month,
                                                        $singleLibrarian->id);
                                                        $leaveData =
                                                        App\Models\LibrarianAttendance::leaveDataWithMonth($month,
                                                        $singleLibrarian->id);
                                                        @endphp

                                                        <tr>
                                                            <td class="font-weight-bold text-left">
                                                                <a href="#"
                                                                    onclick="librarianAttendense({{$singleLibrarian->id}},'{{$month}}')">
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
                                            <h2 class="card-title custom-payment-title mt-1">Librarian Payment
                                                History</h2>
                                            <div class="divider"></div>

                                            <div class="card-content-datatable table-responsive">
                                                <table id="librarianPH"
                                                    class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">

                                                    <thead>
                                                        <tr>
                                                            <th class="custom-border-right custom-sl-no">SL</th>
                                                            <th class="custom-border-right">Invoice</th>
                                                            <th class="custom-border-right">Month</th>
                                                            <th class="custom-border-right">Date</th>
                                                            <th class="custom-border-right">Net Salary</th>
                                                            <th class="custom-border-right">Payment Amount</th>
                                                            <th class="custom-border-right">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach($paymentData as $key=>$item)
                                                        @if(isset($item) && $item != null)
                                                        <tr>
                                                            <td>{{ $key+1 }}</td>
                                                            <td>INV-TP-{{ $item->id }}</td>
                                                            <td>{{ $item->payment_month }}</td>
                                                            <td>
                                                                {{Carbon\Carbon::createFromFormat('Y-m-d', $item->payment_date)->format('d-m-Y')}}
                                                            </td>
                                                            @php
                                                            //To get librarian details data...
                                                            $singleLibrarianDetailData =
                                                            App\Models\Librarian::getSingleLibrarianDetailWithEmail($item->payment_to_id);
                                                            @endphp
                                                            <td>{{ $singleLibrarianDetailData->salary }}</td>
                                                            <td>{{ $item->total_salary }}</td>

                                                            <td class=" text-center">
                                                                <!-- Dropdown Trigger -->
                                                                <a class='dropdown-trigger btn custom-dropdown-btn'
                                                                    href='#' data-target='dropdown{{$item->id}}'>
                                                                    <i class="material-icons float-right">more_vert</i>
                                                                </a>
                                                                <!-- Dropdown Structure -->
                                                                <ul id='dropdown{{$item->id}}'
                                                                    class='dropdown-content custom-dropdown-for-action'>
                                                                    <li>
                                                                        @if(Auth::user()->can('payment-of-student-list'))
                                                                        <a href="{{route('get-librarian-payment-invoice', $item->id)}}"><i
                                                                                class="material-icons">print</i>Invoice</a>
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
                                                            <th class="custom-border-right custom-sl-no custom-fw-bold">
                                                                SL</th>
                                                            <th class="custom-border-right custom-fw-bold">Invoice</th>
                                                            <th class="custom-border-right custom-fw-bold">Month</th>
                                                            <th class="custom-border-right custom-fw-bold">Date</th>
                                                            <th class="custom-border-right custom-fw-bold">Net Salary
                                                            </th>
                                                            <th class="custom-border-right custom-fw-bold">Payment
                                                                Amount</th>
                                                            <th class="custom-border-right custom-fw-bold">Action</th>
                                                        </tr>
                                                    </tfoot>

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


<script>

    //To fetch the course days attendance with month...
		    function librarianAttendense(librarianId, monthName) {

		        var url = "{{ route('librarian.daysAttendanceWithMonth') }}";
		        if(librarianId != ''){
		            $.ajaxSetup({
		                headers: {
		                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		                }
		            });
		            $.ajax({
		                type: 'post',
		                url: url,
		                data: {
		                    librarianId: librarianId,
		                    monthName: monthName
		                },
		                success: function (data) {
		                    $("#attendenceHistory").html(data);
		                }
		            });
		        }
		    }
</script>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
    $('#librarianPH').DataTable({
    "responsive": false,
    "searching": true,
    "scrollX": false,
    });
    });
</script>
@endsection