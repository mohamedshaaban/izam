<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateProductTest extends TestCase
{


    public function test_add_product_successfully()
    {
        // Prepare mock request data
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

        // Assert that the response is successful
        $response->assertStatus(200);

        // Assert the response contains success and the correct product data
        $response->assertJson([
            'success' => true,
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

        // Assert that the product was created in the database
        $this->assertDatabaseHas('products', [
            'name'=> $name,
            'sku' => $sku,
            'description' => $description,
            'price'=> $price,
            'qty'=> $qty,
            'type' =>'simple',
            'status' =>1
        ]);
    }

    public function test_add_product_validation_error()
    {
        // Call the store method with incomplete data
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->postJson(url('/').'/api/v1/product', []);

        // Assert that the response contains validation errors
        $response->assertStatus(422);
        $response->assertUnprocessable()->assertJsonValidationErrors('name', null);
    }
}
