<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sesión Creada y Código de Asistencia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">¡Éxito!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <h3 class="text-2xl font-bold mb-4">Detalles de la Sesión</h3>
                    
                    <p><strong>Curso:</strong> {{ $sesion->curso->nombre }}</p>
                    <p><strong>Docente:</strong> {{ $sesion->docente->nombres }} {{ $sesion->docente->apellidos }}</p>
                    <p><strong>Aula:</strong> {{ $sesion->aula }}</p>
                    <p><strong>Inicio:</strong> {{ $sesion->fecha_inicio }}</p>
                    <p><strong>Fin:</strong> {{ $sesion->fecha_fin }}</p>
                    
                    <div class="mt-6 p-4 bg-indigo-50 border-l-4 border-indigo-500">
                        <h4 class="text-xl font-semibold text-indigo-700">CÓDIGO DE ASISTENCIA (Compartir con estudiantes)</h4>
                        <p class="text-4xl font-extrabold text-indigo-900 mt-2">{{ $sesion->codigo_sesion }}</p>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('docente.panel') }}" class="text-indigo-600 hover:text-indigo-900">Volver al Panel del Docente</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>