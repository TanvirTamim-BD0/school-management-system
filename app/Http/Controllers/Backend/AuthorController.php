<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Author;
use App\Helpers\CurrentUser;

class AuthorController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:author-list|author-create|author-edit|author-delete', ['only' => ['index','show']]);
         $this->middleware('permission:author-create', ['only' => ['create','store']]);
         $this->middleware('permission:author-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:author-delete', ['only' => ['destroy']]);
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

        //To get all the author data...
        $authorData = Author::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.author.index' ,compact('authorData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.author.create');
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
            'author_name'=> 'required',
        ]);

        $data = $request->all();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        if(Author::create($data)){
            Toastr::success('Author Created Successfully.', 'Success', ["progressbar" => true]);
           return redirect(route('author.index'));
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
        $singleAuthorData = Author::find($id);
        return view('backend.author.edit' , compact('singleAuthorData'));
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
            'author_name'=> 'required',
        ]);

        $data = $request->all();

        $singleAuthorData = Author::find($id);
        if($singleAuthorData->update($data)){
            Toastr::success('Author Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('author.index'));
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
        $singleAuthorData = Author::find($id);

        if($singleAuthorData->delete()){
            Toastr::success('Author Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('author.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }
}
