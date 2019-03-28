@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center"><h1>FreeAds</h1></div>

                <div class="card-body text-center">
                    <h3>Pleins de petites annonces a perte de vue !</h3>
                </div>
            </div>
            @if(Session::has('global'))
                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                                <div id="message" class="alert alert-danger">
                                    {{ Session::get('global') }}
                                </div>
                            </div>
                        </div>
                    @endif
        </div>
    </div>
</div>
@endsection