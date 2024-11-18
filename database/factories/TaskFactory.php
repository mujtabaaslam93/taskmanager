<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {   
        // Create a new project to associate with the task
        $project = Project::factory()->create();

        // Get the max priority for the project (mimicking the controller logic)
        $maxPriority = Task::where('project_id', $project->id)->max('priority') ?: 0;
        $priority = $maxPriority + 1;  // Increment the max priority by 1
        return [
            'name' => $this->faker->sentence,  // Random task name
            'priority' => $priority,  // Set the priority
            'project_id' => $project->id,  // Associate with the created project
        ];

    }
}
