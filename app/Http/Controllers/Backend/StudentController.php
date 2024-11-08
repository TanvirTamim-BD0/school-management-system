<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\StudentPayment;
use App\Models\Student;
use App\Models\Classname;
use App\Models\Section;
use App\Models\Group;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Helpers\CurrentUser;
use App\Helpers\DefaultSessionYear;
use Image;
use App\Helpers\BloodGroup;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Guardian;
use App\Models\Contact;
use App\Models\Session;

class StudentController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:student-list|student-create|student-edit|student-delete', ['only' => ['index','show']]);
         $this->middleware('permission:student-create', ['only' => ['create','store']]);
         $this->middleware('permission:student-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:student-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //To get current user & session year...
        $userId = CurrentUser::getUserId();
        $defaultSessionYear = DefaultSessionYear::getDefaultSessionYear();

        //To get all the student data...
        $students = Student::orderBy('id', 'desc')->where('user_id', $userId)->where('session_year', $defaultSessionYear)->get();

        return view('backend.student.index' ,compact('students'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {      
        //To get current user...
        $userId = CurrentUser::getUserId();

        $getBloodGroup = BloodGroup::getBloodGroup();
        $classes = Classname::where('user_id', $userId)->get();
        $sections = Section::where('user_id', $userId)->get();
        $groups = Group::where('user_id', $userId)->get();
        $sessionData = Session::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.student.create' ,compact('classes','groups','sections','getBloodGroup','sessionData'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        $request->validate([
            'student_name'=> 'required',
            'student_phone'=> 'required|min:11|max:11|unique:students',
            'student_email'=> 'nullable|unique:students',
            'father_name'=> 'required',
            'phone'=> 'nullable|min:11|max:11|unique:guardians',
            'father_profession'=> 'nullable',
            'mother_name'=> 'required',
            'mother_phone'=> 'nullable|min:11|max:11|unique:guardians',
            'mother_profession'=> 'nullable',
            'class_id'=> 'required',
            'address'=> 'required',
            'section_id'=> 'required',
            'group_id'=> 'required',
            'date_of_birth'=> 'required',
            'addmission_date'=> 'required',
            'session_year'=> 'required',
            'roll_no'=> 'required|unique:students',
            'student_photo'=> 'nullable|mimes:jpg,jpeg,png,gif,svg',
        ]);

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To check user is already exist or not with student info...
        $checkStatus = CurrentUser::checkUserIsExistOrNot($userId, $request->student_phone, $request->student_email);
        if($checkStatus != null && $checkStatus['status'] == 1){
            Toastr::error('Error !! Please Use Another Student Phone', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }else if($checkStatus != null && $checkStatus['status'] == 2){
            Toastr::error('Error !! Please Use Another Student Email', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }

        //To check user is already exist or not with father info...
        $guardianEmail = null;
        $checkStatus = CurrentUser::checkUserIsExistOrNotForGuardian($userId, $request->phone, $guardianEmail);
        if($checkStatus != null && $checkStatus['status'] == 1){
            Toastr::error('Error !! Please Use Another Guardian Phone', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }else if($checkStatus != null && $checkStatus['status'] == 2){
            Toastr::error('Error !! Please Use Another Guardian Email', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
        

        $data = $request->all();
        $dateBirth = $request->date_of_birth;
        $addmissioDate = $request->addmission_date;
        $dateOfBirth = Carbon::createFromFormat('d/m/Y', $dateBirth)->format('Y-m-d');
        $data['date_of_birth'] = $dateOfBirth;
        $addmissionDate = Carbon::createFromFormat('d/m/Y', $addmissioDate)->format('Y-m-d');
        $data['addmission_date'] = $addmissionDate;
        $data['user_id'] = $userId;

        if($request->student_photo){
            $file = $request->file('student_photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();

            //For large size image...
            $destinationPath = public_path('uploads/student_photo/');
            Image::make($file)->save($destinationPath.$fileName);
            
            //For thumbnail size image...
            $destinationPath = public_path('uploads/student_photo/thumbnail/');
            Image::make($file)->resize(500,400)->save($destinationPath.$fileName);
            
            $data['student_photo'] = $fileName;
        }
        

        if($result = Student::create($data)){

            $currenYear = Carbon::now()->year;
            $registrationNo = $result->id + 100;

            //To update student roll & registration...
            $singleStudentData = Student::where('id', $result->id)->first();
            $singleStudentData->roll_no = $request->roll_no;
            $singleStudentData->registration_no = "TS".$currenYear.Carbon::now()->month.$registrationNo;
            $singleStudentData->save();

            //To generate student login userid & password....
            $user = new User();
            $user->name = $request->student_name;
            $user->mobile = $request->student_phone;
            $user->email = $request->student_email;
            $user->address = $request->address;
            $user->role = 'student';
            $user->admin_id = $userId;
            $user->password = Hash::make($request->loginPassword);
            $user->status = 1;
            
            if($user->save()){
                //To generate user login id & update to user table...
                $currentYear = date('Y');
                $userLoginId = 'st-'.$currentYear.$result->id;
                User::where('id', $user->id)->update(['login_id' => $userLoginId]);
                
                //To assign user role for student...
                $userRoleForAssign = Role::where('name', $user->role)->first();
                $user->assignRole($userRoleForAssign->id);

                //To create a new guardian....
                $newGuardianData = new Guardian();
                $newGuardianData->user_id = $singleStudentData->user_id;
                $newGuardianData->class_id = $request->class_id;
                $newGuardianData->section_id = $request->section_id;
                $newGuardianData->student_id = $singleStudentData->id;
                $newGuardianData->father_name = $request->father_name;
                $newGuardianData->phone = $request->phone;
                $newGuardianData->father_profession = $request->father_profession;
                $newGuardianData->mother_name = $request->mother_name;
                $newGuardianData->mother_phone = $request->mother_phone;
                $newGuardianData->mother_profession = $request->mother_profession;
                $newGuardianData->address = $request->address;
                $newGuardianData->save(); 

                //To generate guardian login userid & password....
                $userForGD = new User();
                $userForGD->name = $request->father_name;
                $userForGD->mobile = $request->phone;
                $userForGD->address = $request->address;
                $userForGD->role = 'guardian';
                $userForGD->admin_id = $userId;
                $userForGD->password = Hash::make($request->loginPassword);
                $userForGD->status = 1;

                if($userForGD->save()){
                    //To generate user login id & update to user table...
                    $student = Student::where('id',$singleStudentData->id)->first();
                    $userData = User::where('mobile',$student->student_phone)->first();
                    
                    $loginData = $userData->login_id;
                    $loginIdForGD = str_replace('st', 'gd', $loginData);

                    $userLoginIdForGD = $loginIdForGD;
                    User::where('id', $userForGD->id)->update(['login_id' => $userLoginIdForGD]);

                    //To assign user role for guardian...
                    $userGDRoleForAssign = Role::where('name', $userForGD->role)->first();
                    $userForGD->assignRole($userGDRoleForAssign->id);

                    Toastr::success('Student Created Successfully.', 'Success', ["progressbar" => true]);
                    return redirect(route('student.index'));
                }else{
                    Toastr::error('Error !! Someting Is Wrong', 'Error', ["progressbar" => true]);
                    return redirect()->back();
                }
            }else{
                Toastr::error('Error !! Someting Is Wrong', 'Error', ["progressbar" => true]);
                return redirect()->back();
            }
        }else{
            Toastr::error('Error !! Someting Is Wrong', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    
        //To get current user...
        $userId = CurrentUser::getUserId();
        $student = Student::find($id);
        $getBloodGroup = BloodGroup::getBloodGroup();
        $classes = Classname::where('user_id', $userId)->get();
        $sections = Section::where('class_id',$student->class_id)->where('user_id', $userId)->get();
        $groups = Group::where('user_id', $userId)->get();  
        $sessionData = Session::orderBy('id', 'desc')->where('user_id', $userId)->get();
        $singleDOB = Carbon::createFromFormat('Y-m-d', $student->date_of_birth)->format('d/m/Y');
        $singleAddmissionDate = Carbon::createFromFormat('Y-m-d', $student->addmission_date)->format('d/m/Y');

        return view('backend.student.edit' ,compact('student','classes','groups','sections','getBloodGroup','sessionData','singleDOB','singleAddmissionDate'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $singleSTD = Student::find($id);
        $request->validate([
            'student_name'=> 'required',
            'student_phone'=> 'required|min:11|max:11|unique:students,student_phone,'.$id,
            'student_email'=> 'nullable|unique:students,student_email,'.$id,
            'father_name'=> 'required',
            'phone'=> 'nullable|min:11|max:11|unique:guardians,phone,'.$singleSTD->guardianData->id,
            'father_profession'=> 'nullable',
            'mother_name'=> 'required',
            'mother_phone'=> 'nullable|min:11|max:11|unique:guardians,mother_phone,'.$singleSTD->guardianData->id,
            'mother_profession'=> 'nullable',
            'class_id'=> 'required',
            'address'=> 'required',
            'section_id'=> 'required',
            'group_id'=> 'required',
            'date_of_birth'=> 'required',
            'addmission_date'=> 'required',
            'roll_no'=> 'required|unique:students',
            'student_photo'=> 'nullable|mimes:jpg,jpeg,png,gif,svg',
        ]);

        $data = $request->all();
        $dateBirth = $request->date_of_birth;
        $addmissioDate = $request->addmission_date;
        $dateOfBirth = Carbon::createFromFormat('d/m/Y', $dateBirth)->format('Y-m-d');
        $data['date_of_birth'] = $dateOfBirth;
        $addmissionDate = Carbon::createFromFormat('d/m/Y', $addmissioDate)->format('Y-m-d');
        $data['addmission_date'] = $addmissionDate;

        //To get single student data...
        $student = Student::find($id);

        //To check user is already exist or not with student info...
        $checkStatus = CurrentUser::checkUserIsExistOrNot($student->user_id, $request->student_phone, $request->student_email);
        if($checkStatus != null && $checkStatus['status'] == 1){
            if($checkStatus['userData']->mobile != $student->student_phone){
                Toastr::error('Error !! Please Use Another Phone', 'Error', ["progressbar" => true]);
                return redirect()->back();
            }
        }else if($checkStatus != null && $checkStatus['status'] == 2){
             if($checkStatus['userData']->email != $student->student_email){
                Toastr::error('Error !! Please Use Another Email', 'Error', ["progressbar" => true]);
                return redirect()->back();
            }
        }

        //To check user is already exist or not with father info...
        $guardianEmail = null;
        $checkStatusForGD = CurrentUser::checkUserIsExistOrNotForGuardian($student->user_id, $request->phone, $guardianEmail);
        if($checkStatusForGD != null && $checkStatusForGD['status'] == 1){
            if($checkStatusForGD['userData']->mobile != $request->phone){
                Toastr::error('Error !! Please Use Another Phone', 'Error', ["progressbar" => true]);
                return redirect()->back();
            }
        }else if($checkStatusForGD != null && $checkStatusForGD['status'] == 2){
             if($checkStatusForGD['userData']->email != $guardianEmail){
                Toastr::error('Error !! Please Use Another Email', 'Error', ["progressbar" => true]);
                return redirect()->back();
            }
        }

        //For student previous profile picture...
        if($request->student_photo){
            //To remove previous file...
            $destinationPath = public_path('uploads/student_photo/');
            if(file_exists($destinationPath.$student->student_photo)){
                if($student->student_photo != ''){
                    unlink($destinationPath.$student->student_photo);
                }
            }

            $destinationPath = public_path('uploads/student_photo/thumbnail/');
            if(file_exists($destinationPath.$student->student_photo)){
                if($student->student_photo != ''){
                    unlink($destinationPath.$student->student_photo);
                }
            }


            $file = $request->file('student_photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();

             //For large size image...
            $destinationPath = public_path('uploads/student_photo/');
            Image::make($file)->save($destinationPath.$fileName);
            

            //For thumbnail size image...
            $destinationPath = public_path('uploads/student_photo/thumbnail/');
            Image::make($file)->resize(500,400)->save($destinationPath.$fileName);
            $data['student_photo'] = $fileName;
        }
        
        //To check student phone & email with user table...
        $userDataForSTD = User::where('mobile',$student->student_phone)->first();
        if($userDataForSTD->email != $request->student_email || $userDataForSTD->mobile != $request->student_phone){
            $userDataForSTD->mobile = $request->student_phone;
            $userDataForSTD->email = $request->student_email;
            $userDataForSTD->save();
        }

        if($student->update($data)){
            //To check guardian phone & email with user table...
            $userDataForGD = User::where('mobile',$student->guardianData->phone)->first();
            if($userDataForGD->mobile != $request->phone){
                $userDataForGD->mobile = $request->phone;
                $userDataForGD->save();
            }

            //To update guardian info...
            $singleGuardianData = Guardian::where('id', $student->guardianData->id)->first();
            $singleGuardianData->class_id = $request->class_id;
            $singleGuardianData->section_id = $request->section_id;
            $singleGuardianData->student_id = $student->id;
            $singleGuardianData->father_name = $request->father_name;
            $singleGuardianData->phone = $request->phone;
            $singleGuardianData->father_profession = $request->father_profession;
            $singleGuardianData->mother_name = $request->mother_name;
            $singleGuardianData->mother_phone = $request->mother_phone;
            $singleGuardianData->mother_profession = $request->mother_profession;
            $singleGuardianData->address = $request->address;
            $singleGuardianData->save(); 

            Toastr::success('Student Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('student.index'));
        }else{
            Toastr::error('Error !! Updated Failed', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //To get student & user data...
        $student = Student::find($id);
        $userData = User::where('email', $student->student_email)->first();

        //To check file is available or not...  
        if ($student->student_photo != null && file_exists(public_path('uploads/student_photo/'.$student->student_photo))) {
            unlink(public_path('uploads/student_photo/'.$student->student_photo));
            unlink(public_path('uploads/student_photo/thumbnail/'.$student->student_photo));
        }

        if($student->delete()){
            $userData->delete();
            Toastr::success('Student Delete Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('student.index'));
        }else{
            Toastr::error('Error !! Delete Failed', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }  
    }

    //To get student profile page...
    public function studentProfile($id)
    {
        $startMotnhNumber = 0;
        while ($startMotnhNumber < 12) {
            $monthNames[] = date("F", strtotime("+$startMotnhNumber months"));
            $startMotnhNumber++;
        }

        //To fetch single student data...
        $student = Student::where('id',$id)->first();

        $gurdianData = Guardian::where('class_id',$student->class_id)->where('section_id',$student->section_id)->where('student_id',$student->id)->first();
        
        //To get all the student payment data....    
        $getStdentPaymentData = StudentPayment::orderBy('id', 'desc')->where('class_id', $student->class_id)
                            ->where('section_id', $student->section_id)->where('student_id', $student->id)->get();
        
        $stdentPaymentData = [];
        $studentTotalPaidAmount = 0;
        $studentTotalFineAmount = 0;
        $studentTotalCollectionAmount = 0;
        foreach($getStdentPaymentData as $key=>$item){
            if(isset($item) && $item != null){
                $totalCollection = $item->total_paid_amount + $item->total_fine_amount;

                $studentTotalPaidAmount += $item->total_paid_amount;
                $studentTotalFineAmount += $item->total_fine_amount;
                $studentTotalCollectionAmount += $totalCollection;
                $stdentPaymentData[] = array(
                    'id' => $item->id,
                    'serial_no' => $key+1,
                    'invoice_id' => $item->invoice_id,
                    'total_paid_amount' => $item->total_paid_amount,
                    'total_fine_amount' => $item->total_fine_amount,
                    'total_collection_amount' => $totalCollection,
                    'payment_date' => $item->payment_date
                );
            }
        }

        return view('backend.student.studentProfile',compact('student','monthNames','stdentPaymentData'
                    ,'studentTotalPaidAmount','studentTotalFineAmount','studentTotalCollectionAmount','gurdianData'));
    }

    //To get student attendance data...
    public function studentDaysAttendanceWithMonth(Request $request)
    {
        //To fetch student course information...
        $student = Student::where('id',$request->studentId)->first();
        
        $dates = [];
        $courseYear = Carbon::parse($student->created_at)->year;
        $monthPosition = Carbon::parse('1'. $request->monthName)->month;
        $dateNumber = Carbon::parse($request->monthName)->daysInMonth;
        $currentMonth = $request->monthName;
        
        //All days show...
        for($i=1; $i < $dateNumber + 1; ++$i) {
            $dates[] = Carbon::createFromDate($courseYear, $monthPosition, $i)->format('Y-m-d');
        }

        return view('backend.student.daysAttendanceWithMonth' , compact('currentMonth','student','dates'));
    }


    //student id card generate student filter ........
    public function studentIdCartFilter(){

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get all the class data...
        $classData = Classname::where('user_id', $userId)->get();

        return view('backend.studentIdCard.filterStudent',compact('classData'));
    }

    //student idcard generate...............
    public function studentIdCardGenerate(Request $request){

        $studentData = Student::where('class_id',$request->class_id)->where('section_id',$request->section_id)->where('id',$request->student_id)->first();

        $singleContactInfoData = Contact::first();
        $todayDate = Carbon::now()->today()->toDateString();
        $invoiceData = array(
            'school_logo' => $singleContactInfoData->logo_image,
            'name' => $singleContactInfoData->name,
            'email' => $singleContactInfoData->email,
            'phone' => $singleContactInfoData->phone,
            'address' => $singleContactInfoData->address,
            'date' => $todayDate,
        );

        return view('backend.studentIdCard.idCard',compact('studentData','invoiceData'));
    }

    //student id card invoice 
    public function studentIdCardInvoice(Request $request){

         $studentData = Student::where('class_id',$request->class_id)->where('section_id',$request->section_id)->where('id',$request->student_id)->first();

        $singleContactInfoData = Contact::first();
        $todayDate = Carbon::now()->today()->toDateString();
        $invoiceData = array(
            'school_logo' => $singleContactInfoData->logo_image,
            'name' => $singleContactInfoData->name,
            'email' => $singleContactInfoData->email,
            'phone' => $singleContactInfoData->phone,
            'address' => $singleContactInfoData->address,
            'date' => $todayDate,
        );

        return view('backend.studentIdCard.idCardInvoice',compact('studentData','invoiceData'));
    }


    //student admit card generate....
    public function admitCard(){

        $singleContactInfoData = Contact::first();
        $todayDate = Carbon::now()->today()->toDateString();
        $invoiceData = array(
            'school_logo' => $singleContactInfoData->logo_image,
            'name' => $singleContactInfoData->name,
            'email' => $singleContactInfoData->email,
            'phone' => $singleContactInfoData->phone,
            'address' => $singleContactInfoData->address,
            'date' => $todayDate,
        );

        return view('backend.admitCard.admitCard',compact('invoiceData'));
    }

    //admit card print ...
    public function admitCardInvoice(Request $request)
    {
        $singleContactInfoData = Contact::first();
        $todayDate = Carbon::now()->today()->toDateString();
        $invoiceData = array(
            'school_logo' => $singleContactInfoData->logo_image,
            'name' => $singleContactInfoData->name,
            'email' => $singleContactInfoData->email,
            'phone' => $singleContactInfoData->phone,
            'address' => $singleContactInfoData->address,
            'date' => $todayDate,
        );

        return view('backend.admitCard.admitCardInvoice',compact('invoiceData'));

    }

    //To check student roll-id is unique or not...
    public function checkStudentRollId(Request $request)
    {
        //To get current user & single student data...
        $userId = CurrentUser::getUserId();
        $checkRoleId = Student::where('class_id', $request->class_id)->where('section_id', $request->section_id)
                       ->where('group_id', $request->group_id)->where('roll_no', $request->roll_no) 
                       ->where('user_id', $userId)->first();
        
        if(isset($checkRoleId) && $checkRoleId != null){
            return response()->json([
                'error' => 'Roll no must be unique.!'
            ]);
        }
    }

}
