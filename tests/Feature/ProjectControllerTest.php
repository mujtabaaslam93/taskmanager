<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Project;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_store_creates_project_with_valid_data()
    {
        $response = $this->post(route('projects.store'), [
            'name' => 'New Project',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('projects', ['name' => 'New Project']);
    }

}
