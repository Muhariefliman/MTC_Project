@extends('layout.template')

@section('main-content')

<div class="container shadow p-3 bg-white rounded">
    <table class="table">
        <thead>
                <tr>
                    <th scope="col" colspan="10">Transaction ID</th>
                    <th scope="col" colspan="10">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($histories as $history)
                    <tr>
                        <td colspan="10">{{$history->id}}</td>
                        <td colspan="10">{{$history->date}}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{url('/detail_history/'.$history->id)}}" class="btn btn-secondary me-2">View Details</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
    </table>
</div>

@endsection
