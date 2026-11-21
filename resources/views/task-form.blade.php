@extends('layouts.site')

@section('title', isset($task) ? 'Edit Task' : 'Create Task')

@section('content')
    @php
        $editing = isset($task);
        $selectedStatus = old('status', $editing ? $task->status : 'pending');
        $selectedDate = old(
            'task_date',
            $editing ? $task->task_date->format('Y-m-d') : ''
        );
    @endphp

    <section class="content-card">
        <h1>{{ $editing ? 'Edit Task' : 'Create Task' }}</h1>

        <form method="POST"
              action="{{ $editing ? route('tasks.update', $task) : route('tasks.store') }}">
            @csrf

            @if ($editing)
                @method('PUT')
            @endif

            <p>
                <label for="title">Task title</label><br>
                <input id="title"
                       name="title"
                       type="text"
                       maxlength="255"
                       value="{{ old('title', $editing ? $task->title : '') }}"
                       required>
                @error('title')
                    <br><span>{{ $message }}</span>
                @enderror
            </p>

            <p>
                <label for="status">Status</label><br>
                <select id="status" name="status" required>
                    <option value="pending" @selected($selectedStatus === 'pending')>Pending</option>
                    <option value="in_progress" @selected($selectedStatus === 'in_progress')>In Progress</option>
                    <option value="done" @selected($selectedStatus === 'done')>Done</option>
                </select>
                @error('status')
                    <br><span>{{ $message }}</span>
                @enderror
            </p>

            <p>
                <label for="task_date">Task date</label><br>
                <input id="task_date"
                       name="task_date"
                       type="date"
                       value="{{ $selectedDate }}"
                       required>
                @error('task_date')
                    <br><span>{{ $message }}</span>
                @enderror
            </p>

            <button type="submit">
                {{ $editing ? 'Save Changes' : 'Create Task' }}
            </button>
        </form>
    </section>
@endsection