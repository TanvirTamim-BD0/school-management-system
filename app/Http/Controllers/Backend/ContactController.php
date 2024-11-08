<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Helpers\CurrentUser;
use Carbon\Carbon;
use DB;
use Brian2694\Toastr\Facades\Toastr;

class ContactController extends Controller
{   
    function __construct()
    {
         $this->middleware('permission:contact', ['only' => ['index','show']]);
    }

    public function index()
    {   
        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get single contact information...
        $contact = Contact::where('user_id', $userId)->first();

        return view('backend.contact.index',compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=> 'required',
            'phone'=> 'required|unique:contacts,phone,'.$id,
            'email'=> 'nullable|unique:contacts,email,'.$id,
        ]);

        $data = $request->all();
        $contact = Contact::find($id);

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        if($request->logo_image){
            //To remove previous file...
            $destinationPath = public_path('uploads/logo_image/');
            if(file_exists($destinationPath.$contact->logo_image)){
                if($contact->logo_image != ''){
                    unlink($destinationPath.$contact->logo_image);
                }
            }

            $file = $request->file('logo_image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath,$fileName);
            $data['logo_image'] = $fileName;
        }

        if($contact->update($data)){
            Toastr::success('Contact Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('contacts'))->with('message','Successfully Updated');
        }else{

            return redirect()->back()->with('error','Error !! Update Failed');
        }

    }
}
