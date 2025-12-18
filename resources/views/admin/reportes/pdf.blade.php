<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte de Asistencias - I.E.S.T.P. Pedro P. Díaz</title>
    <style>
        /* Configuraciones de página */
        @page { margin: 1.5cm; }
        
        body { 
            font-family: 'Helvetica', Arial, sans-serif; 
            font-size: 11px; 
            line-height: 1.4;
            color: #333; 
        }

        /* Encabezado */
        .header-table {
            width: 100%;
            border-bottom: 2px solid #ce1212;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .logo-container { width: 20%; border: none; }
        .title-container { width: 80%; text-align: right; border: none; }
        .institution-name { 
            font-size: 18px; 
            font-weight: bold; 
            color: #ce1212; 
            margin: 0;
        }
        .report-title { 
            font-size: 14px; 
            margin: 5px 0; 
            color: #555;
            text-transform: uppercase;
        }

        /* Tabla de Datos Principal */
        .main-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
        }
        .main-table th { 
            background-color: #ce1212; 
            color: white; 
            padding: 10px 8px; 
            text-align: left; 
            text-transform: uppercase;
            font-size: 10px;
        }
        .main-table td { 
            border-bottom: 1px solid #eee; 
            padding: 8px; 
            vertical-align: top;
        }
        
        .text-bold { font-weight: bold; }
        .text-muted { color: #666; font-size: 9px; }

        /* Colores de Estado */
        .status-asistio { color: #1a7f37; font-weight: bold; }
        .status-tardanza { color: #b08800; font-weight: bold; }

        /* Tabla de Resumen (Solución al error de superposición) */
        .summary-table {
            width: 250px;
            margin-top: 30px;
            margin-left: auto; /* Alinea a la derecha */
            border-collapse: collapse;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        .summary-table th {
            background-color: #f2f2f2;
            color: #333;
            text-align: center;
            padding: 8px;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .summary-table td {
            padding: 8px 12px;
            border: none;
        }
        .text-right { text-align: right; }

        /* Footer */
        .footer { 
            position: fixed; 
            bottom: -30px; 
            left: 0; 
            right: 0; 
            text-align: center; 
            font-size: 9px; 
            color: #999;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td class="logo-container">
                {{-- Asegúrate que la ruta public_path('img/logo-ppd.png') sea correcta --}}
                <img src="{{ public_path('img/logo-ppd.png') }}" style="width: 70px;">
            </td>
            <td class="title-container">
                <p class="institution-name">I.E.S.T.P. PEDRO P. DÍAZ</p>
                <p class="report-title">Reporte Detallado de Asistencias</p>
                <p style="margin:0;">
                    Periodo: {{ \Carbon\Carbon::parse(request('fecha_inicio'))->format('d/m/Y') }} 
                    al {{ \Carbon\Carbon::parse(request('fecha_fin'))->format('d/m/Y') }}
                </p>
                <p class="text-muted">Generado el: {{ now()->format('d/m/Y H:i:s') }}</p>
            </td>
        </tr>
    </table>

    <table class="main-table">
        <thead>
            <tr>
                <th width="15%">Fecha / Hora</th>
                <th width="35%">Estudiante</th>
                <th width="35%">Curso / Grupo</th>
                <th width="15%">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asistencias as $asistencia)
            <tr>
                <td>
                    <span class="text-bold">{{ \Carbon\Carbon::parse($asistencia->fecha_hora_registro)->format('d/m/Y') }}</span><br>
                    <span class="text-muted">{{ \Carbon\Carbon::parse($asistencia->fecha_hora_registro)->format('H:i:s') }}</span>
                </td>
                <td>
                    <span class="text-bold">{{ $asistencia->estudiante->nombre_completo }}</span><br>
                    <span class="text-muted">ID: {{ $asistencia->estudiante_id }}</span>
                </td>
                <td>
                    {{ $asistencia->sesionClase->curso->nombre }}<br>
                    <span class="text-muted">Grupo: {{ $asistencia->sesionClase->asignacion->grupo->nombre ?? 'Sin grupo' }}</span>
                </td>
                <td class="{{ $asistencia->tipo == 'Asistió' ? 'status-asistio' : 'status-tardanza' }}">
                    {{ $asistencia->tipo }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="page-break-inside: avoid;">
        <table class="summary-table">
            <thead>
                <tr>
                    <th colspan="2">RESUMEN DEL REPORTE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total Registros:</td>
                    <td class="text-right text-bold">{{ $asistencias->count() }}</td>
                </tr>
                <tr>
                    <td style="color: #1a7f37;">Puntuales:</td>
                    <td class="text-right text-bold" style="color: #1a7f37;">{{ $asistencias->where('tipo', 'Asistió')->count() }}</td>
                </tr>
                <tr>
                    <td style="color: #b08800;">Tardanzas:</td>
                    <td class="text-right text-bold" style="color: #b08800;">{{ $asistencias->where('tipo', 'Tardanza')->count() }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="footer">
        I.E.S.T.P. Pedro P. Díaz - Sistema de Control de Asistencias Digital
    </div>

</body>
</html>