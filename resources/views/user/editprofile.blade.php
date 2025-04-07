<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: url('https://wallpaperboat.com/wp-content/uploads/2021/04/08/74172/purple-space-24.jpg') no-repeat   ;
        }

        .edit-container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 900px;
            width: 95%;
            margin: 20px auto;
            display: flex;
        }

        .left-panel {
            background: #9117bd;
            color: white;
            padding: 40px 30px;
            text-align: center;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .left-panel img {
            width: 180px;
            height: 180px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid white;
            margin-bottom: 20px;
        }

        .left-panel h2 {
            font-size: 1.6rem;
            margin-top: 10px;
        }

        .right-panel {
            flex: 2;
            padding: 40px;
        }

        .right-panel h1 {
            font-size: 2rem;
            color: #9117bd;
            margin-bottom: 25px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            color: #9117bd;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="tel"],
        input[type="password"],
        input[type="file"] {
            padding: 12px;
            border: 2px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
            transition: border 0.3s;
        }

        input:focus {
            border-color: #9117bd;
            outline: none;
            box-shadow: 0 0 8px rgba(145,23,189,0.3);
        }

        .error {
            color: red;
            font-size: 0.85rem;
            margin-top: 3px;
        }

        button {
            padding: 12px;
            background-color: #9117bd;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #7e0ca5;
            transform: scale(1.03);
        }

        .alert {
            padding: 15px;
            background: #4CAF50;
            color: white;
            text-align: center;
            margin: 20px auto;
            width: 90%;
            border-radius: 8px;
        }

        .reserved-button {
            padding: 12px;
            background-color: #f76c5e;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s, transform 0.2s;
            margin-top: 20px;
            width: 100%;
        }

        .reserved-button:hover {
            background-color: #e04c3c;
            transform: scale(1.03);
        }

        @media (max-width: 768px) {
            .edit-container {
                flex-direction: column;
            }

            .left-panel, .right-panel {
                width: 100%;
                padding: 30px;
            }

            .left-panel img {
                width: 140px;
                height: 140px;
            }
        }
    </style>
</head>
<body>
    <div style="background-color: white;">
        @include('user.navbar')
    </div>

    <div class="container">
        @if (session('message'))
            <div class="alert">{{ session('message') }}</div>
        @endif

        <div class="edit-container">
            <div class="left-panel">
                <img src="{{ auth()->user()->image ? asset('images/' . auth()->user()->image) : asset('img/default-avatar.png') }}"
                     alt="Profile Picture">
                <h2>{{ auth()->user()->name }}</h2>
            </div>

            <div class="right-panel">
                <h1>Edit Profile</h1>
                <form method="POST" action="{{ route('update', auth()->user()->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="input-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" required>
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="tel" id="phone_number" name="phone_number"
                               value="{{ auth()->user()->phone_number }}" required>
                        @error('phone_number')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="password">New Password</label>
                        <input type="password" id="password" name="password" required>
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                        @error('password_confirmation')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="image">Profile Picture</label>
                        <input type="file" id="image" name="image" accept="image/*">
                        @error('image')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit">Update Profile</button>
                </form>

                <!-- Button to view reserved rooms -->
                <button class="reserved-button" onclick="window.location.href='{{ route('bookingUser') }}'">View Reserved Rooms</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
