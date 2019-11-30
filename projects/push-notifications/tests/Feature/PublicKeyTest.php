<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\RsaKey;

class PublicKeyTest extends TestCase
{
    use RefreshDatabase;
    private $latestKey = NULL;

    protected function setUp(): void
    {
        parent::setUp();
        $this->latestKey = factory(Rsakey::class, 2)->create()->last();
    }

    public function testGetPublicKeyVersion()
    {
        $response = $this->get('/api/v1/public-key/version');
        $data = $response->decodeResponseJson();
        
        $response->assertStatus(200);
        $this->assertEquals($data['version'], $this->latestKey->version);
    }
}
