<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nuevo Grupo/Sección') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('grupos.store') }}">
                    @csrf
                    
                    <div class="mt-4">
                        <x-input-label for="carrera" :value="__('Nombre de la Carrera (Ej: Desarrollo de Sistemas de Información)')" />
                        <x-text-input id="carrera" name="carrera" type="text" class="mt-1 block w-full" :value="old('carrera')" required autofocus />
                        <x-input-error :messages="$errors->get('carrera')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="nombre" :value="__('Nombre del Grupo/Sección (Ej: DSI-IV-B, CONT-VI-A)')" />
                        <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full uppercase" :value="old('nombre')" required />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        <p class="text-xs text-gray-500 mt-1">Debe ser una combinación única de Carrera, Semestre y Letra/Identificador.</p>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button class="bg-purple-600 hover:bg-purple-700">
                            {{ __('Guardar Grupo') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>