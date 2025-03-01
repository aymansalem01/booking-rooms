@extends('layouts.uerPage')

@section('content')




    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Our Rooms</h2>
                        <div class="bt-option">
                            <a href="./home.html">Home</a>
                            <span>Rooms</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->




    <!-- Rooms Section Begin -->
    <section class="rooms-section spad">
        <div class="container">
            <div class="row">

                @foreach ($rooms as $room)
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="{{ $room->image->first() ? 'storage/images/'.$room->image->first()->image : 'path/to/default-image.jpg' }}" alt="" style="width: 100%; height: 250px; object-fit: cover;">
                        <div class="ri-text">
                            <h4 style="font-size: 20px; margin-bottom: 8px;">{{ $room->name }}</h4>
                            <h3 style="font-size: 22px; margin-bottom: 10px;">{{ $room->price }} JD<span>/Pernight</span></h3>
                            <table>
                                <tbody>
                                    
                                    <tr>
                                        <td class="r-o">Size:</td>
                                        <td>{{ $room->size }}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">category:</td>
                                        <td>{{ $room->category->name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="rating" style="margin-bottom: 10px;">
                                @php
                                    $averageRating = $room->review->avg('rate') ?? 0;
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
                            </div>



                                <a href="{{ route('store.show', $room->id) }}" class="primary-btn" >More Details</a>


                        </div>
                    </div>
                </div>

            @endforeach



            <div class="pagination-links">
                {{ $rooms->links('pagination::bootstrap-4') }}
            </div>
            </div>
        </div>
    </section>
    <!-- Rooms Section End -->


@endsection
