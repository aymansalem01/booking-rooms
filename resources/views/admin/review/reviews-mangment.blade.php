@extends('layouts.adminPage')

@section('content')
<div class="content">
    <style>

        .search{

            display: flex;
            gap: 4px;
            flex-direction: row-reverse;
            padding-right: 30px
        }
        .filter{

            display: flex;
            align-items: center

        }
      
        .searcTxt{

            width: 52%;
        }
        .num{
            width: 40%
        }

        .adduser {
background-color: #9282ffdd;
border: 1px solid #9282ffdd;
color: white;
width: 20%;

}

.adduser:hover {
border: 1px solid #9282ffdd;
color: #9282ffdd;
}
        .apply {
            background-color: #9282ffdd;
border: 1px solid #9282ffdd;
color: white;

}

.apply:hover {
border: 1px solid #9282ffdd;
color: #9282ffdd;
background-color: white
}

    </style>
    <div class="container mt-5">
        <h2 style="color: #777; padding-bottom:40px" class="text-center text-purple fw-bold">Reviews Management</h2>

        <div class="filter-box">
            <form method="GET" action="{{ route('admin.search') }}" class="filter-form">
                <input type="hidden" name="page" value="reviews">

                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="query" class="form-control" placeholder="Search reviews..." value="{{ request('query') }}">
                    </div>
                    <div class="col-md-2">
                        <select name="sort_by_rating" class="form-control">
                            <option value="">Sort by Rating</option>
                            <option value="asc" {{ request('sort_by_rating') == 'asc' ? 'selected' : '' }}>Low to High</option>
                            <option value="desc" {{ request('sort_by_rating') == 'desc' ? 'selected' : '' }}>High to Low</option>
                        </select>
                    </div>
                    {{-- <div class="col-md-2 text-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div> --}}
                    <div class="col-12 text-center mt-3 search">
                        <a href="{{ route('adreview.index') }}" class="btn btn-secondary"><i class="fas fa-sync-alt"></i> Reset</a>
                        <button type="submit" class="btn btn-success px-4 apply"><i class="fas fa-filter"></i> Apply Filters</button>
                        
                    
                     
                    </div>
                </div>
            </form>
        </div>

        <div class="row justify-content-center" style="gap: 20px;">
            @if(isset($reviews) && count($reviews) > 0)
                @foreach ($reviews as $review)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="review-card">
                            <img src="{{ asset('images/'.$review->user->image) }}" alt="User Image" class="user-img">
                            <h5 class="user-name">{{ $review->user->name }}</h5>
                            <p class="user-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="star {{ $i <= $review->rate ? 'filled' : 'unfilled' }}">
                                        <i class="fa-solid fa-star"></i>
                                    </span>
                                @endfor
                            </p>
                            <p class="room-name">Room: {{ $review->room->name }}</p>
                            <div class="comment-box">
                                <p class="user-comment">{{ $review->comment }}</p>
                            </div>
                            <div class="action-buttons">
                                <a href="{{ route('adreview.show', $review->id) }}" class="view-btn">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <form action="{{ route('review.destroy', $review->id) }}" method="POST" onsubmit="return confirmDelete();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="no-reviews">No reviews available!</p>
            @endif
        </div>

        <div class="pagination-container">
            {{ $reviews->links('pagination::bootstrap-4') }}
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

    .user-img {
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
        font-size: 1.2em;
        color: #B197FC;
        font-weight: bold;
    }

    .room-name {
        font-size: 1em;
        color: #666;
        margin: 10px 0;
    }

    .comment-box {
        background-color: #f8f9fa;
        border-left: 4px solid #B197FC;
        padding: 10px;
        border-radius: 8px;
        width: 100%;
        margin-bottom: 10px;
    }

    .user-comment {
        font-size: 0.95em;
        color: #555;
        margin: 0;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
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
        color: #cd44afdd;
    }

    .no-reviews {
        text-align: center;
        font-size: 1.2em;
        color: #777;
        margin-top: 20px;
    }

    .filled {
        color: #FFD700;
    }

    .unfilled {
        color: #ccc;
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
