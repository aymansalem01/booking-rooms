@extends('layouts.adminPage')
@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-purple fw-bold">{{ $room->name }}</h2>

    <div class="card shadow-lg border-0 rounded-lg">
        <div class="row g-0">
            <div class="col-md-5">
                <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($room->images as $key => $image)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100" alt="Room Image">
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <p><strong>Address:</strong> {{ $room->address }}</p>
                    <p><strong>Price:</strong> ${{ $room->price }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge {{ $room->status == 'va' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($room->status) }}
                        </span>
                    </p>
                    <p><strong>Count:</strong> {{ $room->count }}</p>
                    <p><strong>Description:</strong> {{ $room->description }}</p>

                    <a href="{{ route('room.edit', $room->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('room.destroy', $room->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
