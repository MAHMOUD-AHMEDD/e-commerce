@extends(
    auth()->user()->type === 'admin' ? 'layout.layout_admin' :
    (auth()->user()->type === 'client' ? 'layout.layout_client' : 'layout.layout_supplier')
)
@section('title','User|Profile')
@section('content')

            <div class="container rounded bg-white mt-5 mb-5">
                <form method="post" action="{{route('profile.update')}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger">{{$error}}</p>
                    @endforeach
                @endif
                @if(session('success'))
                    <p class="alert alert-success">{{session('success')}}</p>
                @endif
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
{{--                            <img class="rounded-circle mt-5" src="{{asset('/images'.$user->image->name)}}">--}}
                            @if($user->image?->name)
                                <img class="rounded-circle mt-5" src="{{ asset('images/'.$user->image->name) }}" alt="">
                            @else
                                <img class="rounded-circle mt-5" src="{{ asset('images/default.jpeg') }}" alt="">
                            @endif
                            <span class="font-weight-bold">{{$user->username}}</span>
                            <span class="text-black-50">{{$user->email}}</span>
                            <span> </span>
                        </div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile Settings</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6"><label class="labels">Name</label><input required type="text" name="username" class="form-control" placeholder="username" value="{{$user->username}}"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Password (leave blank if you don't want to change it)</label><input type="password" class="form-control" placeholder="enter password" value=""></div>
                                <div class="col-md-12"><label class="labels">Address</label><input type="text" class="form-control" placeholder="enter address" name="address" value="{{$user->address}}"></div>
                                <div class="col-md-12"><label class="labels">Email</label><input required type="text" class="form-control" placeholder="enter email" value="{{$user->email}}" name="email"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6"><label class="labels">Type</label><select class="form-control" name="type">
                                        <option value="client">client</option>
                                        <option value="supplier">supplier</option>
                                    </select>
                                </div>
{{--                                <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div>--}}
                            </div>
                            <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                        </div>
                    </div>
{{--                    <div class="col-md-4">--}}
{{--                        <div class="p-3 py-5">--}}
{{--                            <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>--}}
{{--                            <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value=""></div> <br>--}}
{{--                            <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
               </form>
            </div>
@endsection
