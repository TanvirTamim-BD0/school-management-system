<!-- BEGIN: SideNav-->

@if(Request::is('payment-of-student/account-section'))
  <aside class="sidenav-main nav-collapsible sidenav-light sidenav-active-square nav-collapsed">
@else
  <aside class="sidenav-main nav-collapsible sidenav-light sidenav-active-square nav-lock">
@endif

    @php
      $getUserId = App\Helpers\CurrentUser::getUserId();
      $contactData = App\Models\Contact::where('user_id', $getUserId)->first();
    @endphp

  <div class="brand-sidebar">
    <h1 class="logo-wrapper">
      <a class="brand-logo darken-1" href="{{route('home')}}">

        @if(isset($contactData->logo_image) && $contactData->logo_image != null)
          <img id="firstLogo" class="firstLogo" src="{{ asset('/uploads/logo_image/'.$contactData->logo_image) }}">
          <img id="secondLogo" class="secondLogo" src="{{ asset('uploads/logo_image/default/small-logo.png') }}">
        @else
          <img id="firstLogo" class="firstLogo" src="{{ asset('uploads/logo_image/default/logo.png') }}" width="170" height="150">
          <img id="secondLogo" class="secondLogo" src="{{ asset('uploads/logo_image/default/small-logo.png') }}" width="170" height="150">
        @endif

       <span
          class="logo-text hide-on-med-and-down">          

          </span></a><a class="navbar-toggler" onclick="sidebarLogo()" href="#">

            @if(Request::is('payment-of-student/account-section'))
              <i class="material-icons">radio_button_unchecked</i>
            @else
              <i class="material-icons">radio_button_checked</i>
            @endif

        </a></h1>
  </div>

  <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
    data-menu="menu-navigation" data-collapsible="menu-accordion">

    <li class="bold"><a class="waves-effect waves-cyan {{ request()->is('dashboard') ? 'active' : '' }} "
        href="{{route('home')}}"><i class="material-icons">settings_input_svideo</i><span class="menu-title"
          data-i18n="Mail">Dashboard</span></a>
    </li>

    @if(Auth::user()->can('class-list') || Auth::user()->can('section-list') ||
    Auth::user()->can('group-list') || Auth::user()->can('group-list') || Auth::user()->can('subject-list')
    || Auth::user()->can('room-list') || Auth::user()->can('assignment-list'))

      <li class="bold 
        {{ request()->is('class*') ? 'active open' : '' }}
        {{ request()->is('section*') ? 'active open' : '' }}
        {{ request()->is('section*') ? 'active open' : '' }}
        {{ request()->is('group*') ? 'active open' : '' }}
        {{ request()->is('subject*') ? 'active open' : '' }}
        {{ request()->is('room*') ? 'active open' : '' }}
        {{ request()->is('assignment*') ? 'active open' : '' }}
        {{ request()->is('syllabus*') ? 'active open' : '' }}
        {{ request()->is('admit-card*') ? 'active open' : '' }}
        {{ request()->is('student-id-card-filter') ? 'active open' : '' }}
        {{ request()->is('student-id-card-generate') ? 'active open' : '' }}
        {{ request()->is('session*') ? 'active open' : '' }}
        ">
        
        <a class="collapsible-header waves-effect waves-cyan 
        {{ request()->is('class') ? 'active-mendu-root' : '' }}
        {{ request()->is('section*') ? 'active-mendu-root' : '' }}
        {{ request()->is('section*') ? 'active-mendu-root' : '' }}
        {{ request()->is('group*') ? 'active-mendu-root' : '' }}
        {{ request()->is('subject*') ? 'active-mendu-root' : '' }}
        {{ request()->is('room*') ? 'active-mendu-root' : '' }}
        {{ request()->is('assignment*') ? 'active-mendu-root' : '' }}
        {{ request()->is('syllabus*') ? 'active-mendu-root' : '' }}
        {{ request()->is('classRoutine*') ? 'active-mendu-root' : '' }}
        {{ request()->is('admit-card*') ? 'active-mendu-root' : '' }}
        {{ request()->is('student-id-card-filter') ? 'active-mendu-root' : '' }}
        {{ request()->is('student-id-card-generate') ? 'active-mendu-root' : '' }}
        {{ request()->is('session*') ? 'active-mendu-root' : '' }}
        "

        href="JavaScript:void(0)"><i class="material-icons">import_contacts</i><span class="menu-title"
          data-i18n="Pages">Academic</span></a>

        <div class="collapsible-body">
          <ul class="collapsible collapsible-sub" data-collapsible="accordion">

            @if(Auth::user()->can('class-list'))
              <li><a href="{{route('class.index')}}" class="{{ request()->is('class*') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact"> Class</span></a>
              </li>
            @endif
            
            @if(Auth::user()->can('section-list'))
              <li><a href="{{route('section.index')}}" class="{{ request()->is('section*') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact"> Section</span></a>
              </li>
            @endif
            
            @if(Auth::user()->can('group-list'))
              <li><a href="{{route('group.index')}}" class="{{ request()->is('group*') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact"> Group</span></a>
              </li>
            @endif

            @if(Auth::user()->can('group-list'))
              <li><a href="{{route('session.index')}}" class="{{ request()->is('session*') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact"> Session</span></a>
              </li>
            @endif
            
            
            @if(Auth::user()->can('subject-list'))
              <li><a href="{{route('subject.index')}}" class="{{ request()->is('subject*') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact"> Subject</span></a>
              </li>
            @endif
            
            @if(Auth::user()->can('room-list'))
              <li><a href="{{route('room.index')}}" class="{{ request()->is('room*') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact"> Room</span></a>
              </li>
            @endif
            
            
            @if(Auth::user()->can('assignment-list'))
              <li><a href="{{route('assignment.index')}}" class="{{ request()->is('assignment*') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact"> Assignment</span></a>
              </li>
            @endif

            @if(Auth::user()->can('class-routine-list'))
              <li><a href="{{route('classRoutine.index')}}" class="{{ request()->is('classRoutine*') ? 'active' : '' }} {{ request()->is('class-rutine-get') ? 'active' : '' }} "><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact"> Class Routine</span></a>
              </li>
            @endif


            @if(Auth::user()->can('syllabus-list'))
              <li><a href="{{route('syllabus.index')}}" class="{{ request()->is('syllabus*') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact"> Syllabus</span></a>
              </li>
            @endif

            @if(Auth::user()->can('student-list'))
              <li><a href="{{route('student-id-card-filter')}}" class="{{ request()->is('student-id-card*') ? 'active' : '' }} {{ request()->is('student-id-card-generate') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact"> Student ID Card</span></a>
              </li>
            @endif

            @if(Auth::user()->can('syllabus-list'))
              <li><a href="{{route('admit-card')}}" class="{{ request()->is('admit-card*') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact"> Admit Card</span></a>
              </li>
            @endif

          </ul>
        </div>
      </li>
      
    @endif
    
    @if(Auth::user()->can('attendace-of-student-list') || Auth::user()->can('attendace-of-teacher-list')
        || Auth::user()->can('attendace-of-accountent-list') || Auth::user()->can('attendace-of-librarian-list'))
      <li class="bold
      {{ request()->is('attendace-of-student*') ? 'active open' : '' }}
      {{ request()->is('attendace-of-teacher*') ? 'active open' : '' }}
      {{ request()->is('attendace-of-accountent*') ? 'active open' : '' }}
      {{ request()->is('attendace-of-librarian*') ? 'active open' : '' }}
      ">
      <a
        class="collapsible-header waves-effect waves-cyan 
        {{ request()->is('attendace-of-student*') ? 'active-mendu-root' : '' }}
        {{ request()->is('attendace-of-teacher*') ? 'active-mendu-root' : '' }}
        {{ request()->is('attendace-of-accountent*') ? 'active-mendu-root' : '' }}
        {{ request()->is('attendace-of-librarian*') ? 'active-mendu-root' : '' }}
        "
        href="JavaScript:void(0)"><i class="material-icons">border_vertical</i><span class="menu-title"
          data-i18n="Pages">Attendance</span></a>
      <div class="collapsible-body">
        <ul class="collapsible collapsible-sub" data-collapsible="accordion">

          @if(Auth::user()->can('attendace-of-student-list'))
            <li><a href="{{route('attendace-of-student.index')}}" class="{{ request()->is('attendace-of-student*') ? 'active' : '' }}"><i
                  class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Student Attendance</span></a>
            </li>
          @endif

          @if(Auth::user()->can('attendace-of-teacher-list'))
            <li><a href="{{route('attendace-of-teacher.index')}}" class="{{ request()->is('attendace-of-teacher*') ? 'active' : '' }}"><i
                  class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Teacher Attendance</span></a>
            </li>
          @endif
          
          @if(Auth::user()->can('attendace-of-accountent-list'))
            <li><a href="{{route('attendace-of-accountent.index')}}" class="{{ request()->is('attendace-of-accountent*') ? 'active' : '' }}"><i
                  class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Accountent Attendance</span></a>
            </li>
          @endif
          
          @if(Auth::user()->can('attendace-of-librarian-list'))
            <li><a href="{{route('attendace-of-librarian.index')}}" class="{{ request()->is('attendace-of-librarian*') ? 'active' : '' }}"><i
                  class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Librarian Attendance</span></a>
            </li>
          @endif

          </ul>
        </div>
      </li>
    @endif


    @if(Auth::user()->can('teacher-assign-list') || Auth::user()->can('teacher-assign-create'))
    <li class="bold {{ request()->is('assign-teacher*') ? 'active' : '' }} "><a class="collapsible-header waves-effect waves-cyan {{ request()->is('assign-teacher*') ? 'active-mendu-root' : '' }} " href="JavaScript:void(0)"><i class="material-icons">gavel</i><span class="menu-title" data-i18n="Pages">Teacher Assign</span></a>
      <div class="collapsible-body">
        <ul class="collapsible collapsible-sub" data-collapsible="accordion">

          @if(Auth::user()->can('teacher-assign-list'))
          <li class="{{ request()->is('assign-teacher') ? 'active' : '' }}"><a href="{{route('assign-teacher.index')}}" class="{{ request()->is('assign-teacher') ? 'active' : '' }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Contact">Manage Teacher Assign</span></a>
          </li>
          @endif

          @if(Auth::user()->can('teacher-assign-create'))
          <li class="{{ request()->is('assign-teacher/create') ? 'active' : '' }}"><a href="{{route('assign-teacher.create')}}" class="{{ request()->is('assign-teacher/create') ? 'active' : '' }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Blog">Teacher Assign</span></a>
          </li>
          @endif

        </ul>
      </div>
    </li>
    @endif


   
    
    @if(Auth::user()->can('leave-category-list') || Auth::user()->can('leave-assign-list') || Auth::user()->can('leave-apply-list') || Auth::user()->can('leave-apply-admin-list'))
      <li class="bold
        {{ request()->is('leave-category*') ? 'active open' : '' }}
        {{ request()->is('leave-assign*') ? 'active open' : '' }}
        {{ request()->is('leave-apply*') ? 'active open' : '' }}
        {{ request()->is('leave-application-list*') ? 'active open' : '' }}
        ">
        <a
          class="collapsible-header waves-effect waves-cyan 
          {{ request()->is('leave-category*') ? 'active-mendu-root' : '' }}
          {{ request()->is('leave-assign*') ? 'active-mendu-root' : '' }}
          {{ request()->is('leave-apply*') ? 'active-mendu-root' : '' }}
          {{ request()->is('leave-application-list*') ? 'active-mendu-root' : '' }}
          "
          href="JavaScript:void(0)"><i class="material-icons">move_to_inbox</i><span class="menu-title"
            data-i18n="Pages">Leave Application</span></a>
        <div class="collapsible-body">
          <ul class="collapsible collapsible-sub" data-collapsible="accordion">

            @if(Auth::user()->can('leave-apply-admin-list'))
              <li><a href="{{route('leave-application-list')}}" class="{{ request()->is('leave-application-list*') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Leave Application List</span></a>
              </li>
            @endif

            @if(Auth::user()->can('leave-category-list'))
              <li><a href="{{route('leave-category.index')}}" class="{{ request()->is('leave-category*') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Leave Category</span></a>
              </li>
            @endif

            {{-- @if(Auth::user()->can('leave-assign-list'))
              <li><a href="{{route('leave-assign.index')}}" class="{{ request()->is('leave-assign*') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Leave Assign</span></a>
              </li>
            @endif --}}
            
            @if(Auth::user()->can('leave-apply-list'))
              <li><a href="{{route('leave-apply.index')}}" class="{{ request()->is('leave-apply*') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Leave Apply</span></a>
              </li>
            @endif

          </ul>
        </div>
      </li>
    @endif


    @if(Auth::user()->can('library-book-list'))
      <li class="bold
        {{ request()->is('book-limit-setting*') ? 'active open' : '' }}
        {{ request()->is('rackNo*') ? 'active open' : '' }}
        {{ request()->is('author*') ? 'active open' : '' }}
        {{ request()->is('book-category-of-library*') ? 'active open' : '' }}
        {{ request()->is('libraryBook*') ? 'active open' : '' }}
        {{ request()->is('bookIssue*') ? 'active open' : '' }}
        {{ request()->is('book-return*') ? 'active open' : '' }}
        {{ request()->is('library-book-fine') ? 'active open' : '' }}
        {{ request()->is('return-date-expire-fine-list') ? 'active open' : '' }}
        {{ request()->is('search-student') ? 'active open' : '' }}
        {{ request()->is('book-issue-teacher*') ? 'active open' : '' }}
        {{ request()->is('student-date-expire-issued-list') ? 'active open' : '' }}
        {{ request()->is('teacher-date-expire-issued-list') ? 'active open' : '' }}
        {{ request()->is('search-teacher') ? 'active open' : '' }}
        ">
        <a
          class="collapsible-header waves-effect waves-cyan 
          {{ request()->is('book-limit-setting*') ? 'active-mendu-root' : '' }}
          {{ request()->is('rackNo*') ? 'active-mendu-root' : '' }}
          {{ request()->is('author*') ? 'active-mendu-root' : '' }}
          {{ request()->is('book-category-of-library*') ? 'active-mendu-root' : '' }}
          {{ request()->is('libraryBook*') ? 'active-mendu-root' : '' }}
          {{ request()->is('bookIssue*') ? 'active-mendu-root' : '' }}
          {{ request()->is('book-return*') ? 'active-mendu-root' : '' }}
          {{ request()->is('return-date-expire-fine-list') ? 'active-mendu-root' : '' }}
          {{ request()->is('search-student') ? 'active-mendu-root' : '' }}
          {{ request()->is('library-book-fine') ? 'active-mendu-root' : '' }}
          {{ request()->is('book-issue-teacher*') ? 'active-mendu-root' : '' }}
          {{ request()->is('student-date-expire-issued-list') ? 'active-mendu-root' : '' }}
          {{ request()->is('teacher-date-expire-issued-list') ? 'active-mendu-root' : '' }}
          {{ request()->is('search-teacher') ? 'active-mendu-root' : '' }}
          "
          href="JavaScript:void(0)"><i class="material-icons">menu_book</i><span class="menu-title"
            data-i18n="Pages">Library</span></a>
        <div class="collapsible-body">
          <ul class="collapsible collapsible-sub" data-collapsible="accordion">

            @if(Auth::user()->can('library-rack-list'))
              <li><a href="{{route('book-limit-setting.index')}}" class="{{ request()->is('book-limit-setting*') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Book Limit Setting</span></a>
              </li>
            @endif

            @if(Auth::user()->can('library-rack-list'))
              <li><a href="{{route('rackNo.index')}}" class="{{ request()->is('rackNo*') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Rack No</span></a>
              </li>
            @endif
            
            @if(Auth::user()->can('author-list'))
              <li><a href="{{route('author.index')}}" class="{{ request()->is('author*') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Book Author</span></a>
              </li>
            @endif
            
            @if(Auth::user()->can('book-category-of-library-list'))
              <li><a href="{{route('book-category-of-library.index')}}" class="{{ request()->is('book-category-of-library*') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Book Category</span></a>
              </li>
            @endif

            @if(Auth::user()->can('library-book-list'))
              <li><a href="{{route('libraryBook.index')}}" class="{{ request()->is('libraryBook*') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Library Book</span></a>
              </li>
            @endif

            @if(Auth::user()->can('student-book-issue-list'))
              <li><a href="{{route('bookIssue.index')}}" class="{{ request()->is('bookIssue*') ? 'active' : '' }}{{ request()->is('search-student') ? 'active' : '' }} {{ request()->is('bookIssue/create') ? 'active' : '' }} {{ request()->is('book-return*') ? 'active' : '' }} {{ request()->is('library-book-fine') ? 'active' : '' }} "><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Student Book Issue</span></a>
              </li>
            @endif


             @if(Auth::user()->can('teacher-book-issue-list'))
              <li><a href="{{route('book-issue-teacher.index')}}" class="{{ request()->is('book-issue-teacher*') ? 'active' : '' }}{{ request()->is('search-teacher') ? 'active' : '' }}  }} "><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Teacher Book Issue</span></a>
              </li>
            @endif

            @if(Auth::user()->can('student-book-issue-list'))
            <li><a href="{{route('student-date-expire-issued-list')}}"
                class="{{ request()->is('student-date-expire-issued-list') ? 'active' : '' }}"><i
                  class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Student Expire Book List</span></a>
            </li>
            @endif
           
            @if(Auth::user()->can('teacher-book-issue-list'))
            <li><a href="{{route('teacher-date-expire-issued-list')}}"
                class="{{ request()->is('teacher-date-expire-issued-list') ? 'active' : '' }}"><i
                  class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Teacher Expire Book List</span></a>
            </li>
            @endif

            @if(Auth::user()->can('student-book-issue-list'))
              <li><a href="{{route('return-date-expire-fine-list')}}" class="{{ request()->is('return-date-expire-fine-list') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Return Date Expire Fine</span></a>
              </li>
            @endif

          </ul>
        </div>
      </li>
    @endif
    

    <!--  @if(Auth::user()->can('exam-list'))
      <li class="bold
        {{ request()->is('academic-exam*') ? 'active open' : '' }}
        {{ request()->is('all-student-result-filter') ? 'active open' : '' }}
        {{ request()->is('get-all-student-result') ? 'active open' : '' }}
        {{ request()->is('result-filter') ? 'active open' : '' }}
        {{ request()->is('get-single-student-result') ? 'active open' : '' }}
      
        ">
        <a
          class="collapsible-header waves-effect waves-cyan 
          {{ request()->is('academic-exam*') ? 'active-mendu-root' : '' }}
          {{ request()->is('all-student-result-filter') ? 'active-mendu-root' : '' }}
          {{ request()->is('get-all-student-result') ? 'active-mendu-root' : '' }}
          {{ request()->is('result-filter') ? 'active-mendu-root' : '' }}
          {{ request()->is('get-single-student-result') ? 'active-mendu-root' : '' }}
          "
          href="JavaScript:void(0)"><i class="material-icons">token</i><span class="menu-title"
            data-i18n="Pages">Academic Exam</span></a>
        <div class="collapsible-body">
          <ul class="collapsible collapsible-sub" data-collapsible="accordion">

            @if(Auth::user()->can('exam-list'))
              <li><a href="{{route('academic-exam.index')}}" class="{{ request()->is('academic-exam') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Exam</span></a>
              </li>
            @endif

            @if(Auth::user()->can('exam-list'))
              <li><a href="{{route('all-student-result.filter')}}" class="{{ request()->is('all-student-result-filter') ? 'active' : '' }} {{ request()->is('get-all-student-result') ? 'active' : '' }} "><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">All Student Result</span></a>
              </li>
            @endif
            
            @if(Auth::user()->can('exam-list'))
              <li><a href="{{route('result.filter')}}" class="{{ request()->is('result-filter') ? 'active' : '' }} {{ request()->is('get-single-student-result') ? 'active' : '' }} "><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Single Student Result</span></a>
              </li>
            @endif


          </ul>
        </div>
      </li>
    @endif -->


    @if(Auth::user()->can('exam-list'))
      <li class="bold
        {{ request()->is('exam*') ? 'active open' : '' }}
        {{ request()->is('all-student-result-filter') ? 'active open' : '' }}
        {{ request()->is('get-all-student-result') ? 'active open' : '' }}
        {{ request()->is('result-filter') ? 'active open' : '' }}
        {{ request()->is('get-single-student-result') ? 'active open' : '' }}
      
        ">
        <a
          class="collapsible-header waves-effect waves-cyan 
          {{ request()->is('exam*') ? 'active-mendu-root' : '' }}
          {{ request()->is('all-student-result-filter') ? 'active-mendu-root' : '' }}
          {{ request()->is('get-all-student-result') ? 'active-mendu-root' : '' }}
          {{ request()->is('result-filter') ? 'active-mendu-root' : '' }}
          {{ request()->is('get-single-student-result') ? 'active-mendu-root' : '' }}
          "
          href="JavaScript:void(0)"><i class="material-icons">token</i><span class="menu-title"
            data-i18n="Pages">Class Test Exam</span></a>
        <div class="collapsible-body">
          <ul class="collapsible collapsible-sub" data-collapsible="accordion">

            @if(Auth::user()->can('exam-list'))
              <li><a href="{{route('exam.index')}}" class="{{ request()->is('exam') ? 'active' : '' }}"><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Exam</span></a>
              </li>
            @endif

            @if(Auth::user()->can('exam-list'))
              <li><a href="{{route('all-student-result.filter')}}" class="{{ request()->is('all-student-result-filter') ? 'active' : '' }} {{ request()->is('get-all-student-result') ? 'active' : '' }} "><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">All Student Result</span></a>
              </li>
            @endif
            
            @if(Auth::user()->can('exam-list'))
              <li><a href="{{route('result.filter')}}" class="{{ request()->is('result-filter') ? 'active' : '' }} {{ request()->is('get-single-student-result') ? 'active' : '' }} "><i
                    class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Single Student Result</span></a>
              </li>
            @endif


          </ul>
        </div>
      </li>
    @endif
    
    
    
    @if(Auth::user()->can('make-payment') 
      || Auth::user()->can('fees-type-list') 
      || Auth::user()->can('fees-assign-list') 
      || Auth::user()->can('fees-assign-student-list') 
      || Auth::user()->can('payment-of-student-list'))
      <li class="bold
        {{ request()->is('make-payment') ? 'active open' : '' }}
        {{ request()->is('get-user-details-with-role-wise') ? 'active open' : '' }}
        {{ request()->is('make-payment-for-teacher/*') ? 'active open' : '' }}
        {{ request()->is('make-payment-for-librarian/*') ? 'active open' : '' }}
        {{ request()->is('make-payment-for-accountent/*') ? 'active open' : '' }}
        {{ request()->is('fees-type*') ? 'active open' : '' }}
        {{ request()->is('fees-assign*') ? 'active open' : '' }}
        {{ request()->is('fees-assign-student*') ? 'active open' : '' }}
        {{ request()->is('payment-of-student*') ? 'active open' : '' }}
        ">
        <a
          class="collapsible-header waves-effect waves-cyan 
          {{ request()->is('make-payment') ? 'active-mendu-root' : '' }}
          {{ request()->is('get-user-details-with-role-wise') ? 'active-mendu-root' : '' }}
          {{ request()->is('make-payment-for-teacher/*') ? 'active-mendu-root' : '' }}
          {{ request()->is('make-payment-for-librarian/*') ? 'active-mendu-root' : '' }}
          {{ request()->is('make-payment-for-accountent/*') ? 'active-mendu-root' : '' }}
          "
          href="JavaScript:void(0)"><i class="material-icons">monetization_on</i><span class="menu-title"
            data-i18n="Pages">Payment</span></a>
        <div class="collapsible-body">
          <ul class="collapsible collapsible-sub" data-collapsible="accordion">
            
              @if(Auth::user()->can('fees-type-list') || Auth::user()->can('fees-assign-list') 
              || Auth::user()->can('fees-assign-student-list') || Auth::user()->can('payment-of-student-list'))

              <li class="bold
                {{ request()->is('fees-type*') ? 'active open' : '' }}
                {{ request()->is('fees-assign*') ? 'active open' : '' }}
                {{ request()->is('fees-assign-student*') ? 'active open' : '' }}
                {{ request()->is('payment-of-student*') ? 'active open' : '' }}
                ">
                <a
                  class="collapsible-header waves-effect waves-cyan 
                  {{ request()->is('fees-type*') ? 'active-mendu-root' : '' }}
                  {{ request()->is('fees-assign*') ? 'active-mendu-root' : '' }}
                  {{ request()->is('fees-assign-student*') ? 'active-mendu-root' : '' }}
                  {{ request()->is('payment-of-student*') ? 'active-mendu-root' : '' }}
                  "
                  href="JavaScript:void(0)"><i class="material-icons">request_quote</i><span class="menu-title"
                    data-i18n="Pages">Student Account</span></a>
                <div class="collapsible-body">
                  <ul class="collapsible collapsible-sub" data-collapsible="accordion">

                    @if(Auth::user()->can('fees-type-list'))
                      <li><a href="{{route('fees-type.index')}}" class="{{ request()->is('fees-type*') ? 'active' : '' }}"><i
                            class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Fees Type</span></a>
                      </li>
                    @endif

                    @if(Auth::user()->can('fees-assign-list'))
                      <li><a href="{{route('fees-assign.index')}}" class="{{ request()->is('fees-assign*') ? 'active' : '' }}"><i
                            class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Fees Assign</span></a>
                      </li>
                    @endif
                    
                    @if(Auth::user()->can('payment-of-student-list'))
                      <li><a href="{{route('payment-of-student.index')}}" class="{{ request()->is('payment-of-student*') ? 'active' : '' }}"><i
                            class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Payment Of Student</span></a>
                      </li>
                    @endif

                  </ul>
                </div>
              </li>
            @endif

            @if(Auth::user()->can('make-payment'))
            <li class="bold
              {{ request()->is('make-payment') ? 'active open' : '' }}
              {{ request()->is('get-user-details-with-role-wise') ? 'active open' : '' }}
              {{ request()->is('make-payment-for-teacher/*') ? 'active open' : '' }}
              {{ request()->is('make-payment-for-librarian/*') ? 'active open' : '' }}
              {{ request()->is('make-payment-for-accountent/*') ? 'active open' : '' }}
              ">
              <a
                class="collapsible-header waves-effect waves-cyan 
                {{ request()->is('make-payment') ? 'active-mendu-root' : '' }}
                {{ request()->is('get-user-details-with-role-wise') ? 'active-mendu-root' : '' }}
                {{ request()->is('make-payment-for-teacher/*') ? 'active-mendu-root' : '' }}
                {{ request()->is('make-payment-for-librarian/*') ? 'active-mendu-root' : '' }}
                {{ request()->is('make-payment-for-accountent/*') ? 'active-mendu-root' : '' }}
                "
                href="JavaScript:void(0)"><i class="material-icons">monetization_on</i><span class="menu-title"
                  data-i18n="Pages">Payroll</span></a>
              <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                  
                  @if(Auth::user()->can('make-payment'))
                    <li><a href="{{route('make-payment')}}" 
                      class="
                      {{ request()->is('make-payment') ? 'active' : '' }}
                      {{ request()->is('get-user-details-with-role-wise') ? 'active' : '' }}
                      {{ request()->is('make-payment-for-teacher/*') ? 'active' : '' }}
                      {{ request()->is('make-payment-for-librarian/*') ? 'active' : '' }}
                      {{ request()->is('make-payment-for-accountent/*') ? 'active' : '' }}
                      "
                      ><i
                          class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Make Payment</span></a>
                    </li>
                  @endif

                </ul>
              </div>
            </li>
            @endif

          </ul>
        </div>
      </li>
    @endif
    
    @if(Auth::user()->can('teacher-list') || Auth::user()->can('teacher-create')
    || Auth::user()->can('student-list') || Auth::user()->can('student-create')
    || Auth::user()->can('accountent-list') || Auth::user()->can('accountent-create')
    || Auth::user()->can('librarian-list') || Auth::user()->can('librarian-create')
    || Auth::user()->can('guardian-list') || Auth::user()->can('guardian-create'))
    
    <li class="bold 
            {{ request()->is('teacher') ? 'active open' : '' }} 
            {{ request()->is('teacher/*') ? 'active open' : '' }} 
            {{ request()->is('student') ? 'active open' : '' }} 
            {{ request()->is('student/*') ? 'active open' : '' }} 
            {{ request()->is('accountent*') ? 'active open' : '' }} 
            {{ request()->is('librarian*') ? 'active open' : '' }} 
            {{ request()->is('guardian*') ? 'active open' : '' }} 
    
            ">
      <a class="collapsible-header waves-effect waves-cyan 
              {{ request()->is('teacher') ? 'active-mendu-root' : '' }}
              {{ request()->is('teacher/*') ? 'active-mendu-root' : '' }}
              {{ request()->is('student') ? 'active-mendu-root' : '' }}
              {{ request()->is('student/*') ? 'active-mendu-root' : '' }}
              {{ request()->is('accountent*') ? 'active-mendu-root' : '' }}
              {{ request()->is('librarian*') ? 'active-mendu-root' : '' }}
              {{ request()->is('guardian*') ? 'active-mendu-root' : '' }}
              " href="JavaScript:void(0)"><i class="material-icons">group_add</i><span class="menu-title"
          data-i18n="Pages">Users</span></a>
    
      <div class="collapsible-body">
        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
    
          @if(Auth::user()->can('accountent-list'))
          <li class="
                  {{ request()->is('accountent') ? 'active' : '' }}
                  {{ request()->is('accountent-profile/*') ? 'active' : '' }}
                  {{ request()->is('accountent/*') ? 'active' : '' }}
                  
                  ">
            <a href="{{route('accountent.index')}}" class="
                    {{ request()->is('accountent') ? 'active' : '' }}
                    {{ request()->is('accountent-profile/*') ? 'active' : '' }}
                    {{ request()->is('accountent/*') ? 'active' : '' }}
    
                    ">
              <i class="material-icons">radio_button_unchecked</i><span data-i18n="Contact">Accountents</span></a>
          </li>
          @endif
    
          @if(Auth::user()->can('librarian-list'))
          <li class="
                              {{ request()->is('librarian') ? 'active' : '' }}
                              {{ request()->is('librarian-profile/*') ? 'active' : '' }}
                              {{ request()->is('librarian/*') ? 'active' : '' }}
                              
                              ">
            <a href="{{route('librarian.index')}}" class="
                                {{ request()->is('librarian') ? 'active' : '' }}
                                {{ request()->is('librarian-profile/*') ? 'active' : '' }}
                                {{ request()->is('librarian/*') ? 'active' : '' }}
                
                                ">
              <i class="material-icons">radio_button_unchecked</i><span data-i18n="Contact">Librarians</span></a>
          </li>
          @endif
    
          @if(Auth::user()->can('teacher-list'))
          <li class="
                              {{ request()->is('teacher') ? 'active' : '' }}
                              {{ request()->is('teacher-profile/*') ? 'active' : '' }}
                              {{ request()->is('teacher/*') ? 'active' : '' }}
                              
                              ">
            <a href="{{route('teacher.index')}}" class="
                                {{ request()->is('teacher') ? 'active' : '' }}
                                {{ request()->is('teacher-profile/*') ? 'active' : '' }}
                                {{ request()->is('teacher/*') ? 'active' : '' }}
                
                                ">
              <i class="material-icons">radio_button_unchecked</i><span data-i18n="Contact">Teachers</span></a>
          </li>
          @endif
    
          @if(Auth::user()->can('student-list'))
          <li class="
                              {{ request()->is('student') ? 'active' : '' }}
                              {{ request()->is('student-profile/*') ? 'active' : '' }}
                              {{ request()->is('student/*') ? 'active' : '' }}
                              
                              ">
            <a href="{{route('student.index')}}" class="
                                {{ request()->is('student') ? 'active' : '' }}
                                {{ request()->is('student-profile/*') ? 'active' : '' }}
                                {{ request()->is('student/*') ? 'active' : '' }}
                
                                ">
              <i class="material-icons">radio_button_unchecked</i><span data-i18n="Contact">Students</span></a>
          </li>
          @endif
    
          @if(Auth::user()->can('guardian-list'))
          <li class="
                    {{ request()->is('guardian') ? 'active' : '' }}
                    {{ request()->is('guardian-profile/*') ? 'active' : '' }}
                    {{ request()->is('guardian/*') ? 'active' : '' }}
                      
                  ">
            <a href="{{route('guardian.index')}}" class="
                      {{ request()->is('guardian') ? 'active' : '' }}
                      {{ request()->is('guardian-profile/*') ? 'active' : '' }}
                      {{ request()->is('guardian/*') ? 'active' : '' }}
      
                    ">
              <i class="material-icons">radio_button_unchecked</i><span data-i18n="Contact">Guardians</span></a>
          </li>
          @endif
    
        </ul>
      </div>
    </li>
    
    @endif


    @if(Auth::user()->can('role-list') 
    || Auth::user()->can('user-list'))
    <li class="bold
      {{ request()->is('roles*') ? 'active open' : '' }}
      {{ request()->is('users*') ? 'active open' : '' }}
    
      ">
      <a
        class="collapsible-header waves-effect waves-cyan 
        {{ request()->is('roles*') ? 'active-mendu-root' : '' }}
        {{ request()->is('users*') ? 'active-mendu-root' : '' }}
        "
        href="JavaScript:void(0)"><i class="material-icons">manage_accounts</i><span class="menu-title"
          data-i18n="Pages">User Management</span></a>
      <div class="collapsible-body">
        <ul class="collapsible collapsible-sub" data-collapsible="accordion">

          @if(Auth::user()->can('user-list'))
            <li><a href="{{route('users.index')}}" class="{{ request()->is('users*') ? 'active' : '' }}"><i
                  class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">User</span></a>
            </li>
          @endif

          @if(Auth::user()->can('role-list'))
            <li><a href="{{route('roles.index')}}" class="{{ request()->is('roles*') ? 'active' : '' }}"><i
                  class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Role</span></a>
            </li>
          @endif

          
        </ul>
      </div>
    </li>
    @endif


     @if(Auth::user()->can('extend-class-of-students') 
     || Auth::user()->can('default-session'))
      <li class="bold
      
            {{ request()->is('extend-class-of-students') ? 'active open' : '' }}
            {{ request()->is('default-session') ? 'active open' : '' }}
          
            ">
        <a class="collapsible-header waves-effect waves-cyan 

              {{ request()->is('extend-class-of-students') ? 'active-mendu-root' : '' }}
              {{ request()->is('default-session') ? 'active-mendu-root' : '' }}

              " href="JavaScript:void(0)"><i class="material-icons">settings_applications</i><span class="menu-title"
            data-i18n="Pages">Administrative</span></a>


        <div class="collapsible-body">
          <ul class="collapsible collapsible-sub" data-collapsible="accordion">
        
            @if(Auth::user()->can('extend-class-of-students'))
            <li><a href="{{route('extend-class-of-students')}}" class="{{ request()->is('extend-class-of-students') ? 'active' : '' }}"><i
                  class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Extend Class of Students</span></a>
            </li>
           @endif 
            
            @if(Auth::user()->can('default-session')) 
            <li><a href="{{route('default-session')}}" class="{{ request()->is('default-session') ? 'active' : '' }}"><i
                  class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Default Session Year</span></a>
            </li>
            @endif
        
        
          </ul>
        </div>

      </li>
     @endif 

    @if(Auth::user()->can('income-list') || Auth::user()->can('income-create')
    || Auth::user()->can('expense-list') || Auth::user()->can('expense-create')
    || Auth::user()->can('mail-list') || Auth::user()->can('mail-create')
    || Auth::user()->can('sms-list') || Auth::user()->can('sms-create')
    || Auth::user()->can('push-notification') || Auth::user()->can('push-notification')
    || Auth::user()->can('rollback'))
    <li class="bold
      {{ request()->is('income*') ? 'active open' : '' }}
      {{ request()->is('expense*') ? 'active open' : '' }}
      {{ request()->is('mail*') ? 'active open' : '' }}
      {{ request()->is('sms*') ? 'active open' : '' }}
      {{ request()->is('push-notification*') ? 'active open' : '' }}
      {{ request()->is('push-notification-direct*') ? 'active open' : '' }}
      {{ request()->is('rollback*') ? 'active open' : '' }}
    
      ">
      <a
        class="collapsible-header waves-effect waves-cyan 
        {{ request()->is('income*') ? 'active-mendu-root' : '' }}
        {{ request()->is('expense*') ? 'active-mendu-root' : '' }}
        {{ request()->is('mail*') ? 'active-mendu-root' : '' }}
        {{ request()->is('sms*') ? 'active-mendu-root' : '' }}
        {{ request()->is('push-notification*') ? 'active-mendu-root' : '' }}
        {{ request()->is('push-notification-direct*') ? 'active-mendu-root' : '' }}
        {{ request()->is('rollback*') ? 'active-mendu-root' : '' }}
        "
        href="JavaScript:void(0)"><i class="material-icons">settings</i><span class="menu-title"
          data-i18n="Pages">Settings</span></a>

      <div class="collapsible-body">
        <ul class="collapsible collapsible-sub" data-collapsible="accordion">

          @if(Auth::user()->can('income-list') || Auth::user()->can('expense-list'))
          <li class="bold">
            <a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons custom-submenu-icon">storefront</i><span class="menu-title"
                data-i18n="Pages">Income/Expense</span></a>
            <div class="collapsible-body">
              <ul class="collapsible collapsible-sub" data-collapsible="accordion">
          
                @if(Auth::user()->can('income-list') || Auth::user()->can('income-create') || Auth::user()->can('income-update'))
                <li><a href="{{route('income.index')}}" class="{{ request()->is('income*') ? 'active' : '' }}"><i
                      class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Income</span></a>
                </li>
                @endif
          
                @if(Auth::user()->can('expense-list') || Auth::user()->can('expense-create') ||
                Auth::user()->can('expense-update'))
                <li><a href="{{route('expense.index')}}" class="{{ request()->is('expense*') ? 'active' : '' }}"><i
                      class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Expense</span></a>
                </li>
                @endif
          
          
              </ul>
            </div>
          </li>
          @endif

          @if(Auth::user()->can('mail-list') || Auth::user()->can('sms-list'))
          <li class="bold">
            <a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons custom-submenu-icon">mail</i><span class="menu-title" data-i18n="Pages">Mail
                / SMS</span></a>
            <div class="collapsible-body">
              <ul class="collapsible collapsible-sub" data-collapsible="accordion">
          
                @if(Auth::user()->can('mail-list'))
                <li><a href="{{route('mail.index')}}" class="{{ request()->is('mail*') ? 'active' : '' }}"><i
                      class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Mail</span></a>
                </li>
                @endif
          
                @if(Auth::user()->can('sms-list'))
                <li><a href="{{route('sms.index')}}" class="{{ request()->is('sms*') ? 'active' : '' }}"><i
                      class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">SMS</span></a>
                </li>
                @endif
          
          
              </ul>
            </div>
          </li>
          @endif

          @if(Auth::user()->can('push-notification'))
          <li class="bold">
            <a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons custom-submenu-icon">mail</i><span class="menu-title"
                data-i18n="Pages">Push Notification</span></a>
            <div class="collapsible-body">
              <ul class="collapsible collapsible-sub" data-collapsible="accordion">
          
                @if(Auth::user()->can('push-notification'))
                <li><a href="{{route('push-notification-direct')}}" class="
                              {{ request()->is('push-notification-direct') ? 'active' : '' }}
                              {{ request()->is('push-notification-direct-create') ? 'active' : '' }}
                              "><i class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Direct
                      Notification</span></a>
                </li>
                @endif
          
                @if(Auth::user()->can('push-notification'))
                <li><a href="{{route('push-notification.index')}}" class="
                              {{ request()->is('push-notification') ? 'active' : '' }}
                              {{ request()->is('push-notification/create') ? 'active' : '' }}
                              "><i class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Timely
                      Notification</span></a>
                </li>
                @endif
          
          
              </ul>
            </div>
          </li>
          @endif
          
          @if(Auth::user()->can('rollback'))
            <li><a href="{{route('rollback')}}" class="{{ request()->is('rollback*') ? 'active' : '' }}"><i
                  class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Rollback</span></a>
            </li>
          @endif

        </ul>
      </div>
    </li>
    @endif


    @if(Auth::user()->can('contact') || Auth::user()->can('admission-list')
    || Auth::user()->can('notice-list') || Auth::user()->can('notice-create')
    || Auth::user()->can('event-list') || Auth::user()->can('event-create')
    || Auth::user()->can('holiday-list') || Auth::user()->can('holiday-create')
    || Auth::user()->can('blog-list') || Auth::user()->can('blog-create')
    || Auth::user()->can('contact-form-list'))
    <li class="bold
              {{ request()->is('admission*') ? 'active open' : '' }}
              {{ request()->is('form-of-admissions*') ? 'active open' : '' }}
              {{ request()->is('notice*') ? 'active open' : '' }}
              {{ request()->is('event*') ? 'active open' : '' }}
              {{ request()->is('holiday*') ? 'active open' : '' }}
              {{ request()->is('blog-backend*') ? 'active open' : '' }}
              {{ request()->is('contact-form') ? 'active open' : '' }}
              {{ request()->is('contacts*') ? 'active open' : '' }}
            
              ">
      <a class="collapsible-header waves-effect waves-cyan 
                {{ request()->is('admission*') ? 'active-mendu-root' : '' }}
                {{ request()->is('form-of-admissions*') ? 'active-mendu-root' : '' }}
                {{ request()->is('notice*') ? 'active-mendu-root' : '' }}
                {{ request()->is('event*') ? 'active-mendu-root' : '' }}
                {{ request()->is('holiday*') ? 'active-mendu-root' : '' }}
                {{ request()->is('blog-backend*') ? 'active-mendu-root' : '' }}
                {{ request()->is('contact-form') ? 'active-mendu-root' : '' }}
                {{ request()->is('contacts*') ? 'active-mendu-root' : '' }}
                " href="JavaScript:void(0)"><i class="material-icons">leak_add</i><span class="menu-title"
          data-i18n="Pages">Others</span></a>
    
      <div class="collapsible-body">
        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
    
          @if(Auth::user()->can('admission-list'))
          <li class="bold">
            <a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i
                class="material-icons custom-submenu-icon">dataset</i><span class="menu-title"
                data-i18n="Pages">Admission</span></a>
            <div class="collapsible-body">
              <ul class="collapsible collapsible-sub" data-collapsible="accordion">
    
                @if(Auth::user()->can('admission-list'))
                <li><a href="{{route('admission.index')}}" class="{{ request()->is('admission*') ? 'active' : '' }}"><i
                      class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Admission</span></a>
                </li>
                @endif
    
                @if(Auth::user()->can('admission-form-list'))
                <li><a href="{{route('form-of-admissions.index')}}"
                    class="{{ request()->is('form-of-admissions*') ? 'active' : '' }}"><i
                      class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Admission Form</span></a>
                </li>
                @endif
    
              </ul>
            </div>
          </li>
          @endif
    
          @if(Auth::user()->can('notice-list') || Auth::user()->can('event-list') || Auth::user()->can('holiday-list'))
          <li class="bold">
            <a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i
                class="material-icons custom-submenu-icon">add_alert</i><span class="menu-title"
                data-i18n="Pages">Announcement</span></a>
            <div class="collapsible-body">
              <ul class="collapsible collapsible-sub" data-collapsible="accordion">
    
                @if(Auth::user()->can('notice-list'))
                <li><a href="{{route('notice.index')}}" class="{{ request()->is('notice*') ? 'active' : '' }}"><i
                      class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Notice</span></a>
                </li>
                @endif
    
                @if(Auth::user()->can('event-list'))
                <li><a href="{{route('event.index')}}" class="{{ request()->is('event*') ? 'active' : '' }}"><i
                      class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Events</span></a>
                </li>
                @endif
    
                @if(Auth::user()->can('holiday-list'))
                <li><a href="{{route('holiday.index')}}" class="{{ request()->is('holiday*') ? 'active' : '' }}"><i
                      class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Holidays</span></a>
                </li>
                @endif
    
              </ul>
            </div>
          </li>
          @endif
    
          @if(Auth::user()->can('blog-list'))
          <li><a href="{{route('blog-backend.index')}}" class="{{ request()->is('blog-backend*') ? 'active' : '' }}"><i
                class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Blog</span></a>
          </li>
          @endif
    
          @if(Auth::user()->can('contact-form-list'))
          <li><a href="{{route('contact-form')}}" class="{{ request()->is('contact-form') ? 'active' : '' }}"><i
                class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Contact Form</span></a>
          </li>
          @endif
    
          @if(Auth::user()->can('contact'))
          <li><a href="{{route('contacts')}}" class="{{ request()->is('contacts*') ? 'active' : '' }}"><i
                class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Contact</span></a>
          </li>
          @endif
    
        </ul>
      </div>
    </li>
    @endif


    @if(Auth::user()->can('class-report') 
    || Auth::user()->can('student-report') 
    || Auth::user()->can('class-routine-report') 
    || Auth::user()->can('student-attendence-report') 
    || Auth::user()->can('teacher-attendence-report') 
    || Auth::user()->can('addmission-report') 
    || Auth::user()->can('library-book-report') 
    || Auth::user()->can('library-book-issue-report'))
    <li class="custom-report-padding-bottom bold
      {{ request()->is('report-of-class*') ? 'active open' : '' }}
      {{ request()->is('report-of-student*') ? 'active open' : '' }}
      {{ request()->is('report-of-library-book-issue*') ? 'active open' : '' }}
      {{ request()->is('report-of-library-book') ? 'active open' : '' }}
      {{ request()->is('report-of-routine*') ? 'active open' : '' }}
      {{ request()->is('report-of-attendence-student*') ? 'active open' : '' }}
      {{ request()->is('report-of-attendence-teacher*') ? 'active open' : '' }}
      {{ request()->is('report-of-addmission*') ? 'active open' : '' }}
      ">
      <a
        class="collapsible-header waves-effect waves-cyan 
        {{ request()->is('report-of-class*') ? 'active-mendu-root' : '' }}
        {{ request()->is('report-of-student*') ? 'active-mendu-root' : '' }}
        {{ request()->is('report-of-library-book-issue*') ? 'active-mendu-root' : '' }}
        {{ request()->is('report-of-library-book') ? 'active-mendu-root' : '' }}
        {{ request()->is('report-of-routine*') ? 'active-mendu-root' : '' }}
        {{ request()->is('report-of-attendence-student*') ? 'active-mendu-root' : '' }}
        {{ request()->is('report-of-attendence-teacher*') ? 'active-mendu-root' : '' }}
        {{ request()->is('report-of-addmission*') ? 'active-mendu-root' : '' }}
        "
        href="JavaScript:void(0)"><i class="material-icons">report</i><span class="menu-title"
          data-i18n="Pages">Report</span></a>
      <div class="collapsible-body">
        <ul class="collapsible collapsible-sub" data-collapsible="accordion">

          @if(Auth::user()->can('class-report'))
            <li><a href="{{route('report-of-class')}}" class="{{ request()->is('report-of-class*') ? 'active' : '' }}"><i
                  class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Class Report</span></a>
            </li>
          @endif


            @if(Auth::user()->can('student-report'))
            <li><a href="{{route('report-of-student')}}" class="{{ request()->is('report-of-student*') ? 'active' : '' }}"><i
                  class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Student Report</span></a>
            </li>
          @endif


          @if(Auth::user()->can('class-routine-report'))
            <li><a href="{{route('report-of-routine')}}" class="{{ request()->is('report-of-routine*') ? 'active' : '' }}"><i
                  class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Class Routine Report</span></a>
            </li>
          @endif

          @if(Auth::user()->can('student-attendence-report'))
            <li><a href="{{route('report-of-attendence-student-filter')}}" class="{{ request()->is('report-of-attendence-student*') ? 'active' : '' }}"><i
                  class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Student Attendence Report</span></a>
            </li>
          @endif


          @if(Auth::user()->can('teacher-attendence-report'))
            <li><a href="{{route('report-of-attendence-teacher-filter')}}" class="{{ request()->is('report-of-attendence-teacher*') ? 'active' : '' }}"><i
                  class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Teacher Attendence Report</span></a>
            </li>
          @endif


          @if(Auth::user()->can('addmission-report'))
            <li><a href="{{route('report-of-addmission')}}" class="{{ request()->is('report-of-addmission*') ? 'active' : '' }}"><i
                  class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Addmission Report</span></a>
            </li>
          @endif

          @if(Auth::user()->can('library-book-issue-report'))
            <li><a href="{{route('report-of-library-book-issue')}}" class="{{ request()->is('report-of-library-book-issue*') ? 'active' : '' }}"><i
                  class="material-icons ">radio_button_unchecked</i><span data-i18n="Contact">Library Book Issue Report</span></a>
            </li>
          @endif
        

        </ul>
      </div>
    </li>
    @endif


  </ul>
  
  <div class="navigation-background"></div><a
    class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
    href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
<!-- END: SideNav-->