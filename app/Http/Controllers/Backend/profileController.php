<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Auth;
use Hash;
use Carbon\Carbon;
use Validator;
use Session;
use Brian2694\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Permission;

class profileController extends Controller
{
     public function index(){
        return view('backend.profile.index');
    }

     public function Update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required',
        ]);

        $id = Auth::user()->id;

        $User = User::find($id);
        $User->name = $request->name;
        $User->email = $request->email;
        $User->mobile = $request->mobile;

        if($request->hasFile('image')) {
            $destinationPath = public_path('uploads/user_img/');
            if(file_exists($destinationPath.$User->image)){
                if($User->image != ''){
                    unlink($destinationPath.$User->image);
                }
            }

            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/user_img'), $imageName);
            $User->image = $imageName;

        }

        $User->save();
        Toastr::success('Profile Update Successfully.', 'Success', ["progressbar" => true]);
        return redirect(route('profile'))->with('message','Successfully Profile Updated');;
    }


    public function securityUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        $current_user = Auth()->user();

        if (Hash::check($request->old_password,$current_user->password)) {

            if ($request->new_password == $request->confirm_password) {

                User::find($current_user->id)->update([
                    'password' => Hash::make($request->new_password)
                ]);

                Auth::logout();
                Toastr::success('Successfully Password Change.', 'Success', ["progressbar" => true]);
                return Redirect()->route('login');

            }else{
                Toastr::success('Password and Confirm Password do not match.', 'Danger', ["progressbar" => true]);
                return redirect()->route('profile');
            }

        }else{
            Toastr::success('Old Password do not match.', 'Danger', ["progressbar" => true]);
            return redirect()->route('profile');
        }
    }

}
