<?php


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateRegisterTest extends TestCase
{


    public function test_register_user_successfully()
    {
        // Prepare mock request data
        $name = Str::random(10);
        $email = Str::random(10).'@example.com';
        $password=   'password';

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' =>  $password,
        ];
         // Call the store method with the request data
        $response = $this->postJson(url('/').'/api/register', $data);

        // Assert that the response is successful
        $response->assertStatus(200);

        // Assert the response contains success and the correct product data
        $response->assertJson([
            'success' => true,
            'user' => [
                'name' => $name,
                'email' => $email,
            ],
        ]);

        // Assert that the product was created in the database
        $this->assertDatabaseHas('users',['name' => $name, 'email' => $email]);
    }

    public function test_register_user_validation_error()
    {
        // Call the store method with incomplete data
        $response = $this->postJson(url('/').'/api/register', []);
        // Assert that the response contains validation errors
        $response->assertStatus(422);
        $response->assertUnprocessable()->assertJsonValidationErrors('name', null);
    }
}
