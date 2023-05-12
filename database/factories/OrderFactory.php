<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Illuminate\Support\Str;

use App\Models\{
    Order,
    Tenant
};
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'tenant_id' => factory(Tenant::class),
        'identify'=>uniqid() .Str::random(10),
        'total'=> 50.00,
        'status'=>'open',
        'comment'=>$faker->sentence
    ];
});
