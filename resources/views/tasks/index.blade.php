@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-lg-12">
            <h2 class="text-center">Task Management</h2>
        </div>
        <div class="col-lg-12 text-end">
            <a class="btn btn-success" href="{{ route('tasks.create') }}">Create New Task</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>{{ $message }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-lg-12 text-center">
            <a class="btn btn-secondary mx-1" href="{{ route('tasks.index') }}">All Tasks</a>
            <a class="btn btn-secondary mx-1" href="{{ route('tasks.filterByStatus', 'completed') }}">Completed Tasks</a>
            <a class="btn btn-secondary mx-1" href="{{ route('tasks.filterByStatus', 'pending') }}">Pending Tasks</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th width="280px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 0; @endphp
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>
                            <span class="badge {{ $task->completed ? 'bg-success' : 'bg-warning' }}">
                                {{ $task->completed ? 'Completed' : 'Pending' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a class="btn btn-primary btn-sm" href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                @if($task->completed)
                                    <form action="{{ route('tasks.pending', $task->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-warning btn-sm">Mark as Pending</button>
                                    </form>
                                @else
                                    <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">Mark as Completed</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
