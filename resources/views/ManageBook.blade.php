@extends('layout.template')

@section('main-content')

<div class="container shadow p-3 bg-white rounded mb-4">
    <h1 class="Card-title">Insert Book Form</h1>
    <table class="table table-borderless">
        <form action="{{route('insert_book')}}" method="post" enctype="multipart/form-data">
            @csrf
            <tbody>
              <tr>
                <td>Name</td>
                <td>
                    <input type="text" name="book_name" class="form-control">
                </td>
              </tr>
              <tr>
                <td>Author</td>
                <td>
                    <input type="text" name="Author_name" class="form-control">
                </td>
              </tr>
              <tr>
                <td>Synopsis</td>
                <td>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 150px" name="synopsis"></textarea>
                        <label for="floatingTextarea2">Synopsis</label>
                      </div>
                </td>
              </tr>
              <tr>
                <td>Genre(s)</td>
                <td>
                    @foreach ($genres as $genre)
                        <div class="row-auto">
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="genre[]" value="{{$genre->genre_ID}}" >
                                    <label class="form-check-label">
                                        {{$genre->name}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </td>
              </tr>
              <tr>
                <td>Price</td>
                <td>
                    <input type="number" name="price" min="1" class="form-control">
                </td>
              </tr>
              <tr>
                <td>Cover</td>
                <td>
                    <div class="mb-3 col-3">
                        <input class="form-control" type="file" id="formFile" name="images">
                    </div>
                </td>
              </tr>
            </tbody>
        </table>
        <div>
            <input type="submit" value="Insert" class="btn btn-primary">
        </div>
    </form>
</div>

<div>
    <table class="table">
        <thead>
            <tr>
            <th scope="col" colspan="10">Name</th>
            <th scope="col">Author</th>
            <th scope="col">Synopsis</th>
            <th scope="col">Genre</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($books)
                @foreach ($books as $book)
                    <tr>
                        <td colspan="10">{{$book->title}}</td>
                        <td>{{$book->author}}</td>
                        <td>{{$book->synopsis}}</td>
                        @foreach ($genres as $item)
                            @if($item->genre_ID == $book->genre_id)
                                <td>{{$item->name}}</td>
                            @endif
                        @endforeach
                        <td>{{$book->price}}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{url('/details/'.$book->book_id)}}" class="btn btn-secondary">View Details</a>
                                <form action="{{route('delete_book')}}" method="post" class="ms-2">
                                    @csrf
                                    <input type="text" name="id" value="{{$book->book_id}}" hidden>
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

@endsection
