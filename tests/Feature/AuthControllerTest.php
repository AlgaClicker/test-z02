<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use http\Params;
use Illuminate\Support\Collection;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    protected $users = [];
    protected array $tokens = [] ;

    /**
     * A basic test example.
     */
    public function __construct(string $name)
    {
        $user1 = [
            $testl = md5(time()*rand(1000,9999)),
            "email" => "$testl@test.local",
            "password" => "password",
            "password_confirm" => "password",
            "full_name" => "test-$testl"
        ];

        $this->users[] =  $user1;
        parent::__construct($name);
    }

    private function addToken($token) {
        $this->tokens[] = $token;
    }


    public function test_the_application_auth(): void
    {
            $user = $this->users[0];
            $response = $this->post('/api/register',$user);
            $response->assertStatus(200);

            $response = $this->post('/api/login',$user);
            $response = $response->assertStatus(200);
            $resultData = json_decode($response->getContent());
            $token  =  $resultData->data->token ;
            echo "Token:".$token."\r\n";
            $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                ->json('get', '/api/me');
            $response->assertStatus(200);

            echo $response->getContent()."\r\n";
            $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                ->json('get', 'api/account/delete');
            $response->assertStatus(200);
    }

    /*
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/api/login');

        $response->assertStatus(200);
    }
    */
}
