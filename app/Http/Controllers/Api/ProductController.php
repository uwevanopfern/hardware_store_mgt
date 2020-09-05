<?php

namespace App\Http\Controllers\Api;


use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollection;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Product as ProductResource;


class ProductController extends Controller
{
    /**
     * Get auth user
     */
    private function getAuthUser()
    {
        return Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return ProductCollection
     */
    public function index()
    {
        $companyId = $this->getAuthUser()->company_id;
        $products = Product::where('company_id', $companyId)->orderBy('id', 'DESC')->get();
        return new ProductCollection($products);
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
     * @param ProductRequest|Request $request
     * @return ProductResource
     */
    public function store(ProductRequest $request)
    {
        $product = new Product;

        $companyId = $this->getAuthUser()->company_id;

        $product->company_id = $companyId;
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->manufacturer = $request->notes;
        $product->category = $request->category;
        $product->weight = $request->weight;
        $product->save();
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest|Request $request
     * @param  \App\Product $product
     * @return ProductResource
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product = Product::where("id", $product->id)->first();

        $companyId = $this->getAuthUser()->company_id;

        $product->company_id = $companyId;
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->manufacturer = $request->notes;
        $product->category = $request->category;
        $product->weight = $request->weight;
        $product->save();
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
