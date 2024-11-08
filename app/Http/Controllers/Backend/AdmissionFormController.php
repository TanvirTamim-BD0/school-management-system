<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\AdmissionForm;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ContactForm;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use App\Helpers\CurrentUser;

class AdmissionFormController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:admission-form-list|admission-form-delete', ['only' => ['index','show']]);
         $this->middleware('permission:admission-form-delete', ['only' => ['destroy']]);
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
        $admissionForms = AdmissionForm::orderBy('id', 'desc')->get();

        return view('backend.admissionForm.index' ,compact('admissionForms'));
    }


    public function approveStudent($id){

        $from = AdmissionForm::where('id',$id)->first();
        $from->status = 1;
        $from->save();

        $data['user_id'] = Auth::user()->id;
        $data['student_photo'] =$from->student_photo;
        $data['class_id'] = $from->class_id;
        $data['section_id'] = 1;
        $data['group_id'] = 1;
        $data['student_name'] = $from->student_name;
        $data['student_email'] = $from->student_email;
        $data['student_phone'] = $from->student_phone;
        $data['gender'] = $from->gender;
        $data['blood_group'] = $from->blood_group;
        $data['religion'] = $from->religion;
        $data['address'] = $from->address;
        $data['date_of_birth'] = $from->date_of_birth;
        $data['addmission_date'] = $from->addmission_date;
        $data['address'] = $from->address;

        if($result = Student::create($data)){

            $currenYear = Carbon::now()->year;
            $registrationNo = $result->id + 100;

            //To update student roll & registration...
            $singleStudentData = Student::where('id', $result->id)->first();
            $singleStudentData->roll_no = ($currenYear.$result->id);
            $singleStudentData->registration_no = "TS".$currenYear.Carbon::now()->month.$registrationNo;
            $singleStudentData->save();

            $user = new User();
            $user->name = $from->student_name;
            $user->mobile = $from->student_phone;
            $user->email = $from->student_email;
            $user->address = $from->address;
            $user->role = 'student';
            $user->password = Hash::make($from->loginPassword);
            $user->status = 1;
            $user->save();

            Toastr::success('Successfully Student Approved.', 'Success', ["progressbar" => true]);
             return redirect(route('form-of-admissions.index'));
        }else{
            return redirect()->back()->with('error','Error !! Added Failed');
        }

    }
    




    //contact form ......................

    public function contactForm(){

        $contactForm = ContactForm::orderBy('id', 'desc')->get();
        return view('backend.contactForm.index', compact('contactForm'));
    }

    public function contactFormDestroy($id){

        $contactForm = ContactForm::find($id);

        if($contactForm->delete()){
            Toastr::success('Contact Form Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('contact-form'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }
}
