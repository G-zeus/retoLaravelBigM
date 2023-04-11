<?php

namespace Tests\Feature\Controllers;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    use WithFaker;

    public function testStore (): void
    {

        $data = [
            'name' => $this->faker->name(),
            'email' =>  $this->faker->email()
        ];

        $this->post('roles', $data)->assertSessionHas('success');
        $this->assertDatabaseHas('roles', $data);
        $this->post('roles' )->assertSessionHas('error');


    }

    public function testUpdate():void
    {

        $data = [
            'name' => $this->faker->name(),
            'email' =>  $this->faker->email()
        ];

        $user = Role::factory()->create();


        $this->put("roles/$user->id", $data)->assertSessionHas('success');
        $this->assertDatabaseHas('roles', $data);
        $this->put("roles/$user->id" )->assertSessionHas('error');


    }

    public function testDelete():void
    {

        $data = [
            'name' => $this->faker->name(),
            'email' =>  $this->faker->email()
        ];

        $user = Role::factory()->create();


        $this->delete("roles/$user->id", $data)->assertSessionHas('success');
        $this->assertDatabaseMissing('roles', $data);


    }
}
