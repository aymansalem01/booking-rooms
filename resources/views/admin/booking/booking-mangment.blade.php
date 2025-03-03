@extends('layouts.adminPage')

@section('content')
<div class="content">
    <div class="container mt-5">
        <h2 style="color: #777" class="text-center text-purple fw-bold">Bookings Management</h2>

        <div class="filter-box">
            <form action="{{ route('admin.search') }}" method="GET" class="filter-form">
                <input type="hidden" name="page" value="booking">
                <div class="row">
                    <div class="col-md-3">
                        <select name="sort_by_date" class="form-control">
                            <option value="">Sort by Date</option>
                            <option value="asc" {{ request('sort_by_date') == 'asc' ? 'selected' : '' }}>Oldest to Newest</option>
                            <option value="desc" {{ request('sort_by_date') == 'desc' ? 'selected' : '' }}>Newest to Oldest</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="sort_by_price" class="form-control">
                            <option value="">Sort by Price</option>
                            <option value="asc" {{ request('sort_by_price') == 'asc' ? 'selected' : '' }}>Lowest to Highest</option>
                            <option value="desc" {{ request('sort_by_price') == 'desc' ? 'selected' : '' }}>Highest to Lowest</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="sort_by_total_price" class="form-control">
                            <option value="">Sort by Total Price</option>
                            <option value="asc" {{ request('sort_by_total_price') == 'asc' ? 'selected' : '' }}>Lowest to Highest</option>
                            <option value="desc" {{ request('sort_by_total_price') == 'desc' ? 'selected' : '' }}>Highest to Lowest</option>
                        </select>
                    </div>
                    <div class="col-md-3 text-end">
                        <button type="submit" class="btn btn-primary">Sort</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row justify-content-center" style="gap: 20px;">
            @if($booking->isNotEmpty())
                @foreach ($booking as $book)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="review-card">
                            <img src="{{ asset('images/' . $book->room->image->first()->image) }}" alt="Room Image" class="review-image">
                            <h5 class="user-name">Room: {{ $book->room->name }}</h5>
                            <h5 class="user-name">User: {{ $book->user->name }}</h5>
                            <p class="user-rating">Start Date: {{ $book->start_date }}</p>
                            <p class="user-rating">End Date: {{ $book->end_date }}</p>
                            <p class="user-rating"> Price: {{ $book->price }}</p>
                            <p class="user-rating">Total Price: {{ $book->total_price }}</p>
                            <div class="action-buttons">
                                <form action="{{ route('adbooking.destroy', $book->id) }}" method="POST" onsubmit="return confirmDelete();">
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
        width: 100%;
        height: auto;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .user-name {
        font-size: 1.2em;
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

    .delete-btn {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        transition: color 0.3s ease;
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
