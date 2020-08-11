<?php

namespace Tests\Feature;

use Tests\ApiTestCase;
use Faker\Factory as Faker;

class UserTest extends ApiTestCase
{
    /** @test */
    public function a_user_can_be_created()
    {
        $data = $this->validPayload();

        $this->withDefaultHeaders()->post('api/v1/register', $data)
            ->assertStatus(201)
            ->assertJsonStructure([
                'id'
            ])->assertJsonFragment([
                'email' => $data['email'],
            ]);
    }

    private function validPayload()
    {
        $faker = Faker::create();
        $email = $faker->email;
        $password = $faker->password;

        return [
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'email' => $email,
            'email_confirmation' => $email,
            'password' => $password,
            'password_confirmation' => $password,
            'terms_conditions' => true,
            'privacy_policy' => true,
            'url' => $faker->url,
        ];
    }
}
