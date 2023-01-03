<?php

namespace App\Services;

use App\Models\Product;

/**@author Agung Prasetyo Nugroho <agungpn33@gmail.com> */
class ProductService
{
    public function store(array $data): Product
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data): Product
    {
        $product->update($data);
        return Product::find($product->id);
    }

    public function delete(Product $product): ?bool
    {
        return $product->delete();
    }
}
