<?php

namespace Tests\Feature;

use App\Models\Items;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @return void
     */
    function testGetALLItems()
    {
        $this->json('GET', '/api/items', ['Accept' => 'application/json'])->assertStatus(200);
    }

    /**
     * @return void
     */
    function testGetItemById()
    {
        Items::firstOrCreate(['id' => 1], [
            'name' => 'test',
            'price' => 1000,
        ]);

        $this->json('GET', '/api/items/1', ['Accept' => 'application/json'])->assertStatus(200);
    }
}
