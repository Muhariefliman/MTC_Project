<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\TransactionHistory;

class TransactionheaderController extends BaseController
{
    // Add new Transaction
    public function addTransaction(Request $request)
    {
        // $result = TransactionHeader::all()->last();
        $result = TransactionHeader::where('user_ID', Auth::user()->id)->orderBy('transaction_header_id', 'desc')->first();
        if(!$result){
            // dd(Auth::user()->id);
            $transcation = TransactionHeader::create([
                'user_ID' => Auth::user()->id,
                'total_price' => 0,
            ]);
        }
        $result = TransactionHeader::where('user_ID', Auth::user()->id)->orderBy('transaction_header_id', 'desc')->first();

        $val = TransactionDetail::where('transaction_header_id', $result->transaction_header_ID)->first();
        // dd($val);
        if($val && $val->book_ID == $request->book_id){
            // $request->quantity = $request->quantity + $val->quantity;
            TransactionDetail::where('transaction_header_id', TransactionHeader::where('user_ID', Auth::user()->id)->orderBy('transaction_header_id', 'desc')->first()->transaction_header_ID)
                            ->where("book_ID", $request->book_id)
                            ->update(['quantity'=>$request->quantity + $val->quantity]);

            // Update Total Price
            $tr_header = TransactionHeader::where('user_ID', Auth::user()->id)->orderBy('transaction_header_id', 'desc')->first();
            $total_price = $request->quantity * $request->price;

            TransactionHeader::where('transaction_header_ID', $tr_header->transaction_header_ID)
                ->update(['total_price' => $total_price]);

            // Update Quantity DB Book
            $book = Book::where('book_ID', $request->book_id)->first();
            // dd($book);
            Book::where('book_ID', $book->book_id)
                ->update(['quantity' => $book->quantity - $request->quantity]);
        }else{
            // dd($result);
            TransactionDetail::create([
                'transaction_header_id' => $result->transaction_header_ID,//PK FK
                'book_id' => $request->book_id, // PK FK
                'quantity' => $request->quantity
            ]);

            $book = Book::where('book_ID', $request->book_id)->first();
            Book::where('book_ID', $book->book_id)
                ->update(['quantity' => $book->quantity - $request->quantity]);

            TransactionHeader::where('transaction_header_ID', $result->transaction_header_ID)
                ->update(['total_price' => $result->total_price+($request->price*$request->quantity)]);
        }
        return redirect('/details/'.$request->book_id)->with('Success', 'Success Add To Cart');
        // return view('transactionheader.add');
    }

    // Delete transaction
    public function deleteTransaction(Request $request)
    {
        TransactionDetail::where('transaction_header_id', TransactionHeader::where('user_ID', Auth::user()->id)->orderBy('transaction_header_id', 'desc')->first()->transaction_header_ID)
        ->where("book_ID", $request->book_id)
        ->delete();

        $book = Book::where('book_ID', $request->book_id)->first();
        Book::where('book_ID', $book->book_id)
            ->update(['quantity' => $book->quantity + $request->quantity]);


        $tr_header = TransactionHeader::where('user_ID', Auth::user()->id)->orderBy('transaction_header_id', 'desc')->first();
        $total_price = $tr_header->total_price-($book->price*$request->quantity);

        TransactionHeader::where('transaction_header_ID', $tr_header->transaction_header_ID)
            ->update(['total_price' => $total_price]);
        return redirect('/viewCart');
    }

    public function checkout(Request $request){
        $result = TransactionHeader::where('user_ID', Auth::user()->id)
                                    ->where('transaction_header_id', $request->transaction_header_ID)
                                    ->orderBy('transaction_header_id', 'desc')->first();
        // dd($result->transaction_header_ID);
        TransactionHistory::create([
            'transaction_header_ID' => $result->transaction_header_ID,
            'total_price' => $result->total_price,
        ]);

        TransactionHeader::create([
            'user_ID' => Auth::user()->id,
            'total_price' => 0,
        ]);
        return redirect('');
    }

    // Update transaction
    public function updateTransaction(Request $request)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        // Update Quantity Detail Book
        TransactionDetail::where('transaction_header_id', TransactionHeader::where('user_ID', Auth::user()->id)->orderBy('transaction_header_id', 'desc')->first()->transaction_header_ID)
        ->where("book_ID", $request->book_id)
        ->update(['quantity'=>$request->quantity]);

        // Update Total Price
        $tr_header = TransactionHeader::where('user_ID', Auth::user()->id)->orderBy('transaction_header_id', 'desc')->first();
        $total_price = $request->quantity * $request->price;

        TransactionHeader::where('transaction_header_ID', $tr_header->transaction_header_ID)
            ->update(['total_price' => $total_price]);

        // Update Quantity DB Book
        $book = Book::where('book_ID', $request->book_id)->first();
        // dd($book);
        Book::where('book_ID', $book->book_id)
            ->update(['quantity' => $book->quantity - $request->quantity]);

        return redirect('/editBook/'.$book->book_id)->with('Success', 'Success Update Book');

    }

    // Get History Details
    public function historyDetail($id){
        $history = TransactionHistory::find($id);
        $th = TransactionHeader::where('transaction_header_ID', $history->transaction_header_id)->first();
        $td = TransactionDetail::where('transaction_header_id', $th->transaction_header_ID)->get();

        $books = [];
        // dd($tr_detail);
        foreach($td as $book_detail){
            array_push($books, Book::where('book_id', $book_detail->book_ID)->first());
        }

        return view('TransactionDetail', compact('th', 'td', 'books'));
    }



}
