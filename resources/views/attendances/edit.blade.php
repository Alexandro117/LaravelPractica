<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Asistencia</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Asistencia</h1>
        <form method="POST" action="{{ route('attendances.update', $attendance->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="student_id" class="form-label">ID del Estudiante</label>
                <input type="text" class="form-control" id="student_id" name="student_id" value="{{ $attendance->student_id }}" required>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $attendance->date }}" required>
            </div>
            <div class="mb-3">
                <label for="present" class="form-label">Presente</label>
                <select class="form-select" id="present" name="present" required>
                    <option value="1" {{ $attendance->present == 1 ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ $attendance->present == 0 ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>