<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Passport\ClientRepository;
use Illuminate\Support\Facades\DB;
use DateTime;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    protected $url = '/api';

    public function setUp(): void
    {
        parent::setUp();

        $clientRepo = new ClientRepository();
        $client = $clientRepo->createPersonalAccessClient(null, 'Test Token', $this->url);

        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testBaseUrl()
    {
        $response = $this->get($this->url);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true
        ]);
    }

    public function testCorrectRegistrationResponse()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'test@test.com',
            'password' => 'password'
        ];

        $response = $this->post($this->url . '/auth/register', $data);

        $response->assertSuccessful();
        $response->assertJson([
            'success' => true
        ]);
    }

    public function testApiTokenIsReturned()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'test@test.com',
            'password' => 'password'
        ];

        $response = $this->post($this->url . '/auth/register', $data);

        $response->assertSuccessful();
        $this->assertIsString($response['data']['token']);
    }

    public function testUserCannotRegisterWithWrongCredentials()
    {
        $data = [
            'name' => 'John',
            'password' => 'short'
        ];

        $response = $this->post($this->url . '/auth/register', $data);

        $response->assertJson([
            'success' => false
        ]);
    }
}
