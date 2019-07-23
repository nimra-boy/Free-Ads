<?php
  
namespace App\Http\Controllers;
  
use App\Product;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
  
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $products = Product::where('user_id', $userId)->paginate(5);
        $image = Image::all();
  
        return view('products.index',compact('products', 'image'));
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'type' => 'required',
        ]);
  
        $post = Product::create([
            'user_id' => Auth::user()->id,
            'title' => request('title'),
            'description' => request('description'),
            'price' => request('price'),
            'type' => request('type'),
        ]);

        $this->addPics($post, $request);
   
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $image = Image::all();
        return view('products.show',compact('product', 'image'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
  
        $product->update([
            'user_id' => Auth::user()->id,
            'title' => request('title'),
            'description' => request('description'),
            'price' => request('price'),
        ]);
  
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
  
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }

    private function addPics($post, Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($request->hasFile('image'))
        {
            foreach($request->file('image') as $image)
            {
                $name = $image ? time().'_'.rand() . '.'.$image->getClientOriginalExtension() : '';
                $image->move(public_path('/images'), $name);
                $img = Image::create(array(
                    'product_id'=> $post->id,
                    'image'=> $name
                ));
            }
        }
    }
}