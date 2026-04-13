<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        //$products = Product::paginate(10);
        $products = Product::with('user')->paginate(10);
        return response()->json($products, 201);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::create($request->all());
            DB::commit();
        } 
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al crear el producto'], 500);
        }
        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        try {
            DB::beginTransaction();
            $product = Product::findOrFail($product->id);
            DB::commit();
        } 
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al retornar el producto'], 500);
        }
        return response()->json($product, 201);
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $product->update($request->all());
            DB::commit();
        } 
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al actualizar el producto'], 500);
        }
        return response()->json($product, 201);
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $product  = Product::findOrFail($id);
            $product->delete();
            DB::commit();
        } 
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al eliminar el producto'], 500);
        }
        return response()->json($product, 201);
    }
}
