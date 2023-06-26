@extends('layout.template')

@section('main-content')

<div class="container shadow p-3 bg-white rounded">
    <h1 class="Card-title">
        Genre Name Details
    </h1>
    {{-- @foreach ($genre as $item) --}}
        <form action="{{route('update_genre')}}" method="post" class="row">
            @csrf
            <div class="col-4 mb-3">
                <p>Name</p>
                <br>
                <input type="submit" value="Update" class="btn btn-primary form-control">
            </div>
            <div class="col-8">
                <input type="text" name="id" value="{{$genre->genre_ID}}" hidden>
                <input type="text" class="form-control" value="{{$genre->name}}" name="name">
            </div>
        </form>
    {{-- @endforeach --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('Success'))
        <div class="alert alert-success">
            {{ session('Success') }}
        </div>
    @endif
    <div>
        <h1 class="Card-title">
            Book List
        </h1>
        <table class="table">
            <thead>
                <tr>
                  <th scope="col" colspan="10">Name</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($Books)
                    @foreach ($Books as $book)
                        @if ($book)
                            <tr>
                                <td colspan="10">{{$book->title}}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{url('details/'.$book->book_id)}}" class="btn btn-secondary me-2">View Details</a>
                                        <form action="{{route('delete_book')}}" method="post" class="ms-2">
                                            @csrf
                                            <input type="text" name="id" value="{{$book->book_id}}" hidden>
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endif
                        {{-- {{dd($book)}} --}}
                    @endforeach
                @endif
              </tbody>
        </table>
    </div>
</div>



@endsection
