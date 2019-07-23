@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Profile</div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="{{ route('update') }}">
                        @csrf
                            <div class="form-group row">
                                <label class="col-md-2">Name</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="name" type="text" value="{{Auth::user()->name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2">Email</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="email" type="email" value="{{Auth::user()->email}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9 offset-md-2">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection