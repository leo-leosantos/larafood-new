<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTenant;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TenantController extends Controller
{
    private $repository;

    public function __construct(Tenant $tenants)
    {
        $this->repository = $tenants;
        $this->middleware(['can:tenants']);

    }

    public function index()
    {
        $tenants = $this->repository->latest()->paginate();

        return view('admin.pages.tenants.index', compact('tenants'));
    }


    public function create()
    {
        return view('admin.pages.tenants.create');
    }


    public function store(StoreUpdateTenant $request)
    {

        $this->repository->create($request->all());

        return redirect()->route('tenants.index');
    }


    public function show($id)
    {
        if (!$tenant = $this->repository->with('plan')->find($id)) {
            return redirect()->back()->with('error', 'item nao localizado');
        }
        return view('admin.pages.tenants.show', compact('tenant'));
    }


    public function edit($id)
    {
        if (!$tenant = $this->repository->find($id)) {
            return redirect()->back()->with('error', 'item nao localizado');
        }
        return view('admin.pages.tenants.edit', compact('tenant'));
    }


    public function update(StoreUpdateTenant $request, $id)
    {

        if (!$tenant = $this->repository->find($id)) {
            return redirect()->back()->with('error', 'item nao localizado');
        }

        $data = $request->all();


        if ($request->hasFile('logo') && $request->logo->isValid()) {
            if(Storage::exists($tenant->logo)){

                Storage::delete($tenant->logo);

            }

            $data['logo'] =   $request->logo->store("tenants/{$tenant->uuid}");
        }


        $tenant->update($data);
        $notifications = [
            'message'=>'Empresa Editada com sucesso',
            'alert-type' => 'success',

        ];

        return redirect()->route('tenants.index')->with($notifications);
    }


    public function destroy($id)
    {

        if (!$tenant = $this->repository->find($id)) {
            return redirect()->back();
        }

        if( Storage::exists($tenant->logo)){
            Storage::delete($tenant->logo);
        }


        $tenant->delete();

        $notifications = [
            'message'=>'Empresa deletado com sucesso',
            'alert-type' => 'success',

        ];

        return redirect()->route('tenants.index')->with($notifications);
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');


        $tenants = $this->repository->where(function ($query) use ($request) {
            if ($request->filter) {
                $query->orWhere('name', $request->filter);
            }
        })->latest()->paginate();

        return view('admin.pages.tenants.index', compact('tenants', 'filters'));
    }
}
