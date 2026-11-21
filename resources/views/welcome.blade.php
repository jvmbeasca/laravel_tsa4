@extends('layouts.site')

@section('title', 'Welcome')

@section('content')
    <section class="welcome">
        <h1>Tasks for Today</h1>
        <p>Tasks scheduled for {{ today()->format('F j, Y') }}</p>
    </section>

    <section class="content-card">
        <h2>Today’s Tasks</h2>

        @if ($tasks->isEmpty())
            <p>No tasks are scheduled for today.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $task->status)) }}</td>
                            <td>{{ $task->task_date->format('M j, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </section>
@endsection