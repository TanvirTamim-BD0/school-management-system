@extends('backend.master')
@section('content')
@section('title') Accountent Payment List @endsection
@section('make-payment') active @endsection
@section('make-payment-for-accountent') active @endsection
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
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Accountent Payment List</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Accountent Payment</a>
                        </li>
                        <li class="breadcrumb-item active">Accountent Payment List
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col s12">
        <div class="card mb-0">
            <div class="card-content custom-card-content">
                <h2 class="card-title">Accountent Payment Record List</h2>
                <div class="float-right justify-content-end">
                </div>
            </div>
        </div>

        <!-- Account settings -->
        <section class="">

            <div class="row">
                <div class="col l3 s12 mt-1">
                    <!-- tabs  -->
                    <div class="card-panel">
                        <div class="sidebar-left sidebar-fixed">
                            <div class="sidebar">
                                <div class="sidebar-content">
                                    <div class="sidebar-header">
                                        <div class="sidebar-details">
                                            <div class="row valign-wrapper pt-2 animate fadeLeft">
                                                <div class="col s3 media-image">

                                                    @if(isset($singleAccountentData->accountent_photo) &&
                                                    $singleAccountentData->accountent_photo !=
                                                    null)
                                                    <img src="{{ asset('/uploads/accountent_photo/'.$singleAccountentData->accountent_photo) }}"
                                                        width="75" height="65">
                                                    @else
                                                    @if($singleAccountentData->gender == 'male')
                                                    <img src="{{ asset('backend/app-assets/images/user/male.png') }}"
                                                        width="75" height="65">
                                                    @else
                                                    <img src="{{ asset('backend/app-assets/images/user/female.png') }}"
                                                        width="75" height="65">
                                                    @endif
                                                    @endif

                                                </div>
                                                <div class="col s9 ml-10 custom-profile-data-15">
                                                    <p class="m-0 subtitle font-weight-700">
                                                        {{ Str::title($singleAccountentData->accountent_name) }}</p>
                                                    <p class="m-0 text-muted">
                                                        {{ $singleAccountentData->accountent_phone }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="card-content custom-student-account-profile mt-10">
                                                <p><i class="material-icons profile-card-i">import_contacts</i>
                                                    <span class="custom-student-account-profile-content">
                                                        {{$singleAccountentData->designation}}
                                                    </span>
                                                </p>
                                                <p>
                                                    <i class="material-icons profile-card-i">email</i>
                                                    <span
                                                        class="custom-student-account-profile-content">{{$singleAccountentData->accountent_email}}</span>
                                                </p>
                                                <p><i class="material-icons profile-card-i">person_outline</i>
                                                    <span class="custom-student-account-profile-content">
                                                        {{Str::title($singleAccountentData->gender)}} <span
                                                            class="custom-text-info">({{$singleAccountentData->blood_group}})</span>
                                                    </span>
                                                </p>
                                                <p><i class="material-icons profile-card-i">eject</i>
                                                    <span class="custom-student-account-profile-content">
                                                        {{$singleAccountentData->religion}}
                                                    </span>
                                                </p>
                                                <p>
                                                    <i class="material-icons profile-card-i">directions</i>
                                                    <span
                                                        class="custom-student-account-profile-content">{{$singleAccountentData->address}}</span>
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                                href="#paymentHistory">
                                                <i class="material-icons mr-2">error_outline</i><span>Accountent Payment History</span>
                                            </a>
                                        </li>

                                        <li class="tab">
                                            <a class="display-flex align-items-center" id="information-tab"
                                                href="#addNewPayment">
                                                <i class="material-icons dp48 mr-2">add_circle_outline</i><span>Add A
                                                    New Payment</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="divider"></div>
                                    <div class="row">
                                        <div class="col s12" id="paymentHistory">

                                            <div class="card-content-datatable table-responsive">
                                                <table id="studentPaymentHistory"
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
                                                            //To get accountent details data...
                                                            $singleAccountentDetailData =
                                                            App\Models\Accountent::getSingleAccountentDetailWithEmail($item->payment_to_id);
                                                            @endphp
                                                            <td>{{ $singleAccountentDetailData->salary }}</td>
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
                                                                        <a href="{{route('get-accountent-payment-invoice', $item->id)}}"><i class="material-icons">print</i>Invoice</a>
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

                                        <div class="col s12" id="addNewPayment">
                                            <h2 class="card-title custom-payment-title mt-2">Accountent Payment Create
                                            </h2>
                                            <div class="divider"></div>

                                            <div class="row mt-4">

                                                <form method="post"
                                                    action="{{route('add-make-payment-for-accountent')}}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="payment_to_id" id="payment_to_id"
                                                        value="{{ $singleAccountentData->id }}">
                                                    <div class="row">

                                                        <div class="input-field col s12 m6">
                                                            <select
                                                                class="select2 browser-default custom-payment-modal-option"
                                                                id="payment_year" name="payment_year" required>
                                                                <option value="" selected disabled>Select Year</option>

                                                                @foreach($yearData as $singleYearData)
                                                                @if(isset($singleYearData) && $singleYearData != null)
                                                                <option value="{{ $singleYearData }}"
                                                                    {{ $singleYearData == $currentYear ? 'selected' : '' }}>
                                                                    {{ $singleYearData }}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>

                                                            @error('payment_year')
                                                            <span
                                                                class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="input-field col s12 m6">
                                                            <select class="select2 browser-default" id="payment_month"
                                                                name="payment_month" required>
                                                                <option value="" selected disabled>Select Month</option>

                                                                @foreach($monthData as $singleMonthData)
                                                                @if(isset($singleMonthData) && $singleMonthData != null)
                                                                <option value="{{ $singleMonthData }}"
                                                                    {{ $singleMonthData == $currentMonth ? 'selected' : '' }}>
                                                                    {{ $singleMonthData }}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>

                                                            @error('payment_month')
                                                            <span
                                                                class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="input-field col s12 m6" id="view-date-picker">
                                                            <label for="payment_date">Payment Date <span
                                                                    class="custom-text-danger">*</span></label>
                                                            <input type="text" class="datepicker" name="payment_date"
                                                                id="payment_date" value="{{$todayDate}}" required>

                                                            @error('payment_date')
                                                            <span
                                                                class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="input-field col s12 m6">
                                                            <input id="total_salary" type="number" class="validate custom-readonly"
                                                                name="total_salary" required readonly 
                                                                value="{{$singleAccountentData->salary}}">
                                                            <label for="total_salary">Salary <span
                                                                    class="custom-text-danger">*</span></label>

                                                            @error('total_salary')
                                                            <span
                                                                class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="input-field col s12 m6">
                                                            <input id="payment_comment" type="text" class="validate"
                                                                name="payment_comment" required
                                                                value="{{ old('payment_comment') }}">
                                                            <label for="payment_comment">Comment <span
                                                                    class="custom-text-danger">*</span> </label>

                                                            @error('payment_comment')
                                                            <span
                                                                class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                                                            @enderror
                                                        </div>


                                                        <div class="input-field col s12 m6">
                                                            <select class="select2 browser-default" id="payment_method"
                                                                name="payment_method" required>
                                                                <option value="" selected disabled>Select Payment Method
                                                                    <span class="custom-text-danger">*</span>
                                                                </option>
                                                                <option value="Hand Cash">Hand Cash</option>
                                                                <option value="Hand Check">Hand Check</option>
                                                                <option value="Bkash">Bkash</option>
                                                                <option value="Rocket">Rocket</option>
                                                            </select>

                                                            @error('payment_method')
                                                            <span
                                                                class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="input-field col s12 m12">
                                                            <button
                                                                class="waves-effect waves-green btn waves-light gradient-45deg-green-teal 
                                                                                                                                                                                                                    gradient-shadow custom-display-flex custom-make-payment-btn custom-payment-submit-btn"
                                                                type="submit">
                                                                <span>Submit</span>
                                                            </button>
                                                        </div>



                                                    </div>
                                                </form>

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
    $(document).ready(function() {
    $('#studentPaymentHistory').DataTable({
    "responsive": false,
    "searching": true,
    "scrollX": false,
    });
    });
</script>
@endsection