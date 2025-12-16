<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nuevo Docente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('docentes.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <h4 class="text-lg font-semibold mb-3 border-b pb-1">Datos Personales</h4>
                            
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
                        <x-primary-button>
                            {{ __('Guardar Docente') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>