<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\ProductHelper;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Helper class of the Product operations
     *
     * @var ProductHelper
     */
    private $helper;

    public function __construct()
    {
        $this->helper = new ProductHelper();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('product.list')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.edit')->with([
            'header_label' => "messages.new_product",
            'route' => "product.store",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();

        $this->helper->setProperties($product, $request);

        $requestTagNames = explode(",", $request->tags);
        $allTagNames = $this->helper->getAllTagNamesInArray();

        $this->helper->saveNewTags($requestTagNames, $allTagNames, $product);


        $product->save();

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $productTags = $this->helper->getProductTagsInString($product);

        return view('product.detail')->with([
            'product' => $product,
            'product_tags' => $productTags,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $productTags = $this->helper->getProductTagsInString($product);

        return view('product.edit')->with([
            'product' => $product,
            'product_tags' => $productTags,
            'header_label' => "messages.edit_product",
            'route' => "product.update",
        ]);
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
        $requestTagNames = explode(",", $request->tags);
        $allTagNames = $this->helper->getAllTagNamesInArray();

        $this->helper->saveNewTags($requestTagNames, $allTagNames, $product);

        $productTagNames = $this->helper->getProductTagNamesInArray($product);

        $this->helper->removeUnusedTags($productTagNames, $requestTagNames, $product);

        $this->helper->setProperties($product, $request);

        $product->save();

        return redirect()->route('product.show', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->tags()->detach();
        $product->delete();

        return redirect()->route('product.index');
    }
}
