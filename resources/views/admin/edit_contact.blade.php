@extends('layout.layout_admin')
@section('title', 'Edit User')
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
            <form method="post" action="{{route('dashboard.update.contact', $contact->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>name</label>
                    <input class="form-control" name="name" value="{{ $contact->name }}">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input class="form-control" name="email" value="{{ $contact->email }}">
                </div>
                <div class="mb-3">
                    <label>info</label>
                    <input class="form-control" name="info" value="{{ $contact->info }}">
                </div>
                <input type="submit" class="btn btn-success" value="Update Contact">
            </form>
        </div>
    </div>
@endsection
