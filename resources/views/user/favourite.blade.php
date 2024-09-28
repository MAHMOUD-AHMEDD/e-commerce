@extends('layout/layout_client')
@section('title','Products|Favourite')
@section('content')
    <div class="products">
        <div class="container">
            <div class="row">
                @if(session('success'))
                    <p class="alert alert-success">{{session('success')}}</p>
                @endif
                @foreach($favourites as $favourite)
                    <div class="container" onclick="location.href='products/{{$favourite->product['id']}}';" style="position: relative;cursor: pointer;">
                        <div class="images">
                            <img src="{{asset('images/'.$favourite->product->images[0]->name)}}" />
                        </div>
                        <div class="product">
                            <h1>{{$favourite->product['name']}}</h1>
                            <h2>${{$favourite->product['price']}}</h2>
                            <p class="desc">{{$favourite->product['info']}}</p>
                            <div class="buttons">
                                <a class="add" href="/delete-item?model_name=favorite_products&id={{$favourite->id}}">Remove from Favourite</a>
                                {{--                                    <button class="like"><span>♥</span></button>--}}
                                @if(auth()->id() ==$favourite->product['supplier_id'] ||auth()->user()['type']=='admin' )
                                    <a href="products/{{$favourite->product['id']}}/edit" class="add">Edit</a>
                                    <a href="/delete-item?model_name=Products&id={{$favourite->product->id}}" class="card-link">Delete Product</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{--                    --}}

                    {{--                    <div class="col-6">--}}
                    {{--                        <div class="card" style="width: 18rem; cursor: pointer;" onclick="location.href='products/{{$product->id}}';">--}}
                    {{--                            <div class="card-img-top images">--}}
                    {{--                                <div class="d-flex form-images">--}}

                    {{--                                        <div class="position-relative delete-image">--}}
                    {{--                                            <img src="{{asset('images/'.$product->images[0]->name)}}">--}}
                    {{--                                        </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="card-body">--}}
                    {{--                                <h5 class="card-title">{{$product['name']}}</h5>--}}
                    {{--                                <p class="card-text">{{$product['info']}}</p>--}}
                    {{--                            </div>--}}
                    {{--                            <ul class="list-group list-group-flush">--}}
                    {{--                                <li class="list-group-item">{{$product['price']}}</li>--}}
                    {{--                            </ul>--}}
                    {{--                            <div class="card-body">--}}
                    {{--                                <p>{{auth()->id()}} ||||||||| {{$product['supplier_id']}}</p>--}}
                    {{--                                @if(auth()->id() ==$product['supplier_id'] ||auth()->user()['type']=='admin' )--}}
                    {{--                                <a href="products/{{$product['id']}}/edit" class="card-link">Edit</a>--}}
                    {{--                                    <a href="/delete-item?model_name=Products&id={{$product->id}}" class="card-link">Delete Product</a>--}}
                    {{--                                @endif--}}
                    {{--                                @if(auth()->user()['type']=='client')--}}
                    {{--                                    <a href="orders/add/{{$product['id']}}" class="card-link">add to cart</a>--}}
                    {{--                                @endif--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{----}}


                @endforeach
                {{--                    {!! $products->links() !!}--}}
                {{$favourites->links()}}
            </div>
        </div>
    </div>


@endsection
