<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proyectos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        nav {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav-left a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.2em;
        }
        .nav-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .nav-right span {
            font-weight: bold;
        }
        nav a {
            color: #fff;
            text-decoration: none;
        }
        nav form {
            display: inline;
        }
        button.logout {
            background-color: #e74c3c;
            border: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        button.logout:hover {
            background-color: #c0392b;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
        }
        td {
            padding: 8px;
        }
        a.action-link {
            color: #3498db;
            text-decoration: none;
            margin-right: 5px;
        }
        a.action-link:hover {
            text-decoration: underline;
        }
        .alert-success {
            color: green;
            margin-bottom: 15px;
        }
        .alert-error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-left">
            <a href="{{ route('proyectos.index') }}">Tech Solutions</a>
        </div>
        <div class="nav-right">
            @if(session('usuario_nombre'))
                <span>Hola, {{ session('usuario_nombre') }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout">Cerrar Sesión</button>
                </form>
            @else
                <a href="{{ route('login') }}">Iniciar Sesión</a>
                <a href="{{ route('registro') }}">Registrarse</a>
            @endif
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>
