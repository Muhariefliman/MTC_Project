@extends('layout.template')

@section('main-content')

<div class="container shadow p-3 bg-white rounded">
    @if ($result)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Book Author</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    {{--  @foreach ($tr_detail as $item)  --}}
                    <?php $count = 0?>
                        @foreach ($books as $book1)
                            @foreach ($book1 as $book)
                            <tr>
                                <td>{{$book->title}}</td>
                                <td>{{$book->author}}</td>
                                <td>{{$book->price}}</td>
                                <td>{{$tr_detail[$count]->quantity}}</td>
                                <td>IDR {{$book->price*$tr_detail[$count]->quantity}}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{url('details/'.$book->book_id)}}" class="btn btn-secondary me-2">View Details</a>
                                        <a href="{{url('editBook/'.$book->book_id)}}" class="btn btn-primary me-2">Edit</a>
                                        <form action="{{route('delete_cart_book')}}" method="post" class="ms-2">
                                            @csrf
                                            <input type="text" value="{{$book->book_id}}" name="book_id" hidden>
                                            <input type="number" value="{{$tr_detail[$count]->quantity}}" name="quantity" hidden>
                                            <input type="submit" class="btn btn-danger" value="Remove">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php $count++?>
                            @endforeach

                        @endforeach

                    {{--  @endforeach  --}}
                </tbody>
        </table>
        <div class="mb-3">

            <p class="Card-title">Grand Total: <span>{{$result->total_price}}</span></p>
            <br>
            <form action="{{route('checkout_cart_book')}}" method="post" class="">
            @csrf
                <input type="text" name="transaction_header_ID", value="{{$result->transaction_header_ID}}" hidden>
                <input type="submit" class="btn btn-primary" value="Check Out">
            </form>
        </div>
    @else
        <h1 class="text-center">
            Cart Is Empty
        </h1>

    @endif
</div>



@endsection
