<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;


    public function test_main_page()
    {
        $response = $this->get(route('products'));
        $response->assertStatus(200);
    }

    public function testFilterByCategory()
    {

        $category_1 = Category::factory()->create(['name' => 'category_1']);
        $category_2 = Category::factory()->create(['name' => 'category_2']);

        $product1 = Product::factory()->create([
            'name' => 'product1',
            'id_category' => $category_1->id
        ]);

        $product2 = Product::factory()->create([
            'name' => 'product2',

            'id_category' => $category_2->id,
        ]);

        $response = $this->get('/products?category=' . $category_1->id);

        $response->assertSee($product1->name)->assertDontSee($product2->name);
    }

    public function testSortByMinPriceASC()
    {
        $categoryA = Category::factory()->create();

        $productA = Product::factory()->create([
            'id_category' => $categoryA->id
        ]);
        $productA->prices()->createMany([
            ['price' => 100],
            ['price' => 50],
            ['price' => 75],
        ]);

        $productB = Product::factory()->create([
            'id_category' => $categoryA->id
        ]);
        $productB->prices()->createMany([
            ['price' => 200],
            ['price' => 150],
            ['price' => 175],
        ]);

        $productC = Product::factory()->create([
            'id_category' => $categoryA->id
        ]);
        $productC->prices()->createMany([
            ['price' => 300],
            ['price' => 250],
            ['price' => 275],
        ]);

        $response = $this->get('/products?sort_by=min_price&sort_order=asc');

        $response->assertSeeInOrder([
            $productA->name,
            $productB->name,
            $productC->name,
        ]);
    }

    public function testSortByProductASC()
    {
        $categoryA = Category::factory()->create();

        $productA = Product::factory()->create([
            'name' => 'productA',
            'id_category' => $categoryA->id
        ]);
        $productA->prices()->createMany([
            ['price' => 100],
            ['price' => 50],
            ['price' => 75],
        ]);

        $productB = Product::factory()->create([
            'name' => 'productB',

            'id_category' => $categoryA->id
        ]);
        $productB->prices()->createMany([
            ['price' => 200],
            ['price' => 150],
            ['price' => 175],
        ]);

        $productC = Product::factory()->create([
            'name' => 'productC',
            'id_category' => $categoryA->id
        ]);
        $productC->prices()->createMany([
            ['price' => 300],
            ['price' => 250],
            ['price' => 275],
        ]);

        $response = $this->get('/products?sort_by=name&sort_order=asc');

        $response->assertSeeInOrder([
            $productA->name,
            $productB->name,
            $productC->name,
        ]);
    }

    public function testSortByProductDesc()
    {
        $categoryA = Category::factory()->create();

        $productA = Product::factory()->create([
            'name' => 'productA',
            'id_category' => $categoryA->id
        ]);
        $productA->prices()->createMany([
            ['price' => 100],
            ['price' => 50],
            ['price' => 75],
        ]);

        $productB = Product::factory()->create([
            'name' => 'productB',

            'id_category' => $categoryA->id
        ]);
        $productB->prices()->createMany([
            ['price' => 200],
            ['price' => 150],
            ['price' => 175],
        ]);

        $productC = Product::factory()->create([
            'name' => 'productC',
            'id_category' => $categoryA->id
        ]);
        $productC->prices()->createMany([
            ['price' => 300],
            ['price' => 250],
            ['price' => 275],
        ]);

        $response = $this->get('/products?sort_by=name&sort_order=desc');

        $response->assertSeeInOrder([
            $productC->name,
            $productB->name,
            $productA->name,
        ]);
    }

    public function testSortByMinPriceDESC()
    {
        $categoryA = Category::factory()->create();

        $productA = Product::factory()->create([
            'id_category' => $categoryA->id
        ]);
        $productA->prices()->createMany([
            ['price' => 100],
            ['price' => 50],
            ['price' => 75],
        ]);

        $productB = Product::factory()->create([
            'id_category' => $categoryA->id
        ]);
        $productB->prices()->createMany([
            ['price' => 200],
            ['price' => 150],
            ['price' => 175],
        ]);

        $productC = Product::factory()->create([
            'id_category' => $categoryA->id
        ]);
        $productC->prices()->createMany([
            ['price' => 300],
            ['price' => 250],
            ['price' => 275],
        ]);

        $response = $this->get('/products?sort_by=min_price&sort_order=desc');

        $response->assertSeeInOrder([
            $productC->name,
            $productB->name,
            $productA->name,
        ]);
    }

    public function testSortByMaxPriceASC()
    {
        $categoryA = Category::factory()->create();

        $productA = Product::factory()->create([
            'id_category' => $categoryA->id
        ]);
        $productA->prices()->createMany([
            ['price' => 100],
            ['price' => 50],
            ['price' => 75],
        ]);

        $productB = Product::factory()->create([
            'id_category' => $categoryA->id
        ]);
        $productB->prices()->createMany([
            ['price' => 200],
            ['price' => 150],
            ['price' => 175],
        ]);

        $productC = Product::factory()->create([
            'id_category' => $categoryA->id
        ]);
        $productC->prices()->createMany([
            ['price' => 300],
            ['price' => 250],
            ['price' => 275],
        ]);

        $response = $this->get('/products?sort_by=max_price&sort_order=asc');

        $response->assertSeeInOrder([
            $productA->name,
            $productB->name,
            $productC->name,
        ]);
    }

    public function testSortByMaxPriceDESC()
    {
        $categoryA = Category::factory()->create();

        $productA = Product::factory()->create([
            'id_category' => $categoryA->id
        ]);
        $productA->prices()->createMany([
            ['price' => 100],
            ['price' => 50],
            ['price' => 75],
        ]);

        $productB = Product::factory()->create([
            'id_category' => $categoryA->id
        ]);
        $productB->prices()->createMany([
            ['price' => 200],
            ['price' => 150],
            ['price' => 175],
        ]);

        $productC = Product::factory()->create([
            'id_category' => $categoryA->id
        ]);
        $productC->prices()->createMany([
            ['price' => 300],
            ['price' => 250],
            ['price' => 275],
        ]);

        $response = $this->get('/products?sort_by=max_price&sort_order=desc');

        $response->assertSeeInOrder([
            $productC->name,
            $productB->name,
            $productA->name,
        ]);
    }

    public function testSearchByName()
    {
        $category = Category::factory()->create();

        $productA = Product::factory()->create([
            'name' => 'Apple iPhone 12',
            'id_category' => $category->id
        ]);

        $productB = Product::factory()->create([
            'name' => 'Samsung Galaxy S21',
            'id_category' => $category->id
        ]);

        $productC = Product::factory()->create([
            'name' => 'OnePlus 9 Pro',
            'id_category' => $category->id
        ]);

        $searchTerm = 'Apple';

        $response = $this->get('/products?search=' . $searchTerm);

        $response->assertSee($productA->name);
        $response->assertDontSee($productB->name);
        $response->assertDontSee($productC->name);
    }

    public function testSeeProductsOnPage()
    {
        $categoryA = Category::factory()->create([
            'name' => 'Category A'
        ]);
        $categoryB = Category::factory()->create([
            'name' => 'Category B'
        ]);

        $productA = Product::factory()->create([
            'name' => 'Product A',
            'id_category' => $categoryA->id,
            'description' => 'This is product A',
        ]);
        $productA->prices()->createMany([['price' => 100],
            ['price' => 50],
            ['price' => 75],
        ]);

        $productB = Product::factory()->create([
            'name' => 'Product B',
            'id_category' => $categoryB->id,
            'description' => 'This is product B',
        ]);
        $productB->prices()->createMany([['price' => 200],
            ['price' => 150],
            ['price' => 175],
        ]);

        $productC = Product::factory()->create([
            'name' => 'Product C',
            'id_category' => $categoryA->id,
            'description' => 'This is product C',
        ]);
        $productC->prices()->createMany([['price' => 300],
            ['price' => 250],
            ['price' => 275],
        ]);

        $response = $this->get(route('products', ['search' => 'Product', 'category' => $categoryA->id, 'sort_by' => 'min_price', 'sort_order' => 'desc',]));

        $response->assertOk();
        $response->assertSeeInOrder(['Product C', 'Product A',]);
        $response->assertDontSee('Product B');
    }

    public function testTryAddProductWithoutAuthentication()
    {
        $response = $this->post('/products/save', [
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'prices' => [10.99, 13, 123],
            'id_category' => 1,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('products', [
            'name' => 'Test Product',
        ]);
    }

    public function testTryDeleteProductWithoutAuthentication()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'id_category' => $category->id,
        ]);
        $response = $this->delete(route('product-delete', $product->id));


        $response->assertStatus(302);
        $response->assertRedirect('/login');
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
        ]);
    }

    public function testEditProductWithoutAuthentication()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'id_category' => $category->id,
        ]);
        $response = $this->get(route('product-edit', $product));

        $response->assertRedirect(route('login'));
    }

    public function testEditProductWithAuthentication()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category_1 = Category::factory()->create();
        $category_2 = Category::factory()->create();
        $product = Product::factory()->create([
            'name' => 'name',
            'id_category' => $category_1->id,
            'description' => 'description'
        ]);
        $product->prices()->createMany([
            ['price' => 100],
            ['price' => 75],
            ['price' => 50],
        ]);
        $response = $this->get(route('product-edit', $product->id));
        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee($product->description);
        $response->assertSee($category_1->name);
        $response->assertSee('50.00');
        $response->assertSee('75.00');
        $response->assertSee('100.00');

        $product->name = 'New Product Name';
        $product->description = 'New Product Description';
        $product->prices = [999, 99, 123, 235];
        $product->new_prices = [998, 1234, 926];

        $response = $this->put(route('product-store', $product->id), [
            'name' => $product->name,
            'description' => $product->description,
            'prices' => $product->prices,
            'new_prices' => $product->new_prices,
            'id_category' => $category_2->id,

        ]);


        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'id_category' => $category_2->id,
        ]);
    }

    public function testTryAddProductWithAuthentication()
    {
        $category = Category::factory()->create();

        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/products/save', [
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'prices' => [10.99, 13, 123],
            'id_category' => $category->id,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('products'));
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
        ]);
    }

    public function testTryDeleteProductWithAuthentication()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'id_category' => $category->id,
        ]);
        $response = $this->delete(route('product-delete', $product->id));


        $response->assertStatus(302);
        $response->assertRedirect(route('products'));
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

}
