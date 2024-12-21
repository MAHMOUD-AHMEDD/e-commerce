@extends('layout/layout_client')
@section('title','Order | Confirmation')
@section('content')

    <section class="confirmation-section" style="background-color: #f8f9fa; min-height: 100vh; padding: 50px 0;">
        <div class="container mt-5 d-flex justify-content-center">
            <div class="card shadow-lg p-4 rounded-3" style="max-width: 600px; background: white; border: none;">
                <!-- Thank You Header -->
                <div class="text-center mb-4">
                    <img src="https://i.imgur.com/NiAVkEw.png" width="80" alt="Success Icon">
                    <h2 class="mt-3" style="color: #28a745; font-weight: bold;">Thank You, {{$user->username}}!</h2>
                    <p class="text-muted">Your order was successful.</p>
                </div>

                <!-- Order Details -->
                <div class="text-center mb-4">
                    <p class="text-secondary" style="font-size: 16px;">
                        Your order has been dispatched and is on its way to the delivery address below.
                    </p>
                    <div class="address-box py-3 px-4" style="background-color: #f7f7f7; border-radius: 8px;">
                        <p class="mb-0" style="font-size: 16px; color: #333;">
                            <i class="ri-map-pin-line" style="color: #ff6347;"></i>
                            {{$user->address}}
                        </p>
                    </div>
                </div>

                <!-- Divider -->
                <hr class="my-4" style="border-color: #ddd;">

                <!-- Confirmation Footer -->
                <div class="text-center">
                    <h5 class="text-success mb-3">Your order will arrive soon!</h5>
                    <a href="/" class="btn btn-primary btn-lg" style="background-color: #007bff; border-color: #007bff;">
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
