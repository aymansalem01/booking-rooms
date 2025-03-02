@extends('layouts.ownerPage')

@section('content')
<div class="content">
    <div class="container mt-5">
        <div class="row justify-content-center" style="gap: 20px;">
        <h2 style="color: #777" class="text-center text-purple fw-bold">Reviews Management</h2>

            @if(isset($reviews) && count($reviews) > 0)
                @foreach ($reviews as $review)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="review-card">
                            
                            <img src="{{ asset($review->user->image) }}" alt="User Image" class="user-img">
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

