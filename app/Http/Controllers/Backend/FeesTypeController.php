<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\FeesType;
use App\Helpers\CurrentUser;
use App\Helpers\HelperFeesType;
use Carbon\Carbon;

class FeesTypeController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:fees-type-list|fees-type-create|fees-type-edit|fees-type-delete', ['only' => ['index','show']]);
         $this->middleware('permission:fees-type-create', ['only' => ['create','store']]);
         $this->middleware('permission:fees-type-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:fees-type-delete', ['only' => ['destroy']]);
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
        
        //To check fees type is avialable or not...
        $singleFeesTypeData = FeesType::where('fees_type', 'Tution Fee (Jan)')
                                ->where('user_id', $userId)->first();

        if(isset($singleFeesTypeData) && $singleFeesTypeData != null){
            //To get all the FeesType data...
            $feesTypeData = FeesType::orderBy('id', 'asc')->where('user_id', $userId)->get();

            return view('backend.feesType.index' ,compact('feesTypeData'));
        }else{
            //to add basic fees type data...
            $getFessTypeData = HelperFeesType::getBasicFeesType($userId);
            $this->addBasicFeesType($userId,$getFessTypeData);

            //To get all the FeesType data...
            $feesTypeData = FeesType::orderBy('id', 'asc')->where('user_id', $userId)->get();

            return view('backend.feesType.index', compact('feesTypeData'));
        }
    }

    //to add basic fees type data...
    public function addBasicFeesType($userId,$getFessTypeData)
    {
        foreach($getFessTypeData as $singleFeesTypeData){
            if(isset($getFessTypeData) && $getFessTypeData != null){
                $data = new FeesType();
                $data->user_id = $userId;
                $data->fees_type = $singleFeesTypeData;
                $data->save();
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.feesType.create');
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
            'fees_type'=> 'required'
        ]);

        $data = $request->all();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        if(FeesType::create($data)){
            Toastr::success('FeesType Created Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('fees-type.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
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
        $singleFeesTypeData = FeesType::find($id);
        return view('backend.feesType.edit' , compact('singleFeesTypeData'));
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
            'fees_type'=> 'required'
        ]);

        $data = $request->all();
        $singleFeesTypeData = FeesType::find($id);

        if($singleFeesTypeData->update($data)){
            Toastr::success('FeesType Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('fees-type.index'));
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
        $singleFeesTypeData = FeesType::find($id);

        if($singleFeesTypeData->delete()){
            Toastr::success('FeesType Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('fees-type.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }
}
