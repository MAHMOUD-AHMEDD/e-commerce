@extends('layout/layout_client')
@section('title','Order|Confirmation')
@section('content')
<div class="confirmation">
        <div class="container mt-5 d-flex justify-content-center">
            <div class="card p-4 mt-3">
                <div class="first d-flex justify-content-between align-items-center mb-3">
                    <div class="info">
                        <span class="d-block name">Thank you, {{$user->username}}</span>
                        <span class="order">Order success</span>

                    </div>

                    <img src="https://i.imgur.com/NiAVkEw.png" width="40"/>


                </div>
                <div class="detail">
                    <span class="d-block summery">Your order has been dispatched. we are delivering you order.</span>
                </div>
                <hr>
                <span class="d-block address mb-3">{{$user->address}}</span>

        </div>
    </div>


@endsection
