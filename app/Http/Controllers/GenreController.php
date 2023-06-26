<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\book_genre;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class GenreController extends BaseController
{
    // View all genres
    public function index()
    {
        $genres = Genre::all();

        return view('genres.index', compact('genres'));
    }

    // View a single genre
    public function genreDetails($id)
    {
        $genre = Genre::where('genre_ID', $id)->first();

        $Book_genre = book_genre::where('genre_ID', $id)->get();
        $Books = [];
        foreach($Book_genre as $item){
            array_push($Books, Book::where('book_ID', $item->book_ID)->first());
        }
        // dd($Books);
        if(!$Books) $Books = Null;
        // dd($Books);
        // dd($genre);

        return view('genreDetail', compact('genre', 'Books'));
    }

    public function updateGenre(Request $request){
        $request->validate([
            'id' => 'required',
            'name' => 'required'
        ]);

        // $genre = Genre::where('genre_ID', $request->id)->first();
        // $genre->name = $request->name;
        // $genre->save();
        Genre::where('genre_ID', $request->id)
            ->update(['name' => $request->name]);

        return redirect('/genre/'.$request->id)->with('Success', 'Success Update Genre');
    }

    // Create a new genre
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:genres'
        ]);

        Genre::create([
            'name' => $request->name
        ]);

        return redirect('/genre');
    }

    // Delete genre
    public function destroy(Request $request)
    {
        // dd($request->all());
        $genre = Genre::firstOrFail()->where('genre_ID', $request->id);
        // $genre = Genre::find($request->id);
        $genre->delete();
        return redirect('/genre');
    }


}
