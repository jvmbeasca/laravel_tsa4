@extends('layouts.site')

@section('title', 'Task List')

@section('content')
    <section class="content-card">
        <h1>All Tasks</h1>

        @auth
            <p><a href="{{ route('tasks.create') }}">Create a Task</a></p>
            <p><a href="{{ route('tasks.archived') }}">View Archived Tasks</a></p>
        @endauth

        @if ($tasks->isEmpty())
            <p>No active tasks found.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Date</th>
                        @auth
                            <th>Actions</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $task->status)) }}</td>
                            <td>{{ $task->task_date->format('M j, Y') }}</td>

                            @auth
                                <td>
                                    <a href="{{ route('tasks.edit', $task) }}">Edit</a>

                                    <form method="POST"
                                          action="{{ route('tasks.archive', $task) }}"
                                          style="display:inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit">Archive</button>
                                    </form>
                                </td>
                            @endauth
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </section>
@endsection