@extends('layout.template')

@section('main-content')

<div class="container shadow p-3 bg-white rounded">
    <h2 class="Card-Title">{{$book->title}}</h2>
    @if (Auth::check())
        @if (Auth::user()->roles == 'Admin')
            <div>
                <table class="table table-borderless">
                    <form action="{{route('update_book')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <tbody>
                          <tr>
                            <td>Name</td>
                            <td>
                                <input type="text" name="book_id" value="{{$book->book_id}}" hidden>
                                <input type="text" name="book_name" class="form-control" value="{{$book->title}}">
                            </td>
                          </tr>
                          <tr>
                            <td>Author</td>
                            <td>
                                <input type="text" name="Author_name" class="form-control" value="{{$book->author}}">
                            </td>
                          </tr>
                          <tr>
                            <td>Synopsis</td>
                            <td>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 150px" name="synopsis">{{$book->synopsis}}</textarea>
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
                                                @if ($genre->genre_ID == $book->genre_id)
                                                    <input class="form-check-input" type="checkbox" name="genre[]" value="{{$genre->genre_ID}}" checked>
                                                @else
                                                    <input class="form-check-input" type="checkbox" name="genre[]" value="{{$genre->genre_ID}}" >
                                                @endif
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
                                <input type="number" name="price" min="1" class="form-control" value="{{$book->price}}">
                            </td>
                          </tr>
                          <tr>
                            <td>Cover</td>
                            <td>
                                <div class="mb-3 col-3">
                                    <div style="width: 15rem; height: 15rem;">
                                        <img src="{{Storage::url($book->cover)}}" alt="{{$book->title}}'Cover" class="mb-3" width="100%" height="100%">
                                    </div>
                                    <input class="form-control" type="file" id="formFile" name="images">
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Quantity</td>
                            <td>
                                <input type="number" name="quantity" min="1" class="form-control" value="{{$book->quantity}}">
                            </td>
                          </tr>
                        </tbody>
                    </table>
                    <div>
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
        @else
            <div class="row">
                <div class="col-3">
                    <div style="width: 15rem; height: 15rem">
                        <img src="{{Storage::url($book->cover)}}" alt="{{$book->title}}" width="100%" height="100%">
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
                                        {{$item->name}}
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>{{$book->price}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <form action="{{route('add_to_cart')}}" method="post" class="row g-3">
                        @csrf
                            <div class="col-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Quantity</span>
                                    <input type="text" name="book_id" value="{{$book->book_id}}" hidden>
                                    <input type="number" name="price" value="{{$book->price}}" hidden>
                                    <input type="number" class="form-control" aria-label="Username" name="quantity" aria-describedby="basic-addon1" value="1" min="1" max="{{$book->quantity}}">
                                </div>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-3">
                                {{--  <button type="submit" class="btn btn-primary mb-3">Add To Cart</button>  --}}
                                <input type="submit" class="btn btn-primary mb-3" value="Add To Cart">
                            </div>
                    </form>
                </div>
            </div>
        @endif
    @else
        <div class="row">
            <div class="col-3">
                <div style="width: 15rem; height: 15rem">
                    <img src="{{Storage::url($book->cover)}}" alt="{{$book->title}}" width="100%" height="100%">
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
                                | {{$item->name}}
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>{{$book->price}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    @endif
    {{--  Guest  --}}


    {{--  Member  --}}
    {{--   --}}

    {{--  Admin  --}}
    {{--    --}}


</div>

@endsection
