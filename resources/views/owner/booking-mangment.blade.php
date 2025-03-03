@extends('layouts.ownerPage')

@section('content')
<div class="content">
    <div class="container mt-5">
        <h2 style="color: #777" class="text-center text-purple fw-bold">Bookings Management</h2>
        <div class="row justify-content-center" style="gap: 20px;">
            @if($booking->isNotEmpty())
                @foreach ($booking as $book)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="review-card">
                            <img src="{{ asset('images/'. $book->room->image->first()->image) }}" alt="Room Image" class="review-image">
                            <h5 class="user-name">Room: {{ $book->room->name }}</h5>
                            <h5 class="user-name">User: {{ $book->user->name }}</h5>
                            <p class="user-rating">Start Date: {{ $book->start_date }}</p>
                            <p class="user-rating">End Date: {{ $book->end_date }}</p>
                            <p class="user-rating">Total Price: {{ $book->total_price }}</p>
                            <div class="action-buttons">
                            <a href="{{ route('booking.show', $book->id) }}"  class="view-btn" >
                            <i class="fas fa-eye"></i>
                        </a>
                                <form action="{{ route('booking.destroy', $book->id) }}" method="POST" onsubmit="return confirmDelete();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            @else
                <p class="no-reviews">No bookings available!</p>
            @endif
        </div>
        <div class="pagination-container">
        {{ $booking->links('pagination::bootstrap-4') }}
    </div>
    </div>
</div>
@endsection

<style>
    .review-card {
        width: 100%;
        max-width: 350px;
        padding: 20px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        transition: transform 0.3s ease-in-out;
        margin: 20px;
    }

    .review-card:hover {
        transform: translateY(-5px);
    }

    .review-image {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-bottom: 15px;
    }

    .user-name {
        font-size: 1.1em;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .user-rating {
        font-size: 1.1em;
        color: #B197FC;
        font-weight: bold;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-top: 10px;
    }

    .view-btn, .delete-btn {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .view-btn {
        color: #B197FC;
    }

    .view-btn:hover {
        color: #8c6efc;
    }

    .delete-btn {
        color: red;
    }

    .delete-btn:hover {
        color: darkred;
    }

    .no-reviews {
        text-align: center;
        font-size: 1.2em;
        color: #777;
        margin-top: 20px;
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
                            text: "The review has been deleted.",
                            icon: "success"
                        });
                    }
                });
            });
        });
    });
</script>
