@extends('layouts.uerPage')

@section('content')

  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
</div>


<!-- Hero Section Begin -->
<section class="hero-section">
    <div class="container">
        <div class="row" >
            <div class="col-lg-12">
                <div class="hero-text" >
                    <h1 >Escape Reality</h1>
                    <p >Here are the best room booking sites, including discounts and fun rooms.</p>
                    <a href="#" class="primary-btn">Discover Now</a>
                </div>
            </div>

        </div>
    </div>
    <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="img/hero/room1.webp" ></div>
            <div class="hs-item set-bg" data-setbg="img/hero/index1.webp"></div>
            <div class="hs-item set-bg" data-setbg="img/hero/ice1.webp"></div>
        </div>
</section>
<div class="space" >

</div>

<!-- Hero Section End -->

<!-- About Us Section Begin -->
<div class="spad">
    <div class="container">
                <div class="about-text">
                    <div class="section-title">
                        <span>About Us</span>
                    </div>
                    <p class="f-para">Escape Reality offers an unforgettable experience with themed rooms that transport you to another world. From space adventures to magical snow and water realms, our rooms are designed to immerse you in fun and excitement. Book your adventure today and escape into a reality like no other!</p>
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
                        <i class="fas fa-ghost" style="color: #ff4c4c;"></i>  <!-- Horror Room Icon -->
                        <h4>Horror</h4>
                        <p>The horror room offers you an experience filled with excitement and suspense.</p>
                    </div>
                </a>
            </div>
            <div class="custom-col">
                <a href="{{ route('room.category', ['id' => 2]) }}">
                    <div class="custom-service-item">
                        <i class="fas fa-spa" style="color: #4c9aff;"></i>  <!-- Relaxation Room Icon -->
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
                        <i class="fas fa-snowflake" style="color: #00aaff;"></i>  <!-- Snow Room Icon -->
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
            <div class="row" >
                @foreach ($rooms as $room)
                <div class="col-lg-3 col-md-6">
                    <div class="hp-room-item set-bg" data-setbg="{{ $room->image->first() ? asset('storage/images/'.$room->image->first()->image) : asset('path/to/default-image.jpg') }}">
                        <div class="hr-text">
                            <h3>{{ $room->name }}</h3>
                            <h2>
                                @if ($room->discount > 0)
                                    <span style="color: #999; text-decoration: line-through;">{{ $room->price }} JD</span>
                                    {{ $room->price - ($room->discount * ($room->price / 100)) }} JD
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
                                        <td class="r-o">Capacity:</td>
                                        <td>Max person {{ $room->capacity }}</td>
                                    </tr>
                                </tbody>
                            </table>
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
                    <span>Testimonials</span>
                    <h2>Rooms On Sale</h2>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="testimonial-slider owl-carousel">
                    <div class="ts-item">
                        <p>After a construction project took longer than expected, my husband, my daughter and I
                            needed a place to stay for a few nights. As a Chicago resident, we know a lot about our
                            city, neighborhood and the types of housing options available and absolutely love our
                            vacation at Sona Hotel.</p>
                        <div class="ti-author">
                            <div class="rating">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star-half_alt"></i>
                            </div>
                            <h5> - Alexander Vasquez</h5>
                        </div>
                        <img src="img/testimonial-logo.png" alt="">
                    </div>
                    <div class="ts-item">
                        <p>After a construction project took longer than expected, my husband, my daughter and I
                            needed a place to stay for a few nights. As a Chicago resident, we know a lot about our
                            city, neighborhood and the types of housing options available and absolutely love our
                            vacation at Sona Hotel.</p>
                        <div class="ti-author">
                            <div class="rating">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star-half_alt"></i>
                            </div>
                            <h5> - Alexander Vasquez</h5>
                        </div>
                        <img src="{{ asset('img/testimonial-logo.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonial Section End -->


@endsection
