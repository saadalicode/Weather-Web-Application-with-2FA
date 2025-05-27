<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weather App</title>
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            overflow: hidden; /* Prevents scrolling */
        }

        /* Top Navigation */
        .top-right {
            position: absolute;
            top: 20px;
            right: 30px;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 20px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            display: flex;
            gap: 15px;
        }

        .top-right a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            font-weight: bold;
            transition: 0.3s;
        }

        .top-right a:hover {
            color: #ffcc00;
        }

        /* Weather App Heading */
        .heading {
            font-size: 40px;
            font-weight: bold;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }

        /* Cloud Image */
        .center-image img {
            width: 200px; /* Adjust as needed */
            height: auto;
            filter: drop-shadow(0px 10px 15px rgba(0, 0, 0, 0.2));
        }
    </style>
</head>
<body>
    <!-- Top Navigation -->
    <div class="top-right">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        @endif
    </div>

    <!-- Weather App Heading -->
    <div class="heading">Weather App</div>

    <!-- Centered Cloud Image -->
    <div class="center-image">
        <img src="{{ asset('images/cloud.png') }}" alt="Cloud Image">
    </div>
</body>
</html>
