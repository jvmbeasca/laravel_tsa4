<h1>Task completed</h1>

<p>The following task was marked as done:</p>

<p><strong>{{ $task->title }}</strong></p>

<p>Task date: {{ $task->task_date->format('F j, Y') }}</p>

<p>This notification was generated automatically by Tasks for Today.</p>