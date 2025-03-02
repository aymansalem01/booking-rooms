@extends('layouts.adminPage')

@section('content')

<div class="container mt-4" style="min-height: 100vh;
        display: flex;
        flex-direction: column;">
    <h2 style="color: #777; padding-bottom:40px" class="text-center text-purple fw-bold">Rooms Management</h2>

    <div class="row">
        @if($rooms->isEmpty())
            <p class="text-center text-muted">No rooms available.</p>
        @else
            @foreach($rooms as $room)
            <div class="col-md-6">
                <div class="card room-card shadow-sm border-0 rounded-lg mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('assets/img/' . $room->image) }}" class="room-img rounded-start" alt="Room Image">
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
    <div class="pagination-container">
        {{ $rooms->links('pagination::bootstrap-4') }}
    </div>
</div>

<style>
.room-card {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    transition: 0.3s ease-in-out;
    padding: 30px;
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

@endsection
