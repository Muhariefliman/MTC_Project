<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Book;
use App\Models\book_genre;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends BaseController
{

    // View single book
    public function show($id)
    {
        $book = Book::where('book_id', $id)->first();
        $genres = Genre::all();
        $book_genre = book_genre::where('book_ID', $id)->get();
        // dd($book_genre);
        $genre = [];
        foreach($book_genre as $item){
            array_push($genre, Genre::where('genre_ID', $item->genre_ID)->first());
        }
        // dd($genre);
        return view('bookDetail', compact('book', 'genre', 'genres'));
    }

    public function deleteBook(Request $request){
        // dd($request->id);
        $request->validate([
            'id' => 'required'
        ]);

        $book = Book::where('book_id', $request->book_id)->first();
        Storage::delete($book->cover);

        Book::where('book_id', $request->id)
            ->delete();
        book_genre::where('book_ID', $request->id)->delete();
        return redirect('/manageBook');
    }

    // Store a new book
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            // 'book_id' => 'required',
            'book_name' => 'required',
            'Author_name' =>'required',
            'synopsis' => 'required',
            'genre' => 'required',
            'price' => 'required|integer',
            'images' => 'required|image'
        ]);

        $book = new Book;
        $book->title = $request->book_name;
        $book->author = $request->Author_name;
        $book->synopsis = $request->synopsis;

        $imageName = "";
        if($request->file('images')){
            $file = $request->file('images');
            $imageName = time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('public/images', $file, $imageName);
            $imageName = 'images/'.$imageName;
        }

        $book->cover = $imageName;
        $book->price = $request->price;
        // $book->genre_id = $request->genre;
        $book->quantity = 1;
        $book->save();

        // dd($book->book_ID);
        foreach($request->genre as $genre){
            book_genre::create([
                'book_ID' => Book::orderBy('book_ID', 'desc')->first()->book_id,
                'genre_ID' => $genre
            ]);
        }

        // dd($book);
        return redirect('/manageBook');
    }

    // Update an existing book
    public function update(Request $request)
    {
        $request->validate([
            'book_id' => 'required',
            'book_name' => 'required',
            'Author_name' =>'required',
            'synopsis' => 'required',
            'genre' => 'required',
            'price' => 'required|integer',
            'images' => 'sometimes|image',
            'quantity' => 'required'
        ]);

        foreach($request->genre as $genre_ID){
            if(!Genre::where('genre_ID', $genre_ID)->exists()){
                return redirect('/details/'.$request->book_id)->with('Error', 'Genre ID Is Not Exist');
            }
        }

        Book::where('book_id', $request->book_id)
            ->update([
                'title' => $request->book_name,
                'author' =>$request->Author_name,
                'synopsis' => $request->synopsis,
                'price' => $request->price,
                'quantity' => $request->quantity
        ]);

        if($request->file('images')){
            $file = $request->file('images');
            $imageName = time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('public/images', $file, $imageName);
            $imageName = 'images/'.$imageName;

            $book = Book::where('book_id', $request->book_id)->first();
            Storage::delete($book->cover);

            Book::where('book_id', $request->book_id)
            ->update(['cover' => $imageName]);
        }

        foreach($request->genre as $genre){
            book_genre::where('book_ID', $request->book_id)->delete();
            book_genre::create([
                'book_ID' => Book::orderBy('book_ID', 'desc')->first()->book_id,
                'genre_ID' => $genre
            ]);
        }

        return redirect('/details/'.$request->book_id);
    }
}
