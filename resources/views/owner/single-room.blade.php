@extends('layouts.ownerPage')

@section('content')
    <style>
        .room-thumbnails {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .thumbnail {
            width: 60px;
            height: 60px;
            cursor: pointer;
            opacity: 0.6;
            transition: 0.3s;
            border: 2px solid transparent;
        }

        .thumbnail:hover,
        .thumbnail.active {
            opacity: 1;
            border: 2px solid #ce05a2;
        }
    </style>
    <div class="container mt-4">
        <h2 class="text-center text-purple fw-bold">Room Details</h2>

        <div class="card shadow-lg border-0 rounded-lg p-4">
            <h3>{{ $room->name }}</h3>
            <p><strong>Address:</strong> {{ $room->address }}</p>
            <p><strong>Price:</strong> ${{ $room->price }}</p>
            <p><strong>Discount:</strong> %{{ $room->discount }}</p>
            <p><strong>Price After Discount:</strong> ${{ $room->total_price }}</p>
            <p><strong>Room Type:</strong>{{ $room->category->name }}</p>
            <p><strong>Count:</strong> {{ $room->count }}</p>
            <p><strong>Size:</strong> {{ $room->size }}</p>
            <p><strong>Size:</strong> {{ $room->capacity }}</p>

            <p><strong>Status:</strong> {{ $room->status }}</p>
            <p><strong>Description:</strong> {{ $room->description }}</p>
            <img id="main-room-image" style="margin-bottom: 5px" width="750" height="600"
                src="{{ asset('images/' . $room->image->first()->image) }}" alt="">
            <div class="room-thumbnails" style="margin-bottom: 0">
                @foreach ($room->image as $key => $image)
                    <img class="thumbnail" src="{{ asset('images/' . $image->image) }}" alt="">
                @endforeach
            </div>

            <a href="{{ route('room.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('addimage', $room->id) }}" class="btn btn-secondary">add image</a>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const thumbnails = document.querySelectorAll(".thumbnail");
            const mainImage = document.getElementById("main-room-image");

            thumbnails.forEach(thumb => {
                thumb.addEventListener("click", function() {
                    mainImage.src = this.src;
                    thumbnails.forEach(t => t.classList.remove("active"));
                    this.classList.add("active");
                });
            });
        });
    </script>
@endsection
