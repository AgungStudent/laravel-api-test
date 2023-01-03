<?php

namespace App\Repositories;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

/**@author Agung Prasetyo Nugroho <agungpn33@gmail.com> */
class ProductRepository
{
    public function getAllProducts(): JsonResource
    {
        return ProductResource::collection(Product::all());
    }
}
