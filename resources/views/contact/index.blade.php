@extends(auth()->user()->type === 'client' ? 'layout.layout_client' : 'layout.layout_supplier')
@section('title','Contact Us')
@section('content')
    <div class="contain">

    <div class="wrapper">

        <div class="form">
            <h4>GET IN TOUCH</h4>
            <h2 class="form-headline">Send us a message</h2>
            @if(session('message'))
                <p class="alert alert-success">{{session('message')}}</p>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            @endif
            <form id="submit-form" method="POST" action="{{route('contact.save')}}">
                @csrf
                <p>
                    <input id="name" class="form-input" type="text" placeholder="Your Name*" name="name" required>
                </p>
                <p>
                    <input id="email" class="form-input" type="email" placeholder="Your Email*" name="email" required>
                </p>
                <p class="full-width">
                    <textarea  minlength="20" id="message" cols="30" rows="7" placeholder="Your Message*" required name="info"></textarea>
                </p>
                <p class="full-width">
                    <input type="submit" class="submit-btn">
                    <button class="reset-btn" onclick="reset()">Reset</button>
                </p>
            </form>
        </div>

        <div class="contacts contact-wrapper">

            <ul>
                <li>We've driven online revenues of over <span class="highlight-text-grey">$2
            billion</span> for our clients. Ready to know
                    how we can help you?</li>
                <span class="hightlight-contact-info">
          <li class="email-info"><i class="fa fa-envelope" aria-hidden="true"></i> info@demo.com</li>
          <li><i class="fa fa-phone" aria-hidden="true"></i> <span class="highlight-text">+91 11 1111 2900</span></li>
        </span>
            </ul>
        </div>
    </div>
</div>
@endsection
