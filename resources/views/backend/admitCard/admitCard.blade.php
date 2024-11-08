@extends('backend.master')
@section('content')
@section('title') Admit Card @endsection
@section('admit-card') Admit Card @endsection
@section('admit-card') active @endsection
@section('styles')
<style>
    .card{
        max-width: 90%;
        margin: auto;
    }
      .section {
        max-width: 100%;
        margin: auto;
      }

      .section--background {
        position: relative;
        background: white;
        padding: 2rem 2rem;
      }

      .section--background::before {
        content: "";
        position: absolute;
        top: -1rem;
        left: -1rem;
        right: -1rem;
        display: block;
        background-color: #ffffff;
        background-image: linear-gradient(45deg, transparent 49%, #aaaaff 50%, transparent 51%);
        background-size: 5px 5px;
        right: -1rem;
        bottom: -1rem;
        z-index: -1;
      }

      .section--border {
        padding: 2rem 2rem;
        border: 1rem solid #aaaaff;
        -o-border-image: repeating-linear-gradient(50deg, transparent, transparent 5px, #aaaaff 6px, #aaaaff 15px, transparent 16px, transparent 20px) 20/1rem;
           border-image: repeating-linear-gradient(50deg, transparent, transparent 5px, #aaaaff 6px, #aaaaff 15px, transparent 16px, transparent 20px) 20/1rem;
      }

      .head-name .school{
        font-size: 22px;
        font-weight: bold;
      }

      .head-name .admit{
        font-size: 18px;
        font-weight: bold;
      }

      .head-name p{
        font-size: 17px;
      }

      .table-first td{
        font-size: 15px;
        padding: 10px;
      }

      .table-first td b{
        font-size: 16px;
        font-weight: 900;
      }

      .table-second{
        width: 100%;
      }

      .table-second thead{
        width: 100%;
      }

      .table-second tbody{
        width: 100%;
      }

      .table-second th{
        font-size: 16px;
        font-weight: bold;
      }

      .table-second td{
        font-size: 16px;
        padding: 8px;
      }

      .button-print{
        margin-right: 20px;
        margin-top: -100px;
      }

    .print-conatiner,
    .print-conatiner * {
      visibility: visible;
    }

    .signature{
      margin-top: -5px !important;
    }

    .signature p{
       margin-left: 25px !important;
    } 
    
</style>


@endsection
@section('content')

  <div class="breadcrumbs-dark pb-0 pt-4 mb-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Admit Card</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Admit Card</a>
            </li>
            <li class="breadcrumb-item active">Admit Card
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

    <div class="float-right ">
        <form class="col s12" method="post" action="{{route('admit-card-invoice')}}" enctype="multipart/form-data">
        @csrf
          <button class="btn btn-primary button-print">Print</button>
       </form>
      </div>

  <div class="print-conatiner">

  <div class="card">
      <div class="card-content">
        <div class="section section--border">
            <div class="heading text-center head-name mb-2">
                  <h6 class="school">{{$invoiceData['name']}}</h6>
                  <p class="mb-1">{{$invoiceData['address']}}</p>
                  <img src="{{ asset('backend/app-assets/images/user/img_avatar.png') }}" width="85" height="90"> 
                  <h6 class="admit">ADMIT CARD YEAR FINAL EXAMINATION- 2023</h6>          
            </div>
            <div class="content">
              <div class="row mb-1">
                <div class="col m8">
                  <table class="striped table-first">

                    <tr>
                      <td><b>Student Name:</b>  Jhon Due</td>
                      <td><b>Exam Name:</b> Final Exam</td>
                    </tr>

                    <tr>
                      <td><b>Father Name: </b> Albert Sing</td>
                      <td><b>Class:</b> 10</td>
                    </tr>

                    <tr>
                      <td><b>Mother Name:</b> Manika Sing</td>
                      <td><b>Section:</b> A</td>
                    </tr>

                    <tr>
                      <td><b>Registration:</b> 111634482084</td>
                      <td><b>Roll:</b> 20231001</td>
                    </tr>

                  </table>
                </div>
              </div>

              <div class="row">
                <div class="col m12">

                  <table class="striped table-second">
                    <thead>
                      <tr>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Hall Room</th>
                        </tr>
                    </thead>

                    <tbody>

                      <tr>
                        <td>Bangla</td>
                        <td>27-08-2023</td>
                        <td>10:00 AM</td>
                        <td>101</td>
                      </tr>

                      <tr>
                        <td>Bangla</td>
                        <td>27-08-2023</td>
                        <td>10:00 AM</td>
                        <td>101</td>
                      </tr>

                      <tr>
                        <td>Bangla</td>
                        <td>27-08-2023</td>
                        <td>10:00 AM</td>
                        <td>101</td>
                      </tr>

                      <tr>
                        <td>Bangla</td>
                        <td>27-08-2023</td>
                        <td>10:00 AM</td>
                        <td>101</td>
                      </tr>

                      <tr>
                        <td>Bangla</td>
                        <td>27-08-2023</td>
                        <td>10:00 AM</td>
                        <td>101</td>
                      </tr>

                      <tr>
                        <td>Bangla</td>
                        <td>27-08-2023</td>
                        <td>10:00 AM</td>
                        <td>101</td>
                      </tr>

                      <tr>
                        <td>Bangla</td>
                        <td>27-08-2023</td>
                        <td>10:00 AM</td>
                        <td>101</td>
                      </tr>

                      <tr>
                        <td>Bangla</td>
                        <td>27-08-2023</td>
                        <td>10:00 AM</td>
                        <td>101</td>
                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>

            </div>

            <div class="row mt-7">
              <div class="col m9">
                <p>Date of Published Admit Card : 23 September 2023</p>
              </div>

              <div class="col m3 signature">
                <hr>
                <p>Principle Signature</p>
              </div>
            </div>
        </div>
      </div>
  </div>
</div>


          

@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      $('#sectionTable').DataTable({
        "responsive": false,
        "searching": true,
        "scrollX": false,
      });
    });
  </script>
@endsection

                                                                    
