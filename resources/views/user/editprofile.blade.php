<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('https://wallpaperboat.com/wp-content/uploads/2021/04/08/74172/purple-space-24.jpg') no-repeat center center/cover;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .signup-container {
            background: rgba(255, 255, 255, 0.97);
            padding: 60px;
            width: 100%;
            max-width: 500px;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
            transition: transform 0.3s ease-in-out;
        }

        .signup-container:hover {
            transform: scale(1.05);
        }

        .signup-container h1 {
            font-size: 2.4rem;
            margin-bottom: 25px;
            color: #9117bd;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .input-group label {
            font-size: 1.1rem;
            margin-bottom: 7px;
            font-weight: bold;
            color: #9117bd;
        }

        .input-group input {
            width: 100%;
            padding: 14px;
            border: 2px solid #ccc;
            border-radius: 10px;
            font-size: 1.1rem;
            transition: 0.3s;
        }

        .input-group input:focus {
            border-color: #9117bd;
            outline: none;
            box-shadow: 0 0 10px rgba(145, 23, 189, 0.5);
        }

        .error {
            color: red;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        button {
            width: 100%;
            padding: 14px;
            background: #9117bd;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #7e0ca5;
            transform: scale(1.05);
        }

        .signup-container p {
            margin-top: 20px;
            font-size: 1rem;
        }

        .signup-container a {
            color: #9117bd;
            text-decoration: none;
            font-weight: bold;
        }

        .signup-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h1>edit Profile</h1>
        <form method="post" action="{{ route('update',auth()->user()->id) }}" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="input-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" value="{{ auth()->user()->name }}" required>
                @error('name')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="input-group">
                <label for="phone_number">Phone Number</label>
                <input type="tel" id="phone_number" name="phone_number" placeholder="Enter your phone number" value="{{ auth()->user()->phone_number }}" required>
                @error('phone_number')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="input-group">
                <label for="password"> New Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                @error('password')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="input-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                @error('password_confirmation')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="input-group">
                <label for="image">Profile Picture</label>
                <input type="file" id="image" name="image" accept="image/*" >
                @error('image')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>
