<?php

namespace Tests\Feature;

use App\Models\Items;
use App\Models\Orders;
use App\Models\User;
use App\Repositories\OrderRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;
    protected $email = 'firstTest@gmail.com';
    protected $password = 12345678;

    function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->user = User::firstOrCreate(['email' => $this->email], [
            'email' => $this->email,
            'name' => 'first',
            'password' => bcrypt($this->password),
        ]);

        $this->token = $this->getToken();
    }

    /**
     * @return void
     * success
     */
    function testCreateOrderSuccess()
    {

        Items::firstOrCreate(['id' => 1], [
            'name' => 'test',
            'price' => 100
        ]);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->json('POST', '/api/order', ['items' => [1]]);
        $response->assertStatus(200)->assertJson([
            'status' => true
        ]);
    }

    /**
     * @return void
     * check if order not found
     */
    function testOrderNotFound()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->json('get', '/api/order/134131212');
        $response->assertStatus(403)->assertJson([
            'status' => false
        ]);
    }

    /**
     * @return mixed
     * return token after login to use it in insertion api that need token
     */
    public function getToken()
    {
        $body = [
            'email' => $this->email,
            'password' => $this->password,
        ];
        $auth_response = $this->json('POST', '/api/login', $body, ['Accept' => 'application/json']);

        $token = $auth_response->getData()->data->token;
        return $token;
    }


}
