<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class FeatureProductTest extends TestCase
{

    public function it_can_create_a_product()
    {
        // Prepare the data to be sent in the request
        $name = Str::random(10);
        $sku = Str::random(5);
        $description = Str::random(100);
        $price = rand(10,1000);
        $qty = rand(10,1000);
        $data = [
            'name'=> $name,
            'sku' => $sku,
            'description' => $description,
            'price'=> $price,
            'qty'=> $qty,
            'type' =>'simple',
            'status' =>1
        ];
        $user = User::factory()->create();
        // Call the store method with the request data
        $response = $this->actingAs($user, 'api')->postJson(url('/').'/api/v1/product', $data);


        // Assert that the response status is 201 (created)
        $response->assertStatus(201);

        // Assert the response contains the expected structure and data
        $response->assertJsonStructure([
            'success',
            'product' => [
                'name'=> $name,
                'sku' => $sku,
                'description' => $description,
                'price'=> $price,
                'qty'=> $qty,
                'type' =>'simple',
                'status' =>1
            ]
        ]);

        // Assert the product was created in the database
        $this->assertDatabaseHas('products',[
            'name'=> $name,
            'sku' => $sku,
            'description' => $description,
            'price'=> $price,
            'qty'=> $qty,
            'type' =>'simple',
            'status' =>1
        ]);
    }

    /** @test */
    public function it_requires_name_and_price_to_create_a_product()
    {
        // Send a POST request with empty data
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->postJson(url('/').'/api/v1/product', []);

        // Assert that the response status is 422 (Unprocessable Entity)
        $response->assertStatus(422);

        // Assert that validation errors were returned for the name and price fields
        $response->assertUnprocessable()->assertJsonValidationErrors(['name','price'], null);
    }

    /** @test */
    public function it_fails_when_qty_price_is_negative()
    {
        // Prepare data with an invalid price
        $data = [
            'name' => 'Test Product',
            'price' => -10,
            'qty' => -10,
        ];

        // Send the POST request
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->postJson(url('/').'/api/v1/product', $data);

        // Assert that the response status is 422 (Unprocessable Entity)
        $response->assertStatus(422);

        // Assert validation error for the price field
        $response->assertUnprocessable()->assertJsonValidationErrors(['price','qty'], null);

    }
}
