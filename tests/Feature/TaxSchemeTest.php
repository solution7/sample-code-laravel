<?php

namespace Tests\Feature;

use Tests\ApiTestCase;
use Faker\Factory as Faker;
use App\Models\TaxScheme;

class TaxSchemeTest extends ApiTestCase
{
    /** @test */
    public function user_can_get_all_tax_scheme_through_api()
    {
        $this->actAsValidUser();

        $response = $this->json('get', 'api/v1/admin/taxschemes');

        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_add_tax_scheme_through_api()
    {
        $faker = Faker::create();
        $this->actAsValidUser();

        $response = $this->json('POST', '/api/v1/admin/taxschemes', [
            'id' => null,
            'name' => $faker->word,
            'country_id' => 42,
            'value' => rand(10, 30),
            'public_name' => [$faker->word],
            'tax_key' => [$this->taxKeyValid->id],
        ])->assertStatus(201);
    }

    /** @test */
    public function admin_can_be_update_tax_scheme_through_api()
    {
        $faker = Faker::create();

        $this->actAsValidUser();

        $taxScheme = factory(TaxScheme::class)->create();

        $this->json('POST', '/api/v1/admin/taxschemes', [
            'id' => $taxScheme->id,
            'name' => $faker->word,
            'country_id' => 42,
            'value' => rand(10, 30),
            'public_name' => [$faker->word],
            'tax_key' => [$this->taxKeyValid->id],
        ])->assertStatus(201);
    }

    /** @test */
    public function admin_can_be_delete_tax_scheme_through_api()
    {
        $this->actAsValidUser();

        $taxScheme = factory(TaxScheme::class)->create();

        $this->json('DELETE', 'api/v1/admin/taxschemes/'.$taxScheme->id)
              ->assertStatus(204);
        $this->assertNull(TaxScheme::find($taxScheme->id));
    }
}
