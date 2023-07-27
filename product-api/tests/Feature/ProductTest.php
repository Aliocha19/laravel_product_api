<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    /**
     * A basic product creation test.
     *
     * @return void
     */

    use RefreshDatabase;

    public function test_create_products()
    {
        // test validations

        $formData = [
            "name"=> "my kombo 1",
            "slug"=> "slug",
        ];

        $response = $this->post(route('products.store'), $formData);

        $response->assertInvalid([
            'description' => 'The description field is required.',
            'price' => 'The price field is required.'
        ]);

        $response->assertStatus(302);


        $formData = [
            "name"=> "my kombo 1",
            "slug"=> "slug",
            "description"=> "une description",
            "price"=> 14.22
        ];

        $response = $this->post(route('products.store'), $formData);


        $response->assertStatus(201);
      
    }


    public function test_show_product()
    {

        $product = Product::factory()->create();

        $response = $this->get(route('products.show',  $product->id));
        $response->assertStatus(200);
        
    }
}
