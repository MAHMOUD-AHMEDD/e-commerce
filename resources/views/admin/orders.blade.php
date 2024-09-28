@extends('layout.layout_admin')
@section('title','Admin | Orders')

@section('content')
    <div class="users_list">
        <div class="container">
            <h1 class="my-4">All Users</h1>
            <table class="table table-bordered table-striped text-center">
                <thead class="thead-dark">
                <tr>
                    <th>orderId</th>
                    <th>UserId</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>product name</th>
                    <th>Date of order</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                @if($orders->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center">No users found.</td>
                    </tr>
                @else
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->id }}</td>
{{--                            <td>{{ $user->image?->name }}</td>--}}
                            <td>{{ $order->user->username }}</td>
                            <td>{{ $order->user->email }}</td>
                            <td>{{$order->product->name}}</td>
                            <td>{{ $order->created_at}}</td>
                           <td> <a href="/delete-item?model_name=orders&id={{$order->id}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
{{--                            <td><a href="" class="btn btn-primary">Edit</a> <a href="{{route('delete',$user->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>--}}
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            {{$orders->links()}}
        </div>
    </div>
@endsection
