<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold text-center mb-6">Login & Get Token</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/login" class="space-y-4">
        @csrf

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

        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-semibold">
            Get Token
        </button>
    </form>

    @if (!empty($token))
        <div class="mt-6">
            <h3 class="font-semibold mb-2">Token Result</h3>
            <pre class="bg-gray-900 text-green-400 text-xs p-3 rounded overflow-x-auto">
                {{ json_encode($token, JSON_PRETTY_PRINT) }}
            </pre>
        </div>
    @endif

    <p class="text-center text-sm mt-4">
        No account?
        <a href="/register" class="text-blue-600 hover:underline">Register</a>
    </p>
</div>

</body>
</html>
