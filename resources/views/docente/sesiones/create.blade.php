<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Generar Nueva Sesión de Clase (CU02)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('docente.sesiones.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="curso_id" :value="__('Curso')" />
                            <select id="curso_id" name="curso_id" required class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Seleccione un Curso</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id_curso }}">{{ $curso->nombre }} ({{ $curso->codigo }})</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('curso_id')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="aula" :value="__('Aula o Laboratorio')" />
                            <x-text-input id="aula" name="aula" type="text" class="mt-1 block w-full" required autofocus :value="old('aula')" />
                            <x-input-error :messages="$errors->get('aula')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="fecha_inicio" :value="__('Fecha y Hora de Inicio')" />
                            <x-text-input id="fecha_inicio" name="fecha_inicio" type="datetime-local" class="mt-1 block w-full" required />
                            <x-input-error :messages="$errors->get('fecha_inicio')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="fecha_fin" :value="__('Fecha y Hora de Fin')" />
                            <x-text-input id="fecha_fin" name="fecha_fin" type="datetime-local" class="mt-1 block w-full" required />
                            <x-input-error :messages="$errors->get('fecha_fin')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Generar Sesión') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>