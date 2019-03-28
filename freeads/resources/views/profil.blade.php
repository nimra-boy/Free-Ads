@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
<h2 style="margin-top: 12px;" class="alert alert-success text-center">Bienvenue sur votre profil {{ucfirst(Auth::user()->name)}}</h2><br>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center"><h1>Summary</h1></div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td colspan="2"><strong>Name</strong></td>
                                <td colspan="2"><strong>Email</strong></td>
                                <td colspan="1"><strong>Password</strong></td>
                                <td colspan="1"><strong>Deleting your account</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                                <td>{{ Auth::user()->name }}</td>
                                <td class="text-center"><a href="{{ route('edit') }}" id="edit-user" data-id="{{ Auth::user()->id }}" class="btn btn-info">Edit</a></td>
                                <td>{{ Auth::user()->email }}</td>
                                <td class="text-center"><a href="{{ route('edit') }}" id="edit-user" data-id="{{ Auth::user()->id }}" class="btn btn-info">Edit</a></td>
                                <td class="text-center"><a href="{{ route('reset') }}" class="btn btn-info">Edit</a></td>
                                <td class="text-center"><a href="{{ route('destroy') }}" id="delete-user" data-id="{{ Auth::user()->id }}" class="btn btn-danger delete-user">Delete</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ url('/products') }}"><button type="button" class="btn btn-warning">See Products</button></a>
                    @if(Session::has('success'))
                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                                <div id="message" class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection