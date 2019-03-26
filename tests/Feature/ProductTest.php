<?php

namespace Tests\Feature;

use App\Models\Product;
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
        $product = factory(Product::class)->make(['created_by' => null]);

        $response = $this->post('admin/products', $product->toArray());

        $response->assertSessionHas(['title' => 'Created!']);
        $response->assertRedirect('admin/products');
        $this->assertDatabaseHas('products', [
            'name' => $product->name,
            'created_by' => $this->user->id,
        ]);
    }


    /** @test */
    public function it_can_be_updated()
    {
        $product = factory(Product::class)->create();
        $newName = $product->name = 'New name';

        $response = $this->put('admin/products/'.$product->id, $product->toArray());


        $response->assertSessionHas(['title' => 'Updated!']);
        $response->assertRedirect('/admin/products/');
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'updated_by' => $this->user->id,
            'name' => $newName
        ]);
    }

    /** @test */
    public function it_can_be_deleted()
    {
        $product = factory(Product::class)->create();

        $response = $this->delete('admin/products/'.$product->id);

        $response->assertSessionHas(['title' => 'Deleted!']);
        $response->assertRedirect('/admin/products/');
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'deleted_by' => $this->user->id,
        ]);
    }

    /** @test */
    public function it_requires_a_img()
    {
        $product = factory(Product::class)->make(['img_path' => null]);

        $response = $this->post('/admin/products', $product->toArray());

        $response->assertSessionHasErrors('img_path');
    }

    /** @test */
    public function it_requires_a_title()
    {
        $product = factory(Product::class)->make(['name' => null]);

        $response = $this->post('/admin/products', $product->toArray());

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function it_requires_a_description()
    {
        $product = factory(Product::class)->make(['description' => null]);

        $response = $this->post('/admin/products', $product->toArray());

        $response->assertSessionHasErrors('description');
    }

    /** @test */
    public function it_requires_a_code()
    {
        $product = factory(Product::class)->make(['code' => null]);

        $response = $this->post('/admin/products', $product->toArray());

        $response->assertSessionHasErrors('code');
    }

    /** @test */
    public function it_requires_a_category_id()
    {
        $product = factory(Product::class)->make(['category_id' => null]);

        $response = $this->post('/admin/products', $product->toArray());

        $response->assertSessionHasErrors('category_id');
    }

}
