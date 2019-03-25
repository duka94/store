<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Services\SaleService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        $sales = Sale::where('date_to', '>', Carbon::now())->get();

        return view('index', compact('products', 'sales'));
    }

    public function show($id)
    {
        $sale = Sale::with('products')->find($id);

        $sale = app(SaleService::class)->setSale($sale)->getDiscount();

        return view('sale', compact('sale'));
    }
}
