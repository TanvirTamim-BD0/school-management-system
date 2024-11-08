<?php

use Illuminate\Support\Facades\Route;
use Backend\UserRole\UserController;
use Backend\UserRole\RoleController;
use Backend\ClassController;
use Backend\GroupController;
use Backend\SectionController;
use Backend\SubjectController;
use Backend\RoomController;
use Backend\SyllabusController;
use Backend\AssignmentController;
use Backend\StudentController;
use Backend\TeacherController;
use Backend\AccountentController;
use Backend\LibrarianController;
use Backend\GuardianController;
use Backend\TeacherAssignController;
use Backend\AttendanceOfStudentController;
use Backend\AttendanceOfTeacherController;
use Backend\AttendanceOfAccountentController;
use Backend\AttendanceOfLibrarianController;
use Backend\ClassRoutineController;
use Backend\NoticeController;
use Backend\EventController;
use Backend\HolidayController;
use Backend\LeaveCategoryController;
use Backend\LeaveAssignController;
use Backend\LeaveApplyController;
use Backend\FeesTypeController;
use Backend\FeesAssignController;
use Backend\FeesAssignStudentController;
use Backend\PaymentStudentController;
use Backend\MailController;
use Backend\SmsController;
use Backend\ExpenseController;
use Backend\IncomeController;
use Backend\AdmissionController;
use Backend\AdmissionFormController;
use Backend\RackNoController;
use Backend\AuthorController;
use Backend\LibraryBookCategoryController;
use Backend\LibraryBookController;
use Backend\BlogController;
use Backend\StudentBookIssueController;
use Backend\report\ReportController;
use Backend\ContactController;
use Backend\PushNotificationController;
use Backend\ExamController;
use Backend\ResultController;
use Backend\AcademicExamController;
use Backend\SessionController;
use Backend\BookLimitSettingController;
use Backend\TeacherBookIssueController;

Route::get('/', [App\Http\Controllers\HomePageController::class, 'index'])->name('welcome');
Route::get('/head-teacher', [App\Http\Controllers\HomePageController::class, 'headTeacher'])->name('head-teacher');
Route::get('/assistant-head-teacher', [App\Http\Controllers\HomePageController::class, 'assistantHeadTeacher'])->name('assistant-head-teacher');
Route::get('/all-teachers', [App\Http\Controllers\HomePageController::class, 'allTeacher'])->name('all-teachers');

Route::get('/blog', [App\Http\Controllers\HomePageController::class, 'blog'])->name('blog');
Route::get('/blog-details/{id}', [App\Http\Controllers\HomePageController::class, 'blogDetails'])->name('blog-details');
Route::get('/addmission-list', [App\Http\Controllers\HomePageController::class, 'addmissionList'])->name('addmission-list');
Route::get('/addmission-form/{id}', [App\Http\Controllers\HomePageController::class, 'addmissionForm'])->name('addmission-form');
Route::post('/addmission-form-submit', [App\Http\Controllers\HomePageController::class, 'addmissionFormSubmit'])->name('addmission-form-submit');
Route::get('/contact', [App\Http\Controllers\HomePageController::class, 'contact'])->name('contact');
Route::Post('/contact-form-submit', [App\Http\Controllers\HomePageController::class, 'contactFormSubmit'])->name('contact-form-submit');
Route::get('/features', [App\Http\Controllers\HomePageController::class, 'features'])->name('features');

Auth::routes();

//All the backend route list here...
Route::group(['middleware'=>['auth']],function(){

	Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	Route::get('/student-class-rutine/{id}', [App\Http\Controllers\HomeController::class, 'studentClassRutine'])->name('student-class-rutine');
	Route::get('/upComing-notice', [App\Http\Controllers\HomeController::class, 'upComingNotice'])->name('upComing-notice');

	Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');

	//UserRolePermission System Controller...
	Route::resource('users', UserController::class);
	Route::get('user-active/{id}', [App\Http\Controllers\Backend\UserRole\UserController::class, 'userActive'])->name('user-active');
    Route::get('user-inactive/{id}', [App\Http\Controllers\Backend\UserRole\UserController::class, 'userInactive'])->name('user-inactive');
    Route::post('user-password-update/{id}', [App\Http\Controllers\Backend\UserRole\UserController::class, 'userPassword'])->name('user-password-update');
	Route::resource('roles', RoleController::class);

	//Academic Section Controller Start...
	Route::resource('class', ClassController::class);
	Route::resource('group', GroupController::class);
	Route::resource('section', SectionController::class);
	Route::resource('subject', SubjectController::class);
	Route::resource('room', RoomController::class);
	Route::resource('session', SessionController::class);

	Route::resource('student', StudentController::class);
	Route::get('student-profile/{id}', [App\Http\Controllers\Backend\StudentController::class, 'studentProfile'])->name('student-profile');
	Route::post('student.daysAttendanceWithMonth', [App\Http\Controllers\Backend\StudentController::class, 'studentDaysAttendanceWithMonth'])->name('student.daysAttendanceWithMonth');
	Route::get('student-id-card-filter', [App\Http\Controllers\Backend\StudentController::class, 'studentIdCartFilter'])->name('student-id-card-filter');
	Route::post('student-id-card-generate', [App\Http\Controllers\Backend\StudentController::class, 'studentIdCardGenerate'])->name('student-id-card-generate');
	Route::post('student-id-card-invoice', [App\Http\Controllers\Backend\StudentController::class, 'studentIdCardInvoice'])->name('student-id-card-invoice');
	Route::get('admit-card', [App\Http\Controllers\Backend\StudentController::class, 'admitCard'])->name('admit-card');
	Route::post('admit-card-invoice', [App\Http\Controllers\Backend\StudentController::class, 'admitCardInvoice'])->name('admit-card-invoice');
	Route::post('check-student-roll-id', [App\Http\Controllers\Backend\StudentController::class, 'checkStudentRollId'])->name('check-student-roll-id');

	Route::resource('teacher', TeacherController::class);
	Route::get('teacher-profile/{id}', [App\Http\Controllers\Backend\TeacherController::class, 'teacherProfile'])->name('teacher-profile');
	Route::post('teacher.daysAttendanceWithMonth', [App\Http\Controllers\Backend\TeacherController::class, 'teacherDaysAttendanceWithMonth'])->name('teacher.daysAttendanceWithMonth');
	
	Route::resource('accountent', AccountentController::class);
	Route::get('accountent-profile/{id}', [App\Http\Controllers\Backend\AccountentController::class, 'accountentProfile'])->name('accountent-profile');
	Route::post('accountent.daysAttendanceWithMonth', [App\Http\Controllers\Backend\AccountentController::class, 'accountentDaysAttendanceWithMonth'])->name('accountent.daysAttendanceWithMonth');
	
	Route::resource('librarian', LibrarianController::class);
	Route::get('librarian-profile/{id}', [App\Http\Controllers\Backend\LibrarianController::class, 'librarianProfile'])->name('librarian-profile');
	Route::post('librarian.daysAttendanceWithMonth', [App\Http\Controllers\Backend\LibrarianController::class, 'librarianDaysAttendanceWithMonth'])->name('librarian.daysAttendanceWithMonth');
	
	//Academic Teacher Assign, Guardian, ClassRutine, Syllabus & Assignment Controller Start...
	Route::resource('assign-teacher', TeacherAssignController::class);
	Route::resource('guardian', GuardianController::class);
	Route::resource('classRoutine', ClassRoutineController::class);
	Route::post('class-rutine-get', [App\Http\Controllers\Backend\ClassRoutineController::class, 'classRutineGet'])->name('class-rutine-get');
	Route::resource('syllabus', SyllabusController::class);
	Route::get('syllabus-file-download/{id}', [App\Http\Controllers\Backend\SyllabusController::class, 'syllabusFileDownload'])->name('syllabus-file-download');
	Route::resource('assignment', AssignmentController::class);
	Route::get('assignment-file-download/{id}', [App\Http\Controllers\Backend\AssignmentController::class, 'assignmentFileDdownload'])->name('assignment-file-download');
	
	//Attendace Of Student, Teacher, Accountent & Librarian Controller...
	Route::resource('attendace-of-student', AttendanceOfStudentController::class);
	Route::post('attendace-of-student/get-student-filter-data', [App\Http\Controllers\Backend\AttendanceOfStudentController::class, 'getStudentFilterData'])->name('get-student-filter-data');
	Route::post('attendace-of-student/get-student-filter-data-for-attendance', [App\Http\Controllers\Backend\AttendanceOfStudentController::class, 'getStudentFilterDataForAttendance'])->name('get-student-filter-data-for-attendance');
	Route::resource('attendace-of-teacher', AttendanceOfTeacherController::class);
	Route::post('attendace-of-teacher/get-teacher-filter-data', [App\Http\Controllers\Backend\AttendanceOfTeacherController::class, 'getTeacherFilterData'])->name('get-teacher-filter-data');
	Route::post('attendace-of-teacher/get-teacher-filter-data-for-attendance', [App\Http\Controllers\Backend\AttendanceOfTeacherController::class, 'getTeacherFilterDataForAttendance'])->name('get-teacher-filter-data-for-attendance');
	Route::resource('attendace-of-accountent', AttendanceOfAccountentController::class);
	Route::post('attendace-of-accountent/get-accountent-filter-data', [App\Http\Controllers\Backend\AttendanceOfAccountentController::class, 'getAccountentFilterData'])->name('get-accountent-filter-data');
	Route::post('attendace-of-accountent/get-accountent-filter-data-for-attendance', [App\Http\Controllers\Backend\AttendanceOfAccountentController::class, 'getAccountentFilterDataForAttendance'])->name('get-accountent-filter-data-for-attendance');
	Route::resource('attendace-of-librarian', AttendanceOfLibrarianController::class);
	Route::post('attendace-of-librarian/get-librarian-filter-data', [App\Http\Controllers\Backend\AttendanceOfLibrarianController::class, 'getLibrarianFilterData'])->name('get-librarian-filter-data');
	Route::post('attendace-of-librarian/get-librarian-filter-data-for-attendance', [App\Http\Controllers\Backend\AttendanceOfLibrarianController::class, 'getLibrarianFilterDataForAttendance'])->name('get-librarian-filter-data-for-attendance');
	
	//Announcement Of Notice, Event & Holiday Controller...
	Route::resource('notice', NoticeController::class);
	Route::resource('event', EventController::class);
	Route::get('event-file-download/{id}', [App\Http\Controllers\Backend\EventController::class, 'eventFileDdownload'])->name('event-file-download');
	Route::resource('holiday', HolidayController::class);
	Route::get('holiday-file-download/{id}', [App\Http\Controllers\Backend\HolidayController::class, 'holidayFileDdownload'])->name('holiday-file-download');
	
	//Leave Category, Assign & Apply Controller...
	Route::resource('leave-category', LeaveCategoryController::class);
	Route::resource('leave-assign', LeaveAssignController::class);
	Route::resource('leave-apply', LeaveApplyController::class);
	Route::get('leave-application-list', [App\Http\Controllers\Backend\LeaveApplyController::class, 'leaveApplicationList'])->name('leave-application-list');
	Route::get('leave-application-declined/{id}', [App\Http\Controllers\Backend\LeaveApplyController::class, 'leaveApplicationDeclined'])->name('leave-application-declined');
	Route::get('leave-application-approve/{id}', [App\Http\Controllers\Backend\LeaveApplyController::class, 'leaveApplicationApprove'])->name('leave-application-approve');
	
	//Student Payment Section Controller...
	Route::resource('fees-type', FeesTypeController::class);
	Route::resource('fees-assign', FeesAssignController::class);
	Route::post('class-wise-fees-type', [App\Http\Controllers\Backend\FeesAssignController::class, 'classWiseFeesType'])->name('class-wise-fees-type');
	Route::resource('payment-of-student', PaymentStudentController::class);
	Route::post('payment-of-student/account-section', [App\Http\Controllers\Backend\PaymentStudentController::class, 'getStudentPaymentSection'])->name('payment-of-student.account-section');
	Route::post('payment-of-student/add', [App\Http\Controllers\Backend\PaymentStudentController::class, 'addStudentPaymentSection'])->name('payment-of-student.add');

	//Payroll Section Controller...
	Route::get('make-payment', [App\Http\Controllers\Backend\PayRollController::class, 'makePayment'])->name('make-payment');
	Route::post('get-user-details-with-role-wise', [App\Http\Controllers\Backend\PayRollController::class, 'getUserDetailsWithRoleWise'])->name('get-user-details-with-role-wise');
	Route::get('make-payment-for-teacher/{id}', [App\Http\Controllers\Backend\PayRollController::class, 'makePaymentForTeacher'])->name('make-payment-for-teacher');
	Route::post('add-make-payment-for-teacher', [App\Http\Controllers\Backend\PayRollController::class, 'addMakePaymentForTeacher'])->name('add-make-payment-for-teacher');
	Route::get('make-payment-for-librarian/{id}', [App\Http\Controllers\Backend\PayRollController::class, 'makePaymentForLibrarian'])->name('make-payment-for-librarian');
	Route::post('add-make-payment-for-librarian', [App\Http\Controllers\Backend\PayRollController::class, 'addMakePaymentForLibrarian'])->name('add-make-payment-for-librarian');
	Route::get('make-payment-for-accountent/{id}', [App\Http\Controllers\Backend\PayRollController::class, 'makePaymentForAccountent'])->name('make-payment-for-accountent');
	Route::post('add-make-payment-for-accountent', [App\Http\Controllers\Backend\PayRollController::class, 'addMakePaymentForAccountent'])->name('add-make-payment-for-accountent');


	//CommonController...
	Route::post('class-wise-section', [App\Http\Controllers\Backend\CommonController::class, 'classWiseSection'])->name('class-wise-section');
	Route::post('class-and-section-wise-student', [App\Http\Controllers\Backend\CommonController::class, 'classSectionWiseStudent'])->name('class-and-section-wise-student');
	Route::post('get-all-section-and-subject-with-class-id', [App\Http\Controllers\Backend\CommonController::class, 'classWiseSectionAndSubject'])->name('get-all-section-and-subject-with-class-id');
	Route::post('get-student-sectionId-wise', [App\Http\Controllers\Backend\CommonController::class, 'getStudentSectionIdWise'])->name('get-student-sectionId-wise');
	Route::post('role-wise-get-user', [App\Http\Controllers\Backend\CommonController::class, 'roleWiseGetUser'])->name('role-wise-get-user');
	Route::post('class-and-subject-wise-exam-and-student', [App\Http\Controllers\Backend\CommonController::class, 'classAndSubjectWiseExamAndStudent'])->name('class-and-subject-wise-exam-and-student');
	
	//For PrintInvoiceController....
	Route::get('get-teacher-payment-invoice/{id}', [App\Http\Controllers\Backend\PrintInvoiceController::class, 'getTeacherInvoicePrint'])->name('get-teacher-payment-invoice');
	Route::get('get-accountent-payment-invoice/{id}', [App\Http\Controllers\Backend\PrintInvoiceController::class, 'getAccountInvoicePrint'])->name('get-accountent-payment-invoice');
	Route::get('get-teacher-payment-invoice/{id}', [App\Http\Controllers\Backend\PrintInvoiceController::class, 'getTeacherInvoicePrint'])->name('get-teacher-payment-invoice');
	Route::get('get-librarian-payment-invoice/{id}', [App\Http\Controllers\Backend\PrintInvoiceController::class, 'getLibrarianInvoicePrint'])->name('get-librarian-payment-invoice');
	Route::get('get-student-payment-invoice/{id}', [App\Http\Controllers\Backend\PrintInvoiceController::class, 'getStudentInvoicePrint'])->name('get-student-payment-invoice');

	//mail sms route.......
	Route::resource('mail', MailController::class);
	Route::resource('sms', SmsController::class);


	//income expense route.......
	Route::resource('income', IncomeController::class);
	Route::resource('expense', ExpenseController::class);


	//exam route.........
	Route::resource('academic-exam', AcademicExamController::class);
		Route::get('academic-exam-result/{id}', [App\Http\Controllers\Backend\ExamController::class, 'examResult'])->name('academic-exam.result');
	Route::post('academic-results-store', [App\Http\Controllers\Backend\ExamController::class, 'resultsStore'])->name('academic-results.store');

	Route::resource('exam', ExamController::class);
	Route::get('exam-result/{id}', [App\Http\Controllers\Backend\ExamController::class, 'examResult'])->name('exam.result');
	Route::post('results-store', [App\Http\Controllers\Backend\ExamController::class, 'resultsStore'])->name('results.store');
	Route::post('get-student-with-calass-section', [App\Http\Controllers\Backend\ExamController::class, 'getStudentWithClassSection'])->name('get-student-with-calass-section');

	Route::get('all-student-result-filter', [App\Http\Controllers\Backend\ResultController::class, 'allStudentResultFilter'])->name('all-student-result.filter');
	Route::post('get-all-student-result', [App\Http\Controllers\Backend\ResultController::class, 'getAllStudentResult'])->name('get-all-student-result');
	Route::get('result-filter', [App\Http\Controllers\Backend\ResultController::class, 'resultFilter'])->name('result.filter');
	Route::post('get-single-student-result', [App\Http\Controllers\Backend\ResultController::class, 'getSingleStudentResult'])->name('get-single-student-result');


	//addmission route.........
	Route::resource('admission', AdmissionController::class);
	Route::post('class-wise-fees', [App\Http\Controllers\Backend\AdmissionController::class, 'classWiseFees'])->name('class-wise-fees');
	Route::resource('form-of-admissions', AdmissionFormController::class);
	Route::get('approve.student/{id}', [App\Http\Controllers\Backend\AdmissionFormController::class, 'approveStudent'])->name('approve.student');


	//library route .........
	Route::resource('rackNo', RackNoController::class);
	Route::resource('book-limit-setting', BookLimitSettingController::class);
	Route::resource('author', AuthorController::class);
	Route::resource('book-category-of-library', LibraryBookCategoryController::class);
	Route::resource('libraryBook', LibraryBookController::class);


	Route::resource('bookIssue', StudentBookIssueController::class);
	Route::get('book-issue-delete/{id}', [App\Http\Controllers\Backend\StudentBookIssueController::class, 'destroy'])->name('bookIssue.delete');
	Route::post('search-student', [App\Http\Controllers\Backend\StudentBookIssueController::class, 'searchStudent'])->name('search.student');
	Route::get('book-return/{id}', [App\Http\Controllers\Backend\StudentBookIssueController::class, 'bookReturn'])->name('book.return');
	Route::post('book-issue-update/{id}', [App\Http\Controllers\Backend\StudentBookIssueController::class, 'bookIssueUpdate'])->name('book-issue-update');

	Route::resource('book-issue-teacher', TeacherBookIssueController::class);
	Route::get('teacher-book-issue-delete/{id}', [App\Http\Controllers\Backend\TeacherBookIssueController::class, 'destroy'])->name('teacher-book-issue.delete');
	Route::post('search-teacher', [App\Http\Controllers\Backend\TeacherBookIssueController::class, 'searchteacher'])->name('search.teacher');
	Route::get('teacher-date-expire-issued-list', [App\Http\Controllers\Backend\TeacherBookIssueController::class, 'teacherDateExpireIssuedList'])->name('teacher-date-expire-issued-list');
	Route::get('teacher-book-return/{id}', [App\Http\Controllers\Backend\TeacherBookIssueController::class, 'teacherBookReturn'])->name('teacher-book-return');

	
	Route::post('library-book-fine', [App\Http\Controllers\Backend\StudentBookIssueController::class, 'libraryBookFine'])->name('library-book-fine');
	Route::get('student-date-expire-issued-list', [App\Http\Controllers\Backend\StudentBookIssueController::class, 'studentDateExpireIssuedList'])->name('student-date-expire-issued-list');
	Route::get('return-date-expire-fine-list', [App\Http\Controllers\Backend\StudentBookIssueController::class, 'returnDateExpireFineList'])->name('return-date-expire-fine-list');

	Route::get('fine-amount-invoice/{id}', [App\Http\Controllers\Backend\StudentBookIssueController::class, 'fineAmountInvoice'])->name('fine-amount-invoice');


	//Profile route...
	Route::get('/profile', [App\Http\Controllers\Backend\profileController::class, 'index'])->name('profile');
	Route::post('/profile/update', [App\Http\Controllers\Backend\profileController::class, 'update'])->name('profile.update');
	Route::get('/security', [App\Http\Controllers\Backend\profileController::class, 'security'])->name('security');
	Route::post('/profile/security/update', [App\Http\Controllers\Backend\profileController::class, 'securityUpdate'])->name('profile.security.update');


	//contact form route.....
	Route::get('/contact-form', [App\Http\Controllers\Backend\AdmissionFormController::class, 'contactForm'])->name('contact-form');
	Route::get('/contact-form-destroy/{id}', [App\Http\Controllers\Backend\AdmissionFormController::class, 'contactFormDestroy'])->name('contactForm.destroy');

	//blog backend route.......
	Route::resource('blog-backend', BlogController::class);

	//contact route......
	Route::get('/contacts', [App\Http\Controllers\Backend\ContactController::class, 'index'])->name('contacts');
	Route::post('/contact-update/{id}', [App\Http\Controllers\Backend\ContactController::class, 'update'])->name('contact.update');


	//For Push Notification Controller...
	Route::resource('push-notification', PushNotificationController::class);
	Route::get('/push-notification-edit/{id}', [App\Http\Controllers\Backend\PushNotificationController::class, 'edit'])->name('push-notification-edit');
	Route::get('/push-notification-send/{id}', [App\Http\Controllers\Backend\PushNotificationController::class, 'pushNotificationSend'])->name('push-notification-send');

	Route::get('push-notification-direct', [App\Http\Controllers\Backend\PushNotificationController::class, 'pushNotificationDirect'])->name('push-notification-direct');
	Route::get('push-notification-direct-create', [App\Http\Controllers\Backend\PushNotificationController::class, 'pushNotificationDirectCreate'])->name('push-notification-direct-create');
	Route::post('push-notification-direct-store', [App\Http\Controllers\Backend\PushNotificationController::class, 'pushNotificationDirectStore'])->name('push-notification-direct-store');
	Route::get('push-notification-direct-delete/{id}', [App\Http\Controllers\Backend\PushNotificationController::class, 'pushNotificationDirectDelete'])->name('push-notification-direct-delete');


	//For Extend Class Of Students & Set Default Session...
	Route::get('/extend-class-of-students', [App\Http\Controllers\Backend\ExtendClassOfStudentController::class, 'getStudents'])->name('extend-class-of-students');
	Route::post('/extend-class-of-students', [App\Http\Controllers\Backend\ExtendClassOfStudentController::class, 'filterStudents'])->name('filter-students-for-extend-class');
	Route::post('/shift-students-to-upper-class', [App\Http\Controllers\Backend\ExtendClassOfStudentController::class, 'shiftStudents'])->name('shift-students-to-upper-class');
	Route::get('/default-session', [App\Http\Controllers\Backend\ExtendClassOfStudentController::class, 'defaultSession'])->name('default-session');
	Route::post('/default-session', [App\Http\Controllers\Backend\ExtendClassOfStudentController::class, 'updateDefaultSession'])->name('update-default-session');

	//Report Route .....
	Route::get('/report-of-class', [App\Http\Controllers\Backend\report\ReportController::class, 'classReport'])->name('report-of-class');
	Route::post('/report-of-class-filter', [App\Http\Controllers\Backend\report\ReportController::class, 'classReportFilter'])->name('report-of-class-filter');
	Route::post('/report-of-class-invoice', [App\Http\Controllers\Backend\report\ReportController::class, 'reportOfClassInvoice'])->name('report-of-class-invoice');

	Route::get('/report-of-student', [App\Http\Controllers\Backend\report\ReportController::class, 'studentReport'])->name('report-of-student');
	Route::post('/report-of-student-filter', [App\Http\Controllers\Backend\report\ReportController::class, 'studentReportFilter'])->name('report-of-student-filter');
	Route::post('/report-of-student-invoice', [App\Http\Controllers\Backend\report\ReportController::class, 'studentReportInvoice'])->name('report-of-student-invoice');

	Route::get('/report-of-routine', [App\Http\Controllers\Backend\report\ReportController::class, 'classRoutineReport'])->name('report-of-routine');
	Route::post('/report-of-routine-filter', [App\Http\Controllers\Backend\report\ReportController::class, 'classRoutineReportFilter'])->name('report-of-routine-filter');
	Route::post('/report-of-routine-invoice', [App\Http\Controllers\Backend\report\ReportController::class, 'classRoutineReportInvoice'])->name('report-of-routine-invoice');

	Route::get('/report-of-library-book', [App\Http\Controllers\Backend\report\ReportController::class, 'libraryBookReport'])->name('report-of-library-book');
	Route::get('/report-of-library-book-issue', [App\Http\Controllers\Backend\report\ReportController::class, 'libraryBookIssueReport'])->name('report-of-library-book-issue');
	Route::post('/report-of-library-book-issue', [App\Http\Controllers\Backend\report\ReportController::class, 'filterBookIssue'])->name('report-of-library-book-issue');
	Route::post('/report-of-library-book-issue-invoice', [App\Http\Controllers\Backend\report\ReportController::class, 'bookIssueReportInvoice'])->name('report-of-library-book-issue-invoice');

	Route::get('/report-of-addmission', [App\Http\Controllers\Backend\report\ReportController::class, 'addmissionReport'])->name('report-of-addmission');
	Route::post('/report-of-addmission-filter', [App\Http\Controllers\Backend\report\ReportController::class, 'addmissionReportFilter'])->name('report-of-addmission-filter');
	Route::post('/report-of-addmission-invoice', [App\Http\Controllers\Backend\report\ReportController::class, 'addmissionReportInvoice'])->name('report-of-addmission-invoice');


	Route::get('/report-of-attendence-student-filter', [App\Http\Controllers\Backend\report\ReportController::class, 'studentAttendenceReportFilter'])->name('report-of-attendence-student-filter');
	Route::post('/report-of-attendence-student', [App\Http\Controllers\Backend\report\ReportController::class, 'studentAttendenceReport'])->name('report-of-attendence-student');
	Route::post('student-report.daysAttendanceWithMonth', [App\Http\Controllers\Backend\report\ReportController::class, 'studentDaysAttendanceWithMonth'])->name('student-report.daysAttendanceWithMonth');
	Route::post('student-report-daysAttendanceWithMonth', [App\Http\Controllers\Backend\report\ReportController::class, 'studentDaysAttendanceWithMonthReport'])->name('student-report-daysAttendanceWithMonth');
	Route::post('/report-of-attendence-student-monthly-invoice', [App\Http\Controllers\Backend\report\ReportController::class, 'studentAttendenceReportMonthInvoice'])->name('report-of-attendence-student-monthly-invoice');
	Route::post('/report-of-attendence-student-day-invoice', [App\Http\Controllers\Backend\report\ReportController::class, 'studentAttendenceReportDayInvoice'])->name('report-of-attendence-student-day-invoice');


	Route::get('/report-of-attendence-teacher-filter', [App\Http\Controllers\Backend\report\ReportController::class, 'teacherAttendenceReportFilter'])->name('report-of-attendence-teacher-filter');
	Route::post('/report-of-attendence-teacher', [App\Http\Controllers\Backend\report\ReportController::class, 'teacherAttendenceReport'])->name('report-of-attendence-teacher');
	Route::post('teacher-report.daysAttendanceWithMonth', [App\Http\Controllers\Backend\report\ReportController::class, 'teacherDaysAttendanceWithMonth'])->name('teacher-report.daysAttendanceWithMonth');
	Route::post('teacher-report-daysAttendanceWithMonth', [App\Http\Controllers\Backend\report\ReportController::class, 'teacherDaysAttendanceWithMonthReport'])->name('teacher-report-daysAttendanceWithMonth');
	Route::post('/report-of-attendence-teacher-month-invoice', [App\Http\Controllers\Backend\report\ReportController::class, 'teacherAttendenceReportMonthInvoice'])->name('report-of-attendence-teacher-month-invoice');
	Route::post('/report-of-attendence-teacher-day-invoice', [App\Http\Controllers\Backend\report\ReportController::class, 'teacherAttendenceReportDayInvoice'])->name('report-of-attendence-teacher-day-invoice');

	//Rollback Controller ..........
	Route::get('rollback', [App\Http\Controllers\Backend\RollbackController::class, 'rollBack'])->name('rollback');
	Route::get('rollback-clean-data', [App\Http\Controllers\Backend\RollbackController::class, 'rollbackCleanData'])->name('rollback-clean-data');


	Route::get('/queue', [App\Http\Controllers\Backend\QueueContoller::class, 'index'])->name('queue');
	Route::post('/queue-add', [App\Http\Controllers\Backend\QueueContoller::class, 'queueAdd'])->name('queue-add');
});

Route::fallback(function () {
    return view('errors.404');
});