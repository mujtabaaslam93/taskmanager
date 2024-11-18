<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Project;
use App\Models\Task;

class ProjectTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_fillable_attributes()
    {
        $project = new Project(['name' => 'Test Project']);
        $this->assertEquals('Test Project', $project->name);
    }
    public function test_tasks_relationship()
    {
         // Create a project
    $project = Project::factory()->create();

    // Create a task associated with the project, using the factory to auto-generate all fields
    $task = Task::factory()->create([
        'project_id' => $project->id,  // Ensure this is passed explicitly
        'name' => 'Test Task',  // Provide a task name
    ]);

    // Verify the task is related to the project
    $this->assertTrue($project->tasks->contains($task));

    // Verify the task instance
    $this->assertInstanceOf(Task::class, $project->tasks->first());
    }
}
