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
    .custom-error {
    background-color: #ffceec;
    font-weight: bold;
    font-size: 14px;
    color: #a49e9e;
    padding: 10px;
    border-radius: 20px;


}
</style>


<div class="form-container">
    <h2>Edit Room</h2>

    <form action="{{ route('adroom.update', $room->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="text" class="form-control" value="{{ $room->name }}" disabled name="name">
        @error('name')
        <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
        @enderror

        <input type="text" class="form-control" value="{{ $room->address }}" disabled name="address">
        @error('address')
        <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
        @enderror

        <input type="number" class="form-control" name="price" value="{{ $room->price }}" required>
        @error('price')
        <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
        @enderror
        <input type="number" class="form-control" name="discount" value="{{ $room->discount}}" required>
        @error('discount')
        <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
        @enderror

        <select name="category_id" class="form-select">
    <option value="" disabled>Select Category</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ $room->category->id == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
    @endforeach
</select>
@error('category_id')
        <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
        @enderror


        <select name="status" class="form-select">
            <option value="av" {{ $room->status == 'av' ? 'selected' : '' }}>Available</option>
            <option value="notav" {{ $room->status == 'not_available' ? 'selected' : '' }}>Not Available</option>
        </select>
        @error('status')
        <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
        @enderror
        <input type="number" class="form-control" name="count" value="{{ $room->count }}" required>
        @error('count')
        <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
        @enderror

        <textarea class="form-control" name="description" rows="3" required>{{ $room->description }}</textarea>
        @error('description')
        <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
        @enderror

        <h5 class="fw-bold">Current Images</h5>
        {{-- <div class="row">
            @foreach($rooms->images as $image)
                <div class="col-md-3 position-relative">
                    <img src="{{ asset('assets/img/' . $image->path) }}" class="img-thumbnail" alt="Room Image">
                </div>
            @endforeach
        </div> --}}

        <button type="submit" class="btn btn-custom">Update Room</button>
        <a href="{{ route('adroom.index') }}" class="btn btn-custom">Cancel</a>
    </form>
</div>

@endsection
