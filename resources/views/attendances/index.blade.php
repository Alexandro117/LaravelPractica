<!--<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencia Escolar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: "Raleway", sans-serif;
            background-color: #eef4fd;
        }

        .container {
            display: flex;
            flex-direction: column;
            box-shadow: 8px 8px 5px 0px #bdbdbdbf;
            width: 80%;
            background-color: #ffffff;
            border-radius: 30px;
            padding: 20px 30px;
        }

        .table_header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        button {
            outline: none;
            border: none;
            background-color: #6236ff;
            color: #ffffff;
            padding: 10px 30px;
            border-radius: 20px;
            text-transform: uppercase;
            font-size: 14px;
            cursor: pointer;
        }

        button:hover {
            background-color: #552bee;
        }

        select, input[type="text"], input[type="date"] {
            border: none;
            border-bottom: 1px solid #c9c9c9;
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            background-color: transparent;
            margin-bottom: 20px;
        }

        table {
            border-spacing: 0;
            margin-top: 1rem;
            width: 100%;
        }

        thead {
            background-color: #fff7b3;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        tbody tr {
            border-bottom: 1px solid #dfdfdf;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }

        .badge {
            padding: 10px;
            border-radius: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="table_header">
            <h1 class="mb-4">Asistencia Escolar</h1>
        </div>

        <form method="GET" action="{{ route('attendances.index') }}" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="student_id" id="student_id" class="form-control" placeholder="ID del Estudiante" value="{{ request('student_id') }}">
                </div>
                <div class="col-md-4">
                    <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
                </div>
                <div class="col-md-4">
                    <select name="present" id="present" class="form-select">
                        <option value="">Todos</option>
                        <option value="1" {{ request('present') == '1' ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ request('present') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID del Estudiante</th>
                    <th>Fecha</th>
                    <th>Presente</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance['id'] }}</td>
                        <td>{{ $attendance['student_id'] }}</td>
                        <td>{{ $attendance['date'] }}</td>
                        <td>
                            @if($attendance['present'])
                                <span class="badge bg-success">Sí</span>
                            @else
                                <span class="badge bg-danger">No</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Alumnos</title>
    <!-- CSS Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/minty/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="images/logo.png">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #2BBBAD;
        }

        .navbar-brand img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .navbar-nav .nav-item .nav-link {
            color: white;
        }

        .navbar-nav .nav-item .nav-link:hover {
            color: #ffeb3b;
        }

        /* Form Styles */
        .form-wrapper {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 600px; /* Adjusted width */
        }

        .form-wrapper h2 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group select, .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn-primary {
            background-color: #2BBBAD;
            border: none;
            padding: 10px;
            width: 100%;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-primary:hover {
            background-color: #26a69a;
        }

        /* Table Styles */
        .table-wrapper {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 800px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #2BBBAD;
            color: white;
        }

        .table td {
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/logo.png" alt="Logo">
                Alumnos
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Form Section -->
    <div class="form-wrapper">
        <h2 class="text-center mb-4">Registrar Alumno</h2>
        <form>
            <div class="form-group">
                <label for="grupo" class="form-label">Semestre</label>
                <select id="grupo" class="form-select" required>
                    <option selected disabled value="">Seleccione semestre</option>
                    <option value="1">Semestre 1</option>
                    <option value="2">Semestre 2</option>
                    <option value="3">Semestre 3</option>
                    <option value="4">Semestre 4</option>
                    <option value="5">Semestre 5</option>
                    <option value="6">Semestre 6</option>
                    <option value="7">Semestre 7</option>
                    <option value="8">Semestre 8</option>
                    <option value="9">Semestre 9</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre del alumno" required>
            </div>
            <div class="form-group">
                <label for="carrera" class="form-label">Carrera</label>
                <input type="text" class="form-control" id="carrera" placeholder="Carrera" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <div class="form-wrapper">
        <h2 class="text-center mb-4">Registrar Clase</h2>
        <form>
            <div class="form-group">
                <label for="clase" class="form-label">Clase</label>
                <select id="clase" class="form-select" required>
                    <option selected disabled value="">Seleccione Clase</option>
                    <option value="1">Programación</option>
                </select>
            </div>
            <div class="form-group">
                <label for="contraseña" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contraseña" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>

    <!-- Table Section -->
    <div class="table-wrapper">
        <h2 class="text-center mb-4">Clases Registradas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Clase</th>
                    <th>Semestre</th>
                    <th>Profesor</th>
                    <th>Horario</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Programación</td>
                    <td>1</td>
                    <td>Juan Pérez</td>
                    <td>Lunes 10:00 - 12:00</td>
                </tr>
                <!-- More rows as needed -->
            </tbody>
        </table>
    </div>

    <!-- JavaScript Links -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>