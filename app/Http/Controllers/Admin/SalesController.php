<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SaleRequest;
use App\Models\Product;
use App\Models\Sale;
use App\Services\SaleService;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Sale::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::all();

        return view('admin.sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        return view('admin.sales.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request)
    {
        $saleData = $request->only(['title', 'date_to']);
        $saleData['created_by'] = auth()->user()->id;

        $productData = $request->only('products', 'discount');

        DB::beginTransaction();

        try {
            $sale = Sale::create($saleData);

            foreach ($productData['products'] as $productId => $productValue) {
                $sale->products()->attach([
                    $productId => [
                        'discount'=> $productData['discount'][$productId],
                        'created_by'=> auth()->user()->id,
                        'created_at' => Carbon::now()
                    ]]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $e->getMessage();
        }

        return redirect()->route('sales.index')->with([
            'title' => 'Created!',
            'type' => 'success',
            'status' => 'Sale created!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = Sale::with('products')->find($id);
        $products = app(SaleService::class)->setProducts(Product::all())->setSale($sale)->getSelectedProducts();

        return view('admin.sales.edit', compact('products', 'sale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaleRequest $request, $id)
    {
        $sale = Sale::with('products')->find($id);
        $saleData = $request->only(['title', 'date_to']);
        $saleData['updated_by'] = auth()->user()->id;

        $saleProductData = app(SaleService::class)->setSale($sale)->prepareUpdateProduct($request->only('products', 'discount'));

        DB::beginTransaction();

        try {
            $sale->update($saleData);

            $sale->products()->sync($saleProductData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $e->getMessage();
        }

        return redirect()->route('sales.index')->with([
            'title' => 'Updated!',
            'type' => 'success',
            'status' => 'Sale updated!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::with('products')->find($id);
        $sale->deleted_by = auth()->user()->id;
        $saleProducts = app(SaleService::class)->setSale($sale)->prepareDeleteProducts();

        DB::beginTransaction();

        try {
            $sale->save();
            $sale->products()->attach($saleProducts);
            $sale->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }

        return redirect()->route('sales.index')->with([
            'title' => 'Deleted!',
            'type' => 'success',
            'status' => 'Sale deleted!',
        ]);
    }
}
