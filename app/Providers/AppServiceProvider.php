<?php

namespace App\Providers;

use App\Models\{
    Category,
    Client,
    Plan,
    Product,
    Tenant,
    Table
};
use App\Observers\{
    CategoryObserver,
    ClientObserver,
    ProductObserver,
    PlanObserver,
    TableObserver,
    TenantObserver,

};
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {

    }


    public function boot()
    {
        Paginator::useBootstrap();


        Plan::observe(PlanObserver::class);
        Tenant::observe(TenantObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Client::observe(ClientObserver::class);
        Table::observe(TableObserver::class);

        //is customizado

        Blade::if('admin' , function  ( ) {
            $user = auth()->user();
            return $user->isAdmin();
        });
    }
}
