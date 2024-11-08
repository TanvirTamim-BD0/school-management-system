<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\FeesType;
use App\Models\FeesAssign;
use App\Models\Classname;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentFeesAssign;
use App\Models\StudentPayment;
use App\Helpers\CurrentUser;
use Carbon\Carbon;

class PaymentStudentController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:payment-of-student-list|payment-of-student-create|payment-of-student-edit|payment-of-student-delete', ['only' => ['index','show']]);
         $this->middleware('permission:payment-of-student-create', ['only' => ['create','store']]);
         $this->middleware('permission:payment-of-student-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:payment-of-student-delete', ['only' => ['destroy']]);
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

        //To get all the class data...
        $classData = Classname::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.paymentStudent.index', compact('classData'));
    }

    //To get student payment section...
    public function getStudentPaymentSection(Request $request)
    {
        //To get current user...
        $userId = CurrentUser::getUserId();
        $classId = $request->class_id;
        $sectionId = $request->section_id;
        $studentId = $request->student_id;
        $invoiceNumber = "INV-SP-".random_int(100000, 999999);
        $todayDate = Carbon::now()->toDateString();

        //To get all the section & student data with classId...
        $classData = Classname::orderBy('id', 'desc')->where('user_id', $userId)->get();
        $sectionData = Section::where('class_id', $classId)->where('user_id', $userId)->get();
        $studentData = Student::where('class_id', $classId)->where('section_id', $sectionId)
                        ->where('user_id', $userId)->get();
        
        //To get current selected student data...
        $singleStudentData = Student::where('id', $studentId)->first();

        //To check student fess assign is available or not...
        $this->chackFeesAssignIsGenarated($classId, $sectionId, $studentId, $userId);

        //Tp get all the student fees assign data...
        $studentFeesAssignData = StudentFeesAssign::where('user_id', $userId)->where('class_id', $classId)
                                ->where('section_id', $sectionId)->where('student_id', $studentId)->get(); 

        //To get all the student payment data....    
        $getStdentPaymentData = StudentPayment::orderBy('id', 'desc')->where('user_id', $userId)->where('class_id', $classId)
                            ->where('section_id', $sectionId)->where('student_id', $studentId)->get();
        
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

        return view('backend.paymentStudent.getStudentPaymentSection', compact('classId','sectionId','studentId','invoiceNumber'
                ,'todayDate','classData','sectionData','studentData','singleStudentData','studentFeesAssignData'
                ,'stdentPaymentData','studentTotalPaidAmount','studentTotalFineAmount','studentTotalCollectionAmount'));
    }

    //To check student fess assign is available or not...
    public function chackFeesAssignIsGenarated($classId, $sectionId, $studentId, $userId)
    {
        $getFeesAssignData = StudentFeesAssign::where('user_id', $userId)->where('class_id', $classId)->where('section_id', $sectionId)
                                ->where('student_id', $studentId)->first();
        if(isset($getFeesAssignData) && $getFeesAssignData != null){

            //To get all the fees type data...
            $ids = FeesType::select('id')->pluck('id');
            $feesTypeIds = $ids->toArray();

            //To check total count of fees assign...
            $feesTypeAssignCount = FeesAssign::where('user_id', $userId)->where('class_id', $classId)
                                    ->whereIn('fees_type_id', $feesTypeIds)->count();

            $getFeesAssignCount = StudentFeesAssign::where('user_id', $userId)->where('class_id', $classId)->where('section_id', $sectionId)
                                ->where('student_id', $studentId)->count();

            //To check feesAssign with studentFeesAssign...
            if($feesTypeAssignCount != $getFeesAssignCount){
                //To select feesAssignIds from studentFeesAssign table & get all the feesAssign data...
                $getFeesAssignIds = StudentFeesAssign::where('user_id', $userId)->where('class_id', $classId)->where('section_id', $sectionId)
                                ->where('student_id', $studentId)->pluck('fees_assign_id');
                $feesAssignIds = $getFeesAssignIds->toArray();
                $feesTypeAssignData = FeesAssign::where('user_id', $userId)->where('class_id', $classId)
                                    ->whereNotIn('id', $feesAssignIds)->get();
            
                foreach($feesTypeAssignData as $key=>$item){
                    if(isset($item) && $item != null){
                        $data = new StudentFeesAssign();
                        $data->user_id = $userId;
                        $data->fees_type_id = $item->fees_type_id;
                        $data->fees_assign_id = $item->id;
                        $data->class_id = $classId;
                        $data->section_id = $sectionId;
                        $data->student_id = $studentId;
                        $data->fees_amount = $item->fees_amount;
                        $data->year = Carbon::now()->year;
                        $data->save();
                    }
                }
            }else{
                return $getFeesAssignData;
            }
        }else{
            //To get all the fees type data...
            $ids = FeesType::select('id')->pluck('id');
            $feesTypeIds = $ids->toArray();

            $feesTypeAssignData = FeesAssign::where('user_id', $userId)->where('class_id', $classId)
                                    ->whereIn('fees_type_id', $feesTypeIds)->get();
            
            foreach($feesTypeAssignData as $key=>$item){
                if(isset($item) && $item != null){
                    $data = new StudentFeesAssign();
                    $data->user_id = $userId;
                    $data->fees_type_id = $item->fees_type_id;
                    $data->fees_assign_id = $item->id;
                    $data->class_id = $classId;
                    $data->section_id = $sectionId;
                    $data->student_id = $studentId;
                    $data->fees_amount = $item->fees_amount;
                    $data->year = Carbon::now()->year;
                    $data->save();
                }
            }
        }
    }

    //To add student payment...
    public function addStudentPaymentSection(Request $request)
    {   

        //To get current user...
        $userId = $request->user_id;
        $classId = $request->class_id;
        $sectionId = $request->section_id;
        $studentId = $request->student_id;
        $invoiceId = $request->invoice_id;
        $todayDate = Carbon::now()->toDateString();
        $currentMonth = date('F', strtotime($todayDate));
        $currentYear = Carbon::now()->year;

        if(isset($request->student_assign_id)){

            $totalFeesAmount = 0;
            $totalFineAmount = 0;
            $totalPaidAmount = 0;

                //To check paid amount is greter than zero or not...
                if(isset($request->paid_amount) && $request->paid_amount > 0){
                    //To get single student fees assign data...
                    $singleStudentFeesAssign = StudentFeesAssign::where('id', $request->student_assign_id)->first();

                    //To check paid amount is already added or not...
                    if($singleStudentFeesAssign->paid_amount != null){
                        $currentTotalPaidAmount = $singleStudentFeesAssign->paid_amount + $request->paid_amount;

                        if($currentTotalPaidAmount >= $singleStudentFeesAssign->fees_amount){
                            $singleStudentFeesAssign->paid_amount = $singleStudentFeesAssign->fees_amount;
                            $singleStudentFeesAssign->due_amount = 0.00;
                        }else{
                            $singleStudentFeesAssign->paid_amount += $request->paid_amount;

                            //To check total due amount...
                            $currentDueAmount = $singleStudentFeesAssign->fees_amount - $singleStudentFeesAssign->paid_amount;
                            $singleStudentFeesAssign->due_amount = $currentDueAmount;
                        }

                    }else{
                        $singleStudentFeesAssign->paid_amount = $request->paid_amount;
                        $singleStudentFeesAssign->due_amount = $request->due_amount;
                    }
                    
                    
                    $singleStudentFeesAssign->change_amount = $request->change_amount;
                    $singleStudentFeesAssign->year = $currentYear;

                    if($singleStudentFeesAssign->fees_amount <= $singleStudentFeesAssign->paid_amount){
                        $singleStudentFeesAssign->status = true;
                    }


                    $totalFeesAmount += $request->fees_amount;
                    $totalFineAmount += $request->fine_amount;
                    $totalPaidAmount += $request->paid_amount;
                    $studentFeesAssignId[] = $singleStudentFeesAssign->id;

                    $singleStudentFeesAssign->save();
                }
            

            //To generate json encode data...
            $studentFeesAssignIds = json_encode($studentFeesAssignId);

            //To generate a new invoice for student payment...
            $studentPaymentId = $this->generateStudentPaymentInvoice($userId, $invoiceId, $classId, $sectionId, $studentId, $studentFeesAssignIds,
            $totalFeesAmount, $totalFineAmount, $totalPaidAmount, $todayDate, $currentMonth, $currentYear);

            Toastr::success('Student Payment Successfully Done.', 'Success', ["progressbar" => true]);
            return redirect()->route('get-student-payment-invoice', $studentPaymentId);

        }
    }

    //To generate a new invoice for student payment...
    public function generateStudentPaymentInvoice($userId, $invoiceId, $classId, $sectionId, $studentId, $studentFeesAssignIds,
                        $totalFeesAmount, $totalFineAmount, $totalPaidAmount, $todayDate, $currentMonth, $currentYear)
    {
        $data = new StudentPayment();
        $data->user_id = $userId;
        $data->invoice_id = $invoiceId;
        $data->class_id = $classId;
        $data->section_id = $sectionId;
        $data->student_id = $studentId;
        $data->student_fees_assign_id = $studentFeesAssignIds;
        $data->total_fees_amount = $totalFeesAmount;
        $data->total_fine_amount = $totalFineAmount;
        $data->total_paid_amount = $totalPaidAmount;
        $data->payment_date = $todayDate;
        $data->payment_month = $currentMonth;
        $data->year = $currentYear;
        $data->save();

        return $data->id;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
