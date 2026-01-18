<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold text-center mb-6">Create Account</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/register" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Name</label>
            <input name="name" required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input name="email" type="email" required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Password</label>
            <input name="password" type="password" required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Confirm Password</label>
            <input name="password_confirmation" type="password" required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
        </div>

        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-semibold">
            Register
        </button>
    </form>

    <p class="text-center text-sm mt-4">
        Already have an account?
        <a href="/login" class="text-blue-600 hover:underline">Login</a>
    </p>
</div>

</body>
</html>