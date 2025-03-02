@extends('layouts.ownerPage')

@section('content')


<div class="container mt-4">
    <h2 class="text-center text-purple fw-bold">Rooms Management</h2>

    <a href="{{ route('room.create') }}" class="btn btn-primary mb-3">Add New Room</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Room Name</th>
                <th>Price</th>
                <th>Status</th>
                <th>Owner</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
            <tr>
                <td>{{ $room->id }}</td>
                <td>{{ $room->name }}</td>
                <td>${{ $room->price }}</td>
                <td>{{ $room->status }}</td>
                <td>{{ $room->user->name }}</td>
                <td>
                    <a href="{{ route('room.show', $room->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('room.edit', $room->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('room.destroy', $room->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection