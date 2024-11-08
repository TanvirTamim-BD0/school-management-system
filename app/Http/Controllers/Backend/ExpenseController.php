<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Expense;
use App\Helpers\CurrentUser;
use Carbon\Carbon;

class ExpenseController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:expense-list|expense-create|expense-edit|expense-delete', ['only' => ['index','show']]);
         $this->middleware('permission:expense-create', ['only' => ['create','store']]);
         $this->middleware('permission:expense-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:expense-delete', ['only' => ['destroy']]);
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
        $expenses = Expense::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.expense.index' ,compact('expenses'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.expense.create');
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
            'expense_title'=> 'required',
            'expense_date'=> 'required',
            'expense_amount'=> 'required',
            'expense_title'=> 'required',
        ]);
 
        $data = $request->all();

        $date = $request->expense_date;
        $expenseDate = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        $data['expense_date'] = $expenseDate;


        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        if(Expense::create($data)){
            Toastr::success('Expense Created Successfully.', 'Success', ["progressbar" => true]);
           return redirect(route('expense.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
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
        $expense = Expense::find($id);
        $singleDate = Carbon::createFromFormat('Y-m-d', $expense->expense_date)->format('d/m/Y');
        return view('backend.expense.edit' , compact('expense','singleDate'));
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
            'expense_title'=> 'required',
            'expense_date'=> 'required',
            'expense_amount'=> 'required',
            'expense_title'=> 'required',
        ]);

        $data = $request->all();

        $date = $request->expense_date;
        $expenseDate = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        $data['expense_date'] = $expenseDate;

        $expense = Expense::find($id);
        if($expense->update($data)){
            Toastr::success('Expense Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('expense.index'))->with('message','Successfully Expense Updated');
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
        $expense = Expense::find($id);

        if($expense->delete()){
            Toastr::success('Expense Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('expense.index'))->with('message','Successfully Expense Deleted');
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
            
    }

}
