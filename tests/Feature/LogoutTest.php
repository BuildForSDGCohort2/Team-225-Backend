<?php

namespace Tests\Feature;

use App\User;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    protected $url = '/api/auth/logout';

    public function setUp(): void {
        parent::setUP();

        $clientRepo = new ClientRepository();
        $client = $clientRepo->createPersonalAccessClient(null, 'Test toke', $this->url);

        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }

    // public function testCorrectLogoutResponse() {
    //     $user = factory(User::class)->create();

    //     $response = $this->actingAs($user, 'api')->get($this->url);

    //     $this->assertTrue($response['success']);
    // }

}
