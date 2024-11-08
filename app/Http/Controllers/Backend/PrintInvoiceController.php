<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Role;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Payroll;
use App\Models\Contact;
use App\Helpers\CurrentUser;
use Carbon\Carbon;
use Auth;
use App\Models\Accountent;
use App\Models\Librarian;
use App\Models\Student;
use App\Models\StudentPayment;

class PrintInvoiceController extends Controller
{
    //To get teacher payment invoice page...
    public function getTeacherInvoicePrint($id)
    {
        //To get today date...
        $todayDate = Carbon::now()->today()->toDateString();

        //To fetch siongle payroll, user, teacher & contact data with getId...
        $singlePayRollData = Payroll::where('id', $id)->first();
        $singleUserData = User::where('id', $singlePayRollData->payment_to_id)->first();
        $singleTeacherData = Teacher::where('teacher_phone', $singleUserData->mobile)->first();
        $singleContactInfoData = Contact::where('user_id', $singleTeacherData->user_id)->first();

        // dd($singleContactInfoData->logo_img);
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

        return view('backend.printInvoice.teacherPaymentInvoice', compact('invoiceData'));
    }


        //To get account payment invoice page...
        public function getAccountInvoicePrint($id)
        {
            //To get today date...
            $todayDate = Carbon::now()->today()->toDateString();
    
            //To fetch siongle payroll, user, teacher & contact data with getId...
            $singlePayRollData = Payroll::where('id', $id)->first();
            $singleUserData = User::where('id', $singlePayRollData->payment_to_id)->first();
            $singleAccountData = Accountent::where('accountent_phone', $singleUserData->mobile)->first();
            $singleContactInfoData = Contact::where('user_id', $singleAccountData->user_id)->first();
    
            // dd($singleContactInfoData->logo_img);
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
    
            return view('backend.printInvoice.accountPaymentInvoice', compact('invoiceData'));
        }


        //To get librarian payment invoice page...
        public function getLibrarianInvoicePrint($id)
        {
            //To get today date...
            $todayDate = Carbon::now()->today()->toDateString();
    
            //To fetch siongle payroll, user, teacher & contact data with getId...
            $singlePayRollData = Payroll::where('id', $id)->first();
            $singleUserData = User::where('id', $singlePayRollData->payment_to_id)->first();
            $singleLibrarianData = Librarian::where('librarian_phone', $singleUserData->mobile)->first();
            $singleContactInfoData = Contact::where('user_id', $singleLibrarianData->user_id)->first();
    
            // dd($singleContactInfoData->logo_img);
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
    
            return view('backend.printInvoice.librarianPaymentInvoice', compact('invoiceData'));
        }


        
        //To get student payment invoice page...
        public function getStudentInvoicePrint($id)
        {
            //To get today date...
            $todayDate = Carbon::now()->today()->toDateString();
    
            //To fetch siongle payroll, user, teacher & contact data with getId...
            $singlePaymentData = StudentPayment::where('id', $id)->first();
            $singleStudentData = Student::where('id', $singlePaymentData->student_id)->first();
            $singleContactInfoData = Contact::where('user_id', $singleStudentData->user_id)->first();

            //To generate array-data for print-invoice-page...
            $invoiceData = array(
                'school_logo' => $singleContactInfoData->logo_image,
                'name' => $singleContactInfoData->name,
                'email' => $singleContactInfoData->email,
                'phone' => $singleContactInfoData->phone,
                'address' => $singleContactInfoData->address,
                'date' => $todayDate,
                'invoice' => $singlePaymentData->invoice_id,
                'student_name' => $singleStudentData->student_name,
                'student_email' => $singleStudentData->student_email,
                'student_phone' => $singleStudentData->student_phone,
                'address' => $singleStudentData->address,
                'payment_date' => $singlePaymentData->payment_date,
                'payment_amount' => $singlePaymentData->total_paid_amount,
            );
    
            return view('backend.printInvoice.studentPaymentInvoice', compact('invoiceData'));
        }

}
