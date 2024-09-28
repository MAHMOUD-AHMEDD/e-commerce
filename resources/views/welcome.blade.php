@extends(
    auth()->user()->type === 'admin' ? 'layout.layout_admin' :
    (auth()->user()->type === 'client' ? 'layout.layout_client' : 'layout.layout_supplier')
)
@section('title','Home')
@section('content')
<h1>Welcome</h1>


@endsection
