@extends('layout/layout_client')
@section('title','cart')
@section('content')


    <?php $total=0 ?>
    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card border-top border-bottom border-3" style="border-color: #f37a27 !important;">
                        <div class="card-body p-5">

                            <p class="lead fw-bold mb-5" style="color: #f37a27;">Purchase Reciept</p>



                            <div class="mx-n5 px-5 py-4" style="background-color: #f2f2f2;">
                                <div class="row">
                                    @foreach($orders as $order)
                                        <div class="image_name">
                                            <a href="/delete-item?model_name=Orders&id={{$order->id}}"><i class="ri-close-line"></i> </a>
                                            <div class="image" style="width: 50px;">
                                                <img src="{{asset('images/'.$order->product->images[0]->name)}}" class="w-100">
                                            </div>
                                            <div style="margin-left: 20px;">
                                                <p>{{$order->product->name}}</p>
                                                <p>quantity: {{$order->quantity}}</p>

                                            </div>
                                            <div style="margin-left: 158px;">
                                                    <?php $total+=$order->product->price * $order->quantity ?>
                                                <p>{{$order->product->price}}$</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>

                            <div class="row my-4">
                                <div class="col-md-4 offset-md-8 col-lg-3 offset-lg-9">
                                    <p class="lead fw-bold mb-0" style="color: #f37a27;">Total: <?php echo $total ?>$</p>
                                </div>
                            </div>



                        </div>
                    </div>



                </div>
            </div>
        </div>
        </div>
        </div>
    </section>

@endsection
