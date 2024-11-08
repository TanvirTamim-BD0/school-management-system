@extends('backend.master')
@section('content')
@section('title') Book Issue Invoice @endsection
@section('make-payment') active @endsection
@section('make-payment-for-teacher') active @endsection
@section('styles')
<style>
    @media print {
        .custom-page-header{
            display: none;
        }
        .page-footer{
            display: none;
        }
        .sidenav-main {
            display: none;
        }
        .gradient-45deg-indigo-purple{
            background: transparent !important;
        }
        #main{
            padding-left: 0px;
        }

        .media-normal-print-section {
            display: none !important;
        }
        
        .media-print-section {
            display: block !important;
        }

        .invoice-logo-title{
            width: 100%;
        }
       
        .invoice-logo-title{
            width: 100%;
        }

        .custom-col-6-left{
            text-align: left !important;
        }
        
        .custom-col-6-right{
            text-align: right !important;
        }

        .divider {
            margin-top: 50px !important;
            /* overflow: hidden !important; */
            height: 1px !important;
            background-color: #e0e0e0 !important;
        }

        .custom-invoice-left{
            top: -30px !important;
        }
        
        .custom-invoice-left span{
            position: absolute !important;
            margin-top: -10px !important;
        }
        
        .custom-invoice-right img{
            position: absolute !important;
            right: 0px !important;
            top: 0px !important;
        }

        .media-print-normal-date-section {
            display: none !important;
        }
        
        .media-print-date-section{
            display: block !important;
            position: absolute !important;
            right: 0px !important;
            top: 1px !important;
        }

        .invoice-info {
            margin-top: 30px !important;
        }
        
        .invoice-info .invoice-address {
            margin: 3px !important;
        }

        .custom-invoice-subtotal p{
            top: 100% !important;
        }

        .custom-invoice-form {
            margin-top: 20px !important;
        }

        .invoice-product-details {
            margin-top: 130px !important;
        }
    }
</style>
@endsection

@section('content')

<div class="row">

    <!-- app invoice View Page -->
    <section class="invoice-view-wrapper section">
        <div class="row">
            <!-- invoice view page -->
            <div class="col xl12 m12 s12" style="">
                <div class="card">
                    <div class="card-content invoice-print-area">
                        <!-- header section -->
                        <div class="row invoice-date-number">
                            
                            <div class="col xl8 s12">
                                <div class="invoice-date display-flex align-items-center flex-wrap">
                        
                                    <div class="media-print-date-section">
                                        <small>Today Date:</small>
                                        <span>{{Carbon\Carbon::createFromFormat('Y-m-d', $invoiceData['date'])->format('d-m-Y')}}</span>
                                    </div>
                        
                                    <div class="media-print-normal-date-section">
                                        <small>Today Date:</small>
                                        <span>{{Carbon\Carbon::createFromFormat('Y-m-d', $invoiceData['date'])->format('d-m-Y')}}</span>
                                    </div>
                        
                                </div>
                            </div>
                        </div>
                        <!-- logo and title -->
                        {{-- For media print header section to show after window.load.print call... --}}
                        <div class="row mt-3 invoice-logo-title media-print-section">
                            <div class="col m6 s12 custom-invoice-left pull-m6">
                                <h4 class="indigo-text">Invoice</h4>
                                <span>{{$invoiceData['name']}}</span>
                            </div>
                            <div class="col m6 s12 custom-invoice-right display-flex invoice-logo mt-1 push-m6">
                        
                                @if(isset($invoiceData['school_logo']) && $invoiceData['school_logo'] != null)
                                <img src="{{ asset('/uploads/logo_image/'.$invoiceData['school_logo']) }}" alt="logo" height="46" width="164">
                                @else
                                <img src="{{ asset('uploads/logo_image/default/logo.png') }}" alt="logo" height="46" width="164">
                                @endif
                        
                            </div>
                        
                        </div>
                        
                        {{-- For normally media print header section to show... --}}
                        <div class="row mt-3 invoice-logo-title media-normal-print-section">
                            <div class="col m6 s12 custom-col-6-left display-flex invoice-logo mt-1 push-m6">
                        
                                @if(isset($invoiceData['school_logo']) && $invoiceData['school_logo'] != null)
                                <img src="{{ asset('/uploads/logo_image/'.$invoiceData['school_logo']) }}" alt="logo" height="46" width="164">
                                @else
                                <img src="{{ asset('uploads/logo_image/default/logo.png') }}" alt="logo" height="46" width="164">
                                @endif
                        
                            </div>
                            <div class="col m6 s12 custom-col-6-right pull-m6">
                                <h4 class="indigo-text">Invoice</h4>
                                <span>{{$invoiceData['name']}}</span>
                            </div>
                        </div>
                        <div class="divider mb-3 mt-3"></div>
                        <!-- invoice address and contact -->
                       

                        <div class="divider mb-3 mt-3"></div>
                        <!-- product details table-->
                        <div class="invoice-product-details">
                            <table class="striped responsive-table custom-text-center custom-border-invoice-table">
                                <thead class="bg-light custom-bg-light">
                                    <tr>
                                        <th class="custom-border-right text-center">#</th>
						                <th class="custom-border-right text-center">Student</th>
						                <th class="custom-border-right text-center">Book</th>
						                <th class="custom-border-right text-center">Start Date</th>
						                <th class="custom-border-right text-center">End Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($studentBookIssueData as $studentBookIssue)
						              <tr>
						                <td>{{ $loop->iteration }}</td>
						                <td>{{$studentBookIssue->studentData->student_name}}</td>
						                <td>{{$studentBookIssue->LibraryBookData->subject_name}}</td>
						                <td>{{$studentBookIssue->start_date}}</td>
						                <td>{{$studentBookIssue->end_date}}</td>

						              </tr>
						             @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="divider mt-10 mb-3"></div>
                        <div class="invoice-subtotal custom-invoice-subtotal">
                            <div class="row">
                                <div class="col m5 s12">
                                    <p class="mb-5">Thanks for your business. <span class="custom-text-info">{{$invoiceData['name']}}</span></p>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
            <!-- invoice action  -->
        </div>
    </section><!-- START RIGHT SIDEBAR NAV -->

</div>

@endsection
@section('scripts')
<script>
    $( document ).ready(function() {
        $(function () {
            'use strict';
            window.print();
        });
    });

    
</script>
@endsection