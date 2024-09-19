<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\JsonResponse;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{

    /**
     * @group Products
     * 
     * Get a paginated list of products.
     *
     * This endpoint returns a paginated list of products. 
     *
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "Product Name",
     *       "price": 100.00,
     *       "description": "Product Description",
     *       "created_at": "2024-09-19T12:34:56.000000Z",
     *       "updated_at": "2024-09-19T12:34:56.000000Z"
     *     },
     *     // more products
     *   ],
     *   "links": {
     *     "first": "http://example.com/products?page=1",
     *     "last": "http://example.com/products?page=10",
     *     "prev": null,
     *     "next": "http://example.com/products?page=2"
     *   },
     *   "meta": {
     *     "current_page": 1,
     *     "from": 1,
     *     "last_page": 10,
     *     "links": [
     *       // pagination links
     *     ],
     *     "next_page_url": "http://example.com/products?page=2",
     *     "path": "http://example.com/products",
     *     "per_page": 5,
     *     "prev_page_url": null,
     *     "to": 5,
     *     "total": 50
     *   }
     * }
     */
    public function index()
    {
        $products = Product::paginate(5);
        
        return ProductResource::collection($products);
    }

    /**
     * @group Products
     * 
     * Get a single product by ID.
     *
     * This endpoint returns the details of a single product.
     *
     * @response 200 {
     *   "data": {
     *     "id": 1,
     *     "name": "Product Name",
     *     "price": 100.00,
     *     "description": "Product Description",
     *     "created_at": "2024-09-19T12:34:56.000000Z",
     *     "updated_at": "2024-09-19T12:34:56.000000Z"
     *   }
     * }
     * @response 404 {
     *   "error": "Product not found"
     * }
     */

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

}
