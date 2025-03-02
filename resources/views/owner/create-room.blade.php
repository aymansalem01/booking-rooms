@extends('layouts.ownerPage')

@section('content')

<div class="form-container">
    <h2 class="text-center">Add New Room</h2>
    <form action="{{ route('room.store') }}" method="POST">
        @csrf

        <input type="text" name="name" class="form-control" placeholder="Room Name" required>

        <input type="text" name="address" class="form-control" placeholder="Address" required>

        <input type="number" name="price" class="form-control" placeholder="Price" required>

        <select name="status" class="form-select">
            <option value="av">Available</option>
            <option value="notav">Not Available</option>
        </select>

        {{-- <input type="number" name="count" class="form-control" placeholder="Room Count" required> --}}

        <textarea name="description" class="form-control" rows="3" placeholder="Description" required></textarea>

        <button type="submit" class="btn btn-custom">Add Room</button>
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