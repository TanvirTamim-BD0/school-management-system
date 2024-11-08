<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Income;
use App\Helpers\CurrentUser;
use Carbon\Carbon;

class IncomeController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:income-list|income-create|income-edit|income-delete', ['only' => ['index','show']]);
         $this->middleware('permission:income-create', ['only' => ['create','store']]);
         $this->middleware('permission:income-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:income-delete', ['only' => ['destroy']]);
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
        $incomes = Income::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.income.index' ,compact('incomes'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.income.create');
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
            'income_title'=> 'required',
            'income_date'=> 'required',
            'income_amount'=> 'required',
            'income_title'=> 'required',
        ]);
 
        $data = $request->all();

        $date = $request->income_date;
        $incomeDate = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        $data['income_date'] = $incomeDate;

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        if(Income::create($data)){
            Toastr::success('Income Created Successfully.', 'Success', ["progressbar" => true]);
           return redirect(route('income.index'));
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
        $income = Income::find($id);
        $singleDate = Carbon::createFromFormat('Y-m-d', $income->income_date)->format('d/m/Y');
        return view('backend.income.edit' , compact('income','singleDate'));
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
            'income_title'=> 'required',
            'income_date'=> 'required',
            'income_amount'=> 'required',
            'income_title'=> 'required',
        ]);

        $data = $request->all();

        $date = $request->income_date;
        $incomeDate = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        $data['income_date'] = $incomeDate;

        $income = Income::find($id);
        if($income->update($data)){
            Toastr::success('Income Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('income.index'))->with('message','Successfully Income Updated');
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
        $income = Income::find($id);

        if($income->delete()){
            Toastr::success('Income Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('income.index'))->with('message','Successfully Income Deleted');
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
            
    }
}
