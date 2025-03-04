@extends('layouts.uerPage')

@section('content')
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>


    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero-text">
                        <h1>Escape Reality</h1>
                        <p>Here are the best room booking sites, including discounts and fun rooms.</p>
                        <a href="{{route('store.index')}}" class="primary-btn">Discover Now</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="img/hero/room1.webp"></div>
            <div class="hs-item set-bg" data-setbg="img/hero/index1.webp"></div>
            <div class="hs-item set-bg" data-setbg="img/hero/ice1.webp"></div>
        </div>
    </section>
    <div class="space">

    </div>

    <!-- Hero Section End -->

    <!-- About Us Section Begin -->
    <div class="spad">
        <div class="container">
            <div class="about-text">
                <div class="section-title">
                    <span>About Us</span>
                </div>
                <p class="f-para">Escape Reality offers an unforgettable experience with themed rooms that transport you to
                    another world. From space adventures to magical snow and water realms, our rooms are designed to immerse
                    you in fun and excitement. Book your adventure today and escape into a reality like no other!</p>
                <a href="{{ route('about') }}" class="primary-btn about-btn">Read More</a>
            </div>
        </div>
    </div>
    <!-- About Us Section End -->

    <!-- Services Section End -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>What We Do</span>
                        <h2>Discover Our Services</h2>
                    </div>
                </div>
            </div>
            <div class="custom-row">
                <div class="custom-col">
                    <a href="{{ route('room.category', ['id' => 1]) }}">
                        <div class="custom-service-item">
                            <i class="fas fa-ghost" style="color: #ff4c4c;"></i> <!-- Horror Room Icon -->
                            <h4>Horror</h4>
                            <p>The horror room offers you an experience filled with excitement and suspense.</p>
                        </div>
                    </a>
                </div>
                <div class="custom-col">
                    <a href="{{ route('room.category', ['id' => 2]) }}">
                        <div class="custom-service-item">
                            <i class="fas fa-spa" style="color: #4c9aff;"></i> <!-- Relaxation Room Icon -->
                            <h4>Relaxation</h4>
                            <p>The relaxation room offers a peaceful and calming experience, away from stress.</p>
                        </div>
                    </a>
                </div>
                <div class="custom-col">
                    <a href="{{ route('room.category', ['id' => 3]) }}">
                        <div class="custom-service-item">
                            <i class="fas fa-fire" style="color: #ff9500;"></i> <!-- Fire Room Icon -->
                            <h4>Fire</h4>
                            <p>The fire room provides a warm and thrilling experience with hot vibes.</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="custom-row">
                <div class="custom-col">
                    <a href="{{ route('room.category', ['id' => 4]) }}">
                        <div class="custom-service-item">
                            <i class="fas fa-snowflake" style="color: #00aaff;"></i> <!-- Snow Room Icon -->
                            <h4>Snow</h4>
                            <p>The snow room offers a cold and refreshing atmosphere for a unique experience.</p>
                        </div>
                    </a>
                </div>
                <div class="custom-col">
                    <a href="{{ route('room.category', ['id' => 5]) }}">
                        <div class="custom-service-item">
                            <i class="fas fa-female" style="color: #ff66b3;"></i> <!-- Women Room Icon -->
                            <h4>Women</h4>
                            <p>The women’s room offers privacy and comfort for women.</p>
                        </div>
                    </a>
                </div>
                <div class="custom-col">
                    <a href="{{ route('room.category', ['id' => 6]) }}">
                        <div class="custom-service-item">
                            <i class="fas fa-paw" style="color: #4caf50;"></i> <!-- Pets Room Icon -->
                            <h4>Pets</h4>
                            <p>The pet room is designed for the comfort of pets and their owners.</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
        </div>



        </div>
        </div>

        </div>
    </section>
    <!-- Services Section End -->

    <!-- Home Room Section Begin -->
    <section class="hp-room-section">
        <div class="container-fluid">
            <div class="hp-room-items">
                <div class="row">
                    @foreach ($rooms as $room)
                        <div class="col-lg-3 col-md-6">
                            <div class="hp-room-item set-bg"
                                data-setbg="{{ asset('images/' . $room->image->first()->image) }}">
                                <div class="hr-text">
                                    <h3>{{ $room->name }}</h3>
                                    <h2>
                                        @if ($room->discount > 0)
                                            <span style="color: #999; text-decoration: line-through;">{{ $room->price }}
                                                JD</span>
                                            {{ $room->price - $room->discount * ($room->price / 100) }} JD
                                        @else
                                            {{ $room->price }} JD
                                        @endif
                                        <span>/Pernight</span>
                                    </h2>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="r-o">Size:</td>
                                                <td>{{ $room->size }} ft</td>
                                            </tr>
                                            <tr>
                                                <td class="r-o">Category:</td>
                                                <td> {{ $room->category->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="r-o">Capacity:</td>
                                                <td>Max {{ $room->capacity }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="rating" style="margin-bottom: 10px;">
                                        @php
                                            $averageRating = $room->review->avg('rate') ?? 0;
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
                                    </div>
                                    <a href="{{ route('store.show', $room->id) }}" class="primary-btn">More Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <!-- Home Room Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Rooms For Rent</span>
                        <h2> Escape Reality Where Imagination Knows No Limits </h2>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="testimonial-slider owl-carousel">

                        @foreach ($rooms as $room)

                                @php
                                    $review = $room->review->sortByDesc('rate')->first();
                                @endphp
                                <div class="ts-item">
                                    @if ($review && $review->count() > 0)
                                    <p>{{ $review->comment }}.</p>
                                    <div class="ti-author" style="display: flex; align-items: center;">
                                        <div class="rating">
                                            @for ($i = 1; $i <= $review->rate; $i++)
                                                <i class="icon_star"></i>
                                            @endfor
                                        </div>
                                        <h5 style="margin-left: 10px;">- {{ $review->user->name }}</h5>
                                        <img src="{{ asset('images/' . $review->user->image) }}" alt="User Image"
                                            style="width: 50px; height: 50px; border-radius: 50%; margin-left: 10px;">
                                    </div>
                                </div>
                                @endif
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Testimonial Section End -->
@endsection
