<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTable;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    private $repository;

    public function __construct(Table $table)
    {
        $this->repository = $table;
        $this->middleware(['can:tables']);

    }

    public function index()
    {
        $tables = $this->repository->latest()->paginate();
        return view('admin.pages.tables.index', compact('tables'));
    }


    public function create()
    {
        return view('admin.pages.tables.create');
    }


    public function store(StoreUpdateTable $request)
    {


        $table = $this->repository->create($request->all());

        $notifications = [
            'message'=>'Mesa cadastrada com sucesso',
            'alert-type' => 'success',
        ];

        return redirect()->route('tables.index')->with($notifications);
    }


    public function show($id)
    {
        if (!$table = $this->repository->find($id)) {
            return redirect()->back()->with('error', 'item nao localizado');
        }
        return view('admin.pages.tables.show', compact('table'));
    }



    public function edit($id)
    {
        if (!$table = $this->repository->find($id)) {
            return redirect()->back()->with('error', 'item nao localizado');
        }

        return view('admin.pages.tables.edit', compact('table'));
    }


    public function update(StoreUpdateTable $request, $id)
    {

        if (!$table = $this->repository->find($id)) {
            return redirect()->back()->with('error', 'item nao localizado');
        }

         $table->update($request->all());

         $notifications = [
            'message'=>'Mesa Editada com sucesso',
            'alert-type' => 'success',
        ];
        return redirect()->route('tables.index')->with($notifications);

    }


    public function destroy($id)
    {
        if (!$table = $this->repository->find($id)) {
            return redirect()->back()->with('error', 'item nao localizado');
        }

        $table->delete();
        $notifications = [
            'message'=>'Mesa Deletada com sucesso',
            'alert-type' => 'success',
        ];
        return redirect()->route('tables.index')->with($notifications);
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');


        $tables = $this->repository->where(function ($query) use ($request) {
            if ($request->filter) {
                $query->orWhere('description', 'LIKE', "%{$request->filter}%");
                $query->orWhere('identify', $request->filter);
            }
        })->latest()->paginate();

        return view('admin.pages.tables.index', compact('tables', 'filters'));
    }


    public function qrcode($identify)
    {
        if (!$table = $this->repository->where('uuid', $identify)->first()) {
            return redirect()->back()->with('error', 'item nao localizado');
        }

        $tenant = auth()->user()->tenant;
        $uri = env('URI_CLIENT') . "/{$tenant->name}/{$table->identify}";


        return view('admin.pages.tables.qrcode', compact('uri'));
    }

}
