@extends('layout.layout_client')
@section('title','Checkout')
@section('content')

    <section class="checkout-section" style="background-color: #f8f9fa; min-height: 100vh; padding: 50px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-3">
                        <!-- Card Header -->
                        <div class="card-header bg-primary text-white text-center py-4 rounded-top">
                            <h2 class="mb-0">Checkout</h2>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body p-4">
                            <form method="POST" action="{{route('confirmation')}}">
                                @csrf

                                <!-- Address Section -->
                                <div class="mb-4">
                                    <h5 class="text-secondary">Delivery Address</h5>
                                    <div class="card bg-light p-3 border-0 rounded">
                                        <p class="mb-0">
                                            <strong>{{$user->username}}</strong><br>
                                            {{$user->address}}
                                        </p>
                                    </div>
                                </div>

                                <!-- Payment Method -->
                                <div class="mb-4">
                                    <h5 class="text-secondary">Select Payment Method</h5>
                                    <fieldset class="border p-3 rounded">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" id="visa" name="payment-method" value="visa" checked>
                                            <label class="form-check-label" for="visa">
                                                <i class="ri-bank-card-line text-primary"></i> Visa
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" id="paypal" name="payment-method" value="paypal">
                                            <label class="form-check-label" for="paypal">
                                                <i class="ri-paypal-line text-info"></i> PayPal
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="mastercard" name="payment-method" value="mastercard">
                                            <label class="form-check-label" for="mastercard">
                                                <i class="ri-mastercard-line text-danger"></i> MasterCard
                                            </label>
                                        </div>
                                    </fieldset>
                                </div>

                                <!-- Shopping Bill -->
                                <div class="mb-4">
                                    <h5 class="text-secondary">Shopping Bill</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                            <?php $total = 0; ?>
                                            @foreach($orders as $order)
                                                    <?php $total += $order->product->price * $order->quantity; ?>
                                            @endforeach
                                            <tr>
                                                <td>Shipping Fee</td>
                                                <td class="text-end">$5.43</td>
                                            </tr>
                                            <tr>
                                                <td>Price Total</td>
                                                <td class="text-end">${{ number_format($total, 2) }}</td>
                                            </tr>
                                            </tbody>
                                            <tfoot>
                                            <tr class="table-warning">
                                                <th>Total</th>
                                                <th class="text-end">${{ number_format($total + 5.43, 2) }}</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <!-- Buy Now Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="ri-shopping-cart-line"></i> Buy Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
