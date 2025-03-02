@extends('layouts.ownerPage')

@section('content')

<div class="form-container">
    <h2 class="text-center">Edit Room</h2>
    <form action="{{ route('room.update', $room->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" class="form-control" value="{{ $room->name }}" required>
        <input type="text" name="address" class="form-control" value="{{ $room->address }}" required>

        <input type="number" class="form-control" name="price" value="{{ $room->price }}" required>

        <input type="number" name="discount" class="form-control" value="{{ $room->discount }}" required>
        <input type="number" name="count" class="form-control" value="{{ $room->count }}" required>
        <input type="number" name="size" class="form-control" value="{{ $room->size }}" required>
        <input type="number" name="capacity" class="form-control" value="{{ $room->capacity }}" required>

        <select name="category_id" class="form-select">
    <option value="" disabled>Select Category</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ $room->category->id == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
    @endforeach
</select>
        <select name="status" class="form-select">
            <option value="av" {{ $room->status == 'av' ? 'selected' : '' }}>Available</option>
            <option value="notav" {{ $room->status == 'notav' ? 'selected' : '' }}>Not Available</option>
        </select>

        <textarea class="form-control" name="description" rows="3" required>{{ $room->description }}</textarea>

        <button type="submit" class="btn btn-custom">Update Room</button>
        <a href="{{ route('room.index') }}" class="btn btn-custom">Cancel</a>
    </form>
</div>

<style>
    .form-container {
        max-width: 500px;
        margin: 50px auto;
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        background-image: url("{{asset('assets/img/create9.jpg') }}");
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

@endsection
