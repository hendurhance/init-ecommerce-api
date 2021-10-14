<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductNotBelongToUser;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\ProductUpdate;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return ProductCollection new
        return ProductCollection::collection(Product::paginate(30));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product;
        $product->user_id = auth()->user()->id;
        $product->name = $request->name;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->discount = $request->discount;
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('storage/product'), $imageName);
        $product->image = 'storage/product/' . $imageName;
        $product->save();

        return response([
            'data' => new ProductResource($product)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdate $request, Product $product)
    {
        // check if user is authorized to update product
        $this->ProductUserCheck($product);

        $product->update($request->all());
        return response([
            'data' => new ProductResource($product)
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // check if user is authorized to delete product
        $this->ProductUserCheck($product);
        $product->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function search(Request $request)
    {
        $request->validate([
            'q' => 'required|string|max:50'
        ]);
        $q = $request->q;
        $products = Product::where('name', 'LIKE', "%$q%")
            ->orWhere('title', 'LIKE', "%$q%")
            ->paginate(30);
        return ProductCollection::collection($products);
    }

    public function ProductUserCheck($product)
    {
        // id user is not the same as id user of product
        if (auth()->user()->id !== $product->user_id) {
            throw new ProductNotBelongToUser;
        }
    }
}
