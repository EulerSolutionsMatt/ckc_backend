<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
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
                "message" => "Product not found"
            ], 404);
        }
    }

    public function updateProduct(Request $request, $id)
    {
        if (Product::where('id', $id)->exists()) {
            $product = Product::find($id);
            $product->title = is_null($request->title) ? $product->title : $request->title;
            $product->description = is_null($request->description) ? $product->description : $request->description;
            $product->save();
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Product not found"
            ], 404);

        }
    }
}
