@extends('layouts.adminPage')

@section('content')
<div class="content">
    <div class="container mt-5">
        <div class="row justify-content-center" style="padding-left: 30%">
            @if(isset($review))
                <div class="col-md-8 mb-5">
                    <div class="review-card">
                        <img src="{{ asset('images/'. $review->room->image->first()->image) }}" alt="Room Image" class="room-img">

                        <div class="review-content">
                            <div class="user-info">
                                <img src="{{ asset('images/' . $review->user->image) }}" alt="User Image" class="user-img">
                                <div>
                                    <h5 class="user-name">{{ $review->user->name }} <small> ({{ $review->user->id }})</small></h5>
                                    <p class="user-rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="star {{ $i <= $review->rate ? 'filled' : 'unfilled' }}"><i class="fa-solid fa-star"></i>
                                            </span>
                                        @endfor

                                    </p>
                                </div>
                            </div>
                            <!-- Comment -->
                            <div class="comment-box">
                                <p class="user-comment">{{ $review->comment }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p class="no-reviews">Review not found!</p>
            @endif
        </div>
    </div>
</div>
@endsection

<style>
    .review-card {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .room-img {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }

    .review-content {
        padding: 20px;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 10px;
    }

    .user-img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
    }

    .user-name {
        font-size: 1.2em;
        font-weight: bold;
        color: #333;
    }

    .user-rating {
        font-size: 1em;
        font-weight: bold;
    }

    .star {
        font-size: 1.2em;
    }

    .filled {
        color: #FFD700;
    }

    .unfilled {
        color: #ccc;
    }

    .comment-box {
        background-color: #f8f9fa;
        border-left: 4px solid #B197FC;
        padding: 15px;
        border-radius: 8px;
    }

    .user-comment {
        font-size: 1em;
        color: #555;
        margin: 0;
    }

    .no-reviews {
        text-align: center;
        font-size: 1.2em;
        color: #777;
        margin-top: 20px;
    }
</style>
