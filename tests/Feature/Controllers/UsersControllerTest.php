<?php

namespace Tests\Feature\Controllers;

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
            'email' =>  $this->faker->email()
        ];

        $this->post('users', $data)->assertSessionHas('success');
        $this->assertDatabaseHas('users', $data);
        $this->post('users' )->assertSessionHas('error');


    }

    public function testUpdate():void
    {

        $data = [
            'name' => $this->faker->name(),
            'email' =>  $this->faker->email()
        ];

        $user = User::factory()->create();


        $this->put("users/$user->id", $data)->assertSessionHas('success');
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

