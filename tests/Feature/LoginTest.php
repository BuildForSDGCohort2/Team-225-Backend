<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Passport\ClientRepository;
use Illuminate\Support\Facades\DB;
use DateTime;

class LoginTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $url = '/api/auth/login';

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

    public function testCorrectLoginResponse() {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'password')
        ]);

        $response = $this->post($this->url, [
            'email' => $user->email,
            'password' => $password
        ]);

        $response->assertJson([
            'success' => true
        ]);
    }

    public function testApiTokenIsReturned()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'password')
        ]);

        $response = $this->post($this->url, [
            'email' => $user->email,
            'password' => $password
        ]);

        $this->assertIsString($response['data']['token']);
    }

    public function testUserCannotLoginWithWrongCredentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'password')
        ]);

        $response = $this->post($this->url, [
            'email' => 'wrong@email.com',
            'password' => $password
        ]);

        $this->assertFalse($response['success']);
    }
}
