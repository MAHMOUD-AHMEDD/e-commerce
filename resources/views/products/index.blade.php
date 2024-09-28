@extends(
    auth()->user()->type === 'admin' ? 'layout.layout_admin' :
    (auth()->user()->type === 'client' ? 'layout.layout_client' : 'layout.layout_supplier')
)
@section('title','Products')
@section('content')
    <div class="products">
        <div class="container">
            <div class="row">
                @if(session('success'))
                    <p class="alert alert-success">{{session('success')}}</p>
                @endif
                    @if(session('error'))
                    <p class="alert alert-danger">{{session('error')}}</p>
                @endif
                @foreach($products as $product)
                        <div class="container" onclick="location.href='products/{{$product->id}}';" style="position: relative;cursor: pointer;">
                            <div class="images">
                                <img src="{{asset('images/'.$product->images[0]->name)}}" />
                            </div>
                            <div class="product">
                                <h1>{{$product['name']}}</h1>
                                <h2>${{$product['price']}}</h2>
                                <p class="desc">{{$product['info']}}</p>
                                <div class="buttons">
                                    <a class="add" href="{{asset('/products/AddToFavourite/'.$product->id)}}?id={{$product->id}}">Add to Favourite</a>
{{--                                    <button class="like"><span>♥</span></button>--}}
                                    @if(auth()->id() ==$product['supplier_id'] ||auth()->user()['type']=='admin' )
                                        <a href="products/{{$product['id']}}/edit" class="add">Edit</a>
                                        <a href="/delete-item?model_name=Products&id={{$product->id}}" class="card-link">Delete Product</a>
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
                {{$products->links()}}
            </div>
        </div>
    </div>


@endsection
