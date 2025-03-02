@extends('layouts.adminPage')


@section('content')
<div class="container mt-4">
    <h2 style="color: #777" class="text-center text-purple fw-bold">{{ $rooms->name }}</h2>

    <div style="padding: 40px" class="card shadow-lg border-0 rounded-lg">
        <div class="row g-0">
            <div class="col-md-5">
                <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        {{-- @foreach($rooms->images as $key => $image)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100" alt="Room Image">
                        </div>
                        @endforeach --}}
                    </div>
                    {{-- <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button> --}}
                </div>
            </div>
            <div class="col-md-7">
                <div class="card-body">
                <p><strong>Owner:</strong> {{ $rooms->user->name }}</p>
                <p><strong>Type:</strong> {{ $rooms->category->name }}</p>


                    <p><strong>Address:</strong> {{ $rooms->address }}</p>
                    <p><strong>Price:</strong> ${{ $rooms->price }}</p>
                    <p><strong>Discount:</strong> ${{ $rooms->discount }}</p>
                    <p><strong>Total Price:</strong> ${{ $rooms->total_price }}</p>


                    <p><strong>Status:</strong> 
                        <span class="badge {{ $rooms->status == 'av' ? 'bg-success' : 'bg-danger' }}">
                            {{ $rooms->status == 'av' ? 'Avalible' : 'Not Avalible' }}
                            {{ ucfirst($rooms->status) }}
                        </span>
                    </p>
                    <p><strong>Count:</strong> {{ $rooms->count }}</p>
                    <p><strong>Size:</strong> {{ $rooms->size}}</p>
                    <p><strong>Capicity:</strong> {{ $rooms->capacity}}</p>

                    <p><strong>Description:</strong> {{ $rooms->description }}</p>
<div style="display: flex; gap:7px;">
                    <a href="{{ route('room.edit', $rooms->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('room.destroy', $rooms->id) }}" method="POST" class="d-inline-block">
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
</div>
@endsection
