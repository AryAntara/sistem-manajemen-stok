<?php

namespace Tests\Unit\app\Models;

use App\Models\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_inserted_new_entry(): void
    {
        $product = Product::factory()->create();
        $inserted_count = $product->count();
        $this->assertTrue($inserted_count > 0);
    }
}
