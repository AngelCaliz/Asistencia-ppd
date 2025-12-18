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
                            <x-input-label for="asignacion_id" :value="__('Curso y Grupo Asignado')" />
                            <select id="asignacion_id" name="asignacion_id" required class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Seleccione un Curso/Grupo</option>
                                @foreach ($misAsignaciones as $asig)
                                    <option value="{{ $asig->id_asignacion }}" 
                                        {{ (old('asignacion_id') == $asig->id_asignacion || $asignacionId == $asig->id_asignacion) ? 'selected' : '' }}>
                                        {{ $asig->curso->nombre }} - Grupo: {{ $asig->grupo->nombre }} ({{ $asig->curso->codigo }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('asignacion_id')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="aula" :value="__('Aula o Laboratorio')" />
                            <x-text-input id="aula" name="aula" type="text" class="mt-1 block w-full" required autofocus :value="old('aula')" placeholder="Ej: Laboratorio A-102" />
                            <x-input-error :messages="$errors->get('aula')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="fecha_inicio" :value="__('Fecha y Hora de Inicio')" />
                            <x-text-input id="fecha_inicio" name="fecha_inicio" type="datetime-local" class="mt-1 block w-full" required :value="old('fecha_inicio', now()->format('Y-m-d\TH:i'))" />
                            <x-input-error :messages="$errors->get('fecha_inicio')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="fecha_fin" :value="__('Fecha y Hora de Fin')" />
                            <x-text-input id="fecha_fin" name="fecha_fin" type="datetime-local" class="mt-1 block w-full" required :value="old('fecha_fin', now()->addHours(2)->format('Y-m-d\TH:i'))" />
                            <x-input-error :messages="$errors->get('fecha_fin')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Generar Código y Sesión') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>