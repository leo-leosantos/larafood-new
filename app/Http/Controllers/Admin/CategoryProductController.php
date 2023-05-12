<?php

namespace App\Http\Controllers\Admin;

use App\Models\{
    product,
    Category
};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CategoryProductController extends Controller
{
    protected $product, $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
        $this->middleware(['can:products']);

    }


    public function categories($idproduct)
    {
        $product =   $this->product->find($idproduct);


        if (!$product) {
            return redirect()->back()->with('error', 'Item não localizado');
        }


        $categories =  $product->categories()->paginate();

        return view('admin.pages.products.categories.categories', compact('product', 'categories'));
    }

    public function products($idCategory)
    {

        if (!$category =   $this->category->find($idCategory)) {
            return redirect()->back()->with('error', 'Item não localizado');
        }


        $products =  $category->products()->paginate();

        return view('admin.pages.categories.products.products', compact('Category', 'products'));
    }


    public function categoriesAvailable(Request $request, $idproduct)
    {

        if (!$product =   $this->product->find($idproduct)) {
            return redirect()->back()->with('error', 'Item não localizado');
        }

        $filters = $request->except('_token');

        $categories = $product->categoriesAvailable($request->filter);

        return view('admin.pages.products.categories.available', compact('product', 'categories', 'filters'));
    }

    public function attachCategoriesProduct(Request $request, $idproduct)
    {

        if (!$product =   $this->product->find($idproduct)) {
            return redirect()->back()->with('error', 'Item não localizado');
        }

        if (!$request->categories || count($request->categories) == 0) {
            return redirect()->back()->with('info', 'Precisa Escolher pelo menos uma permissão');
        }

        $product->categories()->attach($request->categories);

        return redirect()->route('products.categories', $product->id);
    }

    public function detachCategoryProduct($idproduct, $idCategory)
    {

        $product =   $this->product->find($idproduct);
        $category =   $this->category->find($idCategory);

        if (!$product || !$category) {
            return redirect()->back()->with('error', 'Item não localizado');
        }

        $product->categories()->detach($category);

        return redirect()->route('products.categories', $product->id)->with('message', 'Permissão desvinculada com sucesso!');
    }
}
