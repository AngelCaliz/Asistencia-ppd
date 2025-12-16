<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Administración (Global)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">Estadísticas Clave del Sistema</h3>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        
                        <div class="bg-indigo-600 overflow-hidden shadow rounded-lg p-5 text-white">
                            <p class="text-sm font-medium opacity-75">Total Docentes</p>
                            <p class="text-3xl font-semibold mt-1">{{ $totalDocentes }}</p>
                        </div>
                        
                        <div class="bg-blue-600 overflow-hidden shadow rounded-lg p-5 text-white">
                            <p class="text-sm font-medium opacity-75">Total Estudiantes</p>
                            <p class="text-3xl font-semibold mt-1">{{ $totalEstudiantes }}</p>
                        </div>
                        
                        <div class="bg-teal-600 overflow-hidden shadow rounded-lg p-5 text-white">
                            <p class="text-sm font-medium opacity-75">Total Cursos</p>
                            <p class="text-3xl font-semibold mt-1">{{ $totalCursos }}</p>
                        </div>
                        
                        <div class="bg-pink-600 overflow-hidden shadow rounded-lg p-5 text-white">
                            <p class="text-sm font-medium opacity-75">Sesiones Creadas</p>
                            <p class="text-3xl font-semibold mt-1">{{ $totalSesiones }}</p>
                        </div>
                        
                    </div>

<h3 class="text-xl font-bold mt-10 mb-4">Gestión de Datos Maestros</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        
                        <a href="{{ route('estudiantes.index') }}" class="block p-5 bg-green-100 hover:bg-green-50 border border-green-200 rounded-lg shadow transition duration-150 ease-in-out">
                            <h4 class="font-semibold text-lg text-green-700">Estudiantes</h4>
                            <p class="text-sm text-gray-600 mt-1">Gestión de perfiles, cuentas de acceso y asignación de Grupos.</p>
                        </a>

                        <a href="{{ route('docentes.index') }}" class="block p-5 bg-gray-100 hover:bg-indigo-50 border border-gray-200 rounded-lg shadow transition duration-150 ease-in-out">
                            <h4 class="font-semibold text-lg text-indigo-700">Docentes</h4>
                            <p class="text-sm text-gray-600 mt-1">Crear, editar y eliminar perfiles de Docentes y sus cuentas de usuario.</p>
                        </a>
                        
                        <a href="{{ route('cursos.index') }}" class="block p-5 bg-indigo-100 hover:bg-indigo-50 border border-indigo-200 rounded-lg shadow transition duration-150 ease-in-out">
                            <h4 class="font-semibold text-lg text-indigo-700">Cursos</h4>
                            <p class="text-sm text-gray-600 mt-1">Gestión de datos de Cursos (Nombre, descripción, estado).</p>
                        </a>

                        <a href="{{ route('grupos.index') }}" class="block p-5 bg-purple-100 hover:bg-purple-50 border border-purple-200 rounded-lg shadow transition duration-150 ease-in-out">
                            <h4 class="font-semibold text-lg text-purple-700">Grupos / Secciones</h4>
                            <p class="text-sm text-gray-600 mt-1">Gestionar secciones (Carrera + Semestre + Identificador).</p>
                        </a>

                       
                        
                        </div>
                        
                        <br>
                        <p class="text-gray-600">Desde aquí podrás agregar, editar y eliminar información de: Carreras, Grupos, Docentes y Estudiantes.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>