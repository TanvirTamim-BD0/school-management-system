<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\RackNo;
use App\Models\Author;
use App\Models\LibraryBookCategory;
use App\Models\LibraryBook;
use App\Helpers\CurrentUser;

class LibraryBookController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:library-book-list|library-book-create|library-book-edit|library-book-delete', ['only' => ['index','show']]);
         $this->middleware('permission:library-book-create', ['only' => ['create','store']]);
         $this->middleware('permission:library-book-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:library-book-delete', ['only' => ['destroy']]);
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
        $libraryBooks = LibraryBook::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.libraryBook.index' ,compact('libraryBooks'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get author, rackNo and libraryBookCategory data...
        $rackNoData = RackNo::orderBy('id', 'desc')->where('user_id', $userId)->get();
        $authorData = Author::orderBy('id', 'desc')->where('user_id', $userId)->get();
        $libraryBookCategoryData = LibraryBookCategory::orderBy('id', 'desc')->where('user_id', $userId)->get();


        return view('backend.libraryBook.create',compact('rackNoData','authorData','libraryBookCategoryData'));
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
            'author_id'=> 'required',
            'book_category_id'=> 'required',
            'rack_no_id'=> 'required',
            'subject_name'=> 'required',
            'mrp_price'=> 'required',
            'quantity'=> 'required',
        ]);

        $data = $request->all();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        if(LibraryBook::create($data)){
            Toastr::success('Library Book Created Successfully.', 'Success', ["progressbar" => true]);
           return redirect(route('libraryBook.index'));
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
        //To get current user...
        $userId = CurrentUser::getUserId();
        
        //To get libraryBook, author, rackNo and libraryBookCategory data...
        $libraryBook = LibraryBook::find($id);
        $rackNoData = RackNo::orderBy('id', 'desc')->where('user_id', $userId)->get();
        $authorData = Author::orderBy('id', 'desc')->where('user_id', $userId)->get();
        $libraryBookCategoryData = LibraryBookCategory::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.libraryBook.edit' , compact('libraryBook','rackNoData','authorData','libraryBookCategoryData'));
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
            'author_id'=> 'required',
            'book_category_id'=> 'required',
            'rack_no_id'=> 'required',
            'subject_name'=> 'required',
            'mrp_price'=> 'required',
            'quantity'=> 'required',
        ]);

        $data = $request->all();

        $libraryBook = LibraryBook::find($id);
        if($libraryBook->update($data)){
            Toastr::success('Library Book Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('libraryBook.index'))->with('message','Successfully Library Book Updated');
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
        $libraryBook = LibraryBook::find($id);

        if($libraryBook->delete()){
            Toastr::success('Library Book Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('libraryBook.index'))->with('message','Successfully Library Book Deleted');
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
            
    }
}
