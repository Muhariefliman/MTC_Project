@extends('layout.template')

@section('main-content')

<div class="container shadow p-3 bg-white rounded">
    <div class="row">
        <div class="col-3">
            <div style="width: 15rem; height: 20rem;">
                <img src="{{Storage::url($book->cover)}}" alt="">
            </div>
        </div>
        <div class="col-9">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>{{$book->title}}</td>
                    </tr>
                    <tr>
                        <td>Author</td>
                        <td>{{$book->author}}</td>
                    </tr>
                    <tr>
                        <td>Synopsis</td>
                        <td>{{$book->synopsis}}</td>
                    </tr>
                    <tr>
                        <td>Genre(s)</td>
                        <td>
                            @foreach ($genre as $item)
                                {{$item->name}},
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>{{$book->price}}</td>
                    </tr>
                </tbody>
            </table>
            <form action="{{route('update_cart_book')}}" method="post" class="row g-3">
                @csrf
                    <div class="col-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Quantity</span>
                            <input type="text" name="book_id" value="{{$book->book_id}}" hidden>
                            <input type="number" name="price" value="{{$book->price}}" hidden>
                            <input type="number" class="form-control" aria-label="Username" name="quantity" aria-describedby="basic-addon1" value="{{$tr_detail_book->quantity}}" min="1" max="{{$book->quantity}}">
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-3">
                        {{--  <button type="submit" class="btn btn-primary mb-3">Add To Cart</button>  --}}
                        <input type="submit" class="btn btn-primary mb-3" value="Update">
                    </div>
            </form>
        </div>
    </div>
</div>



@endsection
