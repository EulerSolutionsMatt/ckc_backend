<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function getAllProducts()
    {
        $products = Product::get()->toJson(JSON_PRETTY_PRINT);
        return response($products, 200);
    }

    public function createProduct(Request $request)
    {
        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->save();

        return response()->json([
            "message" => "Success! Product record created."
        ], 201);
    }

    public function getProduct($id)
    {
        if (Product::where('id', $id)->exists()) {
            $product = Product::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($product, 200);
        } else {
            return response()->json([
                "message" => "Student not found"
            ], 404);
        }
    }

    public function updateProduct(Request $request, $id)
    {
        // logic to update a product record goes here
    }

    public function deleteProduct($id)
    {
        // logic to delete a product record goes here
    }
}
