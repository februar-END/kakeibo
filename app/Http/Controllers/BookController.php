<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{
    
    private function checkMyData(Book $book){
        if($book->user_id != Auth::user()->id){
            return redirect()->route('books.error'); 
        }
    }
    
    function index(){
        $books=Book::all();
        return view("books.index", compact("books"));
    }
    
    public function error(){
        return view("books.error");
    }
    
    public function show(Book $book){
        return view("books.show", compact("book"));
    }
    
    public function create(){
        return view("books.create");
    }
    
    public function search(Request $request){
        $books = Auth::user()->books()
                                ->where('amount', '>=', $request->num )
                                ->where('category', '=', $request->category)
                                ->get();
        return view("books.search", compact("books"));
    }
    

    public function store(Request $request){
        $book = new Book();
        $book->fill($request->all());
        $book->user_id = Auth::user()->id;
        $book->save();
        if($request->post_img){
        if($request->post_img->extension() == 'gif' || $request->post_img->extension() == 'jpeg' || $request->post_img->extension() == 'jpg' || $request->post_img->extension() == 'png'){
            $request->file('post_img')->storeAs('public/post_img', $book->id.'.'.$request->post_img->extension());
    }

}
        return redirect()->route('books.show',$book);
    }
    
    public function edit(Book $book){
         if($this->checkMyData($book)<>null){
            return $this->checkMyData($book);
        } else {
            return view("books.edit", compact("book"));
        }
    }
    
    public function update(Request $request, Book $book){
         if($this->checkMyData($book)<>null){
            return $this->checkMyData($book);
        } else {
            $book->fill($request->all());
            $book->save();
            return redirect()->route('books.show',$book);
        }
    }
    
    public function destroy(Book $book){
         if($this->checkMyData($book)<>null){
            return $this->checkMyData($book);
        } else {
            $book->delete();
            return redirect()->route('books.index');
        }
    }
    
    public function __construct(){
        $this->middleware('auth');
    }
}

