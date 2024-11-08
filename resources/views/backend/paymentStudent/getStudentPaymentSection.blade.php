@extends('backend.master')
@section('content')
@section('title') Student Payment List @endsection
@section('attendace-of-student') active @endsection
@section('attendace-of-student.index') active @endsection
@section('styles')
<style>
    .firstLogo {
        display: none;
    }

    .secondLogo {
        display: block;
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
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Student Payment List</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Student Payment</a>
                        </li>
                        <li class="breadcrumb-item active">Student Payment List
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col s12">
        <div class="card">

            <div class="card-content custom-table-filtering-header">
                <h2 class="card-title">Student Record Filter</h2>
                <form method="post" action="{{route('payment-of-student.account-section')}}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col m3  s12">
                            <div class="input-field">
                                <select class="select2 browser-default" id="class_id" name="class_id" required>
                                    <option value="" selected disabled>Select Class</option>
                                    @foreach($classData as $singleClassData)
                                        @if(isset($singleClassData) && $singleClassData != null)
                                            <option value="{{ $singleClassData->id }}" {{ $singleClassData->id == $classId ? 'selected' : '' }}>{{ $singleClassData->class_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col m3  s12">
                            <div class="input-field">
                                <select class="select2 browser-default" name="section_id" id="section_id"
                                    data-placeholder="Select Section" required>
                                    <option value="#" selected disabled>Select Section</option>
                                    @foreach($sectionData as $singleSectionData)
                                        @if(isset($singleSectionData) && $singleSectionData != null)
                                            <option value="{{ $singleSectionData->id }}" {{ $singleSectionData->id == $sectionId ? 'selected' : '' }}>
                                                {{ $singleSectionData->section_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col m3  s12">
                            <div class="input-field">
                                <select class="select2 browser-default" name="student_id" id="student_id"
                                    data-placeholder="Select Student" required>
                                    @foreach($studentData as $singleStudentData)
                                        @if(isset($singleStudentData) && $singleStudentData != null)
                                            <option value="{{ $singleStudentData->id }}" {{ $singleStudentData->id == $studentId ? 'selected' : '' }}>
                                                {{ $singleStudentData->student_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col m3  s12 custom-text-center">
                            <button class="mb-6 btn waves-effect waves-light purple lightrn-1" type="submit">
                                <i class="material-icons">search</i>
                                <span>Filter</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <!-- Account settings -->
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

                                                    @if(isset($singleStudentData->student_photo) && $singleStudentData->student_photo !=
                                                    null)
                                                    <img src="{{ asset('/uploads/student_photo/'.$singleStudentData->student_photo) }}"
                                                        width="75" height="65">
                                                    @else
                                                    @if($singleStudentData->gender == 'male')
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
                                                        class="custom-student-account-profile-content">{{$singleStudentData->student_name}}</span>
                                                </p>

                                                <p>
                                                    <i class="material-icons profile-card-i">format_list_numbered</i>
                                                    <span
                                                        class="custom-student-account-profile-content">{{$singleStudentData->roll_no}}</span>
                                                </p>

                                                <p>
                                                    <i class="material-icons profile-card-i">call</i>
                                                    <span
                                                        class="custom-student-account-profile-content">{{$singleStudentData->student_phone}}</span>
                                                </p>


                                                <p><i class="material-icons profile-card-i">import_contacts</i>
                                                    <span class="custom-student-account-profile-content">
                                                        {{$singleStudentData->classData->class_name}} <span
                                                            class="custom-text-info">( @if($singleStudentData->section_id)
                                                            {{$singleStudentData->sectionData->section_name}} @else @endif )
                                                        </span>
                                                    </span>
                                                </p>
                                                <p>
                                                    <i class="material-icons profile-card-i">email</i>
                                                    <span
                                                        class="custom-student-account-profile-content">{{$singleStudentData->student_email}}</span>
                                                </p>
                                                <p><i class="material-icons profile-card-i">person_outline</i>
                                                    <span class="custom-student-account-profile-content">
                                                        {{Str::title($singleStudentData->gender)}} <span
                                                            class="custom-text-info">({{$singleStudentData->blood_group}})</span>
                                                    </span>
                                                </p>
                                                <p><i class="material-icons profile-card-i">eject</i>
                                                    <span class="custom-student-account-profile-content">
                                                        {{$singleStudentData->religion}}
                                                    </span>
                                                </p>
                                                <p>
                                                    <i class="material-icons profile-card-i">directions</i>
                                                    <span
                                                        class="custom-student-account-profile-content">{{$singleStudentData->address}}</span>
                                                </p>

                                              

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('student.edit',$singleStudentData->id) }}" class="btn waves-effect waves-light purple lightrn-1 " >edit</a>
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
                                            <a class="display-flex align-items-center active" id="account-tab" href="#studentPayment">
                                                <i class="material-icons mr-1">person_outline</i><span>Student Payment</span>
                                            </a>
                                        </li>
                                        <li class="tab">
                                            <a class="display-flex align-items-center" id="information-tab" href="#paymentHistory">
                                                <i class="material-icons mr-2">error_outline</i><span>Pyment History</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="divider mb-1"></div>
                                    <div class="row">
                                        <div class="col s12" id="studentPayment">

                                                <div class="row">
                                                    <div class="col s12">
                                                        <table class="custom-user-payment-section mt-2 custom-table custom-data-table dt-responsive nowrap table-responsive mt-1">
                                                            <thead>
                                                                <tr>
                                                                    <th class="custom-sl-no">#</th>
                                                                    <th class="custom-user-fees-name">Fees Name</th>
                                                                    <th class="custom-user-fees-name">Fees Amount</th>
                                                                    <th class="custom-user-fees-name">Status</th>
                                                                    <th class="custom-user-fees-name">Payment Date</th>
                                                                    <th class="custom-user-fees-name">Payment Time</th>
                                                                    <th class="custom-user-fees">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                               
                                                                @foreach($studentFeesAssignData as $key=>$item)
                                                                    @if(isset($item) && $item != null)
                                                                        
                                                                        <tr>
                                                                            <td>{{ $key+1 }}</td>
                                                                            <td>{{ $item->feesTypeData->fees_type }}</td>

                                                                            <td>
                                                                                {{ $item->fees_amount }}tk
                                                                                <input type="hidden" id="feesAmount{{$item->id}}"
                                                                                 value="{{ $item->fees_amount }}">
                                                                            </td>

                                                                            <td>
                                                                                @if($item->status != true)
                                                                                 Unpaid
                                                                                @else
                                                                                 Paid
                                                                                @endif

                                                                            </td>
                                                                            
                                                                            <td>{{ $item->created_at->toDateString() }}</td>
                                                                            <td>{{ $item->created_at->toTimeString() }}</td>

                                                                            <td>
                                                                                <a href="#modal1{{$item->id}}" class="modal-trigger">Payment</a>
                                                                            </td>

                                                                            



                                                                        <div id="modal1{{$item->id}}" class="modal modal-fixed-footer custom-lg-modal custom-lg-modal-css">

                                                                              <form class="col s12" method="post" action="{{route('payment-of-student.add')}}">
                                                                                @method('post')
                                                                                @csrf

                                                                                 {{-- To get all the basic information... --}}
                                                                                <input type="hidden" name="user_id" value="{{ $singleStudentData->user_id }}">
                                                                                <input type="hidden" name="class_id" value="{{ $classId }}">
                                                                                <input type="hidden" name="section_id" value="{{ $sectionId }}">
                                                                                <input type="hidden" name="student_id" value="{{ $studentId }}">
                                                                                <input type="hidden" name="invoice_id" value="{{ $invoiceNumber }}">
                                                                                <input type="hidden" name="date" value="{{ $todayDate }}">
                                                                                <input type="hidden" name="student_assign_id" value="{{ $item->id }}">
                                                                

                                                                                <div class="modal-dialog" role="document">

                                                                                  <div class="modal-content">
                                                                                    <h4 class="modal-title" id="exampleModalLabel">Student Payment</h4>
                                                                                    <hr>

                                                                                    <div class="row">
                                                                                      <div class="container">
                                                                                       
                                                                                          <div class="input-field col s12 m12">
                                                                                            <input id="feesAmount{{$item->id}}" type="text" class="validate" name="fees_amount" required
                                                                                              value="{{ $item->fees_amount }}" disabled>
                                                                                            <label for="fees">Fees  <span class="custom-text-danger">*</span> </label>
                                                                                          </div>


                                                                                          <div class="input-field col s12 m6">
                                                                                           @if($item->status != true)
                                                                                            <input type="text" name="paid_amount"
                                                                                            placeholder="Paid Amount" value="0.00" id="paid_amount{{ $item->id }}" 
                                                                                            onblur="updatePaidAmount({{$item->id}})"/>
                                                                                            @else
                                                                                            <input  type="text" placeholder="Paid" value="Paid" readonly />
                                                                                            @endif

                                                                                            <label for="fees">Payment <span class="custom-text-danger">*</span> </label>
                                                                                        </div>


                                                                                        <div class="input-field col s12 m6">
                                                                                           @if($item->status != true)
                                                                                                <input type="text" name="fine_amount"
                                                                                                placeholder="Fine Amount" value="0.00" id="fine_amount{{ $item->id }}" 
                                                                                                onblur="updateFineAmount({{$item->id}})"/>
                                                                                            @else
                                                                                            <input  type="text" placeholder="" value="" readonly />
                                                                                             @endif

                                                                                             <label for="fees">Fine  <span class="custom-text-danger">*</span> </label>
                                                                                        </div>


                                                                                        <div class="input-field col s12 m12">
                                                                                           @if($item->status != true)
                                                                                            
                                                                                            <input type="number" id="stdentFeesTotalAmount{{$item->id}}" 
                                                                                            value="0.00" disabled>

                                                                                            <input type="hidden" name="total_amount" id="stdentFeesTotalAmountInput{{$item->id}}" 
                                                                                            value="0.00">

                                                                                            @else
                                                                                            <input  type="text" placeholder="" value="" readonly />

                                                                                            @endif

                                                                                        <label for="fees">Total  <span class="custom-text-danger">*</span> </label>
                                                                                        </div>


                                                                                    <div class="input-field col s12 m6">
                                                                                        @if($item->status != true)
                                                                                        @if($item->due_amount != null)

                                                                                        <input type="text" id="stdentFeesDueAmount{{$item->id}}"
                                                                                            value="{{ $item->due_amount }}" disabled>

                                                                                        <input type="hidden" name="due_amount" id="stdentFeesDueAmountInput{{$item->id}}"
                                                                                            value="{{ $item->due_amount }}">
                                                                                        
                                                                                        <input type="hidden" name="due_amount" id="stdentFeesDueAmountInputOriginal{{$item->id}}"
                                                                                            value="{{ $item->due_amount }}">
                                                                                    @else
                                                                                      
                                                                                        <input type="text" id="stdentFeesDueAmount{{$item->id}}"
                                                                                            value="{{ $item->fees_amount }}" disabled>


                                                                                        <input type="hidden" name="due_amount" id="stdentFeesDueAmountInput{{$item->id}}"
                                                                                            value="{{ $item->fees_amount }}">
                                                                                        @endif

                                                                                        @else
                                                                                            <input  type="text" placeholder="" value="" readonly />

                                                                                        @endif

                                                                                        <label for="fees">Due <span class="custom-text-danger">*</span> </label>
                                                                                    </div>


                                                                                    <div class="input-field col s12 m6">
                                                                                            @if($item->status != true)
                                                                                           
                                                                                            <input type="text" id="stdentFeesChangeAmount{{$item->id}}"
                                                                                            value="0.00" disabled>

                                                                                            <input type="hidden" name="change_amount" id="stdentFeesChangeAmountInput{{$item->id}}" value="0.00">

                                                                                            @else
                                                                                            <input  type="text" placeholder="" value="" readonly />

                                                                                            @endif

                                                                                             <label for="fees">Change <span class="custom-text-danger">*</span> </label>
                                                                                        </div>
                                                                      
                                                                                      </div>

                                                                                    </div>
                                                                                  </div>

                                                                                  <div class="modal-footer">
                                                                                    <button class="mb-6 modal-action modal-close waves-effect waves-red btn-flat" type="button"
                                                                                      class="close" data-dismiss="modal">
                                                                                      Close
                                                                                    </button>

                                                                                    <button class="mb-6 btn waves-effect waves-light purple lightrn-1" type="submit">
                                                                                      Payment
                                                                                    </button>
                                                                                  </div>

                                                                                </div>
                                                                            </form>

                                                                            </div>


                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        <!-- </div> -->
                                                    </div>
                                                
                                                </div>
                                            <!-- users edit account form ends -->
                                        </div>


                                        {{-- Student Payment History Section Start.... --}}
                                        <div class="col s12" id="paymentHistory" class="">
                                            <div class="card-content-datatable table-responsive">
                                                <table id="studentPaymentHistory"
                                                    class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">
                                            
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
                                            
                                                        @foreach($stdentPaymentData as $key=>$item)
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
                                                                        <a class='dropdown-trigger btn custom-dropdown-btn' href='#' data-target='dropdown{{ $item['id'] }}'>
                                                                            <i class="material-icons float-right">more_vert</i>
                                                                        </a>
                                                                        <!-- Dropdown Structure -->
                                                                        <ul id='dropdown{{ $item['id'] }}' class='dropdown-content custom-dropdown-for-action'>
                                                                            <li>
                                                                                @if(Auth::user()->can('payment-of-student-list'))
                                                                                <a href="{{route('get-student-payment-invoice',$item['id'])}}"><i class="material-icons">print</i>Invoice</a>
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
@include('backend.paymentStudent.partial.script')

<script>
    $( document ).ready(function() {
        $("#student_id").select2();
    });

    $(document).ready(function() {
        $('#studentPaymentHistory').DataTable({
            "responsive": false,
            "searching": true,
            "scrollX": false,
        });
    });
</script>

<script>
    //To update paid amount...
    function updatePaidAmount(id) {
        let paidAmount = parseFloat($("#paid_amount" + id).val());
        let fineAmount = parseFloat($("#fine_amount" + id).val());
        let feesAmount = parseFloat($("#feesAmount" + id).val());
        let dueAmount = parseFloat($("#stdentFeesDueAmountInputOriginal" + id).val());
        
        let totalAmount = paidAmount + fineAmount;

        //To check due amount is greter than zero or not...
        if(dueAmount < feesAmount){
            //To check paid amount for due and change amount...
            if(paidAmount <= dueAmount){ 
                let finalDueAmount = dueAmount - paidAmount; 
                $("#stdentFeesDueAmount" + id).val(finalDueAmount); 
                $("#stdentFeesDueAmountInput" + id).val(finalDueAmount);

                $("#stdentFeesChangeAmount" + id).val(0.00); 
                $("#stdentFeesChangeAmountInput" + id).val(0.00);
            }else{ 
                let finalChangeAmount = paidAmount - dueAmount; 
                $("#stdentFeesChangeAmount" + id).val(finalChangeAmount); 
                $("#stdentFeesChangeAmountInput" + id).val(finalChangeAmount); 

                $("#stdentFeesDueAmount" + id).text(0.00); 
                $("#stdentFeesDueAmountInput" + id).val(0.00);
            }
        }else{
            //To check paid amount for due and change amount...
            if(paidAmount <= feesAmount){ 
                let finalDueAmount = feesAmount - paidAmount; 
                $("#stdentFeesDueAmount" + id).val(finalDueAmount); 
                $("#stdentFeesDueAmountInput" + id).val(finalDueAmount);

                $("#stdentFeesChangeAmount" + id).val(0.00); 
                $("#stdentFeesChangeAmountInput" + id).val(0.00);
            }else{ 
                let finalChangeAmount = paidAmount - feesAmount; 
                $("#stdentFeesChangeAmount" + id).val(finalChangeAmount); 
                $("#stdentFeesChangeAmountInput" + id).val(finalChangeAmount); 

                $("#stdentFeesDueAmount" + id).val(0.00); 
                $("#stdentFeesDueAmountInput" + id).val(0.00);
            }
        }
        

        $("#stdentFeesTotalAmount" + id).val(totalAmount); 
        $("#stdentFeesTotalAmountInput" + id).val(totalAmount); 
    }

    function updateFineAmount(id) {
        let paidAmount = parseFloat($("#paid_amount" + id).val());
        let fineAmount = parseFloat($("#fine_amount" + id).val());
        let feesAmount = parseFloat($("#feesAmount" + id).val());
        let dueAmount = parseFloat($("#stdentFeesDueAmountInputOriginal" + id).val());
        
        let totalAmount = paidAmount + fineAmount;

        //To check due amount is greter than zero or not...
        if(dueAmount < feesAmount){
            //To check paid amount for due and change amount...
            if(paidAmount <= dueAmount){ 
                let finalDueAmount = dueAmount - paidAmount; 
                $("#stdentFeesDueAmount" + id).val(finalDueAmount); 
                $("#stdentFeesDueAmountInput" + id).val(finalDueAmount);

                $("#stdentFeesChangeAmount" + id).val(0.00); 
                $("#stdentFeesChangeAmountInput" + id).val(0.00);
            }else{ 
                let finalChangeAmount = paidAmount - dueAmount; 
                $("#stdentFeesChangeAmount" + id).val(finalChangeAmount); 
                $("#stdentFeesChangeAmountInput" + id).val(finalChangeAmount); 

                $("#stdentFeesDueAmount" + id).val(0.00); 
                $("#stdentFeesDueAmountInput" + id).val(0.00);
            }
        }else{
            //To check paid amount for due and change amount...
            if(paidAmount <= feesAmount){ 
                let finalDueAmount = feesAmount - paidAmount; 
                $("#stdentFeesDueAmount" + id).val(finalDueAmount); 
                $("#stdentFeesDueAmountInput" + id).val(finalDueAmount);

                $("#stdentFeesChangeAmount" + id).val(0.00); 
                $("#stdentFeesChangeAmountInput" + id).val(0.00);
            }else{ 
                let finalChangeAmount = paidAmount - feesAmount; 
                $("#stdentFeesChangeAmount" + id).val(finalChangeAmount); 
                $("#stdentFeesChangeAmountInput" + id).val(finalChangeAmount); 

                $("#stdentFeesDueAmount" + id).val(0.00); 
                $("#stdentFeesDueAmountInput" + id).val(0.00);
            }
        } 

        $("#stdentFeesTotalAmount" + id).val(totalAmount); 
        $("#stdentFeesTotalAmountInput" + id).val(totalAmount);
    }
</script>
@endsection