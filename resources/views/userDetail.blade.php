@extends('layout.template')

@section('main-content')

<div class="container shadow p-3 bg-white rounded">
    <h1 class="Card-title">Member&apos;s User Detail</h1>
    <form action="{{url('/userDetails/'.$user->id)}}" method="post">
        @csrf
        <input type="text" name="id" hidden value="{{$user->id}}">
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td colspan="10">User Name</td>
                    <td>
                        <input type="text" class="form-control" name="user_name" value="{{$user->name}}">
                    </td>
                </tr>
                <tr>
                    <td colspan="10">User Email</td>
                    <td>
                        <input type="email" class="form-control" name="user_mail" value="{{$user->email}}">
                    </td>
                </tr>
                <tr>
                    <td colspan="10">User Role</td>
                    <td>
                        <div class="mb-3">
                            <select id="disabledSelect" class="form-select" name="roles">
                                @if ($user->roles == 'Admin')
                                    <option value="Admin">Admin</option>
                                    <option value="Member">Member</option>
                                @else
                                    <option value="Member">Member</option>
                                    <option value="Admin">Admin</option>
                                @endif
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="10">
                        <input type="submit" name="submit" value="Update" class="btn btn-primary form-control">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
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
