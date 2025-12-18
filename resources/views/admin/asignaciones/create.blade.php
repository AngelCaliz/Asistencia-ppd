<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Asignación de Curso') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if (session('error'))
                    <div class="mb-4 text-red-600 font-medium">{{ session('error') }}</div>
                @endif

                <form method="POST" action="{{ route('asignaciones.store') }}">
                    @csrf

                    <div class="mt-4">
                        <x-input-label for="docente_id" :value="__('Docente')" />
                        <select id="docente_id" name="docente_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Seleccione un docente...</option>
                            @foreach($docentes as $docente)
                                <option value="{{ $docente->id_docente }}" {{ old('docente_id') == $docente->id_docente ? 'selected' : '' }}>
                                    {{ $docente->nombres }} {{ $docente->apellidos }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('docente_id')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="curso_id" :value="__('Curso')" />
                        <select id="curso_id" name="curso_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Seleccione un curso...</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id_curso }}" {{ old('curso_id') == $curso->id_curso ? 'selected' : '' }}>
                                    [{{ $curso->codigo }}] {{ $curso->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('curso_id')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="grupo_id" :value="__('Grupo')" />
                        <select id="grupo_id" name="grupo_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Seleccione un grupo...</option>
                            @foreach($grupos as $grupo)
                                <option value="{{ $grupo->id_grupo }}" {{ old('grupo_id') == $grupo->id_grupo ? 'selected' : '' }}>
                                    {{ $grupo->nombre }} - {{ $grupo->carrera }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('grupo_id')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="periodo" :value="__('Periodo Académico')" />
                        <x-text-input id="periodo" name="periodo" type="text" class="mt-1 block w-full" :value="old('periodo', '2025-I')" required />
                        <x-input-error :messages="$errors->get('periodo')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button>
                            {{ __('Crear Asignación') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>