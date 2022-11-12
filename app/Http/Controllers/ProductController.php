<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        //$products = DB::table('products')->simplePaginate(10);
        return view('products.index')->with('products', $products);
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
    public function store(Request $request, Product $product)
    {
        //dd($request->all());
        $request->validate([
           'title' => 'required',
           'price' => 'required',
            'is_featured' => 'boolean'
        ]);
        $data = $request->except('_token');
        $data['user_id'] = auth()->user()->id;
        if($image = $request->file('image')){
            $destination = 'images';
            $imageName = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($destination, $imageName);
            $data['image'] = $imageName;
        }
        //dd($data);
        $product->fill($data);
        $status = $product->save();
        if($status){
            return redirect()->route('products.index')->with('success', 'Product created successfully.');
        }else{
            return redirect()->route('products.index')->with('error', 'Sorry, there was an error while creating Product.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('front.show-prod',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        return view('products.create', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);
            $request->validate([
                'title' => 'required',
                'price' => 'required',
                'is_featured' => 'boolean'
            ]);
            $data = $request->except('_token');
            //dd($data);
            $product->fill($data);
            $status = $product->save();
            if ($status) {
                return redirect()->route('products.index')->with('success', 'Product updagted successfully.');
            } else {
                return redirect()->route('products.index')->with('error', 'Sorry, there was an error while updating Product.');
            }
    }

    public function cart()
    {
        return view('front.cart');
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "title" => $product->title,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
        //return response()->json(['data' => $cart, 'status' => true, 'msg' => 'Product added to cart successfully!'], 200);
    }

    public function viewFeatured()
    {
        $product = Product::where('is_featured', 1)->get();
        return view('front.products')->with('feat_prod', $product);
    }

    public function viewNew()
    {
        $product = Product::orderBy('id', 'desc')->get();
        return view('front.products')->with('new_prod', $product);
    }

    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function cartList()
    {
        return view('front.carts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
}
