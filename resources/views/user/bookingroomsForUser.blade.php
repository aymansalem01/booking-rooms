@extends('layouts.uerPage')

@section('content')

<div class="col-lg-12">
    <div class="breadcrumb-text" style="padding-bottom: 70px;">
        <h2>Reserved Rooms</h2>
        <div class="bt-option">
            <a href="{{route('home')}}">Home</a>
            <span>Reserved Rooms</span>
        </div>
    </div>
</div>

<!-- Reserved Rooms Section Begin -->
<section class="rooms-section spad">
    <div class="container">
        <div class="row">
            @foreach ($rooms as $room)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $room->name }}</h5>

                        @foreach ($room->booking as $booking)
                            @if ($booking->user_id == auth()->id())
                                @php
                                    $startDate = \Carbon\Carbon::parse($booking->start_date);
                                @endphp

                                <p class="card-text">Booking Date: {{ $startDate->format('Y-m-d') }}</p>

                                @if ($startDate->diffInDays(now()) > 2)
                                    <form action="{{ route('booking.cancel', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Cancel Booking</button>
                                    </form>
                                @else
                                    <p>Booking cannot be cancelled as it's too close to the date.</p>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
