@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <form action="{{ route('result') }}" method="get">
            @csrf
                <div class="form-group d-inline-block">
                    <input type="search" name="search" class="form-control" placeholder="Search by title">
                </div>
                <div class="form-group d-inline-block">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
        <div class="col-md-5">
            <form action="{{ route('resultcat') }}" method="get">
            @csrf
                <div class="form-group d-inline-block">
                    <select name="type" class="form-control form-control-lg">
                        <option value="">Category</option>
                        <option value="vehicule">Vehicule</option>
                        <option value="immobilier">Immobilier</option>
                        <option value="multimedia">Multimedia</option>
                        <option value="maison">Maison</option>
                        <option value="loisirs">Loisirs</option>
                        <option value="materiels professionnels">Materiels professionnels</option>
                        <option value="services">Services</option>
                        <option value="vacances">Vacances</option>
                    </select>
                </div>
                <div class="form-group d-inline-block">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
        <div class="col-md-2">
            <form action="{{ route('resulttype') }}" method="get">
            @csrf
                <div class="form-group d-inline">
                    <label><input type="number" name="minPrice" min="0" class="form-control">Min</label>
                </div>
                <div class="form-group d-inline">
                    <label><input type="number" name="maxPrice" min="0" class="form-control">Max</label>
                </div>
                <div class="form-group d-inline">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><strong>All products</strong></div>

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
