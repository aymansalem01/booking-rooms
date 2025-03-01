@extends('layouts.adminPage')


@section('content')
<style>
    .form-container {
        max-width: 500px;
        margin: 50px auto;
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        background-image: url("{{ asset('assets/img/create9.jpg') }}");
        background-size: cover;
    }
    
    .form-container h2 {
        text-align: center;
        margin-bottom: 40px;
        font-weight: bold;
        color: white;
    }
    
    .form-control, .form-select, .btn-custom {
        height: 45px;
        border-radius: 10px;
        font-size: 16px;
        width: 100%;
        color: #333;
    }

    .btn-custom {
        background-color: #a92dfc;
        border: none;
        color: white;
        font-weight: bold;
        transition: 0.3s ease;
        width: 100%;
    }

    .btn-custom:hover {
        background-color: #911ede;
        color: white;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
</style>

<div class="form-container">
    <h2>Edit Room</h2>

    <form action="{{ route('room.update', $rooms->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="text" class="form-control" value="{{ $rooms->name }}" disabled name="name">

        <input type="text" class="form-control" value="{{ $rooms->address }}" disabled name="address">

        <input type="number" class="form-control" name="price" value="{{ $rooms->price }}" required>

        <select name="status" class="form-select">
            <option value="av" {{ $rooms->status == 'av' ? 'selected' : '' }}>Available</option>
            <option value="notav" {{ $rooms->status == 'not_available' ? 'selected' : '' }}>Not Available</option>
        </select>

        <input type="number" class="form-control" name="count" value="{{ $rooms->count }}" required>

        <textarea class="form-control" name="description" rows="3" required>{{ $rooms->description }}</textarea>

        <h5 class="fw-bold">Current Images</h5>
        {{-- <div class="row">
            @foreach($rooms->images as $image)
                <div class="col-md-3 position-relative">
                    <img src="{{ asset('assets/img/' . $image->path) }}" class="img-thumbnail" alt="Room Image">
                </div>
            @endforeach
        </div> --}}

        <button type="submit" class="btn btn-custom">Update Room</button>
        <a href="{{ route('room.index') }}" class="btn btn-custom">Cancel</a>
    </form>
</div>

@endsection
