<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::query();

        // Aplicar filtros si existen
        if ($request->filled('student_id')) {
            $query->where('student_id', $request->input('student_id'));
        }

        if ($request->filled('date')) {
            $query->where('date', $request->input('date'));
        }

        if ($request->filled('present')) {
            $query->where('present', $request->input('present'));
        }

        // Obtener las asistencias paginadas
        $attendances = $query->paginate(10);

        return view('attendances.index', compact('attendances'));
    }

    public function create()
    {
        return view('attendances.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'present' => 'required|boolean',
        ]);

        Attendance::create($request->all());

        return redirect()->route('attendances.index')->with('success', 'Asistencia creada correctamente.');
    }

    public function show(Attendance $attendance)
    {
        return view('attendances.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        return view('attendances.edit', compact('attendance'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'present' => 'required|boolean',
        ]);

        $attendance->update($request->all());

        return redirect()->route('attendances.index')->with('success', 'Asistencia actualizada correctamente.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendances.index')->with('success', 'Asistencia eliminada correctamente.');
    }
}
