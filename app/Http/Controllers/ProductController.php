<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;


class ProductController extends Controller
{

    public function index(Request $request)
    {
        $searchTerm = $request->input('search', '');
        $categoryId = $request->input('category', '');
        $sortBy = $request->input('sort_by', 'name');//name | price
        $sortOrder = $request->input('sort_order', 'asc');

        $product_service = new ProductService();
        return view('products.index', [
            'categories' => Category::all(),
            'products' => $product_service->showProducts($searchTerm, $categoryId, $sortBy, $sortOrder),
            'searchTerm' => $searchTerm,
            'categoryId' => $categoryId,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder
        ]);
    }

    public function show($id)
    {
        return view('products.show', ['product' => Product::findOrFail($id),]);
    }

    public function edit($id)
    {
        return view('products.edit', [
            'product' => Product::findOrFail($id),
            'categories' => Category::all()
        ]);
    }

    public function update(EditProductRequest $request, $id)
    {
        $validated = $request->validated();
        $name = $validated['name'];
        $id_category = $validated['id_category'];
        $description = $validated['description'];
        $prices = $validated['prices'];
        $newPrices = $validated['new_prices'];
        $product_service = new ProductService();

        $product = $product_service->editProduct($id, $name, $description, $prices, $newPrices,$id_category);


        return redirect()->route('product-show', ['id' => $product->id])->with('success', 'Продукт успешно обновлен');
    }

    public function save(CreateProductRequest $request)
    {
        $validated = $request->validated();
        $product_service = new ProductService();
        $product_service->createProduct($validated['name'], $validated['description'], $validated['prices'], $validated['id_category']);
        return redirect()->route('products')->with('success', 'Продукт успешно создан');
    }

    public function create()
    {
        return view('products.create', ['categories' => Category::all()]);
    }

    public function destroy($id)
    {

        Product::where('id', $id)->delete();
        return redirect()->route('products')
            ->with('success', 'Статья успешно удалена.');
    }
}
