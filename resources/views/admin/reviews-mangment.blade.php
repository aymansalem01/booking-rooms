@extends('layouts.adminPage')

@section('content')

<div class="content">
    <div class="container mt-5">
        <div class="row justify-content-center">
        @foreach ($reviews as $review)
    <div class="col-md-3 col-sm-6 mb-4">
        <div style="width: 100%; max-width: 300px; margin: 0 auto; padding: 20px; background-color: #fff; border-radius: 10px; box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1); display: flex; flex-direction: column; align-items: center; text-align: center;">
            <img src="{{ asset('assets/images/user.png') }}" alt="User Image" style="width: 80px; height: 80px; border-radius: 50%; margin-bottom: 15px;">
            <div style="display: flex; flex-direction: column; align-items: center; flex-grow: 1;">
                <h5 style="font-weight: bold; color: #333;">{{ $review->user->name }}</h5>
                <p style="color: #f39c12; font-size: 1.2em; margin-bottom: 10px;">{{ $review->rate }} Stars</p>
                <p style="color: #777; margin-top: auto;">{{ $review->comment }}</p>
            </div>
            <div style="display: flex; gap: 15px; justify-content: center; margin-top: 10px;">
                <i class="fa-solid fa-trash" style="font-size: 20px; cursor: pointer; color: red;"></i>
                <i class="fa-solid fa-eye" style="font-size: 20px; cursor: pointer; color: #B197FC;"></i>
            </div>
        </div>
    </div>
@endforeach

@if(isset($reviews))
    <p>Reviews are available!</p>
@else
    <p>No reviews available!</p>
@endif

        </div>
    </div>
</div>

@endsection
