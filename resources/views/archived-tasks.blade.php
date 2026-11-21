@extends('layouts.site')

@section('title', 'Archived Tasks')

@section('content')
    <section class="content-card">
        <h1>Archived Tasks</h1>

        @if ($tasks->isEmpty())
            <p>There are no archived tasks.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $task->status)) }}</td>
                            <td>{{ $task->task_date->format('M j, Y') }}</td>
                            <td>
                                <form method="POST"
                                      action="{{ route('tasks.restore', $task->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit">Restore</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </section>
@endsection