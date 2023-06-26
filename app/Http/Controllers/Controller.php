<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\book_genre;
use App\Models\Genre;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use App\Models\TransactionHistory;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home(){
        $Books = Book::paginate(5);
        return view('home', compact('Books'));
    }

    public function login(){
        if(Auth::check()){
            return redirect('/home');
        }
        return view('login');
    }

    public function register(){
        if(Auth::check()){
            return redirect('/home');
        }
        return view('register');
    }

    public function search(Request $request){
        $name = $request->book_name;
        // dd($name);
        $Books = Book::where('title', 'LIKE', '%' . $name . '%')->paginate(5);

        return view('/home', compact('Books'));
    }

    public function userProfilePage(){
        return view('userProfilePage');
    }

    public function manageUser(){
        if(Auth::user()->roles == 'Admin'){
            $Users = User::all();
            return view('ManageUser', compact('Users'));
        }else{
            return redirect('/login');
        }
    }

    public function changePassword(){
        return view('changePassword');
    }

    public function genre(){
        if(Auth::user()->roles == 'Admin'){
            $genres = Genre::all();
            if(!$genres) $genres = Null;
            return view('genre', compact('genres'));
        }else{
            return redirect('/home');
        }
    }

    public function manageBook(){
        if(Auth::user()->roles == 'Admin'){
            $books = Book::all();
            $genres = Genre::all();
            if(!$books) $books = Null;
            return view('ManageBook', compact('books', 'genres'));
        }

        return redirect('/home');
    }

    public function viewCart(){


        $thead_id = TransactionHeader::where('user_ID', Auth::user()->id)->orderBy('transaction_header_id', 'desc')->first();

        if(!$thead_id){
            $result = null;
            $books = null;
            $tr_detail = null;
            return view('viewCart', compact('result', 'books', 'tr_detail'));
        }

        $tr_detail = TransactionDetail::where('transaction_header_id',
                                            TransactionHeader::where('user_ID', Auth::user()->id)->orderBy('transaction_header_id', 'desc')->first()->transaction_header_ID)
                                            ->get();
        $books = [];
        $result = [];
        // dd($tr_detail);
        foreach($tr_detail as $book_detail){
            array_push($books, Book::where('book_id', $book_detail->book_ID)->get());
            $result = TransactionHeader::where('transaction_header_id', $book_detail->transaction_header_ID)->orderBy('transaction_header_id', 'desc')->first();
        }

        if(!$result) $result = null;

        return view('viewCart', compact('result', 'books', 'tr_detail'));
    }

    public function editCartBook($id){
        $tr_detail_book = TransactionDetail::where('transaction_header_id', TransactionHeader::where('user_ID', Auth::user()->id)->orderBy('transaction_header_id', 'desc')->first()->transaction_header_ID)
            ->where("book_ID", $id)
            ->first();
        $book = Book::where('book_ID', $tr_detail_book->book_ID)->first();
        $book_genre = book_genre::where('book_ID', $id)->get();
        // dd($book_genre);
        $genre = [];
        foreach($book_genre as $item){
            array_push($genre, Genre::where('genre_ID', $item->genre_ID)->first());
        }
        return view('editCart', compact('tr_detail_book', 'book', 'genre'));
    }

    public function history(){
        $th = TransactionHeader::where('user_ID', Auth::user()->id)->get();
        $histories = [];
        foreach($th as $item){
            $history = TransactionHistory::where('transaction_header_ID', $item->transaction_header_ID)->first();
            if($history) array_push($histories, $history);
        }

        // dd($histories);
        return view('transactionHeader', compact('histories'));
    }


}
