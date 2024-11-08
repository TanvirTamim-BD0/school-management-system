@extends('backend.master')
@section('content')
@section('styles')
@endsection

  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Dasboard</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Dasboard
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

<div class="col s12">
   <div class="container">
      <div class="section">
         <!-- Current balance & total transactions cards-->
         <div class="row vertical-modern-dashboard">
            @can('student-count-view')
            <div class="c-dashboardInfo col s12 m3 l3">
               <div class="wrap">
                  <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Student</h4><span
                     class="hind-font caption-12 c-dashboardInfo__count">{{$student}}</span>
               </div>
            </div>
            @endcan

            @can('teacher-count-view')
            <div class="c-dashboardInfo col s12 m3 l3">
               <div class="wrap">
                  <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Teacher</h4><span
                     class="hind-font caption-12 c-dashboardInfo__count">{{$teacher}}</span>
               </div>
            </div>
            @endcan

            @can('guardian-count-view')
            <div class="c-dashboardInfo col s12 m3 l3">
               <div class="wrap">
                  <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Guardian</h4><span
                     class="hind-font caption-12 c-dashboardInfo__count">{{$guardian}}</span>
               </div>
            </div>
            @endcan

            @can('class-count-view')
            <div class="c-dashboardInfo col s12 m3 l3">
               <div class="wrap">
                  <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Class</h4><span
                     class="hind-font caption-12 c-dashboardInfo__count">{{$class}}</span>
               </div>
            </div>
            @endcan


            @php
               if(Auth::user()->role == 'student'){
                  $data = App\Models\Student::getSingleStudent(Auth::user()->mobile);
               }else{
                  $data = App\Models\Guardian::getSingleGurdian(Auth::user()->mobile);
               }

               $teacherData = App\Models\Teacher::getSingleTeacher(Auth::user()->mobile);
               $accountentData = App\Models\Accountent::getSingleAccountent(Auth::user()->mobile);
               $librarianData = App\Models\Librarian::getSingleLibrarian(Auth::user()->mobile);
            @endphp



         <!-- student and gurdian dashbaord...... -->
         @if(Auth::user()->role == 'student' || Auth::user()->role == 'guardian')

            @if(Auth::user()->role == 'student')
            <div class="c-dashboardInfo col s12 m6 l3">
               <div class="wrap">
                  <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><a href="{{route('student-profile',$data->id)}}">Attendence History</a></h4>
               </div>
            </div>

            <div class="c-dashboardInfo col s12 m6 l3">
                  <div class="wrap">
                     <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><a href="{{route('student-profile',$data->id)}}">Payment History</a></h4>
                  </div>
               </div>


            <div class="c-dashboardInfo col s12 m6 l3">
                  <div class="wrap">
                     <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><a href="{{route('student-class-rutine',$data->id)}}">Class Rutine</a></h4>
                  </div>
               </div>

            @else
            <div class="c-dashboardInfo col s12 m6 l3">
               <div class="wrap">
                  <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><a href="{{route('student-profile',$data->student_id)}}">Attendence History</a></h4>
               </div>
            </div>

            <div class="c-dashboardInfo col s12 m6 l3">
                  <div class="wrap">
                     <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><a href="{{route('student-profile',$data->student_id)}}">Payment History</a></h4>
                  </div>
               </div>


             <div class="c-dashboardInfo col s12 m6 l3">
                  <div class="wrap">
                     <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><a href="{{route('student-class-rutine',$data->student_id)}}">Class Rutine</a></h4>
                  </div>
               </div>

            @endif
         @endif


         <!-- teacher dashbaord...... -->
         @if(Auth::user()->role == 'teacher')
            <div class="c-dashboardInfo col s12 m6 l4">
               <div class="wrap">
                  <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><a href="{{route('teacher-profile',$teacherData->id)}}">Attendence History</a></h4>
               </div>
            </div>

            <div class="c-dashboardInfo col s12 m6 l4">
                  <div class="wrap">
                     <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><a href="{{route('teacher-profile',$teacherData->id)}}">Payment History</a></h4>
                  </div>
               </div>
         @endif


         <!-- accountent dashbaord...... -->
         @if(Auth::user()->role == 'accountent')
            <div class="c-dashboardInfo col s12 m6 l4">
               <div class="wrap">
                  <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><a href="{{route('accountent-profile',$accountentData->id)}}">Attendence History</a></h4>
               </div>
            </div>

            <div class="c-dashboardInfo col s12 m6 l4">
                  <div class="wrap">
                     <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><a href="{{route('accountent-profile',$accountentData->id)}}">Payment History</a></h4>
                  </div>
               </div>
         @endif


         <!-- librarian dashbaord...... -->
         @if(Auth::user()->role == 'librarian')
            <div class="c-dashboardInfo col s12 m6 l4">
               <div class="wrap">
                  <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><a href="{{route('librarian-profile',$librarianData->id)}}">Attendence History</a></h4>
               </div>
            </div>

            <div class="c-dashboardInfo col s12 m6 l4">
                  <div class="wrap">
                     <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><a href="{{route('librarian-profile',$librarianData->id)}}">Payment History</a></h4>
                  </div>
               </div>

         @endif


         @can('upcoming-notice')
            <div class="c-dashboardInfo col s12 m6 l3">
               <div class="wrap">
                  <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><a href="{{route('upComing-notice',)}}">Notice</a></h4>
               </div>
            </div>
         @endcan

         
         </div>


      </div>
   </div>
</div>


<!--work collections start-->
<div id="work-collections">
   <div class="row">

      @can('dashboard-student-book-issue-list')
      <div class="col s12 m12 l6">
         <ul id="projects-collection" class="collection z-depth-1 animate fadeLeft">
            <li class="collection-item avatar">
               <i class="material-icons cyan circle">menu_book</i>
               <h6 class="collection-header m-0">Library Book</h6>
               <p>Books taken from the student library.</p>
            </li>

            @foreach($libararyBookData as $item)
            @if(isset($item) && $item != null)
            <li class="collection-item">
               <div class="row">
                  <div class="col s6">
                     <p class="collections-title">{{$item->LibraryBookData->subject_name}}</p>
                     <p class="collections-content">{{$item->LibraryBookData->subject_code}}</p>
                  </div>

                  <div class="col s3"><span class="task-cat cyan">Start - {{$item->start_date}} <br> End - {{$item->end_date}} </span></div>
                  <div class="col s3"><span class="task-cat red accent-2"><td>
                        @if($item->status == 1)
                          <span class="text-white">Return</span>
                        @else
                          <span class="text-white" >Pending</span>
                        @endif
                    </td>
                 </span></div>

                  <div class="col s3">
                     <div id="project-line-1"></div>
                  </div>
               </div>
            </li>
            @endif
            @endforeach


         </ul>
      </div>
      @endcan


      @can('latest-student-list')
      <div class="col s12 m12 l6">
         <ul id="projects-collection" class="collection z-depth-1 animate fadeLeft">
            <li class="collection-item avatar">
               <i class="material-icons cyan circle">group</i>
               <h6 class="collection-header m-0"> Student</h6>
               <p>New</p>
            </li>
            @foreach($studentData as $item)
            @if(isset($item) && $item != null)
            <li class="collection-item">
               <div class="row">
                  <div class="col s6">
                     <p class="collections-title">{{$item->student_name}}</p>
                     <p class="collections-content">{{$item->addmission_date}}</p>
                  </div>

                  <div class="col s3"><span class="task-cat cyan">{{$item->roll_no}}</span></div>
                  <div class="col s3"><span class="task-cat red accent-2">{{$item->registration_no}}</span></div>

                  <div class="col s3">
                     <div id="project-line-1"></div>
                  </div>
               </div>
            </li>
            @endif
            @endforeach
         </ul>
      </div>
      @endcan


      @can('dashboard-leave-application-list')
      <div class="col s12 m12 l6">
         <ul id="issues-collection" class="collection z-depth-1 animate fadeRight">
            <li class="collection-item avatar">
               <i class="material-icons blue accent-2 circle">move_to_inbox</i>
               <h6 class="collection-header m-0">Leave Application</h6>
            </li>

            @foreach($leaveApplyData as $item)
            @if(isset($item) && $item != null)
            <li class="collection-item">
               <div class="row">
                  <div class="col s3">
                     <p class="collections-title">{{$item->leaveCategoryData->leave_category}}</p>
                  </div>
               
                  <div class="col s3"><span>{{Carbon\Carbon::createFromFormat('Y-m-d', $item->start_date)->format('d-m-Y')}} - {{Carbon\Carbon::createFromFormat('Y-m-d', $item->end_date)->format('d-m-Y')}}</span></div>
                  <div class="col s3"><span>{{$item->reason}}</span></div>
                  <div class="col s3"><span>{{$item->attachment_file}}</span></div>

               </div>
            </li>
            @endif
            @endforeach 

         </ul>
      </div>
      @endcan


      <!-- teacher dashboard section -->
      @if(Auth::user()->role == 'teacher')
      <div class="col s12 m12 l6">
         <ul id="issues-collection" class="collection z-depth-1 animate fadeRight">
            <li class="collection-item avatar">
               <i class="material-icons green accent-2 circle">gavel</i>
               <h6 class="collection-header m-0">Teacher Assign</h6>
            </li>

            @foreach($teacherAssignData as $teacherAssign)
            @if(isset($teacherAssign) && $teacherAssign != null)
            <li class="collection-item">
               <div class="row">
                  <div class="col s4">
                     <p class="collections-title">{{$teacherAssign->classData->class_name}}</p>
                  </div>
               
                  <div class="col s4"><span>{{$teacherAssign->sectionData->section_name}}</span></div>
                  <div class="col s4"><span>{{$teacherAssign->subjectData->subject_name}}</span></div>

               </div>
            </li>
            @endif
            @endforeach 

         </ul>
      </div>
      @endif


      <!-- student dashboard section -->
      @if(Auth::user()->role == 'student' || Auth::user()->role == 'guardian')
      <div class="col s12 m12 l6">
         <ul id="issues-collection" class="collection z-depth-1 animate fadeRight">
            <li class="collection-item avatar">
               <i class="material-icons red accent-2 circle">add_alert</i>
               <h6 class="collection-header m-0">Assignment</h6>
               <p>Latest</p>
            </li>

           @foreach($assignmentData as $item)
            @if(isset($item) && $item != null)
            <li class="collection-item">
               <div class="row">
                  <div class="col s9">
                     <p class="collections-title">{{$item->title}}</p>
                     <p class="collections-content">{!! Str::limit($item->description, 200) !!}</p>
                  </div>
                  
                  <div class="col s3"><span class="task-cat deep-orange accent-2">{{$item->deadline}}</span></div>

                  <a href="{{route('assignment-file-download', $item->id)}}">
                     {{$item->assignment_file}}
                  </a>

               </div>
            </li>
            @endif
            @endforeach

         </ul>
      </div>
      @endif





      
   </div>
</div>
<!--work collections end-->

@endsection