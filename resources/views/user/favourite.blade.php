@extends('layout/layout_client')
@section('title','Products | Favourite')
@section('content')
    <div class="products">
        <div class="container py-4">
            <div class="row">
                @if(session('success'))
                    <p class="alert alert-success">{{session('success')}}</p>
                @endif

                @foreach($favourites as $favourite)
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card product-card h-100" onclick="location.href='products/{{$favourite->product['id']}}';" style="cursor: pointer;">
                            <img src="{{asset('images/'.$favourite->product->images[0]->name)}}" class="card-img-top product-image" style="width: 300px;height: 300px;" alt="{{$favourite->product['name']}}">
                            <div class="card-body">
                                <h5 class="card-title text-primary">{{$favourite->product['name']}}</h5>
                                <h6 class="card-subtitle mb-2 text-success">${{$favourite->product['price']}}</h6>
                                <p class="card-text text-muted">{{$favourite->product['info']}}</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                                <a href="/delete-item?model_name=favorite_products&id={{$favourite->id}}" class="btn btn-outline-danger btn-sm">Remove from Favourite</a>
                                @if(auth()->id() == $favourite->product['supplier_id'] || auth()->user()['type'] == 'admin')
                                    <a href="products/{{$favourite->product['id']}}/edit" class="btn btn-outline-secondary btn-sm">Edit</a>
                                    <a href="/delete-item?model_name=Products&id={{$favourite->product->id}}" class="btn btn-outline-danger btn-sm">Delete</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-center mt-4">
                    {{$favourites->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
