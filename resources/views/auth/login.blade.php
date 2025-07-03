<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Menggunakan Tailwind CSS untuk styling cepat -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <!-- Formulir akan mengirim data ke route 'login.authenticate' -->
        <form action="{{ route('login.authenticate') }}" method="POST">
            <!-- Token CSRF Wajib untuk keamanan di Laravel -->
            @csrf

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Welcome</h1>
                <h2 class="text-gray-500 mt-2">Enter your Credentials to access your account</h2>
            </div>

            <!-- Menampilkan pesan error jika login gagal -->
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Input Username -->
            <div class="mb-4">
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
                <input type="text" name="username" id="username" placeholder="Masukkan username Anda" value="{{ old('username') }}" required
                       class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 @error('username') border-red-500 @enderror">
                @error('username')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Password -->
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                <input type="password" name="password" id="password" placeholder="Masukkan password Anda" required
                       class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <p class="text-center text-gray-600 mb-4">Login sebagai:</p>

            <!-- Tombol Submit -->
            <div class="flex flex-col sm:flex-row gap-4">
                <button type="submit" name="login_type" value="marketing"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-300">
                    Marketing
                </button>
                <button type="submit" name="login_type" value="project"
                        class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-300">
                    Project
                </button>
            </div>
        </form>
    </div>

</body>
</html>
