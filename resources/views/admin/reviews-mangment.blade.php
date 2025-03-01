@extends('layouts.adminPage')

@section('content')

<div class="content">
    <div class="container mt-5">
        <div class="row justify-content-center" style="gap: 20px;">
        @if(isset($reviews) && count($reviews) > 0)
        @foreach ($reviews as $review)
    <div class="col-md-3 col-sm-6 mb-4">
        <div style="width: 100%; max-width: 300px; height: 350px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 10px; box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1); display: flex; flex-direction: column; align-items: center; text-align: center;">
            <img src="{{ asset('assets/images/user.png') }}" alt="User Image" style="width: 80px; height: 80px; border-radius: 50%; margin-bottom: 15px;">
            <div style="display: flex; flex-direction: column; align-items: center; flex-grow: 1;">
                <h5 style="font-weight: bold; color: #333;">User Name: {{ $review->user->name }}</h5>
                <p style="color: #B197FC; font-size: 1.2em; margin-bottom: 10px;">User Rating: {{ $review->rate }} Stars</p>
                <div style="border-color:#B197FC;border:solid #B197FC"><p style="color: #777; margin-top: auto;">User Comment: {{ $review->comment }}</p></div> 
              <p style="color: #777; margin-top: auto;">Room Name: {{ $review->room->name }}</p>
            </div>
            <div style="display: flex; gap: 15px; justify-content: center; margin-top: 10px;">
                <a href="#"><i class="fa-solid fa-eye" style="font-size: 20px; cursor: pointer; color: #B197FC;"></i></a>

                <form action="{{ route('review.destroy', $review->id) }}" method="POST" onsubmit="return confirmDelete();">
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
        {{ $reviews->links() }}
    </div>
    
    @else
        <p>No reviews available!</p>
    @endif
        </div>
    </div>
</div>

@endsection

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this review?');
    }
</script>
