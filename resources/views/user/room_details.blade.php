@extends('layouts.uerPage')

@section('content')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        .rate {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
            padding: 10px 0;
        }

        .rate input {
            display: none;
        }

        .rate label {
            font-size: 30px;
            color: #ccc;
            cursor: pointer;
            transition: color 0.3s;
        }

        .rate input:checked~label,
        .rate label:hover,
        .rate label:hover~label {
            color: #ffc700;
        }

        .popup {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%) scale(0.9);
            background: white;
            padding: 25px;
            width: 380px;
            border-radius: 12px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            opacity: 0;
            transition: all 0.3s ease-in-out;
        }

        .popup.show {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
            display: block;
        }


        .popup-content {
            text-align: center;
        }

        .popup-content h3 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #222;
        }

        .popup-content label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin: 10px 0 5px;
            color: #555;
            text-align: left;
        }

        .popup-content input {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: border 0.3s ease-in-out;
            background: #f8f8f8;
        }

        .popup-content input:focus {
            border-color: #6f42c1;
            background: #fff;
        }

        #confirm-payment {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background-color: #6f42c1;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 15px;
            transition: all 0.3s ease-in-out;
        }

        #confirm-payment:hover {
            background-color: #5a3791;
        }

        #close-popup {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            font-weight: bold;
            color: #333;
            background: #eee;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 8px;
            transition: all 0.3s ease-in-out;
        }

        #close-popup:hover {
            background: #f30000;
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
                            src="{{ asset('images/' . $room->image->first()->image) }}" alt="">
                        <div class="room-thumbnails" style="margin-bottom: 0">
                            @foreach ($room->image as $key => $image)
                                <img class="thumbnail" src="{{ asset('images/' . $image->image) }}" alt="">
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
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="5 stars">★</label>

                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="4 stars">★</label>

                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="3 stars">★</label>

                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="2 stars">★</label>

                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="1 star">★</label>
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
                                <input type="inpute" class="date-input" name="start_date" id="date-in"
                                    placeholder="MM/DD/YYYY" required>
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="check-date">
                                <label for="date-out">Check Out:</label>
                                <input type="input" class="date-input" name="end_date" id="date-out"
                                    placeholder="MM/DD/YYYY" required>
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
    <div id="payment-popup" class="popup">
        <div class="popup-content">
            <h3>Enter Payment Details</h3>
            <label for="card-number">Card Number:</label>
            <input type="text" id="card-number" required>

            <label for="expiry-date">Expiry Date:</label>
            <input type="month" id="expiry-date" required>

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" required>

            <button id="confirm-payment">Confirm Payment</button>
            <button id="close-popup">Cancel</button>
        </div>
    </div>
    <!-- Room Details Section End -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".rate label");
    const inputs = document.querySelectorAll(".rate input");

    stars.forEach((star) => {
        star.addEventListener("mouseover", function () {
            highlightStars(this);
        });

        star.addEventListener("mouseout", function () {
            resetStars();
        });

        star.addEventListener("click", function () {
            persistHighlight(this);
        });
    });

    function highlightStars(star) {
        resetStars();
        let starValue = star.getAttribute("for").replace("star", "");
        stars.forEach((s) => {
            if (s.getAttribute("for").replace("star", "") <= starValue) {
                s.style.color = "#ffc700";
            }
        });
    }

    function resetStars() {
        stars.forEach((s) => {
            s.style.color = "#ccc";
        });
        const checkedStar = document.querySelector(".rate input:checked");
        if (checkedStar) {
            persistHighlight(document.querySelector(`label[for="${checkedStar.id}"]`));
        }
    }

    function persistHighlight(star) {
        let starValue = star.getAttribute("for").replace("star", "");
        stars.forEach((s) => {
            if (s.getAttribute("for").replace("star", "") <= starValue) {
                s.style.color = "#ffc700";
            }
        });
    }
});






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
            $(document).ready(function() {
                $("#booking-form").submit(function(event) {
                    event.preventDefault();
                    $("#payment-popup").addClass("show");
                });

                $("#confirm-payment").click(function() {
                    let cardNumber = $("#card-number").val();
                    let expiryDate = $("#expiry-date").val();
                    let cvv = $("#cvv").val();

                    if (cardNumber && expiryDate && cvv) {
                        $("#payment-popup").removeClass("show");
                        $("#booking-form").off("submit").submit();
                    } else {
                        alert("Please enter payment details.");
                    }
                });

                $("#close-popup").click(function() {
                    $("#payment-popup").removeClass("show");
                });
            });
        });
    </script>
@endsection
