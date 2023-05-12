<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\{
    Category,
    Tenant
};
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'tenant_id' => factory(Tenant::class),
        'name'=>$faker->unique()->name,
        'description'=>$faker->sentence
    ];
});
