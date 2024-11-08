@extends('backend.master')
@section('content')
@section('title') Student Book Issue @endsection
@section('bookIssue') active @endsection
@section('bookIssue.index') active @endsection
@section('styles')
@endsection
@section('content')

<div class="row">

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Student Book Issue</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Student Book Issue
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col s12">

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
                                                <div class="col s3 media-image">

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
                                                <div class="col s9 ml-10 custom-profile-data-15 pad">
                                                    <p class="m-0 subtitle font-weight-700">{{ $student->student_name }}
                                                        <br> {{ $student->roll_no }}</p>
                                                    <p class="m-0 text-muted">{{ $student->student_phone }}</p>
                                                </div>


                                            </div>

                                            <div class="card-content custom-student-account-profile mt-10">
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

                        <a href="{{ route('student.edit',$student->id) }}" class="btn waves-effect waves-light purple lightrn-1 editbutton">edit</a>
                        
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
                      <a class="display-flex align-items-center active" id="account-tab" href="#bookIssue">
                        <i class="material-icons mr-1">menu_book</i><span>Book Issue</span>
                      </a>
                    </li>

                    <li class="tab">
                      <a class="display-flex align-items-center" id="information-tab" href="#bookIssueHistory">
                        <i class="material-icons mr-2">error_outline</i><span>Book Issue History</span>
                      </a>
                    </li>
                  </ul>
                  <div class="divider mb-1"></div>
                  <div class="row">


                    <div class="col s12" id="bookIssue" class="">

                      <form class="col s12" method="post" action="{{route('bookIssue.store')}}">
                        @csrf
                        <div class="row">

                          <input id="student_id" type="hidden" class="validate" name="student_id"
                            value="{{$student->id}}">

                          <div class="input-field col s12 m12">
                            <select class="select2 browser-default" name="library_book_id" id="library_book_id"
                              required>
                              <option value="" disabled selected>Select Library Book <span
                                  class="custom-text-danger">*</span></option>
                              @foreach($libraryBookData as $libraryBook)
                              <option value="{{$libraryBook->id}}" class="left circle">{{$libraryBook->subject_name}} -
                                {{$libraryBook->subject_code}} / qty - {{$libraryBook->quantity}}</option>
                              @endforeach

                            </select>

                            @error('student_id')
                            <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                            @enderror

                          </div>


                          <div class="input-field col s12 m6">
                            <input id="start_date" type="text" class="datepicker" name="start_date" required>
                            <label for="start_date">Issue Date <span class="custom-text-danger">*</span></label>

                            @error('start_date')
                            <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                            @enderror
                          </div>


                          <div class="input-field col s12 m6">
                            <input id="end_date" type="text" class="datepicker" name="end_date" required>
                            <label for="end_date">Return Date <span class="custom-text-danger">*</span></label>

                            @error('end_date')
                            <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                            @enderror
                          </div>


                          <div class="input-field col s12 m12">
                            <input id="note" type="text" class="validate" name="note">
                            <label for="note">Note</label>

                            @error('note')
                            <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                            @enderror
                          </div>



                          <div class="col s12 mb-3">
                            <button class="mb-6 btn waves-effect waves-light purple lightrn-1" type="submit">
                              Submit
                            </button>
                          </div>

                        </div>

                      </form>

                    </div>


                    <div class="col s12" id="bookIssueHistory" class="">
                      <table id="bookIssueHistoryee"
                        class="display custom-table custom-data-table custom-table-border dt-responsive nowrap table-responsive">
                        <thead>
                          <tr>
                            <th class="custom-border-right">Book</th>
                            <th class="custom-border-right">Start Date</th>
                            <th class="custom-border-right">End Date</th>
                            <th class="custom-border-right">Note</th>
                            <th class="custom-border-right">Status</th>
                            <th class="custom-border-right">Action</th>
                          </tr>
                        </thead>

                        <tbody>
                          @foreach($studentBookIssueData as $studentBookIssue)
                          <tr>
                            <td>{{$studentBookIssue->LibraryBookData->subject_name}}</td>
                           <td>
                                {{Carbon\Carbon::createFromFormat('Y-m-d', $studentBookIssue->start_date)->format('d-m-Y')}}
                            </td>
                            <td>
                                {{Carbon\Carbon::createFromFormat('Y-m-d', $studentBookIssue->end_date)->format('d-m-Y')}}
                            </td>
                            <td>{{$studentBookIssue->note}}</td>
                            <td>
                              @if($studentBookIssue->status == 1)
                              <span style="color: green;">Return</span>
                              @else
                              <span style="color: red;">Pending</span>
                              @endif
                            </td>

                            <td class="text-center">
                              <!-- Dropdown Trigger -->
                              <a class='dropdown-trigger btn custom-dropdown-btn' href='#'
                                data-target='dropdown1{{$studentBookIssue->id}}'>
                                <i class="material-icons float-right">more_vert</i>
                              </a>
                              <!-- Dropdown Structure -->
                              <ul id='dropdown1{{$studentBookIssue->id}}'
                                class='dropdown-content custom-dropdown-for-action'>
                                <li>
                                  <a href="{{ route('book.return',$studentBookIssue->id) }}"><i
                                      class="material-icons">keyboard_return</i>Return</a>

                                  <a href="#modal1{{$studentBookIssue->id}}" class="modal-trigger"><i
                                      class="material-icons">edit2</i>Edit</a>
                                </li>

                              </ul>


                              <!-- Modal Structure -->
                              <div id="modal1{{$studentBookIssue->id}}" class="modal modal-fixed-footer">
                                <div class="modal-content">
                                  <h4>Edit Book Issue</h4>
                                  @php

                                  $start_date = \Carbon\Carbon::createFromFormat('Y-m-d',
                                  $studentBookIssue->start_date)->format('d/m/Y');

                                  $end_date = \Carbon\Carbon::createFromFormat('Y-m-d',
                                  $studentBookIssue->end_date)->format('d/m/Y');

                                  @endphp

                                  <form class="col s12" method="post"
                                    action="{{route('book-issue-update',$studentBookIssue->id)}}">
                                    @csrf
                                    <div class="row">

                                      <div class="input-field col s12 m12">
                                        <select class="" name="library_book" id="library_book" required>
                                          <option value="" disabled selected>Select Library Book</option>
                                          @foreach($libraryBookData as $libraryBook)
                                          <option value="{{$libraryBook->id}}" class="left circle"
                                            {{ $libraryBook->id == $studentBookIssue->library_book_id ? 'selected' : '' }}>
                                            {{$libraryBook->subject_name}} - {{$libraryBook->subject_code}} qty -
                                            {{$libraryBook->quantity}}</option>
                                          @endforeach

                                        </select>

                                        @error('library_book')
                                        <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                                        @enderror

                                      </div>


                                      <div class="input-field col s12 m6">
                                        <input id="start_date_1" type="text" class="datepicker" name="start_date_1"
                                          value="{{$start_date}}" required>
                                        <label for="start_date_1">Start Date</label>

                                        @error('start_date_1')
                                        <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                                        @enderror
                                      </div>


                                      <div class="input-field col s12 m6">
                                        <input id="end_date_1" type="text" class="datepicker" name="end_date_1"
                                          value="{{$end_date}}" required>
                                        <label for="end_date_1">End Date</label>

                                        @error('end_date_1')
                                        <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                                        @enderror
                                      </div>


                                      <div class="input-field col s12 m12">
                                        <input id="note_1" type="text" class="validate" name="note_1"
                                          value="{{$studentBookIssue->note}}">
                                        <label for="note_1">Note</label>

                                        @error('note_1')
                                        <span class="custom-text-danger custom-text-danger-position">{{$message}}</span>
                                        @enderror
                                      </div>


                                      <div class="col s12 mb-3">
                                        <button class="mb-6 btn waves-effect waves-light purple lightrn-1"
                                          type="submit">
                                          Submit
                                        </button>
                                      </div>

                                    </div>

                                  </form>
                                </div>

                              </div>


                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
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