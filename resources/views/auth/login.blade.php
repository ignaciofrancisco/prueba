<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Tech Solutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-500 to-purple-600 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-10 w-full max-w-md">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-700">Inicia sesión</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.web') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block mb-1 font-medium text-gray-600">Correo</label>
                <input type="email" name="correo" value="{{ old('correo') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-600">Clave</label>
                <input type="password" name="clave" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded transition duration-200">Ingresar</button>
        </form>

        <p class="text-center mt-5 text-gray-600">
            ¿No tienes cuenta? 
            <a href="{{ route('registro') }}" class="text-blue-500 hover:underline font-semibold">Regístrate</a>
        </p>
    </div>
</body>
</html>
