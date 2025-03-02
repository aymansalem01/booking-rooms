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

    .form-control, .form-select {
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
        height: 45px;
        border-radius: 10px;
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
    <h2>Edit User</h2>
    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $user->name }}" class="form-control mb-3" placeholder="Enter your name" required>

        <input type="email" name="email" value="{{ $user->email }}" class="form-control mb-3" placeholder="Enter your email" required>

        <input type="password" name="password" class="form-control mb-3" placeholder="Enter a new password (optional)">

        <select name="role" class="form-select mb-3" required>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="owner" {{ $user->role == 'owner' ? 'selected' : '' }}>Owner</option>
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
        </select>

        <input type="text" name="phone_number" value="{{ $user->phone_number }}" class="form-control mb-3" pattern="^07[0-9]{8}$" placeholder="07XXXXXXXX" required>

        <select name="status" class="form-select mb-3" required>
            <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="block" {{ $user->status == 'block' ? 'selected' : '' }}>Block</option>
        </select>

        <input type="file" name="image" class="form-control mb-3" accept="image/*">

        <button type="submit" class="btn btn-custom">Update User</button>
    </form>
</div>

@endsection
