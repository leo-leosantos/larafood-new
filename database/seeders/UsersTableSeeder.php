<?php
namespace Database\Seeders;

use App\Models\{
    Tenant,
    User,
};

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();
        $tenant->users()->create([
            'name'=>'Leandro dos Santos',
            'email'=>'lds.leosantos@gmail.com',
            'password'=> bcrypt('12345678'),
        ]);
    }
}
