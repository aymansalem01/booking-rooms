@extends('layouts.uerPage')

@section('content')


<div class="col-lg-12">
    <div class="breadcrumb-text " style="padding-bottom: 70px;">
        <h2>{{ $rooms->first()?->category?->name ?? 'No Category' }} Rooms</h2>
        <div class="bt-option">
            <a href="{{route('home')}}">Home</a>
            <span>{{ $rooms->first()?->category?->name ?? 'No Category' }}</span>
        </div>
    </div>
</div>



    <!-- Rooms Section Begin -->
    <section class="rooms-section spad">

        <div class="container">
            <div class="row">

                @foreach ($rooms as $room)
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="{{ asset('images/'. $room->image->first()->image)}}" alt="" style="width: 100%; height: 250px; object-fit: cover;">
                        <div class="ri-text">
                            <h4 style="font-size: 20px; margin-bottom: 8px;">{{ $room->name }}</h4>

                            <h3 style="font-size: 22px; margin-bottom: 10px;">
                                @if ($room->discount > 0)
                                    <span style="color: #999; text-decoration: line-through;">{{ $room->price }} JD</span>
                                    {{ $room->price - ($room->discount * ($room->price/100)) }} JD
                                @else
                                    {{ $room->price }} JD
                                @endif
                                <span>/Pernight</span>
                            </h3>

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

    <script>
        document.getElementById('scrollLeft').addEventListener('click', function() {
            const board = document.getElementById('board');
            board.scrollBy({
                left: -board.offsetWidth / 2,
                behavior: 'smooth'
            });
        });

        document.getElementById('scrollRight').addEventListener('click', function() {
            const board = document.getElementById('board');
            board.scrollBy({
                left: board.offsetWidth / 2,
                behavior: 'smooth'
            });
        });

        setInterval(function() {
            const board = document.getElementById('board');
            const maxScroll = board.scrollWidth - board.offsetWidth;

            if (board.scrollLeft >= maxScroll - 10) {
                board.scrollTo({
                    left: 0,
                    behavior: 'smooth'
                });
            } else {
                board.scrollBy({
                    left: board.offsetWidth / 2,
                    behavior: 'smooth'
                });
            }
        }, 5000);
    </script>

@endsection
