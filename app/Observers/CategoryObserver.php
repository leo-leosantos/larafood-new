<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{

    public function creating(Category $category)
    {
        $category->url = Str::slug($category->name) ;
        $category->uuid = Str::uuid();
    }


    public function updating(Category $category)
    {
        $category->url = Str::slug($category->name) ;
    }


    public function deleted(Category $category)
    {
        //
    }


    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the category "force deleted" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
