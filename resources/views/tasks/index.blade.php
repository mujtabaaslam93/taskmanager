@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <h4>Task Manager</h4>
        </div>
    </div>

    <div class="row">
        <form action="{{ route('projects.store') }}" method="POST" class="col s12">
            @csrf
            <div class="input-field col s6">
                <input id="project_name" type="text" name="name" required>
                <label for="project_name">Project Name</label>
            </div>
            <div class="col s6">
                <button type="submit" class="btn waves-effect waves-light">Add Project</button>
            </div>
        </form>
    </div>

    <div class="row">
        <form action="{{ route('tasks.store') }}" method="POST" class="col s12">
            @csrf
            <div class="input-field col s4">
                <input id="task_name" type="text" name="name" required>
                <label for="task_name">Task Name</label>
            </div>
            <div class="input-field col s4">
                <select name="project_id" required>
                    <option value="" disabled>Select Project</option>
                    @foreach($projects as $key => $project)
                        <option value="{{ $project->id }}" {{ $key == 0 ? 'selected' : '' }}>{{ $project->name }}</option>
                    @endforeach
                </select>
                <label>Project</label>
            </div>
            <div class="col s12">
                <button type="submit" class="btn waves-effect waves-light">Add Task</button>
            </div>
        </form>
    </div>

    <div x-data="{ activeProject: null }">
    <div class="row">
        @foreach($projects as $project)
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-content" @click="activeProject = activeProject === {{ $project->id }} ? null : {{ $project->id }}" style="cursor: pointer;">
                        <span class="card-title">{{ $project->name }}</span>
                    </div>
                    <div class="card-action" x-show="activeProject === {{ $project->id }}">
                        <ul id="tasks-{{ $project->id }}" class="collection">
                            @foreach($project->tasks->sortBy('priority') as $task)
                                <li class="collection-item" data-id="{{ $task->id }}">
                                    <div>
                                        <span id="task_name_{{ $task->id }}">{{ $task->name }}</span>
                                        <i class="material-icons delete-icon red-text right" style="cursor: pointer;" onclick="confirmDeletion('{{ $task->id }}')">delete</i>
                                        <i class="material-icons edit-icon blue-text right" style="cursor: pointer;" onclick="editTask('{{ $task->id }}')">edit</i>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/task-manager.js') }}"></script>
@endpush
