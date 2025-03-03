@extends('layouts.adminPage')

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
@section('content')
    <div class="container mt-4">
        <h2 style="color: #777" class="text-center text-purple fw-bold">{{ $rooms->name }}</h2>

        <div style="padding: 40px" class="card shadow-lg border-0 rounded-lg">
            <div class="row g-0">
                <div class="col-md-5">
                    <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            {{-- @foreach ($rooms->images as $key => $image)
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
                        <p><strong>Size:</strong> {{ $rooms->size }}</p>
                        <p><strong>Capicity:</strong> {{ $rooms->capacity }}</p>

                        <p><strong>Description:</strong> {{ $rooms->description }}</p>
                        <img id="main-room-image" style="margin-bottom: 5px" width="750" height="600"
                            src="{{ asset('images/' . $rooms->image->first()->image) }}" alt="">
                        <div class="room-thumbnails" style="margin-bottom: 0">
                            @foreach ($rooms->image as $key => $image)
                                <img class="thumbnail" src="{{ asset('images/' . $image->image) }}" alt="">
                            @endforeach
                        </div>
                        <div style="display: flex; gap:7px;">
                            <a href="{{ route('adroom.edit', $rooms->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('adroom.destroy', $rooms->id) }}" method="POST" class="d-inline-block">
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
