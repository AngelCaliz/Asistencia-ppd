<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Sesiones de Clase (CU03)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if($sesiones->isEmpty())
                    <p class="text-gray-600">Aún no has creado ninguna sesión de clase.</p>
                    <a href="{{ route('docente.sesiones.create') }}" class="text-indigo-600 hover:text-indigo-900 mt-4 block">Generar la primera sesión</a>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Curso</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inicio / Fin</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-3 bg-gray-50">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($sesiones as $sesion)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $sesion->codigo_sesion }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $sesion->curso->nombre }} ({{ $sesion->aula }})</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Inicio: {{ \Carbon\Carbon::parse($sesion->fecha_inicio)->format('d/m H:i') }}<br>
                                            Fin: {{ \Carbon\Carbon::parse($sesion->fecha_fin)->format('d/m H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @php
                                                $now = now();
                                                if ($now->between($sesion->fecha_inicio, $sesion->fecha_fin)) {
                                                    $estado = 'Activa';
                                                    $color = 'bg-green-100 text-green-800';
                                                } elseif ($now->lt($sesion->fecha_inicio)) {
                                                    $estado = 'Programada';
                                                    $color = 'bg-blue-100 text-blue-800';
                                                } else {
                                                    $estado = 'Finalizada';
                                                    $color = 'bg-red-100 text-red-800';
                                                }
                                            @endphp
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                                {{ $estado }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('docente.sesiones.monitor', $sesion->id_sesion) }}" class="text-indigo-600 hover:text-indigo-900">
                                                Ver Asistencia
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>