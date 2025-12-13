<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Asistencia (CU05)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-2xl font-bold mb-6 text-center">Ingresa el Código de Sesión</h3>
                    
                    <form method="POST" action="{{ route('estudiante.asistencia.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="codigo_sesion" :value="__('Código de 6 dígitos')" class="text-center" />
                            <x-text-input 
                                id="codigo_sesion" 
                                name="codigo_sesion" 
                                type="text" 
                                class="mt-1 block w-full text-center text-3xl p-4 uppercase tracking-widest" 
                                required 
                                autofocus 
                                maxlength="6"
                                placeholder="XXXXXX" 
                                :value="old('codigo_sesion')" 
                            />
                            <x-input-error :messages="$errors->get('codigo_sesion')" class="mt-2 text-center" />
                            @if (session('error'))
                                <p class="text-sm text-red-600 mt-2 text-center">{{ session('error') }}</p>
                            @endif
                        </div>

                        <div class="flex items-center justify-center mt-6">
                            <x-primary-button>
                                {{ __('Confirmar Asistencia') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>