@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('conversations.users', ['users' => $users, 'unread' => $unread])
        <div class="col-md-9">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="card">
                <div class="card-header">{{ ucfirst($user->name) }}</div>
                <div class="card-body conversations">
                    @foreach ($messages as $message)
                        <div class="row">
                        @if ($message->from_id === Auth::user()->id)
                            <div class="col-md-10 offset-md-2 text-right">
                            @else
                            <div class="col-md-10" style="background: AliceBlue;">
                            @endif
                                <p>
                                @if ($message->from_id === Auth::user()->id)
                                    <strong>Moi</strong><br>
                                @else
                                    <strong>{{ ucfirst($user->name) }}</strong><br>
                                @endif
                                    <span style="font-size: 17px;">{!! nl2br(e($message->content)) !!}</span> <br>
                                    <i style="font-size: 10px;">{{ $message->created_at }}</i> <br>
                                    @if ($message->read_at != 0)
                                        <span style="font-size: 7px; color: grey;">Seen on the {{ $message->read_at }}</span>
                                    @else
                                        <span style="font-size: 7px; color: grey;">Not seen yet</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    <form action="" method="post">
                        @csrf
                        <div class="from-group">
                            <textarea name="content" placeholder="Write your message" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection