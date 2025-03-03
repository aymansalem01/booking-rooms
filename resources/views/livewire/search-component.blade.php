<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    <section class="rooms-section spad">
        <div class="container">
            {{-- حقل البحث --}}
            <div class="row mb-5">
                <div class="col-12">
                    <input
                        wire:model.live.debounce.500ms="search"
                        placeholder="Search rooms or categories..."
                        type="text"
                        class="form-control form-control-lg"
                    >
                </div>
            </div>

            {{-- نتائج البحث --}}
            <div class="row">
                @if($search)
                    {{-- عنوان النتائج --}}
                    <div class="col-12 mb-5">
                        <h2 class="results-title">Search results for "{{ $search }}"</h2>
                        <p class="results-count">
                            Found {{ $rooms->total() }} Rooms
                        </p>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            @foreach($rooms as $room)
                                <div class="col-lg-4 col-md-6">
                                    <div class="room-item">
                                        <img src="{{ $room->image->first() ? 'storage/images/'.$room->image->first()->image : 'path/to/default-image.jpg' }}" alt="" style="width: 100%; height: 250px; object-fit: cover;">
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
                        </div>
                    </div>

                    <div class="col-12 mt-4" >
                        {{ $rooms->links() }}
                    </div>
                @else
                @endif
            </div>
        </div>
    </section>
</div>
