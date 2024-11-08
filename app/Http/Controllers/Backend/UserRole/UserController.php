<?php

namespace App\Http\Controllers\backend\userRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use DB;
use Hash;
use Auth;
use Spatie\Permission\Models\Permission;
use Brian2694\Toastr\Facades\Toastr;
use App\Helpers\CurrentUser;
use App\Models\Librarian;
use App\Models\Accountent;
use App\Models\Guardian;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;

class UserController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
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

        //To get all the admission data...
        $userData = User::orderBy('id', 'desc')->where('admin_id', $userId)->where('role','admin')->get();
        
        return view('backend.userRole.users.index',compact('userData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == 'superadmin'){
            $roles = Role::whereNotIn('name', ['superadmin','teacher','student','guardian','accountent','librarian'])->get();
        }elseif(Auth::user()->role == 'admin'){
            $roles = Role::whereNotIn('name', ['superadmin','teacher','student','guardian','accountent','librarian'])->get();
        }elseif(Auth::user()->role == 'teacher'){
            $roles = Role::whereNotIn('name', ['superadmin','teacher','student','guardian','accountent','librarian'])->get();
        }elseif(Auth::user()->role == 'student'){
            $roles = Role::whereNotIn('name', ['superadmin','teacher','student','guardian','accountent','librarian'])->get();
        }elseif(Auth::user()->role == 'guardian'){
            $roles = Role::whereNotIn('name', ['superadmin','teacher','student','guardian','accountent','librarian'])->get();
        }else{
            $roles[] = null;
        }

        $userData[] = null;

        return view('backend.userRole.users.create',compact('roles','userData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|unique:users',
            'password' => 'required|same:password_confirmation',
            'roles' => 'required'
        ]);
    
        $data = $request->all();
        $userRole = Role::where('id', $request->roles)->first();

        $userId = CurrentUser::getUserId();

        //To set user role..
        if($userRole->name == 'admin'){
            $data['role'] = 'admin';
        }
        if($userRole->name == "teacher"){
            $data['role'] = 'teacher';
        }
        if($userRole->name == "student"){
            $data['role'] = 'student';
        }
        if($userRole->name == "guardian"){
            $data['role'] = 'guardian';
        }

        $data['admin_id'] = $userId;
 

        if($request->image){
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('backend/uploads/userRole/');
            $file->move($destinationPath,$fileName);
            $data['image'] = $fileName;
        }


        $data['password'] = Hash::make($data['password']);
    
        if($user = User::create($data)){
            //To generate user login id & update to user table...
            $currentYear = date('Y');
            $userLoginId = 'ad-'.$currentYear.$user->id;
            User::where('id', $user->id)->update(['login_id' => $userLoginId]);

            //To assign user role...
            $user->assignRole($request->input('roles'));
            Toastr::success('User Created Successfully.', 'Success', ["progressbar" => true]);
            return redirect()->route('users.index');
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role == 'superadmin'){
            $roles = Role::whereNotIn('name', ['superadmin','teacher','student','guardian','accountent','librarian'])->get();
        }elseif(Auth::user()->role == 'admin'){
            $roles = Role::whereNotIn('name', ['superadmin','teacher','student','guardian','accountent','librarian'])->get();
        }elseif(Auth::user()->role == 'teacher'){
            $roles = Role::whereNotIn('name', ['superadmin','teacher','student','guardian','accountent','librarian'])->get();
        }elseif(Auth::user()->role == 'student'){
            $roles = Role::whereNotIn('name', ['superadmin','teacher','student','guardian','accountent','librarian'])->get();
        }elseif(Auth::user()->role == 'guardian'){
            $roles = Role::whereNotIn('name', ['superadmin','teacher','student','guardian','accountent','librarian'])->get();
        }else{
            $roles[] = null;
        }

        $userData = User::find($id);
    
        return view('backend.userRole.users.edit',compact('userData','roles'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile' => 'required|unique:users,mobile,'.$id,
            'password' => 'nullable|min:3|same:password_confirmation'
        ]);
    
        $data = $request->all();
        $userData = User::find($id);
        $userRole = Role::where('id', $request->roles)->first();

        if($userRole != null){
            //To set user role..
            if($userRole->name == 'admin'){
                $data['role'] = 'admin';
            }
            if($userRole->name == "teacher"){
                $data['role'] = 'teacher';
            }
            if($userRole->name == "student"){
                $data['role'] = 'student';
            }
            if($userRole->name == "guardian"){
                $data['role'] = 'guardian';
            }
        }

        //To check user role..
        if(Auth::user()->role == 'admin'){
            $data['admin_id'] = Auth::user()->id;
        }
        if(Auth::user()->role == 'teacher'){
            $data['admin_id'] = Auth::user()->admin_id;
        }

        //To check password is empty or not...
        if($request->password != null){
            $data['password'] = Hash::make($data['password']);
        }else{
            $data['password'] = $userData->password;
        }

        if($request->image){
            //To remove previous file...
            $destinationPath = public_path('backend/uploads/userRole/');
            if(file_exists($destinationPath.$userData->image)){
                if($userData->image != ''){
                    unlink($destinationPath.$userData->image);
                }
            }

            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('backend/uploads/userRole/');
            $file->move($destinationPath,$fileName);
            $data['image'] = $fileName;
        }

        if($userData->update($data)){
            if($userData->role != 'superadmin'){
                DB::table('model_has_roles')->where('model_id',$id)->delete();
                $userData->assignRole($request->input('roles'));
            }
            
            Toastr::success('User Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect()->route('users.index')->with('message','Successfully User Updated');
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
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
        $user = User::findOrFail($id);

        if(isset($user->role) && $user->role == 'teacher'){
            //To fetch single teacher data...
            $singleTeacher = Teacher::where('teacher_phone',$user->mobile)->first();

            //To check file is available or not...  
            if ($singleTeacher->teacher_photo != null && file_exists(public_path('uploads/teacher_photo/'.$singleTeacher->teacher_photo))) {
                unlink(public_path('uploads/teacher_photo/'.$singleTeacher->teacher_photo));
                unlink(public_path('uploads/teacher_photo/thumbnail/'.$singleTeacher->teacher_photo));
            }
            
            $singleTeacher->delete();
        }
        if(isset($user->role) && $user->role == 'student'){
            //To fetch single student data...
            $singleStudent = Student::where('student_phone',$user->mobile)->first();

            //To check file is available or not...  
            if ($singleStudent->student_photo != null && file_exists(public_path('uploads/student_photo/'.$singleStudent->student_photo))) {
                unlink(public_path('uploads/student_photo/'.$singleStudent->student_photo));
                unlink(public_path('uploads/student_photo/thumbnail/'.$singleStudent->student_photo));
            }
            
            $singleStudent->delete();
        }
        if(isset($user->role) && $user->role == 'librarian'){
            //To fetch single librarian data...
            $singleLibrarian = Librarian::where('librarian_phone',$user->mobile)->first();

            //To check file is available or not...  
            if ($singleLibrarian->librarian_photo != null && file_exists(public_path('uploads/librarian_photo/'.$singleLibrarian->librarian_photo))) {
                unlink(public_path('uploads/librarian_photo/'.$singleLibrarian->librarian_photo));
                unlink(public_path('uploads/librarian_photo/thumbnail/'.$singleLibrarian->librarian_photo));
            }
            
            $singleLibrarian->delete();
        }
        if(isset($user->role) && $user->role == 'accountent'){
            //To fetch single accountent data...
            $singleAccountent = Accountent::where('accountent_phone',$user->mobile)->first();

            //To check file is available or not...  
            if ($singleAccountent->accountent_photo != null && file_exists(public_path('uploads/accountent_photo/'.$singleAccountent->accountent_photo))) {
                unlink(public_path('uploads/accountent_photo/'.$singleAccountent->accountent_photo));
                unlink(public_path('uploads/accountent_photo/thumbnail/'.$singleAccountent->accountent_photo));
            }
            
            $singleAccountent->delete();
        }
        if(isset($user->role) && $user->role == 'guardian'){
            //To fetch single guardian data...
            $singleGuardian = Guardian::where('phone',$user->mobile)->first();

            //To check file is available or not...  
            if ($singleGuardian->guardian_photo != null && file_exists(public_path('uploads/guardian_photo/'.$singleGuardian->guardian_photo))) {
                unlink(public_path('uploads/guardian_photo/'.$singleGuardian->guardian_photo));
                unlink(public_path('uploads/guardian_photo/thumbnail/'.$singleGuardian->guardian_photo));
            }
            
            $singleGuardian->delete();
        }

        if($user->delete()){
            Toastr::success('User Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect()->back()->with('message','Successfully User Deleted');
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back()->with('message','Something is wrong.!');
        }
    }





    //To active user...
    public function userActive($id)
    {
        $user = User::find($id);
        $user->status = 1;

        if($user->save()){
            Toastr::success('User Activated Successfully.', 'Success', ["progressbar" => true]);
            return redirect()->back()->with('message','Successfully User Deleted');
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back()->with('message','Something is wrong.!');;
        }
    }
    
    //To active user...
    public function userInactive($id)
    {
        $user = User::find($id);
        $user->status = 0;

        if($user->save()){
            Toastr::success('User In-Activated Successfully.', 'Success', ["progressbar" => true]);
            return redirect()->back()->with('message','Successfully User Deleted');
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back()->with('message','Something is wrong.!');;
        }
    }


    public function userPassword(Request $request, $id)
    {
        $request->validate([
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        if ($request->new_password == $request->confirm_password) {

            User::find($id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            return redirect()->route('users.index')->with('message','Successfully Password Updated');

        }else{
            return redirect()->back()->with('error','Something is wrong.!');
        }

        
    }

}
