@extends('layouts.ownerPage')

@section('content')
    <div class="form-container">
        <h2 class="text-center">Add New Room</h2>
        <form action="{{ route('storeimage',$room->id) }}" method="POST"  enctype="multipart/form-data">
            @csrf

            <input type="text" name="name" class="form-control" placeholder="Room Name" value="{{ $room->id }}">
            
            <input type="file" name="image" class="form-control" placeholder="select image"  required>
        @error('image')
        <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
        @enderror

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
            background-image: url("{{ asset('assets/img/create9.jpg') }}");
            background-size: cover;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 40px;
            font-weight: bold;
            color: white;
        }

        .form-control,
        .form-select,
        .btn-custom {
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
@endsection
