<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request) {
        // Получение параметров фильтрации и сортировки из запроса
        $searchTerm = $request->input('search', '');
        $categoryId = $request->input('category', '');
        $sortBy = $request->input('sort_by', 'name');//name | price
        $sortOrder = $request->input('sort_order', 'asc');// asc or desc

        // Получение отфильтрованных и отсортированных продуктов
        $products = Product::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('name', 'like', '%'.$searchTerm.'%');
        })
            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('id_category', $categoryId);
            })
            ->orderBy($sortBy, $sortOrder);
        if ($sortBy == 'min_price'||$sortBy=='name') {
            $products = $products->orderByMinPrice($sortOrder);
        }
        if ($sortBy == 'max_price') {
            $products = $products->orderByMaxPrice($sortOrder);
        }

        $products = $products->get();
        // Передача продуктов на представление
        return view('products.index', [
            'categories'=>Category::all(),
            'products' => $products,
            'searchTerm' => $searchTerm,
            'categoryId' => $categoryId,

            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder
        ]);
    }



    public function show($id){
        return view('products.show',['product'=>Product::find($id),]);
    }
}
