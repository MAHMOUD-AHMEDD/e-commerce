@extends('layout.layout_client')
@section('title','Cart')
@section('content')

    <?php $total=0 ?>
    <section class="h-100 h-custom" style="background-color: #f8f9fa;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-10 col-xl-8">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-header bg-primary text-white py-3 rounded-top">
                            <h4 class="mb-0 text-center">Purchase Receipt</h4>
                        </div>
                        <div class="card-body p-5">

                            <!-- Orders List -->
                            <div class="order-list">
                                @foreach($orders as $order)
                                    <div class="d-flex align-items-center mb-4 p-3 rounded" style="background-color: #f2f2f2;">
                                        <!-- Product Image -->
                                        <div class="product-image" style="width: 80px; height: 80px; overflow: hidden; border-radius: 8px;">
                                            <img src="{{asset('images/'.$order->product->images[0]->name)}}" class="w-100 h-100 object-fit-cover">
                                        </div>

                                        <!-- Product Info -->
                                        <div class="ms-3 flex-grow-1">
                                            <h5 class="mb-1">{{$order->product->name}}</h5>
                                            <p class="mb-0 text-muted">Quantity: {{$order->quantity}}</p>
                                            <p class="mb-0 text-success">${{$order->product->price}}</p>
                                        </div>

                                        <!-- Remove Button -->
                                        <div class="remove-item">
                                            <a href="/delete-item?model_name=Orders&id={{$order->id}}" class="btn btn-sm btn-outline-danger"><i class="ri-close-line"></i> Remove</a>
                                        </div>

                                        <!-- Subtotal -->
                                        <div class="subtotal ms-4 text-end">
                                                <?php $total += $order->product->price * $order->quantity ?>
                                            <h6 class="text-dark">${{$order->product->price * $order->quantity}}</h6>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Divider -->
                            <hr class="my-4">

                            <!-- Total and Checkout -->
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold">Total:</h5>
                                <h5 class="fw-bold text-dark">${{ $total }}</h5>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{asset('/checkout')}}" class="btn btn-primary btn-lg">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
