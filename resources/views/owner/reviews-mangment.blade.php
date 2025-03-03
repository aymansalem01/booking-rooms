@extends('layouts.ownerPage')

@section('content')

<style>

    .search{

        display: flex;
        gap: 4px
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
color: #9282ffdd;
border: 1px solid #9282ffdd;
background-color: white;

}

.apply:hover {
border: 1px solid #9282ffdd;
background-color: #9282ffdd;
color: white
}

</style>
<div class="content">
    <div class="container mt-5">
        <div class="row justify-content-center" style="gap: 20px;">
        <h2 style="color: #777;  padding-bottom:50px" class="text-center text-purple fw-bold">Reviews Management</h2>
<div style="display:flex; flex-direction:column;">
        <form method="GET" action="{{ route('review.index') }}" class="row g-3 ">
            <div class="col-md-8 search">
                <input type="text" name="search" class="form-control searcTxt" placeholder="Search" value="{{ request('search') }}">
           
                <button type="submit" class="btn btn-primary me-2 adduser"><i class="fas fa-search"></i> Search</button>
            </div>
           
        </form>
        
        <div class="filter-container mb-4">
            <form method="GET" action="{{  route('review.index') }}" class="row g-3 filter">
                <div class="col-md-4">
                    <input placeholder="User Name" type="text" name="user_name" id="user_name" class="form-control" value="{{ request('user_name') }}">
                </div>
        
                <div class="col-md-4">
                    <label for="room_id" class="form-label">Room:</label>
                    <select name="room_id" id="room_id" class="form-select">
                        <option value="">All</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                                {{ $room->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
        
                <div class="col-md-4">
                    <label for="rate" class="form-label">Rating:</label>
                    <select name="rate" id="rate" class="form-select">
                        <option value="">All</option>
                        @for ($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" {{ request('rate') == $i ? 'selected' : '' }}>
                                {{ $i }} Stars
                            </option>
                        @endfor
                    </select>
                </div>
        
                
                <div class="col-12 text-center mt-3 search">
                    <button type="submit" class="btn btn-success px-4 apply"><i class="fas fa-filter"></i> Apply Filters</button>
                    
                <a href="{{  route('review.index') }}" class="btn btn-secondary"><i class="fas fa-sync-alt"></i> Reset</a>
                 
                </div>
            </form>
        </div>
        
</div>
            @if(isset($reviews) && count($reviews) > 0)
                @foreach ($reviews as $review)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="review-card">

                            <img src="{{ asset('images/'. $review->user->image) }}" alt="User Image" class="user-img">
                            <h5 class="user-name">{{ $review->user->name }}</h5>
                            <p class="user-rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="star {{ $i <= $review->rate ? 'filled' : 'unfilled' }}"><i class="fa-solid fa-star"></i>
                                            </span>
                                        @endfor

                                    </p>                            <p class="room-name">Room: {{ $review->room->name }}</p>
                            <div class="comment-box">
                                <p class="user-comment">{{ $review->comment }}</p>
                            </div>
                            <div class="action-buttons">
                            <a href="{{ route('review.show', $review->id) }}"  class="view-btn" >
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
        color: #aa248ddd;
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

