<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Estudiante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold mb-4">Bienvenido(a), {{ Auth::user()->name }}</h3>
                    
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">{{ session('success') }}</div>
                    @endif
                     @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">{{ session('error') }}</div>
                    @endif

                    <div class="border p-4 rounded-lg shadow-md bg-indigo-50 hover:bg-indigo-100 transition duration-150 text-center">
                        <h4 class="text-xl font-semibold text-indigo-700 mb-3">Registrar Asistencia (CU05)</h4>
                        <p class="text-gray-600 mb-4">Ingresa el código de 6 dígitos que te proporcionó tu Docente para registrar tu asistencia.</p>
                        <a href="{{ route('estudiante.asistencia.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Registrar Código
                        </a>
                    </div>
                    
                    <div class="mt-8 text-center">
                        <h4 class="text-lg font-semibold mb-2">Historial</h4>
                        <p class="text-gray-500">Consulta tu historial de asistencias (Implementación futura)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>