<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryProductController extends Controller
{
	public function index()
	{
		$categories = CategoryProduct::get();
		return view('products.category-products', compact('categories'));
	}

	public function create(CategoryRequest $request)
	{
		$category = new CategoryProduct($request->all());
		$category->save();
		return response()->json(['saved' => 'ok'], 200);
	}

	public function update(CategoryProduct $category, CategoryRequest $request)
	{
		$category->update($request->all());
		return response()->json(['saved' => 'ok'], 200);
	}

	public function delete(CategoryProduct $category)
	{
		$category->delete();
		return response()->json(['deleted' => 'ok'], 200);
	}
}
