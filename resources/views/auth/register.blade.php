<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Tech Solutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-purple-500 to-pink-500 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-10 w-full max-w-md">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-700">Registro de Usuario</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('registro.web') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block mb-1 font-medium text-gray-600">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400" required>
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-600">Correo</label>
                <input type="email" name="correo" value="{{ old('correo') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400" required>
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-600">Clave</label>
                <input type="password" name="clave" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400" required>
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-600">Confirmar Clave</label>
                <input type="password" name="clave_confirmation" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400" required>
            </div>
            <button type="submit" class="w-full bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 rounded transition duration-200">Registrarse</button>
        </form>

        <p class="text-center mt-5 text-gray-600">
            ¿Ya tienes cuenta? 
            <a href="{{ route('login') }}" class="text-purple-500 hover:underline font-semibold">Inicia sesión</a>
        </p>
    </div>
</body>
</html>
