@extends('layouts.ownerPage')

@section('content')

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

    .search, .filter {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .searcTxt {
        width: 100%; /* Making it take full width */
    }

    .num {
        width: 100%;
    }

    .adduser {
        background-color: #9282ffdd !important;
        border: 1px solid #9282ffdd !important;
        color: white !important;
        width: 100%;
        margin-left: 20px;
    }

    .adduser:hover {
        border: 1px solid #9282ffdd !important;
        color: #9282ffdd !important;
        background-color: white !important;
    }

    .apply {
        background-color: #9282ffdd;
        border: 1px solid #9282ffdd;
        color: white;
        padding: 8px 20px;
    }

    .apply:hover {
        background-color: white;
        border-color: #9282ffdd;
        color: #9282ffdd;
    }

    .reset-btn {
        background-color: white !important;
        border: 1px solid #ddd;
        color: #9282ffdd !important;
        width: auto;
    }

    .reset-btn:hover {
        background-color: #9282ffdd;
        border-color: #9282ffdd;
        color: white;
    }

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
        color: #e95ecbdd;
    }

    .delete-btn:hover {
        color: #d14db4dd;
    }

    .no-reviews {
        text-align: center;
        font-size: 1.2em;
        color: #777;
        margin-top: 20px;
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

<div class="content">
    <div class="container mt-5">
        <h2 style="color: #777; padding-bottom: 50px" class="text-center text-purple fw-bold">Bookings Management</h2>

        <div class="filter-box">
            <form method="GET" action="{{ route('booking.index') }}" class="filter-form">
                <div class="row">
                    <div class="col-md-8 search">
                        <input type="text" name="search" class="form-control searcTxt" placeholder="Search" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4 filter">
                        <button type="submit" class="btn btn-success px-4 apply">Filters</button>
                        <a href="{{ route('booking.index') }}" class="btn btn-secondary reset-btn"><i class="fas fa-sync-alt"></i> Reset</a>
                    </div>
                </div>
            </form>

            <form method="GET" action="{{ route('booking.index') }}" class="filter-form">
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" name="user_name" id="user_name" class="form-control" placeholder="User Name" value="{{ request('user_name') }}">
                    </div>

                    <div class="col-md-2">
                        <select name="room_id" id="room_id" class="form-control">
                            <option value="">All</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                                    {{ $room->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>

                    <div class="col-md-2">
                        <input type="number" name="total_price" id="total_price" class="form-control" placeholder="Min Price" value="{{ request('total_price') }}">
                    </div>
                </div>
            </form>
        </div>

        <div class="row justify-content-center" style="gap: 20px;">
            @if($booking->isNotEmpty())
                @foreach ($booking as $book)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="review-card">
                            <img src="{{ asset('images/'. $book->room->image->first()->image) }}" alt="Room Image" class="review-image">
                            <h5 class="user-name">Room: {{ $book->room->name }}</h5>
                            <h5 class="user-name">User: {{ $book->user->name }}</h5>
                            <p class="user-rating"><span class="user-name">Start Date:</span> {{ $book->start_date }}</p>
                            <p class="user-rating"><span class="user-name">End Date:</span>{{ $book->end_date }}</p>
                            <p class="user-rating"><span class="user-name">Total Price:</span> {{ $book->total_price }}</p>
                            <div class="action-buttons">
                                <a href="{{ route('booking.show', $book->id) }}" class="view-btn"><i class="fas fa-eye"></i></a>
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
                            text: "The booking has been deleted.",
                            icon: "success"
                        });
                    }
                });
            });
        });
    });
</script>
