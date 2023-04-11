<?php

namespace Tests\Feature\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use WithFaker;

    public function testStore (): void
    {

        $data = [
            'name' => $this->faker->name(),
            'email' =>  $this->faker->email(),
            'role' => rand(1,5)
        ];


        $this->post('users', $data)->assertSessionHas('success');

        unset($data['role']);
        $this->assertDatabaseHas('users', $data);
//        $this->assertDatabaseHas('role_user', ['user_id'=>, 'role_id' =>$data['role']]);

        $this->post('users' )->assertSessionHas('error');


    }

    public function testUpdate():void
    {

        $data = [
            'name' => $this->faker->name(),
            'email' =>  $this->faker->email(),
            'role' => rand(1,5)

        ];

        $user = User::factory()->create();


        $this->put("users/$user->id", $data)->assertSessionHas('success');
        unset($data['role']);
        $this->assertDatabaseHas('users', $data);
        $this->put("users/$user->id" )->assertSessionHas('error');


    }

    public function testDelete():void
    {

        $data = [
            'name' => $this->faker->name(),
            'email' =>  $this->faker->email()
        ];

        $user = User::factory()->create();


        $this->delete("users/$user->id", $data)->assertSessionHas('success');
        $this->assertDatabaseMissing('users', $data);


    }
}

