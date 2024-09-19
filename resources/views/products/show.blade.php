@extends(auth()->user()->type === 'client' ? 'layout.layout_client' : 'layout.layout_supplier')
@section('title','Product info')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="card">
            <div class="row g-0">
                <div class="col-md-6 border-end">
                    <div class="d-flex flex-column justify-content-center">
                        <div class="main_image"> <img src={{asset('images/'.$product[0]['images'][0]['name'])}} id="main_product_image" width="350"> </div>
                        <div class="thumbnail_images">
                            <ul id="thumbnail">
                                @foreach($product[0]->images as $image)
                                <li><img onclick="changeImage(this)" src="{{asset('images/'.$image->name)}}" width="70"></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 right-side">
                        @if(session('failed'))
                            <p class="alert alert-danger">{{session('failed')}}</p>
                        @elseif(session('success'))
                            <p class="alert alert-success">{{session('success')}}</p>
                        @endif
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>{{$product[0]->name}}</h3>
                        </div>
                        <div class="mt-2 pr-3 content">
                            <p>{{$product[0]->info}}</p>
                        </div>
                        <h3>${{$product[0]->price}}</h3>
{{--                        <div class="ratings d-flex flex-row align-items-center">--}}
{{--                            <div class="d-flex flex-row"> <i class='bx bxs-star'></i> <i class='bx bxs-star'></i> <i class='bx bxs-star'></i> <i class='bx bxs-star'></i> <i class='bx bx-star'></i> </div>--}}
{{--                            <span>441 reviews</span>--}}
{{--                        </div>--}}
                            @if(auth()->user()['type']=='client')
                                <form method="GET" action="orders/add/{{$product[0]->id}}">
                                    @csrf
                                    <div class="mb-2">
                                        <label for="">Quantity</label>
                                        <input type="number" class="form-control" name="quantity" min="1" required>
                                    </div>
                                    <button class="btn btn-outline-dark">Add to Cart</button>
                                </form>
                            @endif
{{--    <div class="buttons d-flex flex-row mt-5 gap-3"> <button class="btn btn-outline-dark">Buy Now</button>  </div>--}}
                        <form method="GET" action="reviews/{{$product[0]->id}}">
                            <div class="mb-2">
                                <label for="">Want to add review?</label>
                                <textarea name="comment" rows="4" cols="50" placeholder="add your review here"></textarea>
                            </div>
                            <div class="mb-2">
                                <label for="">Rating?</label>
                                <input name="rating" min="1" max="5" type="number">
                            </div>
                            <button class="btn btn-outline-dark">Add review</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="reviews">
            <div class="container">
                @foreach($product[0]->reviews as $review )
                    <div class="cont">
                        <div class="user_image"><img src="{{asset('images/'.$review->user->image->name)}}"></div>
                        <div class="name"><h4 style="font-size: 15px;">{{$review->user->username}}</h4></div>
                        <div class="rating"><p>Rating:{{$review->rating}}</p></div>
                        <div class="review_time"><p class="text-secondary">Reviewed in:{{$review->created_at}}</p></div>
                        <br>
                        <div class="comment"><p>{{$review->comment}}</p></div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>




@endsection
