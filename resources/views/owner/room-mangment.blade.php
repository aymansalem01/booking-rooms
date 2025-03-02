@extends('layouts.ownerPage')

@section('content')

<div class="page-container">
    <div class="container mt-4">
        <h2 class="text-center text-purple fw-bold">Rooms Management</h2>

        <a href="{{ route('room.create') }}" class="btn btn-primary mb-3">Add New Room</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Room Name</th>
                    <th>Price</th>
                    <!-- <th>Discount</th>
                    <th>Total Price</th> -->
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
                    <!-- <td>%{{ $room->discount }}</td>
                    <td>${{ $room->total_price }}</td> -->
                    <td>{{ $room->status }}</td>
                    <td>{{ $room->user->name }}</td>
                    <td>
                        <a href="{{ route('room.show', $room->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('room.edit', $room->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('room.destroy', $room->id) }}" method="POST" style="display:inline-block;" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm delete-btn"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination-container">
            {{ $rooms->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

@endsection

<style>
    .page-container {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .container {
        flex: 1;
    }

    .footer {
        margin-top: auto;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        padding: 10px;
        border-radius: 10px;
    }

    .pagination .page-item .page-link {
        background: #f8f9fa;
        border: 1px solid #ddd;
        color: #9282ffdd;
        border-radius: 8px;
        padding: 8px 12px;
        transition: 0.3s;
    }

    .pagination .page-item .page-link:hover {
        background-color: #9282ffdd;
        color: white;
    }

    .pagination .page-item.active .page-link {
        background-color: #9282ffdd;
        color: white;
        border: none;
    }
</style>
