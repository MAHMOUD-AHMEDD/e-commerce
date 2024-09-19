@extends('layout/layout_client')
@section('title','Register')
@section('content')
    <div class="contact_us">
        <div class="container">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{{$error}}</p>
                @endforeach
            @endif
            @if(session('success'))
                <p class="alert alert-success">{{session('success')}}</p>
            @endif
            <form method="post" action="{{route('auth.register')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label>Username</label>
                    <input class="form-control" name="username" value="{{old('username')}}">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input class="form-control" name="email" value="{{old('email')}}">
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input class="form-control" type="password" name="password" value="{{old('password')}}">
                </div>
                <div class="mb-3">
                    <label>Personal Image</label>
                    <input class="form-control" name="image" type="file">
                </div>
                <div class="mb-3">
                    <select class="form-control" name="type">
                        <option value="client">client</option>
                        <option value="supplier">supplier</option>
                    </select>
                </div>

                <input type="submit" class="btn btn-success">
            </form>
        </div>
    </div>

@endsection
