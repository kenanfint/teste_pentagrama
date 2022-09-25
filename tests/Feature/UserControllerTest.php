<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * Testing if a guest can create an account
     *
     * @return void
     */
    public function test_guest_can_create_an__account()
    {
        //prepare
        $user = User::factory(1)->makeOne()->makeVisible(['password'])->toArray();

        //act
        $response = $this->post('/users/store', $user);

        //assert
        $response->assertRedirect('/');

        $response->assertSessionHasNoErrors();

        $response->assertSessionHasAll([
            'status' => 'Usuário cadastrado com sucesso.'
        ]);
    }

    /**
     * Testing if a user can authenticate (login)
     *
     * @return void
     */
    public function test_user_can_authenticate()
    {
        //prepare
        $user = [
            'email' => 'test@gmail.com',
            'password' => '$2y$10$H6biQEZelIHlJV.IK1C20OttxUgpiDzDpxJjdgkAOOc1tAEpnPKBe'
        ];

        //act
        $response = $this->post('/users/auth', $user);

        //assert
        $response->assertRedirect('/');
    }

    public function test_user_see_cities_table()
    {
        //act
        $response = $this->get('/cities');

        //assert
        $response->assertSuccessful();
        $response->assertViewIs('cities.index');
    }

    public function test_user_can_filter_cities_by_name()
    {
        //prepare
        $searchPayload = [
            'city_name' => 'Salvador'
        ];

        //act
        $response = $this->post('/cities/filter', $searchPayload);

        //assert
        $response->assertSee('São Paulo', false);
        $response->assertSuccessful();
    }
}
