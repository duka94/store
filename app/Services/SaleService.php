<?php

namespace App\Services;

use Carbon\Carbon;

class SaleService {

    protected $products;

    protected $sale;

    public function setProducts($products)
    {
        $this->products = $products;

        return $this;
    }

    public function setSale($sale)
    {
        $this->sale = $sale;

        return $this;
    }

    public function getSelectedProducts()
    {
        foreach ($this->products as $product) {
            foreach ($this->sale->products as $saleProduct) {
                if ($product->id === $saleProduct->id) {
                    $product->checked = true;
                    $product->discount = $saleProduct->pivot->discount;
                }
            }
        }

        return $this->products;
    }

    public function prepareUpdateProduct($payload)
    {
        $data = [];

        foreach ($payload['products'] as $productId => $productVal) {

            $pivotData = [
                'discount'=> $payload['discount'][$productId],
            ];

            foreach ($this->sale->products as $saleProduct) {
                if ($saleProduct->id === $productId) {
                    $pivotData['updated_by'] = auth()->user()->id;
                    $pivotData['updated_at'] = Carbon::now();
                }
            }

            if (!isset($pivotData['updated_by'])) {
                $pivotData['created_by'] = auth()->user()->id;
                $pivotData['created_at'] = Carbon::now();
            }

            $data[$productId] = $pivotData;
        }

        return $data;
    }

    public function prepareDeleteProducts()
    {
        $data = [];

        foreach ($this->sale->products as $product) {
            $data[$product->id] = [
                'discount' => $product->pivot->discount,
                'deleted_at' => Carbon::now(),
                'deleted_by' => auth()->user()->id
            ];
        }

        return $data;
    }

    public function getDiscount()
    {
        foreach ($this->sale->products as $product) {
            $product->price = round($product->price - (($product->price / 100) * $product->pivot->discount), 2);
        }

        return $this->sale;
    }
}
