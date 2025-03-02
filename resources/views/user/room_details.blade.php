@extends('layouts.uerPage')

@section('content')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        .rating input[type="radio"] {
            display: none;
        }

        .rating i {
            font-size: 30px;
            color: #ccc;
        }

        .rating input[type="radio"]:checked~label i {
            color: #ffcc00;
        }

        .rating label {
            cursor: pointer;
        }

        .rating label i {
            transition: color 0.3s ease;
        }
    </style>
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>{{ $room->name }}</h2>
                        <div class="bt-option">
                            <a href="{{ route('home') }}">Home</a>
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
                        <img id="main-room-image" style="margin-bottom: 5px" width="750" height="600"
                            src="{{ asset('/images/' . $room->image->first()) }}" alt="">
                        <div class="room-thumbnails" style="margin-bottom: 0">
                            @foreach ($room->image as $key => $image)
                                <img class="thumbnail {{ asset('/images/' . $loop->first) }}"
                                    src="{{ $room->image->first() ? asset('storage/images/' . $room->image->first()->image) : asset('path/to/default-image.jpg') }}"
                                    alt="">
                            @endforeach
                        </div>
                        <div class="rd-text" style="margin-top: 1px">
                            <div class="rd-title">
                                <div class="rdt-right">
                                    @php
                                        $averageRating = $room->review->avg('rate');
                                        $fullStars = floor($averageRating);
                                        $halfStar = $averageRating - $fullStars >= 0.5 ? 1 : 0;
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

                            <h2>
                                @if ($room->discount > 0)
                                    <span style="color: #999; text-decoration: line-through;">{{ $room->price }} JD</span>
                                    {{ $room->price - $room->discount * ($room->price / 100) }} JD
                                @else
                                    {{ $room->price }} JD
                                    <span>/Pernight</span>
                            </h2>
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

                    {{-- All Reviews for this Room --}}

                    <div class="rd-reviews">
                        <h4>Reviews</h4>
                        @foreach ($room->review as $review)
                            <div class="review-item">
                                <div class="ri-pic">
                                    <img src="{{ asset('/images/' . $review->user->image) }}" alt="User Image">
                                </div>
                                <div class="ri-text">
                                    <span>{{ $review->created_at->format('d M Y') }}</span>
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
                        @if (session('message'))
                        <div class="alert alert-primary">
                            {{ session('message') }}
                        </div>
                    @endif
                        <h4>Add Review</h4>
                        <form action="{{ route('review', $room->id) }}" method="post" class="ra-form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Name*" name="name" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" placeholder="Email*" name="email" required>
                                </div>
                                <div class="col-lg-12">
                                    <div>
                                        <h5>Your Rating:</h5>
                                        <div class="rating">
                                            <label for="star5">
                                                <input type="radio" id="star5" name="rate" value="5">
                                                <i class="icon_star"></i>
                                            </label>
                                            <label for="star4">
                                                <input type="radio" id="star4" name="rate" value="4">
                                                <i class="icon_star"></i>
                                            </label>
                                            <label for="star3">
                                                <input type="radio" id="star3" name="rate" value="3">
                                                <i class="icon_star"></i>
                                            </label>
                                            <label for="star2">
                                                <input type="radio" id="star2" name="rate" value="2">
                                                <i class="icon_star"></i>
                                            </label>
                                            <label for="star1">
                                                <input type="radio" id="star1" name="rate" value="1">
                                                <i class="icon_star"></i>
                                            </label>
                                        </div>
                                    </div>
                                    <textarea placeholder="Your Review" name="comment" required></textarea>
                                    <button type="submit">Submit Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="room-booking">
                        <h3>Your Reservation</h3>
                        <form id="booking-form" method="post" action="{{ route('book', $room->id) }}">
                            @csrf
                            <div class="check-date">
                                <label for="date-in">Check In:</label>
                                <input type="date" class="date-input" name="start_date" id="date-in" required>
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="check-date">
                                <label for="date-out">Check Out:</label>
                                <input type="date" class="date-input" name="end_date" id="date-out" required>
                                <i class="icon_calendar"></i>
                            </div>
                            @if (session('booking'))
                                <div class="alert alert-danger">
                                    {{ session('booking') }}
                                </div>
                            @endif
                            <div class="select-option">
                                <label for="guest">Guests:</label>
                                <select id="guest" name="guests">
                                    <option value="1">1 Adult</option>
                                    <option value="2">2 Adults</option>
                                    <option value="3">3 Adults</option>
                                </select>
                            </div>
                            <button type="submit">Booking</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Room Details Section End -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const thumbnails = document.querySelectorAll(".thumbnail");
            const mainImage = document.getElementById("main-room-image");

            thumbnails.forEach(thumb => {
                thumb.addEventListener("click", function() {
                    mainImage.src = this.src;
                    thumbnails.forEach(t => t.classList.remove("active"));
                    this.classList.add("active");
                });
            });
        });
        $(document).ready(function() {
            let roomId = "{{ $room->id }}";

            $.getJSON(`/get-booked-dates/${roomId}`, function(bookedDates) {
                function disableBookedDates(date) {
                    let dateString = $.datepicker.formatDate("yy-mm-dd", date);
                    return [!bookedDates.includes(dateString)];
                }

                $("#date-in, #date-out").datepicker({
                    dateFormat: "yy-mm-dd",
                    beforeShowDay: disableBookedDates,
                    minDate: 0,
                    onSelect: function(selectedDate) {
                        let option = this.id == "date-in" ? "minDate" : "maxDate",
                            instance = $(this).data("datepicker"),
                            date = $.datepicker.parseDate(instance.settings.dateFormat || $
                                .datepicker._defaults.dateFormat, selectedDate, instance
                                .settings);
                        $("#date-out").datepicker("option", option, date);
                    }
                });
            });
        });
    </script>
@endsection
