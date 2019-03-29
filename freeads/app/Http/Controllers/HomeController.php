<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Image;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $products = Product::paginate(5);
        $image = Image::all();
        return view('home', compact('products', 'image', 'users'));
    }

    public function result(Request $request)
    {
        $search = $request->get('search');
        $users = User::all();
        $image = Image::all();
        $products = Product::where('title', 'like', '%'.$search.'%')->paginate(5);

        return view('result', compact('products', 'image', 'users'));
    }

    public function resultType(Request $request)
    {
        $users = User::all();
        $image = Image::all();
        $minPrice = $request->get('minPrice');
        $maxPrice = $request->get('maxPrice');
        $products = Product::where('price', 'between'.$minPrice.'and'.$maxPrice)->paginate(5);

        return view('result', compact('products', 'image', 'users'));
    }
}
