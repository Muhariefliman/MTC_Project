@extends('layout.template')

@section('main-content')

<div class="container shadow p-3 bg-white rounded">
    <h1 class="Card-title">
        Insert Genre Form
    </h1>
    <form action="{{route('insert_genre')}}" method="post" class="row">
        @csrf
        <div class="col-4">
            <p>Name</p>
            <br>
            <input type="submit" value="Insert" class="btn btn-primary form-control">
        </div>
        <div class="col-8">
            <input type="text" class="form-control" name="name">
        </div>
    </form>
</div>

<div>
    <table class="table">
        <thead>
            <tr>
              <th scope="col" colspan="10">Name</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
          @if ($genres)
            @foreach ($genres as $genre)
                <tr>
                    <td colspan="10">{{$genre->name}}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{url('genre/'.$genre->genre_ID)}}" class="btn btn-secondary">View Details</a>
                            <form action="{{route('delete_genre')}}" method="post" class="ms-2">
                                @csrf
                                <input type="text" name="id" value="{{$genre->genre_ID}}" hidden>
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                {{--  <h1>NO DATA</h1>  --}}
                @endif
            </tbody>

    </table>
</div>

@endsection
