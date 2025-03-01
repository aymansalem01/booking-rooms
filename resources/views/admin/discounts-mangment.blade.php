@extends('layouts.adminPage')

@section('content')

<div class="content">
    <div class="container mt-5">
        <div class="row justify-content-center" style="gap: 20px;">
        @if($coupons->isNotEmpty())  
            @foreach ($coupons as $coupon)
            <div class="col-md-3 col-sm-6 mb-4">
                <div style="width: 100%; max-width: 300px; height: 400px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 10px; box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1); display: flex; flex-direction: column; align-items: center; text-align: center;">
                    <div style="display: flex; flex-direction: column; align-items: center; flex-grow: 1;">
                        <h5 style="font-weight: bold; color: #333;">Coupon Name: {{ $coupon->name }}</h5>
                        <h5 style="font-weight: bold; color: #333;">Coupon Discount: {{ $coupon->discount }}</h5>

                      
                    </div>
                    <div style="display: flex; gap: 15px; justify-content: center; margin-top: 10px;">
                        <a href="#"><i class="fa-solid fa-eye" style="font-size: 20px; cursor: pointer; color: #B197FC;"></i></a>

                        <form action="{{ route('booking.destroy', $book->id) }}" method="POST" onsubmit="return confirmDelete();">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; cursor: pointer;">
                                <i class="fa-solid fa-trash" style="font-size: 20px; color: red;"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-12 text-center mt-4">
                {{ $booking->links() }}
            </div>

        @else
            <p class="text-center text-muted">No bookings available!</p> 
        @endif
        </div>
    </div>
</div>

@endsection

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this booking?');
    }
</script>
