@extends('layouts.ownerPage')

@section('content')
<div class="content">
    <div class="container mt-5">
        <div class="row justify-content-center">
            @if(isset($booking))
                <div class="col-md-8 mb-5">
                    <div class="review-card">
                        <img src="{{ asset($booking->room->image) }}" alt="Room Image" class="room-img">
                        <h5 class="user-name">{{ $booking->room->name }}<span style="color:#B197FC"> {{ $booking->room->price }}$</span> </h5>
                        

                        <div class="review-content">
                            <div class="user-info">
                                <img src="{{ asset($booking->user->image) }}" alt="User Image" class="user-img">
                                <div>
                                    <h5 class="user-name">{{ $booking->user->name }} <small> ({{ $booking->user->id }})</small></h5>
                                    
                                </div>
                            </div>
                            <div class="comment-box">
                                <p class="user-comment">From ({{ $booking->start_date }}) to ({{ $booking->end_date }})</p><span style="color:#B197FC">Total: {{ $booking->total_price }}$</span>
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
