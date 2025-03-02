@extends('layouts.adminPage')

@section('content')

<style>

  .form-container {
            width: 100%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .form-control, .form-select, .btn-custom {
            height: 45px;
            border-radius: 10px;
            font-size: 16px;
            width: 100%;
            color: #333
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
            color: white
        }
    .form-container {
        max-width: 500px;
        margin: 50px auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        background-image: url("{{asset('assets/img/create9.jpg') }}");
        background-size: cover;

    }


    .form-container h2 {
        text-align: center;
        margin-bottom: 40px;
        font-weight: bold;
        color: white;
    }
    form{
        display: flex;
        flex-direction: column;
        gap: 20px
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

    <h2>Create User</h2>
    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
    
        <input type="text" name="name" class="form-control mb-3" placeholder="Enter your name" value="{{ old('name') }}" required>
        @error('name') 
            <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div> 
        @enderror
    
        <input type="email" name="email" class="form-control mb-3" placeholder="Enter your email" value="{{ old('email') }}" required>
        @error('email') 
            <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div> 
        @enderror
    
        <input type="password" name="password" class="form-control mb-3" placeholder="Enter a strong password" required>
        @error('password') 
            <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div> 
        @enderror
    
        <select name="role" class="form-select mb-3" required>
            <option value="" disabled selected>Select Role</option>
            <option value="admin">Admin</option>
            <option value="owner">Owner</option>
            <option value="user">User</option>
        </select>
        @error('role') 
            <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div> 
        @enderror
    
        <input type="text" name="phone_number" class="form-control mb-3" pattern="^07[0-9]{8}$" value="{{ old('phone_number') }}" placeholder="07XXXXXXXX" required>
        @error('phone_number') 
            <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div> 
        @enderror
    
        <select name="status" class="form-select mb-3" required>
            <option value="" disabled selected>Select Status</option>
            <option value="active">Active</option>
            <option value="block">Block</option>
        </select>
        @error('status') 
            <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div> 
        @enderror
    
        <input type="file" name="image" class="form-control mb-3" value="{{ old('image') }}">
        @error('image') 
            <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div> 
            
        @enderror
    
        <button type="submit" class="btn btn-custom w-100">Create User</button>
    </form>
    
    </div>



@endsection
