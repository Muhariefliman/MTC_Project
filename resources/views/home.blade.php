@extends('layout.template')

@section('main-content')

<div id="home">

    <div class="row mb-3 mt-3">
        <form action="{{route('search')}}" method="get">
            {{--  @csrf  --}}
            <div class="row">
                <div class="col-11">
                    <input type="text" class="form-control" name="book_name">
                </div>
                <div class="col-1">
                    <input type="submit" class="btn btn-primary" value="Search">
                </div>
            </div>
        </form>

    </div>

    <div class="mb-3">
        <a href="/home" class="btn btn-primary">Clear Filter</a>
    </div>

    <div class="row mb-3">
        @foreach ($Books as $book)

        <div class="col-auto mb-3">
            <div class="card shadow p-3 bg-white rounded" style="width: 15rem;">
                <div style="width: 13rem; height: 15rem;" class="shadow">
                    <img class="card-img-top" src="{{Storage::url($book->cover)}}" alt="{{$book->title}}" width="100%;">
                </div>
                <div class="card-body">
                  <h5 class="card-title">{{ $book->title }}</h5>
                  <p class="card-text">{{$book->author}}</p>
                  <p class="card-text">{{$book->price}}</p>
                  <a href="{{url('details/'.$book->book_id)}}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
        <div class="mb-3">
            {{$Books->links()}}
        </div>
    </div>
</div>

@endsection
