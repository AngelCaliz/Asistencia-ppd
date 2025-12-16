<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control - Docente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold mb-4">Bienvenido(a), {{ Auth::user()->name }}</h3>
                    <p class="mb-6">Selecciona una opción para gestionar la asistencia de tus cursos.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="border p-4 rounded-lg shadow-md hover:bg-indigo-50 transition duration-150">
                            <h4 class="text-lg font-semibold text-indigo-700 mb-2">Generar Sesión de Clase (CU02)</h4>
                            <p class="text-gray-600 mb-3">Define los parámetros y obtén el código único para que tus estudiantes registren su asistencia.</p>
                            <a href="{{ route('docente.sesiones.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Iniciar Sesión de Clase
                            </a>
                        </div>
                        
                    <div class="border p-4 rounded-lg shadow-md hover:bg-green-50 transition duration-150">
                        <h4 class="text-lg font-semibold text-green-700 mb-2">Monitorear Sesiones Activas (CU03)</h4>
                        <p class="text-gray-600 mb-3">Consulta el estado y el listado de asistencia de tus sesiones activas o pasadas.</p>
                        <a href="{{ route('docente.sesiones.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                            Ver Mis Sesiones
                        </a>
                    </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>