<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        $this->authenticateUser();
    }

    /** @test */
    public function it_can_be_created()
    {
        $product = factory(Product::class)->create(['created_by' => $this->user->id]);
        $product['_token'] = csrf_token();

        $this->actingAs($this->user)->call('POST', 'admin/products', $product->toArray());

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'created_by' => $this->user->id,
        ]);
    }


    /** @test */
    public function it_can_be_updated()
    {
        $product = factory(Product::class)->create(['created_by' => auth()->user()->id]);
        $product['_token'] = csrf_token();
        $product->name = 'New name';

        $response = $this->put('admin/products/'.$product->id, $product->toArray());

        $response->assertRedirect('/');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'created_by' => auth()->user()->id,
            'name' => 'New name'
        ]);
    }

    /** @test */
    public function it_requires_a_title()
    {

        $this->actingAs(factory(User::class)->create());

        $product = factory(Product::class)->make(['name' => null]);

        $response = $this->call('POST', '/admin/products', $product->toArray());

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function it_requires_a_description()
    {
        $this->actingAs($this->user);

        $product = factory(Product::class)->make(['description' => null]);

        $response = $this->call('POST', '/admin/products', $product->toArray());

        $response->assertSessionHasErrors('description');
    }

    /** @test */
    public function it_requires_a_code()
    {
        $this->actingAs($this->user);

        $product = factory(Product::class)->make(['code' => null]);

        $response = $this->call('POST', '/admin/products', $product->toArray());

        $response->assertSessionHasErrors('code');
    }

    /** @test */
    public function it_requires_a_category_id()
    {
        $this->actingAs($this->user);

        $product = factory(Product::class)->make(['category_id' => null]);

        $response = $this->call('POST', '/admin/products', $product->toArray());

        $response->assertSessionHasErrors('category_id');
    }

}
