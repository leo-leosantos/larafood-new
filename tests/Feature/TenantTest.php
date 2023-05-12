<?php

namespace Tests\Feature;

use App\Models\Tenant;
use Carbon\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TenantTest extends TestCase
{
    /**
     * Test Get All tenants.
     *
     * @return void
     */
    public function testGetAllTenants()
    {

        Factory(Tenant::class,10)->create();
        $response = $this->getJson('/api/v1/tenants');
        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

    public function testErrorGetTenants()
    {
        $tenant = 'fake_value';

        $response = $this->getJson("/api/v1/tenants/{$tenant}");
        $response->assertStatus(404);

    }
}
