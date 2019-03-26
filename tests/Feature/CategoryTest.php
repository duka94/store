<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        $this->authenticateUser();
    }

    /** @test */
    public function category_can_be_created()
    {
        $category = factory(Category::class)->make(['created_by' => null]);

        $response = $this->post('admin/categories', $category->toArray());

        $response->assertSessionHas(['title' => 'Created!']);
        $response->assertRedirect('admin/categories');
        $this->assertDatabaseHas('categories', [
            'name' => $category->name,
            'created_by' => $this->user->id,
        ]);
    }


    /** @test */
    public function category_can_be_updated()
    {
        $category = factory(Category::class)->create();
        $newName = $category->name = 'New Category';

        $response = $this->put('admin/categories/'.$category->id, $category->toArray());


        $response->assertSessionHas(['title' => 'Updated!']);
        $response->assertRedirect('/admin/categories/');
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'updated_by' => $this->user->id,
            'name' => $newName
        ]);
    }

    /** @test */
    public function category_can_be_deleted_and_all_products_associated_should_be_deleted()
    {
        $category = factory(Category::class)->create();

        $product = factory(Product::class)->create(['category_id' => $category->id]);
        factory(Product::class)->create();


        $response = $this->delete('admin/categories/'.$category->id);

        $response->assertSessionHas(['title' => 'Deleted!']);
        $response->assertRedirect('/admin/categories/');
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'deleted_by' => $this->user->id,
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'category_id' => $category->id,
        ]);
    }

    /** @test */
    public function category_requires_a_name()
    {
        $category = factory(Category::class)->make(['name' => null]);

        $response = $this->post('/admin/categories', $category->toArray());

        $response->assertSessionHasErrors('name');
    }

}
