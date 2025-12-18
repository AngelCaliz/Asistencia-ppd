<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\Curso;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function index()
    {
        $cursos = Curso::all();
        return view('admin.reportes.index', compact('cursos'));
    }

    public function generarPdf(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $query = Asistencia::with(['estudiante', 'sesionClase.curso', 'sesionClase.asignacion.grupo']);

        // Filtro opcional por curso
        if ($request->curso_id) {
            $query->whereHas('sesionClase', function ($q) use ($request) {
                $q->where('curso_id', $request->curso_id);
            });
        }

        $asistencias = $query->whereBetween('fecha_hora_registro', [
            $request->fecha_inicio . ' 00:00:00',
            $request->fecha_fin . ' 23:59:59'
        ])->orderBy('fecha_hora_registro', 'asc')->get();

        if ($asistencias->isEmpty()) {
            return back()->with('error', 'No se encontraron registros para estas fechas.');
        }

        $pdf = Pdf::loadView('admin.reportes.pdf', compact('asistencias'));

        return $pdf->download('reporte-asistencias.pdf');
    }
}
