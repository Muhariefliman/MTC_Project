@extends('layout.template')

@section('main-content')

<div class="container shadow p-3 bg-white rounded">
    <table class="table">
        <thead>
            <tr>
                <th scope="col" colspan="10">Name</th>
                <th scope="col" colspan="10">Book Author</th>
                <th scope="col" colspan="10">Price</th>
                <th scope="col" colspan="10">Quantity</th>
                <th scope="col" colspan="10">Sub Total</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                <?php $count = 0 ?>
                @foreach ($books as $item)
                    <tr>
                        <td colspan="10">{{$item->title}}</td>
                        <td colspan="10">{{$item->author}}</td>
                        <td colspan="10">{{$item->price}}</td>
                        <td colspan="10">{{$td[$count]->quantity}}</td>
                        <td colspan="10">IDR {{$item->price * $td[$count]->quantity}}</td>
                        <td>
                            <a href="{{url('details/'.$item->book_id)}}" class="btn btn-secondary me-2">View Details</a>
                        </td>
                    </tr>
                    <?php $count++ ?>
                @endforeach
            </tbody>
    </table>
    <div class="mb-3">
        <p class="Card-title">Grand Total: <span>{{$th->total_price}}</span></p>
    </div>
</div>



@endsection
