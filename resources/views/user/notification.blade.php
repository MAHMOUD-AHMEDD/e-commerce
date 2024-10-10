@extends(
    auth()->user()->type === 'admin' ? 'layout.layout_admin' :
    (auth()->user()->type === 'client' ? 'layout.layout_client' : 'layout.layout_supplier')
)
@section('title','User|Notification')
@section('content')

    <div class="notifications">
        <div class="row notification-container">
            <h2 class="text-center">My Notifications</h2>
{{--            <p class="dismiss text-right"><a id="dismiss-all" href="#">Dimiss All</a></p>--}}
            @foreach($notifications as $notification)
            <div class="card notification-card notification-invitation">
                <div class="card-body">
                    <table>
                        <tr>
                            <td style="width:70%"><div class="card-title">{{$notification->data->data}}</td>
                            <td style="width:30%">
                                <a href="#" class="btn btn-primary">View</a>
                                <a href="/delete-item?model_name=notifications&id={{$notification->id}}" class="btn btn-danger dismiss-notification">Dismiss</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            @endforeach


        </div>
    </div>
@endsection
