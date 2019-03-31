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
        $products = Product::orderBy('updated_at','desc')->paginate(5);
        $image = Image::all();
        return view('home', compact('products', 'image', 'users'));
    }

    public function result(Request $request)
    {
        $search = $request->get('search');
        $users = User::all();
        $image = Image::all();
        $products = Product::where('title', 'like', '%'.$search.'%')->orderBy('updated_at','desc')->paginate(5);

        return view('result', compact('products', 'image', 'users'));
    }

    public function resultType(Request $request)
    {
        $users = User::all();
        $image = Image::all();
        $minPrice = $request->get('minPrice');
        $maxPrice = $request->get('maxPrice');
        if(!is_null($minPrice) && !is_null($maxPrice))
        {
            $products = Product::whereBetween('price', [$minPrice, $maxPrice])->orderBy('updated_at','desc')->paginate(5);
        }
        elseif(!is_null($minPrice) && is_null($maxPrice))
        {
            $products = Product::whereBetween('price', [$minPrice, 999999999])->orderBy('updated_at','desc')->paginate(5);
        }
        elseif(is_null($minPrice) && !is_null($maxPrice))
        {
            $products = Product::whereBetween('price', [0, $maxPrice])->orderBy('updated_at','desc')->paginate(5);
        }

        return view('result', compact('products', 'image', 'users'));
    }

    public function resultCategory(Request $request)
    {
        $search = $request->get('type');
        $users = User::all();
        $image = Image::all();
        $products = Product::where('type', $search)->orderBy('updated_at','desc')->paginate(5);

        return view('result', compact('products', 'image', 'users'));
    }
}
