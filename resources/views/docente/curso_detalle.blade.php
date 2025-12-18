<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $asignacion->curso->nombre }} - {{ $asignacion->grupo->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 bg-indigo-50 p-4 rounded-lg">
                    <div>
                        <h3 class="text-lg font-bold text-indigo-900">{{ $asignacion->curso->nombre }}</h3>
                        <p class="text-sm text-gray-600">Código: {{ $asignacion->curso->codigo }} | Carrera: {{ $asignacion->grupo->carrera }}</p>
                    </div>
                    <div class="mt-4 md:mt-0 flex space-x-3">
                        <a href="{{ route('docente.sesiones.create', ['asignacion' => $asignacion->id_asignacion]) }}" 
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md font-bold text-xs uppercase hover:bg-indigo-700">
                            + Iniciar Sesión de Hoy
                        </a>
                    </div>
                </div>

                <h4 class="font-semibold text-gray-700 mb-4 uppercase text-sm tracking-wider">Lista de Estudiantes ({{ $asignacion->grupo->estudiantes->count() }})</h4>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">DNI</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Apellidos y Nombres</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Correo</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($asignacion->grupo->estudiantes as $estudiante)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $estudiante->dni }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $estudiante->apellidos }}, {{ $estudiante->nombres }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $estudiante->user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Matriculado</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500 italic">
                                        No hay estudiantes registrados en este grupo.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 border-t pt-4">
                    <a href="{{ route('docente.panel') }}" class="text-sm text-indigo-600 hover:underline">
                        &larr; Volver al panel
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>