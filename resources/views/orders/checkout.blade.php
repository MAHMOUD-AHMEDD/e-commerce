@extends('layout/layout_client')
@section('title','checkout')
@section('content')

    <body style="background-color: #fae3ea;
  display: grid;
  line-height: 1.5;
  margin: 0;
  min-height: 100vh;
  padding: 5vmin;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  justify-items: center;
  place-items: center;">
    <div class="iphone">
        <header class="header">
            <h1>Checkout</h1>
        </header>
        <form method="POST" action="{{route('confirmation')}}" class="form">
            @csrf
            <div>
                <h2>Address</h2>

                <div class="card">
                    <address>
                        {{$user->username}}<br />
                        {{$user->address}}
                    </address>
                </div>
            </div>

            <fieldset>
                <legend>Payment Method</legend>

                <div class="form__radios">
                    <div class="form__radio">
                        <label for="visa"><svg class="icon">
                                <use xlink:href="#icon-visa" />
                            </svg>Visa Payment</label>
                        <input checked id="visa" name="payment-method" type="radio" />
                    </div>

                    <div class="form__radio">
                        <label for="paypal"><svg class="icon">
                                <use xlink:href="#icon-paypal" />
                            </svg>PayPal</label>
                        <input id="paypal" name="payment-method" type="radio" />
                    </div>

                    <div class="form__radio">
                        <label for="mastercard"><svg class="icon">
                                <use xlink:href="#icon-mastercard" />
                            </svg>Master Card</label>
                        <input id="mastercard" name="payment-method" type="radio" />
                    </div>
                </div>
            </fieldset>

            <div>
                <h2>Shopping Bill</h2>
        <?php $total=0 ?>
    @foreach($orders as $order)
               <?php $total+=$order->product->price * $order->quantity ?>

    @endforeach
                <table>
                    <tbody>
                    <tr>
                        <td>Shipping fee</td>
                        <td align="right">$5.43</td>
                    </tr>
                    <tr>
                        <td>Price Total</td>
                        <td align="right">${{$total}}</td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td>Total</td>
                        <td align="right">${{$total+5.43}}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <div>
                <button class="button button--full" type="submit">Buy Now</button>
            </div>
        </form>
    </div>



@endsection
