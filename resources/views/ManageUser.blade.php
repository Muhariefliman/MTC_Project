@extends('layout.template')

@section('main-content')

<div class="container shadow p-3 bg-white rounded">
    <table class="table">
        <thead>
            <tr>
                <th scope="col" colspan="10">Name</th>
                <th scope="col" colspan="10">Email</th>
                <th scope="col" colspan="10">Role</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($Users as $user)
                    <tr>
                        <td colspan="10">{{$user->name}}</td>
                        <td colspan="10">{{$user->email}}</td>
                        <td colspan="10">{{$user->roles}}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{url('userDetails/'.$user->id)}}" class="btn btn-secondary">View Details</a>
                                <form action="{{route('delete_user')}}" method="post" class="ms-2">
                                    @csrf
                                    <input type="text" name="id" value="{{$user->id}}" hidden>
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                            </div>
                        </td>
                    </tr>

                @endforeach
            </tbody>
    </table>
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
</div>



@endsection
