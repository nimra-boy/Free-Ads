@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><strong>Your search</strong></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <tr>
                            <th>User</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Pictures</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($products as $product)
                        <tr>
                            <td>
                                @foreach ($users as $user)
                                    @if ($product->user_id === $user->id)
                                        {{ $user->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->description }}</td>
                            <td>
                            @foreach ($image as $show)
                                @if ($product->id === $show->product_id)
                                    <img style="width: 150px; height: 150px;" src="{{ asset('images/' . $show->image) }}">
                                @endif
                            @endforeach
                            </td>
                            <td>{{ $product->price }}</td>
                            <td><a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a></td>
                        </tr>
                        @endforeach
                    </table>
                
                    {!! $products->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
