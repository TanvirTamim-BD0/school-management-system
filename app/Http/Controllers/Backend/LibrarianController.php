<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Librarian;
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

class LibrarianController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:librarian-list|librarian-create|librarian-edit|librarian-delete', ['only' => ['index','show']]);
         $this->middleware('permission:librarian-create', ['only' => ['create','store']]);
         $this->middleware('permission:librarian-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:librarian-delete', ['only' => ['destroy']]);
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
        //To get all the librarian data with user id...
        $librarianData = Librarian::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.librarian.index' ,compact('librarianData'));
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

        return view('backend.librarian.create',compact('getBloodGroup'));
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
            'librarian_name'=> 'required',
            'librarian_phone'=> 'required|min:11|max:11|unique:librarians',
            'address'=> 'required',
            'librarian_email'=> 'nullable|unique:librarians',
            'joining_date'=> 'required',
            'date_of_birth'=> 'required',
            'designation'=> 'required',
            'salary'=> 'required',
            'loginPassword'=> 'required',
            'librarian_photo'=> 'nullable|mimes:jpg,jpeg,png,gif,svg',
        ]);

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To check user is already exist or not...
        $checkStatus = CurrentUser::checkUserIsExistOrNot($userId, $request->librarian_phone, $request->librarian_email);
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

        if($request->librarian_photo){
            $file = $request->file('librarian_photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();

            //For large size image...
            $destinationPath = public_path('uploads/librarian_photo/');
            Image::make($file)->save($destinationPath.$fileName);
            
            //For thumbnail size image...
            $destinationPath = public_path('uploads/librarian_photo/thumbnail/');
            Image::make($file)->resize(500,400)->save($destinationPath.$fileName);
            
            $data['librarian_photo'] = $fileName;
        }


        $data['user_id'] = Auth::user()->id;

        if($newLibrarian = Librarian::create($data)){

            $user = new User();
            $user->name = $request->librarian_name;
            $user->mobile = $request->librarian_phone;
            $user->email = $request->librarian_email;
            $user->address = $request->address;
            $user->role = 'librarian';
            $user->admin_id = $userId;
            $user->password = Hash::make($request->loginPassword);
            $user->status = 1;

            if($user->save()){
                //To generate user login id & update to user table...
                $currentYear = date('Y');
                $userLoginId = 'lb-'.$currentYear.$newLibrarian->id;
                User::where('id', $user->id)->update(['login_id' => $userLoginId]);

                //To assign user role...
                $userRoleForAssign = Role::where('name', $user->role)->first();
                $user->assignRole($userRoleForAssign->id); 

                Toastr::success('Librarian Created Successfully.', 'Success', ["progressbar" => true]);
                return redirect(route('librarian.index'));
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
        $singleLibrarian = Librarian::find($id);
        $getBloodGroup = BloodGroup::getBloodGroup();
        $singleJoiningDate = Carbon::createFromFormat('Y-m-d', $singleLibrarian->joining_date)->format('d/m/Y');
        $singleDOB = Carbon::createFromFormat('Y-m-d', $singleLibrarian->date_of_birth)->format('d/m/Y');

        return view('backend.librarian.edit' ,compact('singleLibrarian','getBloodGroup','singleJoiningDate','singleDOB'));
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
            'librarian_name'=> 'required',
            'librarian_phone'=> 'required|min:11|max:11|unique:librarians,librarian_phone,'.$id,
            'address'=> 'required',
            'joining_date'=> 'required',
            'date_of_birth'=> 'required',
            'designation'=> 'required',
            'salary'=> 'required',
            'librarian_photo'=> 'nullable|mimes:jpg,jpeg,png,gif,svg',
        ]);

        $data = $request->all();

        $dateBirth = $request->date_of_birth;
        $joininDate = $request->joining_date;
        $dateOfBirth = Carbon::createFromFormat('d/m/Y', $dateBirth)->format('Y-m-d');
        $data['date_of_birth'] = $dateOfBirth;
        $joiningDate = Carbon::createFromFormat('d/m/Y', $joininDate)->format('Y-m-d');
        $data['joining_date'] = $joiningDate;

        //To get single librarian data...
        $singleLibrarian = Librarian::find($id);

        //To check user is already exist or not...
        $checkStatus = CurrentUser::checkUserIsExistOrNot($singleLibrarian->user_id, $request->librarian_phone, $request->librarian_email);
        if($checkStatus != null && $checkStatus['status'] == 1){
            if($checkStatus['userData']->mobile != $singleLibrarian->librarian_phone){
                Toastr::error('Error !! Please Use Another Phone', 'Error', ["progressbar" => true]);
                return redirect()->back();
            }
        }else if($checkStatus != null && $checkStatus['status'] == 2){
             if($checkStatus['userData']->email != $singleLibrarian->librarian_email){
                Toastr::error('Error !! Please Use Another Email', 'Error', ["progressbar" => true]);
                return redirect()->back();
            }
        }

        if($request->librarian_photo){
            //To remove previous file...
            $destinationPath = public_path('uploads/librarian_photo/');
            if(file_exists($destinationPath.$singleLibrarian->librarian_photo)){
                if($singleLibrarian->librarian_photo != ''){
                    unlink($destinationPath.$singleLibrarian->librarian_photo);
                }
            }

            //To remove previous file...
            $destinationPath = public_path('uploads/librarian_photo/thumbnail/');
            if(file_exists($destinationPath.$singleLibrarian->librarian_photo)){
                if($singleLibrarian->librarian_photo != ''){
                    unlink($destinationPath.$singleLibrarian->librarian_photo);
                }
            }

            $file = $request->file('librarian_photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            
            //For large size image...
            $destinationPath = public_path('uploads/librarian_photo/');
            Image::make($file)->save($destinationPath.$fileName);
            
            //For thumbnail size image...
            $destinationPath = public_path('uploads/librarian_photo/thumbnail/');
            Image::make($file)->resize(500,400)->save($destinationPath.$fileName);

            $data['librarian_photo'] = $fileName;
        }
        
        if($singleLibrarian->update($data)){
            Toastr::success('Librarian Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('librarian.index'))->with('message','Successfully Teacher Updated');
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
        //To get librarian & user data...
        $singleLibrarian = Librarian::find($id);
        $userData = User::where('email', $singleLibrarian->librarian_email)->first();

        //To check file is available or not...  
        if ($singleLibrarian->librarian_photo != null && file_exists(public_path('uploads/librarian_photo/'.$singleLibrarian->librarian_photo))) {
            unlink(public_path('uploads/librarian_photo/'.$singleLibrarian->librarian_photo));
            unlink(public_path('uploads/librarian_photo/thumbnail/'.$singleLibrarian->librarian_photo));
        }

        if($singleLibrarian->delete()){
            $userData->delete();
            Toastr::success('Librarian Delete Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('librarian.index'))->with('message','Successfully Teacher Deleted');
        }else{
            Toastr::error('Error !! Delete Failed', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }

    //To get librarian profile page...
    public function librarianProfile($id)
    {
        $startMotnhNumber = 0;
        while ($startMotnhNumber < 12) {
            $monthNames[] = date("F", strtotime("+$startMotnhNumber months"));
            $startMotnhNumber++;
        }

        //To fetch single librarian & user data...
        $singleLibrarian = Librarian::where('id',$id)->first();
        $singleUserData = User::where('email', $singleLibrarian->librarian_email)->first();

        //To fetch all the payments data with librarian  id wise...
        $paymentData = Payroll::orderBy('id','desc')->where('payment_to_id', $singleUserData->id)->get();

        return view('backend.librarian.librarianProfile',compact('singleLibrarian','monthNames','paymentData'));

    }

    //To get librarian attendance with month wise...
    public function librarianDaysAttendanceWithMonth(Request $request)
    {
        //To fetch student course information...
        $singleLibrarian = Librarian::where('id',$request->librarianId)->first();

        $dates = [];
        $courseYear = Carbon::parse($singleLibrarian->created_at)->year;
        $monthPosition = Carbon::parse('1'. $request->monthName)->month;
        $dateNumber = Carbon::parse($request->monthName)->daysInMonth;
        $currentMonth = $request->monthName;
        
        //All days show...
        for($i=1; $i < $dateNumber + 1; ++$i) {
            $dates[] = Carbon::createFromDate($courseYear, $monthPosition, $i)->format('Y-m-d');
        }

        return view('backend.librarian.daysAttendanceWithMonth' , compact('currentMonth','singleLibrarian','dates'));

    } 
}
