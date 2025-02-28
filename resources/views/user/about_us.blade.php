@extends('layouts.uerPage')

@section('content')


    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>About Us</h2>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- About Us Page Section Begin -->
    <section class="aboutus-page-section spad">
        <div class="container">
            <div class="about-page-text">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ap-title">
                            <h2>Welcome to Escape Reality.</h2>
                            <p>
                                Step into a world beyond the ordinary. Escape Reality offers a collection of uniquely themed rooms designed to 
                                transport you to another dimension. Whether you dream of floating in space, wandering through a winter 
                                wonderland, or diving into an underwater fantasy, we bring the impossible to life.
                            </p>
                           
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1">
                        <ul class="ap-services">
                            <!-- <li><i class="icon_check"></i> 20% Off On Accommodation.</li> -->
                            <li><i class="icon_check"></i> Complimentary Daily Breakfast</li>
                            <!-- <li><i class="icon_check"></i> 3 Pcs Laundry Per Day</li> -->
                            <li><i class="icon_check"></i> Free Wifi.</li>
                            <li><i class="icon_check"></i> Discounts</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="about-page-services">
                <div class="row">
                    
                    <div class="col-md-4">
                        <div class="ap-service-item set-bg" data-setbg="img/about/water-1.jpg">
                            <div class="api-text"style="background-color: rgba(0, 0, 0,0.3);">
                                <h3>Under Water</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="ap-service-item set-bg" data-setbg="img/about/barbie-1.jpg" >
                            <div class="api-text" style="background-color: rgba(0, 0, 0,0.3);">
                                <h3 >Barbie World</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ap-service-item set-bg" data-setbg="img/about/space-1.jpeg">
                            <div class="api-text"style="background-color: rgba(0, 0, 0,0.3);">
                                <h3>Into The Stars</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Page Section End -->

    <!-- Video Section Begin -->
    <section class="video-section set-bg" style="width: 100%;">
        <div class="container" >
            <div class="row" >
                <div class="col-lg-12" >
                    <div class="video-text" style="width: 100%;">
                     
                        
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/9I__ajev57U?si=KS8l7fcJnfH0S4Vo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>                </div>
            </div> 
        </div>
    </section>
    <!-- Video Section End -->

    <!-- Gallery Section Begin -->
    <section class="gallery-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Our Gallery</span>
                        <h2>Discover Our Rooms</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="gallery-item set-bg" data-setbg="img/about/animal-1.jpg">
                        <div class="gi-text">
                            <h3>Animal Room</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="gallery-item set-bg" data-setbg="img/about/horror-1.jpg">
                                <div class="gi-text">
                                    <h3>Horror Room</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="gallery-item set-bg" data-setbg="img/about/cave-2.jpg">
                                <div class="gi-text">
                                    <h3>Cave Room</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="gallery-item large-item set-bg" data-setbg="img/about/movie-2.jpg">
                        <div class="gi-text">
                            <h3>Movie Room</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Gallery Section End -->


@endsection
