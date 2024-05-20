document.addEventListener('DOMContentLoaded', function() {
    initializeFormSelect();
    initializeTaskSorting();
});

function initializeFormSelect() {
    var elems = document.querySelectorAll('select');
    M.FormSelect.init(elems);
}

function initializeTaskSorting() {
    document.querySelectorAll('[id^="tasks-"]').forEach(function(taskList) {
        new Sortable(taskList, {
            animation: 150,
            onEnd: function(evt) {
                let tasks = Array.from(evt.from.children).map(task => task.getAttribute('data-id'));
                axios.post('/tasks/reorder', { tasks: tasks })
                    .catch(function(error) {
                        console.error('Error reordering tasks:', error);
                    });
            }
        });
    });
}

function editTask(taskId) {
    let taskElementId = `task_name_${taskId}`;
    let taskName = document.getElementById(taskElementId);
    let input = document.createElement('input');
    input.type = 'text';
    input.id = taskElementId;
    input.value = taskName.textContent;
    input.onblur = function() {
        saveTaskName(this.value, taskId);
    };
    input.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            this.blur();
        }
    });
    taskName.parentNode.replaceChild(input, taskName);
    input.focus();
}
// Function to send a request to save the updated task name
function saveTaskName(newName, taskId) {
    let taskElementId = `task_name_${taskId}`;
    let taskName = document.getElementById(taskElementId);
    axios.post('/tasks/update', {
        id: taskId,
        name: newName
    }).then(function(response) {
        var newSpan = document.createElement('span');
        newSpan.id = taskElementId;
        newSpan.textContent = newName;
        taskName.parentNode.replaceChild(newSpan, taskName);
    }).catch(function(error) {
        console.log(error);
    });
}

// Confirmation for Deletion
function confirmDeletion(taskId) {
    if (confirm('Are you sure you want to delete this task?')) {
        axios.post(`/tasks/${taskId}`, {
            _method: 'DELETE'
        }).then(function(response) {
            location.reload(); // or handle it in a more dynamic way
        }).catch(function(error) {
            console.log(error);
        });
    }
}