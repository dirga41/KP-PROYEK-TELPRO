<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telkom Property Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen flex">

    <!-- LOGO DI POJOK KIRI ATAS -->
    <img src="{{ asset('asset/logoTelkomHeader.png') }}" alt="logo" class="absolute top-4 left-4 w-36 z-50">

    <!-- KIRI: FORM LOGIN -->
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-white px-8 py-12">
        <div class="w-full max-w-md">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome</h1>
            <p class="text-black-600 mb-8">Enter your Credentials to access your account</p>

            <form action="{{ route('login.authenticate') }}" method="POST">
                @csrf

                <!-- Error Message -->
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Username -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Username</label>
                    <input type="text" name="username" placeholder="Enter your username"
                        class="w-full px-4 py-3 border rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:outline-none"
                        required>
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Password</label>
                    <input type="password" name="password" placeholder="Password"
                        class="w-full px-4 py-3 border rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:outline-none"
                        required>
                </div>

                <!-- Login Buttons -->
                <p class="text-center text-gray-500 mb-3">Login</p>
                <div class="flex justify-center items-center gap-4">
                    <button type="submit" name="login_type" value="marketing"
                        class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition">
                        Marketing
                    </button>
                    <span class="text-gray-400">|</span>
                    <button type="submit" name="login_type" value="project"
                        class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition">
                        Project
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- KANAN: GAMBAR -->
    <div class="hidden lg:block w-1/2 relative h-screen">
        <img src="{{ asset('asset/TLT.jpg') }}" alt="Telkom Property"
            class="w-full h-full object-cover absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-tr from-orange-500 to-yellow-300 opacity-70"></div>
    </div>


</body>

</html>
