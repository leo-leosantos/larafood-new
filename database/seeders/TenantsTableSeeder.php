<?php
namespace Database\Seeders;

use App\Models\{
    Plan,
    Tenant

};
use Illuminate\Database\Seeder;
class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $plan  = Plan::first();
         $plan->tenants()->create([
            'cnpj'=> '123456789',
            'name'=> 'EspecializaTI',
            'url'=>     'especializati',
            'email' =>'leandro.santos@gmail.com'
        ]);


    }
}
