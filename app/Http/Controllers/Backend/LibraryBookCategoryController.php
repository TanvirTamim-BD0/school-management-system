<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\LibraryBookCategory;
use App\Helpers\CurrentUser;

class LibraryBookCategoryController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:book-category-of-library-list|book-category-of-library-create|book-category-of-library-edit|book-category-of-library-delete', ['only' => ['index','show']]);
         $this->middleware('permission:book-category-of-library-create', ['only' => ['create','store']]);
         $this->middleware('permission:book-category-of-library-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:book-category-of-library-delete', ['only' => ['destroy']]);
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

        //To get all the LibraryBookCategory data...
        $libraryBookCategoryData = LibraryBookCategory::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.libraryBookCategory.index' ,compact('libraryBookCategoryData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.libraryBookCategory.create');
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
            'book_category_name'=> 'required',
        ]);

        $data = $request->all();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        if(LibraryBookCategory::create($data)){
            Toastr::success('LibraryBookCategory Created Successfully.', 'Success', ["progressbar" => true]);
           return redirect(route('book-category-of-library.index'));
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
        $singleLBCData = LibraryBookCategory::find($id);
        return view('backend.libraryBookCategory.edit' , compact('singleLBCData'));
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
            'book_category_name'=> 'required',
        ]);

        $data = $request->all();

        $singleLBCData = LibraryBookCategory::find($id);
        if($singleLBCData->update($data)){
            Toastr::success('LibraryBookCategory Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('book-category-of-library.index'));
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
        $singleLBCData = LibraryBookCategory::find($id);

        if($singleLBCData->delete()){
            Toastr::success('LibraryBookCategory Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('book-category-of-library.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }
}
