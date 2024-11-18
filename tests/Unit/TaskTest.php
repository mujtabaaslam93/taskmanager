<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Project;
use App\Models\Task;

class TaskTest extends TestCase
{
    /**
     * A basic unit test task_creation example.
     */
    /** @test */
    public function test_task_creation_with_valid_data()
    {
        $project = Project::factory()->create();

        $task = Task::create([
            'name' => 'Test Task',
            'priority' => '1',
            'project_id' => $project->id,
        ]);

        $this->assertDatabaseHas('tasks', [
            'name' => 'Test Task',
            'priority' => '1',
            'project_id' => $project->id,
        ]);
    }

    /** @test */
    public function test_task_priority_field_is_saved_correctly()
    {
        $project = Project::factory()->create();
        $task = Task::create([
            'name' => 'Test Task with Priority',
            'priority' => '1',
            'project_id' => $project->id,
        ]);

        // Assert the task is in the database with the correct priority
        $this->assertDatabaseHas('tasks', [
            'name' => 'Test Task with Priority',
            'priority' => '1',
        ]);
    }

}
