@extends('layouts.uerPage')

@section('content')


    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>{{ $room->name }}</h2>
                        <div class="bt-option">
                            <a href="{{route('home')}}">Home</a>
                            <span>{{ $room->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Room Details Section Begin -->
    <section class="room-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="room-details-item">
                        <img id="main-room-image" style="margin-bottom: 5px" width="750" height="600" src="{{$room->image->first() ? asset('storage/images/'.$room->image->first()->image) : asset('path/to/default-image.jpg') }}" alt="">
                        <div class="room-thumbnails" style="margin-bottom: 0">
                            @foreach ($room->image as $key => $image)
                                <img class="thumbnail {{ $loop->first ? 'active' : '' }}"
                                     src="{{$room->image->first() ? asset('storage/images/'.$room->image->first()->image) : asset('path/to/default-image.jpg') }}"
                                     alt="" >
                            @endforeach
                        </div>
                        <div class="rd-text" style="margin-top: 1px">
                            <div class="rd-title">
                                <div class="rdt-right">
                                    @php
                                    $averageRating = $room->review->avg('rate');
                                    $fullStars = floor($averageRating);
                                    $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                                @endphp

                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $fullStars)
                                        <span class="fa fa-star checked"></span>
                                    @elseif ($halfStar && $i == $fullStars + 1)
                                        <span class="fa fa-star-half-alt checked"></span>
                                        @php $halfStar = 0; @endphp
                                    @else
                                        <span class="fa fa-star"></span>
                                    @endif
                                @endfor
                                    <a href="#">Booking Now</a>
                                </div>
                            </div>

                            <h2> @if ($room->discount > 0)
                                <span style="color: #999; text-decoration: line-through;">{{ $room->price }} JD</span>
                                {{ $room->price - ($room->discount * ($room->price/100)) }} JD
                            @else
                            {{ $room->price }} JD
                            <span>/Pernight</span></h2>
                            @endif

                            <table>
                                <tbody>
                                    <tr>
                                        <td class="r-o">Owner:</td>
                                        <td>{{ $room->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">category:</td>
                                        <td>{{ $room->category->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Location:</td>
                                        <td>{{ $room->address }}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Size:</td>
                                        <td>{{ $room->size }}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Capacity:</td>
                                        <td>{{ $room->capacity }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="f-para"> {{ $room->description }}. </p>
                        </div>
                    </div>

                          {{-- All Reviews for this Room--}}

                          <div class="rd-reviews">
                            <h4>Reviews</h4>
                            @foreach ($room->review as $review)
                                <div class="review-item">
                                    <div class="ri-pic">
                                        <img src="{{ $review->user->image ?? asset('img\room\avatar\default-avatar.webp') }}" alt="User Image">
                                    </div>
                                    <div class="ri-text">
                                        <span>{{ ($review->created_at)->format('d M Y') }}</span>
                                        <div class="rating">
                                            @for ($i = 1; $i <= $review->rate; $i++)
                                          <i class="icon_star"></i>
                                       @endfor
                                        </div>
                                        <h5>{{ $review->user->name }}</h5>
                                        <p>{{ $review->comment }}.</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>



                    <div class="review-add">
                        <h4>Add Review</h4>
                        <form action="#" class="ra-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Name*">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Email*">
                                </div>
                                <div class="col-lg-12">
                                    <div>
                                        <h5>You Rating:</h5>
                                        <div class="rating">
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star-half_alt"></i>
                                        </div>
                                    </div>
                                    <textarea placeholder="Your Review"></textarea>
                                    <button type="submit">Submit Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="room-booking">
                        <h3>Your Reservation</h3>
                        <form action="#">
                            <div class="check-date">
                                <label for="date-in">Check In:</label>
                                <input type="text" class="date-input" id="date-in">
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="check-date">
                                <label for="date-out">Check Out:</label>
                                <input type="text" class="date-input" id="date-out">
                                <i class="icon_calendar"></i>
                            </div>

                            <div class="select-option">
                                <label for="guest">Guests:</label>
                                <select id="guest">
                                    <option value="">3 Adults</option>
                                </select>
                            </div>
                            <div class="select-option">
                                <label for="room">Room:</label>
                                <select id="room">
                                    <option value="">1 Room</option>
                                </select>
                            </div>
                            <button type="submit">Check Availability</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Room Details Section End -->
<script>

document.addEventListener("DOMContentLoaded", function () {
    const thumbnails = document.querySelectorAll(".thumbnail");
    const mainImage = document.getElementById("main-room-image");

    thumbnails.forEach(thumb => {
        thumb.addEventListener("click", function () {
            mainImage.src = this.src;
            thumbnails.forEach(t => t.classList.remove("active"));
            this.classList.add("active");
        });
    });
});

</script>

@endsection
