<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nuevo Estudiante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('estudiantes.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <h4 class="text-lg font-semibold mb-3 border-b pb-1">Datos Personales y Grupo</h4>
                            
                            <div class="mt-4">
                                <x-input-label for="nombres" :value="__('Nombres')" />
                                <x-text-input id="nombres" name="nombres" type="text" class="mt-1 block w-full" :value="old('nombres')" required />
                                <x-input-error :messages="$errors->get('nombres')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="apellidos" :value="__('Apellidos')" />
                                <x-text-input id="apellidos" name="apellidos" type="text" class="mt-1 block w-full" :value="old('apellidos')" required />
                                <x-input-error :messages="$errors->get('apellidos')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="dni" :value="__('DNI')" />
                                <x-text-input id="dni" name="dni" type="text" class="mt-1 block w-full" :value="old('dni')" required maxlength="8" />
                                <x-input-error :messages="$errors->get('dni')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="codigo_institucional" :value="__('Código Institucional')" />
                                <x-text-input id="codigo_institucional" name="codigo_institucional" type="text" class="mt-1 block w-full" :value="old('codigo_institucional')" required />
                                <x-input-error :messages="$errors->get('codigo_institucional')" class="mt-2" />
                            </div>
                            
                            <div class="mt-4">
                                <x-input-label for="grupo_id" :value="__('Grupo/Sección Asignado')" />
                                <select id="grupo_id" name="grupo_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">-- Seleccionar Grupo --</option>
                                    @foreach ($grupos as $grupo)
                                        <option value="{{ $grupo->id_grupo }}" {{ old('grupo_id') == $grupo->id_grupo ? 'selected' : '' }}>
                                            {{ $grupo->carrera }} ({{ $grupo->nombre }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('grupo_id')" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold mb-3 border-b pb-1">Datos de Acceso</h4>
                            
                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Email (Acceso)')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Contraseña')" />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
                                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>

                    </div>
                    
                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button class="bg-green-600 hover:bg-green-700">
                            {{ __('Guardar Estudiante') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>