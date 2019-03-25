<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::with([
            'createdBy',
            'updatedBy',
            'category',
        ])->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param   \App\Http\Requests\Requests\ProductStoreRequest;
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductStoreRequest $request)
    {
        $data = $request->only(['code', 'name', 'description', 'price', 'category_id']);
        $data['created_by'] = auth()->user()->id;
        $data['updated_by'] = auth()->user()->id;
        $file = Storage::put('public/products', $request->file('img_path'));
        $data['img_path'] = str_replace('public/', '', $file);
        Product::create($data);

        return redirect()->route('products.index')->with([
            'title' => 'Created!',
            'type' => 'success',
            'status' => 'Product created!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Product $product)
    {
        $product->with(['category', 'createdBy', 'updatedBy']);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $product->with(['category', 'createdBy', 'updatedBy']);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Requests\ProductUpdateRequest $request;
     * @param  Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->only(['code', 'name', 'description', 'price', 'category_id']);
        $data['updated_by'] = auth()->user()->id;
        if($request->file('img_path')) {
            Storage::delete($product->img_path);
            $file = Storage::put('public/products', $request->file('img_path'));
            $data['img_path'] = str_replace('public/', '', $file);
        }
        $product->update($data);

        return redirect()->route('products.index')->with([
            'title' => 'Updated!',
            'type' => 'success',
            'status' => "Product {$product->name} updated!"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product $product
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->deleted_by = auth()->user()->id;
        $product->save();
        $product->delete();

        return redirect()->route('products.index')->with([
            'title' => 'Deleted!',
            'type' => 'success',
            'status' => "Product {$product->name} deleted!"
        ]);
    }
}
