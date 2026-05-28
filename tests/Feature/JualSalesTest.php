<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JualSalesTest extends TestCase
{
    use RefreshDatabase;

    public function test_jual_page_calculates_real_sales_revenue_correctly(): void
    {
        // 1. Create seller
        $seller = User::factory()->create();

        // 2. Create books for seller
        $book1 = Book::create([
            'title' => 'Book One',
            'author' => 'Author A',
            'description' => 'Description one',
            'price' => 50000,
            'stock' => 10,
            'category' => 'Novel',
            'user_id' => $seller->id,
            'image' => 'book-images/jual.png',
            'rating' => 4.0,
        ]);

        $book2 = Book::create([
            'title' => 'Book Two',
            'author' => 'Author B',
            'description' => 'Description two',
            'price' => 75000,
            'stock' => 5,
            'category' => 'Edukasi',
            'user_id' => $seller->id,
            'image' => 'book-images/jual.png',
            'rating' => 4.5,
        ]);

        // 3. Create buyer
        $buyer = User::factory()->create();

        // 4. Create an order with items
        // Purchase 2 of Book One (2 * 50,000 = 100,000)
        // Purchase 1 of Book Two (1 * 75,000 = 75,000)
        // Total expected revenue: 175,000
        $order = Order::create([
            'user_id' => $buyer->id,
            'total_price' => 175000,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'payment_method' => 'cod',
            'payment_id' => 'PAY-1234',
            'payment_code' => 123456,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'book_id' => $book1->id,
            'price' => 50000,
            'quantity' => 2,
            'subtotal' => 100000,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'book_id' => $book2->id,
            'price' => 75000,
            'quantity' => 1,
            'subtotal' => 75000,
        ]);

        // 5. Act as seller and visit /jual
        $response = $this->actingAs($seller)->get('/jual');

        // 6. Assert response
        $response->assertStatus(200);

        // Check if the real revenue is calculated in the response HTML:
        // Rp 175.000 should be present
        $response->assertSee('Rp 175.000');
        
        // Assert quantities sold are correct
        $response->assertSee('2'); // for Book One
        $response->assertSee('1'); // for Book Two
    }
}
