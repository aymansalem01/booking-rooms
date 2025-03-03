@extends('layouts.adminPage')

@section('content')
<div class="content">
    <div class="container mt-5">
        <h2 style="color: #777" class="text-center text-purple fw-bold">Rooms Management</h2>

        <div class="filter-box">
            <form method="GET" action="{{ route('admin.search') }}" class="filter-form">
                <input type="hidden" name="page" value="rooms">
                
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="query" class="form-control" placeholder="Search rooms..." value="{{ request('query') }}">
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="av" {{ request('status') == 'av' ? 'selected' : '' }}>Available</option>
                            <option value="na" {{ request('status') == 'na' ? 'selected' : '' }}>Not Available</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="sort_by_price" class="form-control">
                            <option value="">Sort by Price</option>
                            <option value="asc" {{ request('sort_by_price') == 'asc' ? 'selected' : '' }}>Low to High</option>
                            <option value="desc" {{ request('sort_by_price') == 'desc' ? 'selected' : '' }}>High to Low</option>
                        </select>
                    </div>
                    <div class="col-md-2 text-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            @if($rooms->isEmpty())
                <p class="no-reviews">No rooms available.</p>
            @else
                @foreach($rooms as $room)
                <div class="col-md-6">
                    <div class="card room-card shadow-sm border-0 rounded-lg mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('images/' . $room->image->first()->image) }}" class="room-img rounded-start" alt="Room Image">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="fw-bold">{{ $room->name }}</h5>
                                    <p class="text-muted mb-2">
                                        <strong>Address:</strong> {{ $room->address }} <br>
                                        <strong>Price:</strong> {{ $room->price }} <br>
                                        <strong>Status:</strong>
                                        <span class="badge {{ $room->status == 'av' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $room->status == 'av' ? 'Available' : 'Not Available' }}
                                        </span> <br>
                                        <strong>Count:</strong> {{ $room->count }}
                                    </p>
                                    <div style="display: flex; gap:5px" class="d-flex">
                                        <a href="{{ route('adroom.show', $room->id) }}" class="btn btn-sm btn-info me-2">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('adroom.edit', $room->id) }}" class="btn btn-sm btn-warning me-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('adroom.destroy', $room->id) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete-btn">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>

        <div class="col-12 text-center mt-4">
            {{ $rooms->links() }}
        </div>
    </div>
</div>
@endsection

<style>
    .filter-box {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .filter-form .form-control {
        border-radius: 6px;
    }

    .no-reviews {
        text-align: center;
        font-size: 1.2em;
        color: #777;
        margin-top: 20px;
    }

    .room-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
    }

    .room-img {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function (event) {
                event.preventDefault();
                let form = this.closest("form");

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire({
                            title: "Deleted!",
                            text: "The room has been deleted.",
                            icon: "success"
                        });
                    }
                });
            });
        });
    });
</script>
