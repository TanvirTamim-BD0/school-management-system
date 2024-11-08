<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Session;
use App\Helpers\CurrentUser;
use Brian2694\Toastr\Facades\Toastr;

class BlogController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:blog-list|blog-create|blog-edit|blog-delete', ['only' => ['index','show']]);
         $this->middleware('permission:blog-create', ['only' => ['create','store']]);
         $this->middleware('permission:blog-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:blog-delete', ['only' => ['destroy']]);
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
        
        //To fetch all the blog data with userid...
        $data = Blog::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.blog.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blog.create');
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
            'title'=> 'required',
            'post'=> 'required',
            'post'=> 'required',
            'photo'=> 'nullable|image|mimes:jpg,jpeg,png,gif,svg',
        ]);


        $data = $request->all();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        // For blog description title...
        $blogRemovalDescription = strip_tags($request->post);
        $originalBlogDescription = preg_replace("/\s|&nbsp;/"," ",$blogRemovalDescription);

        $data['solid_post'] = $originalBlogDescription;

        if($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/blog_img'), $imageName);

            $data['photo'] = $imageName;
        }

        if(Blog::create($data)){
            Toastr::success('Blog Created Successfully.', 'Success', ["progressbar" => true]);
           return redirect(route('blog-backend.index'));
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
         $blog = Blog::find($id);
         return view('backend.blog.edit' , compact('blog'));
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
            'title'=> 'required',
            'post'=> 'required',
            'post'=> 'required',
            'photo'=> 'nullable|image|mimes:jpg,jpeg,png,gif,svg',
        ]);

        //To fetch single blog data...
        $singleBlogData = Blog::where('id',$id)->first();
        $data = $request->all();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        // For blog description title...
        $blogRemovalDescription = strip_tags($request->post);
        $originalBlogDescription = preg_replace("/\s|&nbsp;/"," ",$blogRemovalDescription);

        $data['solid_post'] = $originalBlogDescription;

        if($request->hasFile('photo')) {

            //To remove previous file...
            if (file_exists(public_path('uploads/blog_img/'.$singleBlogData->photo))) {
                unlink(public_path('uploads/blog_img/'.$singleBlogData->photo));
            }

            $image = $request->file('photo');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/blog_img'), $imageName);

            $data['photo'] = $imageName;
        }

        if($singleBlogData->update($data)){
            Toastr::success('Blog Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('blog-backend.index'));
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
        $singleBlogData = Blog::find($id);

        if (file_exists(public_path('uploads/blog_img/'.$singleBlogData->photo))) {
            unlink(public_path('uploads/blog_img/'.$singleBlogData->photo));
        }

        if($singleBlogData->delete()){
            Toastr::success('Blog Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('blog-backend.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }



}
