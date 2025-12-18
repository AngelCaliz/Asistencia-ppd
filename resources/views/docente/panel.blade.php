<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control - Docente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-gray-800">Bienvenido(a), {{ Auth::user()->name }}</h3>
                        <p class="text-gray-600">Sistema de Gestión de Asistencia - I.S.T. Pedro P. Díaz</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <div class="flex flex-col justify-between border-2 border-indigo-100 p-6 rounded-xl bg-indigo-50 hover:border-indigo-300 transition shadow-sm">
                            <div>
                                <div class="w-12 h-12 bg-indigo-600 rounded-lg flex items-center justify-center mb-4 text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                </div>
                                <h4 class="text-xl font-bold text-indigo-900 mb-2">Nueva Sesión de Clase</h4>
                                <p class="text-gray-600 mb-6">Inicia una clase ahora mismo, genera tu código de acceso y permite que los alumnos marquen su asistencia.</p>
                            </div>
                            <a href="{{ route('docente.sesiones.create') }}" class="w-full text-center px-6 py-3 bg-indigo-600 text-white rounded-lg font-bold uppercase tracking-widest hover:bg-indigo-700 transition">
                                Iniciar Clase Hoy
                            </a>
                        </div>
                        
                        <div class="flex flex-col justify-between border-2 border-green-100 p-6 rounded-xl bg-green-50 hover:border-green-300 transition shadow-sm">
                            <div>
                                <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mb-4 text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                </div>
                                <h4 class="text-xl font-bold text-green-900 mb-2">Historial y Monitor</h4>
                                <p class="text-gray-600 mb-6">Revisa asistencias de clases pasadas o monitorea en tiempo real quiénes se están registrando.</p>
                            </div>
                            <a href="{{ route('docente.sesiones.index') }}" class="w-full text-center px-6 py-3 bg-green-600 text-white rounded-lg font-bold uppercase tracking-widest hover:bg-green-700 transition">
                                Ver Mis Sesiones
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>