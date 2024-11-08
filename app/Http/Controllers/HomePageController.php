<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;
use App\Models\Admission;
use App\Models\Classname;
use App\Helpers\BloodGroup;
use App\Models\AdmissionForm;
use App\Models\Blog;
use Image;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Teacher;

class HomePageController extends Controller
{   

    //blog section..........
     public function blog(){
         $blogs = Blog::orderBy('id', 'desc')->get();
         return view('frontend.blog',compact('blogs'));
    }

    public function blogDetails($id){

         $blog = Blog::where('id',$id)->first();
         return view('frontend.blogDetails',compact('blog'));
    }

    public function index()
    {   
        $blogs = Blog::orderBy('id', 'desc')->limit(3)->get();
    	return view('frontend.index',compact('blogs'));
    }



    //admission section..........
    public function addmissionList(){

        $admissions = Admission::orderBy('id', 'desc')->get();
        return view('frontend.addmissionList',compact('admissions'));
    }

    public function addmissionForm($id){
        $classData = Classname::get();
        $getBloodGroup = BloodGroup::getBloodGroup();
        $admission = Admission::where('id',$id)->first();

        return view('frontend.addmissionForm', compact('id','classData','getBloodGroup','admission'));
    }

    public function addmissionFormSubmit(Request $request){

        $request->validate([
            'student_name'=> 'required',
            'student_email'=> 'required',
            'student_phone'=> 'required',
            'date_of_birth'=> 'required',
            'address'=> 'required',
        ]);

        $check = User::where('email',$request->student_email)->orWhere('mobile',$request->student_phone)->first();

        if ($check) { 
              return redirect()->back()->with('error','Please Another Email And Mobile Submit !!');  
        }else{

            $data = $request->all();

            $date = Carbon::now()->today()->toDateString();
            $data['addmission_date'] = $date;

            if($request->student_photo){
                $file = $request->file('student_photo');
                $fileName = time().'.'.$file->getClientOriginalExtension();

                //For large size image...
                $destinationPath = public_path('uploads/student_photo/');
                Image::make($file)->save($destinationPath.$fileName);
                
                //For thumbnail size image...
                $destinationPath = public_path('uploads/student_photo/thumbnail/');
                Image::make($file)->resize(500,400)->save($destinationPath.$fileName);
                
                $data['student_photo'] = $fileName;
            }

            if(AdmissionForm::create($data)){
               return redirect(route('addmission-list'))->with('message','Successfully Admission Data Send');
            }else{
                return redirect()->back();
            }

        }
    }


    //features section..........
    public function features(){
        return view('frontend.features');
    }
    

   //contact section..........
    public function contact(){
        return view('frontend.contact');
    }

    public function contactFormSubmit(Request $request){

        $request->validate([
            'name'=> 'required',
            'email'=> 'required',
            'phone'=> 'required',
            'subject'=> 'required',
            'message'=> 'required',
        ]);

        $data = $request->all();

        if(ContactForm::create($data)){
           return redirect(route('contact'))->with('message','Successfully Data Send');
        }else{
            return redirect()->back()->with('error','Error !! Added Failed');
        }
    }

    
    public function headTeacher(){

        $headTeacher = Teacher::where('teacher_category','head teacher')->first();
        return view('frontend.headTeacher',compact('headTeacher'));
    }

    public function assistantHeadTeacher(){

        $assistantHeadTeacher = Teacher::where('teacher_category','assistant head teacher')->first();
        return view('frontend.assistantHeadTeacher',compact('assistantHeadTeacher'));
    }

    public function allTeacher(){
        $teachers = Teacher::whereNotIn('teacher_category',['head teacher'])->whereNotIn('teacher_category',['assistant head teacher'])->get();
        return view('frontend.allTeachers',compact('teachers'));
    }

}
