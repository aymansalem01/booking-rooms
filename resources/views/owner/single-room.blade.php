@extends('layouts.ownerPage')

@section('content')

<div class="container mt-4">
    <h2 class="text-center text-purple fw-bold">Room Details</h2>

    <div class="card shadow-lg border-0 rounded-lg p-4">
        <h3>{{ $room->name }}</h3>
        <p><strong>Address:</strong> {{ $room->address }}</p>
        <p><strong>Price:</strong> ${{ $room->price }}</p>
        <p><strong>Discount:</strong> %{{ $room->discount }}</p>
        <p><strong>Price After Discount:</strong> %{{ $room->total_price }}</p>
        <p><strong >Room Type:</strong>{{ $room->category->name }}</p>
        <p><strong>Count:</strong> {{ $room->count }}</p>
        <p><strong>Size:</strong> {{ $room->size }}</p>
        <p><strong>Size:</strong> {{ $room->capacity }}</p>

        <p><strong>Status:</strong> {{ $room->status }}</p>
        <p><strong>Description:</strong> {{ $room->description }}</p>

        <a href="{{ route('room.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

@endsection