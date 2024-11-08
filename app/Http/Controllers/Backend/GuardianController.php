<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guardian;
use App\Models\Classname;
use App\Models\Section;
use App\Models\Student;
use Auth;
use App\Helpers\CurrentUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Image;
use Brian2694\Toastr\Facades\Toastr;

class GuardianController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:guardian-list|guardian-create|guardian-edit|guardian-delete', ['only' => ['index','show']]);
         $this->middleware('permission:guardian-create', ['only' => ['create','store']]);
         $this->middleware('permission:guardian-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:guardian-delete', ['only' => ['destroy']]);
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

        $guardians = Guardian::orderBy('id', 'desc')->where('user_id',$userId)->get();
        return view('backend.guardian.index' ,compact('guardians'));
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

        $classData = Classname::where('user_id',$userId)->get();
        return view('backend.guardian.create',compact('classData'));
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
            'class_id'=> 'required',
            'section_id'=> 'required',
            'student_id'=> 'required',
            'guardian_name'=> 'required',
            'phone'=> 'required|min:11|max:11|unique:guardians',
            'email'=> 'required|unique:guardians',
            'address'=> 'required',
            'photo'=> 'nullable|mimes:jpg,jpeg,png,gif,svg',
        ]);

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To check user is already exist or not...
        $checkStatus = CurrentUser::checkUserIsExistOrNot($userId, $request->phone, $request->email);
        if($checkStatus != null && $checkStatus['status'] == 1){
            Toastr::error('Error !! Please Use Another Phone', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }else if($checkStatus != null && $checkStatus['status'] == 2){
            Toastr::error('Error !! Please Use Another Email', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }

  
        $data = $request->all();

        if($request->photo){
            $file = $request->file('photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();

            //For large size image...
            $destinationPath = public_path('uploads/guardian_photo/');
            Image::make($file)->save($destinationPath.$fileName);
            
            //For thumbnail size image...
            $destinationPath = public_path('uploads/guardian_photo/thumbnail/');
            Image::make($file)->resize(500,400)->save($destinationPath.$fileName);
            
            $data['photo'] = $fileName;
        }

        $data['user_id'] = Auth::user()->id;

        if($newGuardian = Guardian::create($data)){

            $user = new User();
            $user->name = $request->guardian_name;
            $user->mobile = $request->phone;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->role = 'guardian';
            $user->admin_id = $userId;
            $user->password = Hash::make($request->loginPassword);
            $user->status = 1;

            if($user->save()){
                //To generate user login id & update to user table...
                $student = Student::where('id',$request->student_id)->first();
                $userData = User::where('mobile',$student->student_phone)->first();

                $loginData = $userData->login_id;
                $loginId = str_replace('st', 'gd', $loginData);

                $userLoginId = $loginId;
                User::where('id', $user->id)->update(['login_id' => $userLoginId]);

                //To assign user role...
                $user->assignRole($user->role); 

                Toastr::success('Guardian Created Successfully.', 'Success', ["progressbar" => true]);
                return redirect(route('guardian.index'));
            }else{
                Toastr::error('Error !! Someting Is Wrong', 'Error', ["progressbar" => true]);
                return redirect()->back();
            }
        }else{
            return redirect()->back()->with('error','Error !! Added Failed');
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
        $guardian = Guardian::find($id);

        //To get current user...
        $userId = CurrentUser::getUserId();

        $classData = Classname::where('user_id',$userId)->get();
        $sectionData = Section::where('class_id',$guardian->class_id)->where('user_id',$userId)->get();
        $studentData = Student::where('section_id',$guardian->section_id)->where('user_id',$userId)->get();

        return view('backend.guardian.edit' ,compact('guardian','classData','sectionData','studentData'));
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
            'class_id'=> 'required',
            'section_id'=> 'required',
            'student_id'=> 'required',
            'guardian_name'=> 'required',
            'phone'=> 'required|min:11|max:11|unique:guardians,phone,'.$id,
            'email'=> 'required|unique:guardians,email,'.$id,
            'address'=> 'required',
            'photo'=> 'nullable|mimes:jpg,jpeg,png,gif,svg',
        ]);

        $data = $request->all();

        //To get single gurdian data...
        $guardian = Guardian::find($id);

        //To check user is already exist or not...
        $checkStatus = CurrentUser::checkUserIsExistOrNot($guardian->user_id, $request->phone, $request->email);
        if($checkStatus != null && $checkStatus['status'] == 1){
            if($checkStatus['userData']->mobile != $guardian->phone){
                Toastr::error('Error !! Please Use Another Phone', 'Error', ["progressbar" => true]);
                return redirect()->back();
            }
        }else if($checkStatus != null && $checkStatus['status'] == 2){
             if($checkStatus['userData']->email != $guardian->email){
                Toastr::error('Error !! Please Use Another Email', 'Error', ["progressbar" => true]);
                return redirect()->back();
            }
        }

        if($request->photo){
            //To remove previous file...
            $destinationPath = public_path('uploads/guardian_photo/');
            if(file_exists($destinationPath.$guardian->photo)){
                if($guardian->photo != ''){
                    unlink($destinationPath.$guardian->photo);
                }
            }

            //To remove previous file...
            $destinationPath = public_path('uploads/guardian_photo/thumbnail/');
            if(file_exists($destinationPath.$guardian->photo)){
                if($guardian->photo != ''){
                    unlink($destinationPath.$guardian->photo);
                }
            }

            $file = $request->file('photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            
            //For large size image...
            $destinationPath = public_path('uploads/guardian_photo/');
            Image::make($file)->save($destinationPath.$fileName);
            
            //For thumbnail size image...
            $destinationPath = public_path('uploads/guardian_photo/thumbnail/');
            Image::make($file)->resize(500,400)->save($destinationPath.$fileName);

            $data['photo'] = $fileName;
        }
        
        
        if($guardian->update($data)){
             Toastr::success('Guardian Update Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('guardian.index'))->with('message','Successfully Guardian Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
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
        //To get gurdian & user data...
        $guardian = Guardian::find($id);
        $userData = User::where('email', $guardian->email)->first();

        //To check file is available or not...  
        if ($guardian->photo != null && file_exists(public_path('uploads/guardian_photo/'.$guardian->photo))) {
            unlink(public_path('uploads/guardian_photo/'.$guardian->photo));
            unlink(public_path('uploads/guardian_photo/thumbnail/'.$guardian->photo));
        }

        if($guardian->delete()){
            $userData->delete();
            Toastr::success('Guardian Delete Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('guardian.index'))->with('message','Successfully Guardian Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }  
    }

}
