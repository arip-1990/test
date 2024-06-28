<?php

namespace Tests\Feature;

use App\Models\Directory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DirectoryTest extends TestCase
{
    public function testIndex(): void
    {
        $response = $this->get('api/directory');

        $response->assertOk();
    }

    public function testCreate(): void
    {
        $name = 'test';

        $response = $this->post('api/directory', ['name' => $name]);

        $response->assertCreated();
    }

    public function testRename(): void
    {
        $name = 'test 2';
        $directory = Directory::where('name', 'test')->first();

        $this->assertEquals($directory->name, 'test');

        $response = $this->put('api/directory/' . $directory->id, ['name' => $name]);

        $response->assertOk();
    }

    public function testDelete(): void
    {
        $directory = Directory::where('name', 'test 2')->first();

        $this->assertEquals($directory->name, 'test 2');

        $response = $this->delete('api/directory/' . $directory->id);

        $response->assertOk();
    }
}
