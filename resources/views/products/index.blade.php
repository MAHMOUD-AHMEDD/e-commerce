@extends(
    auth()->user()->type === 'admin' ? 'layout.layout_admin' :
    (auth()->user()->type === 'client' ? 'layout.layout_client' : 'layout.layout_supplier')
)
@section('title','Products')
@section('content')
    <div class="products">
        <div class="container py-4">
            <div class="row">
                @if(session('success'))
                    <p class="alert alert-success">{{session('success')}}</p>
                @endif
                @if(session('error'))
                    <p class="alert alert-danger">{{session('error')}}</p>
                @endif

                @foreach($products as $product)
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card product-card h-100" onclick="location.href='products/{{$product->id}}';" style="cursor: pointer;">
                            <img src="{{asset('images/'.$product->images[0]->name)}}" class="card-img-top product-image" style="width: 300px;height: 300px" alt="{{$product['name']}}">
                            <div class="card-body">
                                <h5 class="card-title text-primary">{{$product['name']}}</h5>
                                <h6 class="card-subtitle mb-2 text-success">${{$product['price']}}</h6>
                                <p class="card-text text-muted">{{$product['info']}}</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                                <a href="{{asset('/products/AddToFavourite/'.$product->id)}}?id={{$product->id}}" class="btn btn-outline-primary btn-sm">Add to Favourite</a>
                                @if(auth()->id() == $product['supplier_id'] || auth()->user()['type'] == 'admin')
                                    <a href="products/{{$product['id']}}/edit" class="btn btn-outline-secondary btn-sm">Edit</a>
                                    <a href="/delete-item?model_name=Products&id={{$product->id}}" class="btn btn-outline-danger btn-sm">Delete</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center mt-4">
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
