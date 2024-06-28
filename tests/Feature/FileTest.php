<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FileTest extends TestCase
{
    public function testIndex(): void
    {
        $response = $this->get('api/file');

        $response->assertOk();
    }
}
