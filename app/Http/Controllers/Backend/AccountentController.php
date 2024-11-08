<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accountent;
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

class AccountentController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:accountent-list|accountent-create|accountent-edit|accountent-delete', ['only' => ['index','show']]);
         $this->middleware('permission:accountent-create', ['only' => ['create','store']]);
         $this->middleware('permission:accountent-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:accountent-delete', ['only' => ['destroy']]);
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
        //To get all the accountent data with user id...
        $accountentData = Accountent::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.accountent.index' ,compact('accountentData'));
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

        return view('backend.accountent.create',compact('getBloodGroup'));
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
            'accountent_name'=> 'required',
            'accountent_phone'=> 'required|min:11|max:11|unique:accountents',
            'address'=> 'required',
            'accountent_email'=> 'nullable|unique:accountents',
            'joining_date'=> 'required',
            'date_of_birth'=> 'required',
            'designation'=> 'required',
            'salary'=> 'required',
            'loginPassword'=> 'required',
            'accountent_photo'=> 'nullable|mimes:jpg,jpeg,png,gif,svg',
        ]);

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To check user is already exist or not...
        $checkStatus = CurrentUser::checkUserIsExistOrNot($userId, $request->accountent_phone, $request->accountent_email);
        if($checkStatus != null && $checkStatus['status'] == 1){
            Toastr::error('Error !! Please Use Another Phone', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }else if($checkStatus != null && $checkStatus['status'] == 2){
            Toastr::error('Error !! Please Use Another Email', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
        
        $data = $request->all();

        $dateBirth = $request->date_of_birth;
        $joininDate = $request->joining_date;
        $dateOfBirth = Carbon::createFromFormat('d/m/Y', $dateBirth)->format('Y-m-d');
        $data['date_of_birth'] = $dateOfBirth;
        $joiningDate = Carbon::createFromFormat('d/m/Y', $joininDate)->format('Y-m-d');
        $data['joining_date'] = $joiningDate;

        if($request->accountent_photo){
            $file = $request->file('accountent_photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();

            //For large size image...
            $destinationPath = public_path('uploads/accountent_photo/');
            Image::make($file)->save($destinationPath.$fileName);
            
            //For thumbnail size image...
            $destinationPath = public_path('uploads/accountent_photo/thumbnail/');
            Image::make($file)->resize(500,400)->save($destinationPath.$fileName);
            
            $data['accountent_photo'] = $fileName;
        }


        $data['user_id'] = Auth::user()->id;

        if($newAccountent = Accountent::create($data)){

            $user = new User();
            $user->name = $request->accountent_name;
            $user->mobile = $request->accountent_phone;
            $user->email = $request->accountent_email;
            $user->address = $request->address;
            $user->role = 'accountent';
            $user->admin_id = $userId;
            $user->password = Hash::make($request->loginPassword);
            $user->status = 1;

            if($user->save()){
                //To generate user login id & update to user table...
                $currentYear = date('Y');
                $userLoginId = 'ac-'.$currentYear.$newAccountent->id;
                User::where('id', $user->id)->update(['login_id' => $userLoginId]);

                //To assign user role...
                $userRoleForAssign = Role::where('name', $user->role)->first();
                $user->assignRole($userRoleForAssign->id); 

                Toastr::success('Accountent Created Successfully.', 'Success', ["progressbar" => true]);
                return redirect(route('accountent.index'));
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
        $singleAccountent = Accountent::find($id);
        $getBloodGroup = BloodGroup::getBloodGroup();
        $singleJoiningDate = Carbon::createFromFormat('Y-m-d', $singleAccountent->joining_date)->format('d/m/Y');
        $singleDOB = Carbon::createFromFormat('Y-m-d', $singleAccountent->date_of_birth)->format('d/m/Y');

        return view('backend.accountent.edit' ,compact('singleAccountent','getBloodGroup','singleJoiningDate','singleDOB'));
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
            'accountent_name'=> 'required',
            'accountent_phone'=> 'required|min:11|max:11|unique:accountents,accountent_phone,'.$id,
            'address'=> 'required',
            'joining_date'=> 'required',
            'date_of_birth'=> 'required',
            'designation'=> 'required',
            'salary'=> 'required',
            'accountent_photo'=> 'nullable|mimes:jpg,jpeg,png,gif,svg',
        ]);

        $data = $request->all();

        $dateBirth = $request->date_of_birth;
        $joininDate = $request->joining_date;
        $dateOfBirth = Carbon::createFromFormat('d/m/Y', $dateBirth)->format('Y-m-d');
        $data['date_of_birth'] = $dateOfBirth;
        $joiningDate = Carbon::createFromFormat('d/m/Y', $joininDate)->format('Y-m-d');
        $data['joining_date'] = $joiningDate;

        //To get single accountent data...
        $singleAccountent = Accountent::find($id);

        //To check user is already exist or not...
        $checkStatus = CurrentUser::checkUserIsExistOrNot($singleAccountent->user_id, $request->accountent_phone, $request->accountent_email);
        if($checkStatus != null && $checkStatus['status'] == 1){
            if($checkStatus['userData']->mobile != $singleAccountent->accountent_phone){
                Toastr::error('Error !! Please Use Another Phone', 'Error', ["progressbar" => true]);
                return redirect()->back();
            }
        }else if($checkStatus != null && $checkStatus['status'] == 2){
             if($checkStatus['userData']->email != $singleAccountent->accountent_email){
                Toastr::error('Error !! Please Use Another Email', 'Error', ["progressbar" => true]);
                return redirect()->back();
            }
        }

        if($request->accountent_photo){
            //To remove previous file...
            $destinationPath = public_path('uploads/accountent_photo/');
            if(file_exists($destinationPath.$singleAccountent->accountent_photo)){
                if($singleAccountent->accountent_photo != ''){
                    unlink($destinationPath.$singleAccountent->accountent_photo);
                }
            }

            //To remove previous file...
            $destinationPath = public_path('uploads/accountent_photo/thumbnail/');
            if(file_exists($destinationPath.$singleAccountent->accountent_photo)){
                if($singleAccountent->accountent_photo != ''){
                    unlink($destinationPath.$singleAccountent->accountent_photo);
                }
            }

            $file = $request->file('accountent_photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            
            //For large size image...
            $destinationPath = public_path('uploads/accountent_photo/');
            Image::make($file)->save($destinationPath.$fileName);
            
            //For thumbnail size image...
            $destinationPath = public_path('uploads/accountent_photo/thumbnail/');
            Image::make($file)->resize(500,400)->save($destinationPath.$fileName);

            $data['accountent_photo'] = $fileName;
        }
        
        if($singleAccountent->update($data)){
            Toastr::success('Accountent Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('accountent.index'))->with('message','Successfully Teacher Updated');
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
        //To get accountent & user data...
        $singleAccountent = Accountent::find($id);
        $userData = User::where('email', $singleAccountent->accountent_email)->first();

        //To check file is available or not...  
        if ($singleAccountent->accountent_photo != null && file_exists(public_path('uploads/accountent_photo/'.$singleAccountent->accountent_photo))) {
            unlink(public_path('uploads/accountent_photo/'.$singleAccountent->accountent_photo));
            unlink(public_path('uploads/accountent_photo/thumbnail/'.$singleAccountent->accountent_photo));
        }

        if($singleAccountent->delete()){
            $userData->delete();
            Toastr::success('Accountent Delete Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('accountent.index'))->with('message','Successfully Teacher Deleted');
        }else{
            Toastr::error('Error !! Delete Failed', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }

    //To get accountent profile page...
    public function accountentProfile($id)
    {
        $startMotnhNumber = 0;
        while ($startMotnhNumber < 12) {
            $monthNames[] = date("F", strtotime("+$startMotnhNumber months"));
            $startMotnhNumber++;
        }

        //To fetch single accountent & user data...
        $singleAccountent = Accountent::where('id',$id)->first();
        $singleUserData = User::where('email', $singleAccountent->accountent_email)->first();

        //To fetch all the payments data with librarian  id wise...
        $paymentData = Payroll::orderBy('id','desc')->where('payment_to_id', $singleUserData->id)->get();

        return view('backend.accountent.accountentProfile',compact('singleAccountent','monthNames','paymentData'));

    }

    //To get accountent attendance with month wise...
    public function accountentDaysAttendanceWithMonth(Request $request)
    {
        //To fetch student course information...
        $singleAccountent = Accountent::where('id',$request->accountentId)->first();

        $dates = [];
        $courseYear = Carbon::parse($singleAccountent->created_at)->year;
        $monthPosition = Carbon::parse('1'. $request->monthName)->month;
        $dateNumber = Carbon::parse($request->monthName)->daysInMonth;
        $currentMonth = $request->monthName;
        
        //All days show...
        for($i=1; $i < $dateNumber + 1; ++$i) {
            $dates[] = Carbon::createFromDate($courseYear, $monthPosition, $i)->format('Y-m-d');
        }

        return view('backend.accountent.daysAttendanceWithMonth' , compact('currentMonth','singleAccountent','dates'));

    } 
}
