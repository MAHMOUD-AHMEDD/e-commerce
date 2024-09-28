@extends('layout.layout_admin')
@section('title','Admin | Contacts')

@section('content')

    <div class="users_list">
        <div class="container">
            <h1 class="my-4">All Contacts</h1>
            <table class="table table-bordered table-striped text-center">
                <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>name</th>
                    <th>email</th>
                    <th>info</th>
                    <th>Created at</th>
                    <th>updated at</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                @if($contacts->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center">No users found.</td>
                    </tr>
                @else
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact['id'] }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->info }}</td>
                            <td>{{ $contact -> created_at}}</td>
                            <td>{{ $contact->updated_at }}</td>
                            <td><a href="{{route('dashboard.edit.contact',$contact['id'])}}" class="btn btn-primary">Edit</a> <a href="/delete-item?model_name=contacts&id={{$contact->id}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?');">Delete</a></td>
{{--                            <td><a href="" class="btn btn-primary">Edit</a> <a href="{{route('delete',$user->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>--}}
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
{{--            {{$contacts->links()}}--}}
        </div>
    </div>
@endsection
