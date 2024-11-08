<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Payroll;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Helpers\CurrentUser;
use App\Helpers\BloodGroup;
use Image;
use Brian2694\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Role;

class TeacherController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:teacher-list|teacher-create|teacher-edit|teacher-delete', ['only' => ['index','show']]);
         $this->middleware('permission:teacher-create', ['only' => ['create','store']]);
         $this->middleware('permission:teacher-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:teacher-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //To get current user...
        $userId = CurrentUser::getUserId();
        
        $teachers = Teacher::orderBy('id', 'desc')->where('user_id', $userId)->get();
        return view('backend.teacher.index' ,compact('teachers'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //To get all the blood group...
        $getBloodGroup = BloodGroup::getBloodGroup();

        return view('backend.teacher.create',compact('getBloodGroup'));
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
            'teacher_name'=> 'required',
            'teacher_phone'=> 'required|min:11|max:11|unique:teachers',
            'teacher_email'=> 'nullable|unique:teachers',
            'address'=> 'required',
            'joining_date'=> 'required',
            'designation'=> 'required',
            'loginPassword'=> 'required',
            'teacher_photo'=> 'nullable|mimes:jpg,jpeg,png,gif,svg',
        ]);

        //To get current user...
        $userId = CurrentUser::getUserId();      
        
        //To check user is already exist or not...
        $checkStatus = CurrentUser::checkUserIsExistOrNot($userId, $request->teacher_phone, $request->teacher_email);
        if($checkStatus != null && $checkStatus['status'] == 1){
            Toastr::error('Error !! Please Use Another Phone', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }else if($checkStatus != null && $checkStatus['status'] == 2){
            Toastr::error('Error !! Please Use Another Email', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
        
        $data = $request->all();

        if ($request->date_of_birth) {
            $dateBirth = $request->date_of_birth;
            $dateOfBirth = Carbon::createFromFormat('d/m/Y', $dateBirth)->format('Y-m-d');
            $data['date_of_birth'] = $dateOfBirth;
        }

        $joininDate = $request->joining_date;
        $joiningDate = Carbon::createFromFormat('d/m/Y', $joininDate)->format('Y-m-d');
        $data['joining_date'] = $joiningDate;

        if($request->teacher_photo){
            $file = $request->file('teacher_photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();

            //For large size image...
            $destinationPath = public_path('uploads/teacher_photo/');
            Image::make($file)->save($destinationPath.$fileName);
            
            //For thumbnail size image...
            $destinationPath = public_path('uploads/teacher_photo/thumbnail/');
            Image::make($file)->resize(500,400)->save($destinationPath.$fileName);
            
            $data['teacher_photo'] = $fileName;
        }


        $data['user_id'] = Auth::user()->id;

        if($newTeacher = Teacher::create($data)){

            $user = new User();
            $user->name = $request->teacher_name;
            $user->mobile = $request->teacher_phone;
            $user->email = $request->teacher_email;
            $user->address = $request->address;
            $user->role = 'teacher';
            $user->admin_id = $userId;
            $user->password = Hash::make($request->loginPassword);
            $user->status = 1;

            if($user->save()){
                //To generate user login id & update to user table...
                $currentYear = date('Y');
                $userLoginId = 'tc-'.$currentYear.$newTeacher->id;
                User::where('id', $user->id)->update(['login_id' => $userLoginId]);

                //To assign user role...
                $userRoleForAssign = Role::where('name', $user->role)->first();
                $user->assignRole($userRoleForAssign->id); 

                Toastr::success('Teacher Created Successfully.', 'Success', ["progressbar" => true]);
                return redirect(route('teacher.index'));
            }else{
                Toastr::error('Error !! Someting Is Wrong', 'Error', ["progressbar" => true]);
                return redirect()->back();
            }
        }else{
            Toastr::error('Error !! Added Failed', 'Error', ["progressbar" => true]);
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
        $teacher = Teacher::find($id);
        $getBloodGroup = BloodGroup::getBloodGroup();
        $singleJoiningDate = Carbon::createFromFormat('Y-m-d', $teacher->joining_date)->format('d/m/Y');
        $singleDOB = Carbon::createFromFormat('Y-m-d', $teacher->date_of_birth)->format('d/m/Y');

        return view('backend.teacher.edit' ,compact('teacher','getBloodGroup','singleJoiningDate','singleDOB'));
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
        $request->validate([
            'teacher_name'=> 'required',
            'teacher_phone'=> 'required|min:11|max:11|unique:teachers,teacher_phone,'.$id,
            'teacher_email'=> 'nullable|unique:teachers,teacher_email,'.$id,
            'address'=> 'required',
            'joining_date'=> 'required',
            'designation'=> 'required',
            'teacher_photo'=> 'nullable|mimes:jpg,jpeg,png,gif,svg',
        ]);

        $data = $request->all();

        $dateBirth = $request->date_of_birth;
        $joininDate = $request->joining_date;
        $dateOfBirth = Carbon::createFromFormat('d/m/Y', $dateBirth)->format('Y-m-d');
        $data['date_of_birth'] = $dateOfBirth;
        $joiningDate = Carbon::createFromFormat('d/m/Y', $joininDate)->format('Y-m-d');
        $data['joining_date'] = $joiningDate;

        //To get single teacher data...
        $teacher = Teacher::find($id);

        //To check user is already exist or not...
        $checkStatus = CurrentUser::checkUserIsExistOrNot($teacher->user_id, $request->teacher_phone, $request->teacher_email);
        if($checkStatus != null && $checkStatus['status'] == 1){
            if($checkStatus['userData']->mobile != $teacher->teacher_phone){
                Toastr::error('Error !! Please Use Another Phone', 'Error', ["progressbar" => true]);
                return redirect()->back();
            }
        }else if($checkStatus != null && $checkStatus['status'] == 2){
             if($checkStatus['userData']->email != $teacher->teacher_email){
                Toastr::error('Error !! Please Use Another Email', 'Error', ["progressbar" => true]);
                return redirect()->back();
            }
        }

        if($request->teacher_photo){
            //To remove previous file...
            $destinationPath = public_path('uploads/teacher_photo/');
            if(file_exists($destinationPath.$teacher->teacher_photo)){
                if($teacher->teacher_photo != ''){
                    unlink($destinationPath.$teacher->teacher_photo);
                }
            }

            //To remove previous file...
            $destinationPath = public_path('uploads/teacher_photo/thumbnail/');
            if(file_exists($destinationPath.$teacher->teacher_photo)){
                if($teacher->teacher_photo != ''){
                    unlink($destinationPath.$teacher->teacher_photo);
                }
            }

            $file = $request->file('teacher_photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            
            //For large size image...
            $destinationPath = public_path('uploads/teacher_photo/');
            Image::make($file)->save($destinationPath.$fileName);
            
            //For thumbnail size image...
            $destinationPath = public_path('uploads/teacher_photo/thumbnail/');
            Image::make($file)->resize(500,400)->save($destinationPath.$fileName);

            $data['teacher_photo'] = $fileName;
        }
        
        if($teacher->update($data)){
            Toastr::success('Teacher Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('teacher.index'))->with('message','Successfully Teacher Updated');
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
        //To get teacher & user data...
        $teacher = Teacher::find($id);
        $userData = User::where('email', $teacher->teacher_email)->first();

        //To check file is available or not...  
        if ($teacher->teacher_photo != null && file_exists(public_path('uploads/teacher_photo/'.$teacher->teacher_photo))) {
            unlink(public_path('uploads/teacher_photo/'.$teacher->teacher_photo));
            unlink(public_path('uploads/teacher_photo/thumbnail/'.$teacher->teacher_photo));
        }

        if($teacher->delete()){
            $userData->delete();
            Toastr::success('Teacher Delete Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('teacher.index'))->with('message','Successfully Teacher Deleted');
        }else{
            Toastr::error('Error !! Delete Failed', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }  
    }

    //To get teacher profile page...
    public function teacherProfile($id)
    {
        $startMotnhNumber = 0;
        while ($startMotnhNumber < 12) {
            $monthNames[] = date("F", strtotime("+$startMotnhNumber months"));
            $startMotnhNumber++;
        }

        $teacher = Teacher::where('id',$id)->first();
        $singleUserData = User::where('email', $teacher->teacher_email)->first();

        //To fetch all the payments data with librarian  id wise...
        $paymentData = Payroll::orderBy('id','desc')->where('payment_to_id', $singleUserData->id)->get();

        return view('backend.teacher.teacherProfile',compact('teacher','monthNames','paymentData'));

    }

    //To get teacher attendance with month wise...
    public function teacherDaysAttendanceWithMonth(Request $request)
    {
        //To fetch student course information...
        $teacher = Teacher::where('id',$request->teacherId)->first();

        $dates = [];
        $courseYear = Carbon::parse($teacher->created_at)->year;
        $monthPosition = Carbon::parse('1'. $request->monthName)->month;
        $dateNumber = Carbon::parse($request->monthName)->daysInMonth;
        $currentMonth = $request->monthName;
        
        //All days show...
        for($i=1; $i < $dateNumber + 1; ++$i) {
            $dates[] = Carbon::createFromDate($courseYear, $monthPosition, $i)->format('Y-m-d');
        }

        return view('backend.teacher.daysAttendanceWithMonth' , compact('currentMonth','teacher','dates'));

    }   

}
