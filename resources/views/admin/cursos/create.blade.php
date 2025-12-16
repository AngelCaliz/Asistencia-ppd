<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nuevo Curso') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('cursos.store') }}">
                    @csrf
                    
                    <div class="mt-4">
                        <x-input-label for="nombre" :value="__('Nombre del Curso')" />
                        <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre')" required autofocus />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>
                    <div class="mt-4">
    <x-input-label for="codigo" :value="__('Código del Curso (Ej: DWI25)')" />
    <x-text-input id="codigo" name="codigo" type="text" class="mt-1 block w-full" :value="old('codigo')" required />
    <x-input-error :messages="$errors->get('codigo')" class="mt-2" />
</div>

                    <div class="mt-4">
                        <x-input-label for="descripcion" :value="__('Descripción (Opcional)')" />
                        <textarea id="descripcion" name="descripcion" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">{{ old('descripcion') }}</textarea>
                        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>
                    
                    <div class="mt-6">
                        <x-input-label for="activo" :value="__('Estado del Curso')" class="mb-2"/>
                        <label for="activo_on" class="inline-flex items-center mr-6">
                            <input id="activo_on" type="radio" name="activo" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('activo', 1) == 1 ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-600">{{ __('Activo') }}</span>
                        </label>
                        <label for="activo_off" class="inline-flex items-center">
                            <input id="activo_off" type="radio" name="activo" value="0" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('activo', 1) == 0 ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-600">{{ __('Inactivo') }}</span>
                        </label>
                        <x-input-error :messages="$errors->get('activo')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button>
                            {{ __('Guardar Curso') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>