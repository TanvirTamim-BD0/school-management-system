<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Role;
use App\Models\Teacher;
use App\Models\Librarian;
use App\Models\Accountent;
use App\Models\User;
use App\Models\Payroll;
use App\Helpers\CurrentUser;
use Carbon\Carbon;
use Auth;
use App\Models\Contact;

class PayRollController extends Controller
{
    //To get payment role page...
    public function makePayment(Type $var = null)
    {
        if(Auth::user()->role == 'superadmin'){
            $roleData = Role::whereNotIn('name', ['superadmin','admin','student','guardian'])->get();
        }elseif(Auth::user()->role == 'admin'){
            $roleData = Role::whereNotIn('name', ['superadmin','admin','student','guardian'])->get();
        }elseif(Auth::user()->role == 'accountent'){
            $roleData = Role::whereNotIn('name', ['superadmin','admin','student','guardian'])->get();
        }else{
            $roleData[] = null;
        }

        $selectedRoleData = null;
        $userData[] = null;

        return view('backend.payRoll.makePayment',compact('roleData','selectedRoleData','userData'));
    }

    //To get all the users data with role wise...
    public function getUserDetailsWithRoleWise(Request $request)
    {
        if(Auth::user()->role == 'superadmin'){
            $roleData = Role::whereNotIn('name', ['superadmin','admin','student','guardian'])->get();
        }elseif(Auth::user()->role == 'admin'){
            $roleData = Role::whereNotIn('name', ['superadmin','admin','student','guardian'])->get();
        }elseif(Auth::user()->role == 'accountent'){
            $roleData = Role::whereNotIn('name', ['superadmin','admin','student','guardian'])->get();
        }else{
            $roleData[] = null;
        }

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To fetch single role data...
        $selectedRoleData = Role::where('id', $request->role_id)->first();

        //To fetch all the users data with role wise...
        $userData = User::where('admin_id', $userId)->where('role', $selectedRoleData->name)->get();

        //To check role...
        if($selectedRoleData->name == 'teacher'){
            return view('backend.payRoll.makePaymentForTeacher',compact('roleData','selectedRoleData','userData'));
        }else if($selectedRoleData->name == 'librarian'){
            return view('backend.payRoll.makePaymentForLibrarian',compact('roleData','selectedRoleData','userData'));
        }else if($selectedRoleData->name == 'accountent'){
            return view('backend.payRoll.makePaymentForAccountent',compact('roleData','selectedRoleData','userData'));
        }else{
            Toastr::error('Error !! Users Not Available.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }
    
    //To get make payment for teacher page...
    public function makePaymentForTeacher($id)
    {
        //To fetch single teacher & user data...
        $singleTeacherData = Teacher::where('id', $id)->first();
        $singleUserData = User::where('email', $singleTeacherData->teacher_email)->first();

        //To fetch all the payments data with teacher  id wise...
        $paymentData = Payroll::orderBy('id','desc')->where('payment_to_id', $singleUserData->id)->get();

        //To store all the month name...
        $startMotnhNumber = 0;
        while ($startMotnhNumber < 12) {
            $monthData[] = date("F", strtotime("+$startMotnhNumber months"));
            $startMotnhNumber++;
        }
        $currentMonth = date('F');
        
        //To store all the year name...
        $startYearNumber = 2000;
        while ($startYearNumber <= 2100) {
            $yearData[] = $startYearNumber;
            $startYearNumber++;
        }
        $currentYear = date('Y');

        //To get today date...
        $currentDate = date('Y-m-d');
        $todayDate = Carbon::createFromFormat('Y-m-d', $currentDate)->format('d/m/Y');

        return view('backend.payRoll.payment.getTeacherPaymentSection',
                compact('singleTeacherData','paymentData','monthData','currentMonth','yearData','currentYear','todayDate'));
    }

    //Add make payment for teacher...
    public function addMakePaymentForTeacher(Request $request)
    {
        $request->validate([
            'payment_to_id'=> 'required',
            'payment_date'=> 'required',
            'payment_month'=> 'required',
            'payment_year'=> 'required',
            'total_salary'=> 'required',
            'payment_method'=> 'required',
            'payment_comment'=> 'nullable',
        ]);


        $data =  $request->all();
        $invoiceNumber = "INV-TP-".random_int(100000, 999999);

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;
        $data['invoice_id'] = $invoiceNumber;

        //To formate of selected date...
        $selectedFormatDate = Carbon::createFromFormat('d/m/Y', $request->payment_date)->format('Y-m-d');
        $data['payment_date'] = $selectedFormatDate;

        //To fetch single teacher & user data...
        $singleTeacherData = Teacher::where('id', $request->payment_to_id)->first();
        $singleUserData = User::where('email', $singleTeacherData->teacher_email)->first();
        $data['payment_to_id'] = $singleUserData->id;

        if($payId = Payroll::create($data)){

            //To get today date...
            $todayDate = Carbon::now()->today()->toDateString();

            //To fetch siongle payroll, user, teacher & contact data with getId...
            $singlePayRollData = Payroll::where('id', $payId->id)->first();
            $singleUserData = User::where('id', $singlePayRollData->payment_to_id)->first();
            $singleTeacherData = Teacher::where('teacher_phone', $singleUserData->mobile)->first();
            $singleContactInfoData = Contact::where('user_id', $singleTeacherData->user_id)->first();

            //To generate array-data for print-invoice-page...
            $invoiceData = array(
                'school_logo' => $singleContactInfoData->logo_image,
                'name' => $singleContactInfoData->name,
                'email' => $singleContactInfoData->email,
                'phone' => $singleContactInfoData->phone,
                'address' => $singleContactInfoData->address,
                'date' => $todayDate,
                'invoice' => $singlePayRollData->invoice_id,
                'teacher_name' => $singleTeacherData->teacher_name,
                'teacher_email' => $singleTeacherData->teacher_email,
                'teacher_phone' => $singleTeacherData->teacher_phone,
                'teacher_address' => $singleTeacherData->address,
                'payment_date' => $singlePayRollData->payment_date,
                'payment_method' => $singlePayRollData->payment_method,
                'payment_amount' => $singlePayRollData->total_salary,
            );

            Toastr::success('Teacher Payment Added Successfully.', 'Success', ["progressbar" => true]);
            return view('backend.printInvoice.teacherPaymentInvoice', compact('invoiceData'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }
    
    //To get make payment for librarian page...
    public function makePaymentForLibrarian($id)
    {
        //To fetch single librarian & user data...
        $singleLibrarianData = Librarian::where('id', $id)->first();
        $singleUserData = User::where('email', $singleLibrarianData->librarian_email)->first();

        //To fetch all the payments data with librarian  id wise...
        $paymentData = Payroll::orderBy('id','desc')->where('payment_to_id', $singleUserData->id)->get();

        //To store all the month name...
        $startMotnhNumber = 0;
        while ($startMotnhNumber < 12) {
            $monthData[] = date("F", strtotime("+$startMotnhNumber months"));
            $startMotnhNumber++;
        }
        $currentMonth = date('F');
        
        //To store all the year name...
        $startYearNumber = 2000;
        while ($startYearNumber <= 2100) {
            $yearData[] = $startYearNumber;
            $startYearNumber++;
        }
        $currentYear = date('Y');

        //To get today date...
        $currentDate = date('Y-m-d');
        $todayDate = Carbon::createFromFormat('Y-m-d', $currentDate)->format('d/m/Y');;

        return view('backend.payRoll.payment.getLibrarianPaymentSection',
                compact('singleLibrarianData','paymentData','monthData','currentMonth','yearData','currentYear','todayDate'));
    }

    //Add make payment for librarian...
    public function addMakePaymentForLibrarian(Request $request)
    {
        $request->validate([
            'payment_to_id'=> 'required',
            'payment_date'=> 'required',
            'payment_month'=> 'required',
            'payment_year'=> 'required',
            'total_salary'=> 'required',
            'payment_method'=> 'required',
            'payment_comment'=> 'nullable',
        ]);


        $data =  $request->all();
        $invoiceNumber = "INV-TP-".random_int(100000, 999999);

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;
        $data['invoice_id'] = $invoiceNumber;

        //To formate of selected date...
        $selectedFormatDate = Carbon::createFromFormat('d/m/Y', $request->payment_date)->format('Y-m-d');
        $data['payment_date'] = $selectedFormatDate;

        //To fetch single librarian & user data...
        $singleLibrarianData = Librarian::where('id', $request->payment_to_id)->first();
        $singleUserData = User::where('email', $singleLibrarianData->librarian_email)->first();
        $data['payment_to_id'] = $singleUserData->id;


        //To get today date...
        $todayDate = Carbon::now()->today()->toDateString();

        if($payId = Payroll::create($data)){
    
             //To fetch siongle payroll, user, teacher & contact data with getId...
             $singlePayRollData = Payroll::where('id', $payId->id)->first();
             $singleUserData = User::where('id', $singlePayRollData->payment_to_id)->first();
             $singleLibrarianData = Librarian::where('librarian_phone', $singleUserData->mobile)->first();
             $singleContactInfoData = Contact::where('user_id', $singleLibrarianData->user_id)->first();
     
             //To generate array-data for print-invoice-page...
             $invoiceData = array(
                 'school_logo' => $singleContactInfoData->logo_image,
                 'name' => $singleContactInfoData->name,
                 'email' => $singleContactInfoData->email,
                 'phone' => $singleContactInfoData->phone,
                 'address' => $singleContactInfoData->address,
                 'date' => $todayDate,
                 'invoice' => $singlePayRollData->invoice_id,
                 'librarian_name' => $singleLibrarianData->librarian_name,
                 'librarian_email' => $singleLibrarianData->librarian_email,
                 'librarian_phone' => $singleLibrarianData->librarian_phone,
                 'address' => $singleLibrarianData->address,
                 'payment_date' => $singlePayRollData->payment_date,
                 'payment_method' => $singlePayRollData->payment_method,
                 'payment_amount' => $singlePayRollData->total_salary,
             );

            Toastr::success('Librarian Payment Added Successfully.', 'Success', ["progressbar" => true]);
            return view('backend.printInvoice.librarianPaymentInvoice', compact('invoiceData'));

        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }

    //To get make payment for accountent page...
    public function makePaymentForAccountent($id)
    {
        //To fetch single Accountent & user data...
        $singleAccountentData = Accountent::where('id', $id)->first();
        $singleUserData = User::where('email', $singleAccountentData->accountent_email)->first();

        //To fetch all the payments data with accountent  id wise...
        $paymentData = Payroll::orderBy('id','desc')->where('payment_to_id', $singleUserData->id)->get();

        //To store all the month name...
        $startMotnhNumber = 0;
        while ($startMotnhNumber < 12) {
            $monthData[] = date("F", strtotime("+$startMotnhNumber months"));
            $startMotnhNumber++;
        }
        $currentMonth = date('F');
        
        //To store all the year name...
        $startYearNumber = 2000;
        while ($startYearNumber <= 2100) {
            $yearData[] = $startYearNumber;
            $startYearNumber++;
        }
        $currentYear = date('Y');

        //To get today date...
        $currentDate = date('Y-m-d');
        $todayDate = Carbon::createFromFormat('Y-m-d', $currentDate)->format('d/m/Y');;

        return view('backend.payRoll.payment.getAccountentPaymentSection',
                compact('singleAccountentData','paymentData','monthData','currentMonth','yearData','currentYear','todayDate'));
    }

    //Add make payment for accountent...
    public function addMakePaymentForAccountent(Request $request)
    {
        $request->validate([
            'payment_to_id'=> 'required',
            'payment_date'=> 'required',
            'payment_month'=> 'required',
            'payment_year'=> 'required',
            'total_salary'=> 'required',
            'payment_method'=> 'required',
            'payment_comment'=> 'nullable',
        ]);


        $data =  $request->all();
        $invoiceNumber = "INV-TP-".random_int(100000, 999999);

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;
        $data['invoice_id'] = $invoiceNumber;

        //To formate of selected date...
        $selectedFormatDate = Carbon::createFromFormat('d/m/Y', $request->payment_date)->format('Y-m-d');
        $data['payment_date'] = $selectedFormatDate;

        //To fetch single accountent & user data...
        $singleAccountentData = Accountent::where('id', $request->payment_to_id)->first();
        $singleUserData = User::where('email', $singleAccountentData->accountent_email)->first();
        $data['payment_to_id'] = $singleUserData->id;

        if($payId = Payroll::create($data)){

            //To get today date...
            $todayDate = Carbon::now()->today()->toDateString();
    
            //To fetch siongle payroll, user, teacher & contact data with getId...
            $singlePayRollData = Payroll::where('id', $payId->id)->first();
            $singleUserData = User::where('id', $singlePayRollData->payment_to_id)->first();
            $singleAccountData = Accountent::where('accountent_phone', $singleUserData->mobile)->first();
            $singleContactInfoData = Contact::where('user_id', $singleAccountData->user_id)->first();
    
            //To generate array-data for print-invoice-page...
            $invoiceData = array(
                'school_logo' => $singleContactInfoData->logo_image,
                'name' => $singleContactInfoData->name,
                'email' => $singleContactInfoData->email,
                'phone' => $singleContactInfoData->phone,
                'address' => $singleContactInfoData->address,
                'date' => $todayDate,
                'invoice' => $singlePayRollData->invoice_id,
                'accountent_name' => $singleAccountData->accountent_name,
                'accountent_email' => $singleAccountData->accountent_email,
                'accountent_phone' => $singleAccountData->accountent_phone,
                'address' => $singleAccountData->address,
                'payment_date' => $singlePayRollData->payment_date,
                'payment_method' => $singlePayRollData->payment_method,
                'payment_amount' => $singlePayRollData->total_salary,
            );
            
            Toastr::success('Accountent Payment Added Successfully.', 'Success', ["progressbar" => true]);
            return view('backend.printInvoice.accountPaymentInvoice', compact('invoiceData'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }
}
