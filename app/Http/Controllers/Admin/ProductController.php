<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreUpdateProduct;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    private $repository;

    public function __construct(Product $product)
    {
        $this->repository = $product;
        $this->middleware(['can:products']);

    }

    public function index()
    {
        $products = $this->repository->latest()->paginate();

        return view('admin.pages.products.index', compact('products'));
    }


    public function create()
    {
        return view('admin.pages.products.create');
    }


    public function store(StoreUpdateProduct $request)
    {

        $data = $request->all();

        $tenant = auth()->user()->tenant;

        if ($request->hasFile('image') && $request->image->isValid()) {

            $data['image'] =   $request->image->store("tenants/{$tenant->uuid}/products");
        }

        $this->repository->create($data);

        $notifications = [
            'message'=>'Produto cadastrado com sucesso',
            'alert-type' => 'success',
        ];

        return redirect()->route('products.index')->with($notifications);
    }


    public function show($id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back()->with('error', 'item nao localizado');
        }
        return view('admin.pages.products.show', compact('product'));
    }


    public function edit($id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back()->with('error', 'item nao localizado');
        }
        return view('admin.pages.products.edit', compact('product'));
    }


    public function update(StoreUpdateProduct $request, $id)
    {

        if (!$product = $this->repository->find($id)) {
            return redirect()->back()->with('error', 'item nao localizado');
        }

        $data = $request->all();

        $tenant = auth()->user()->tenant;

        if ($request->hasFile('image') && $request->image->isValid()) {
            if(Storage::exists($product->image)){

                Storage::delete($product->image);

            }

            $data['image'] =   $request->image->store("tenants/{$tenant->uuid}/products");
        }


        $product->update($data);
        $notifications = [
            'message'=>'Produto Editado com sucesso',
            'alert-type' => 'success',

        ];

        return redirect()->route('products.index')->with($notifications);
    }


    public function destroy($id)
    {

        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }

        if( $product->image && Storage::exists($product->image)){
            Storage::delete($product->image);
        }

        $product->delete();

        $notifications = [
            'message'=>'Produto deletado com sucesso',
            'alert-type' => 'success',

        ];

        return redirect()->route('products.index')->with($notifications);
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');


        $products = $this->repository->where(function ($query) use ($request) {
            if ($request->filter) {
                $query->orWhere('description', 'LIKE', "%{$request->filter}%");
                $query->orWhere('name', $request->filter);
            }
        })->latest()->paginate();

        return view('admin.pages.products.index', compact('products', 'filters'));
    }
}
