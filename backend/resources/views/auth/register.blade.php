<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>
            

            <!-- Apellido -->
            <div>
                <x-label for="apellido" :value="__('Apellido')" />

                <x-input id="apellido" class="block mt-1 w-full" type="text" name="apellido" :value="old('apellido')" required autofocus />
            </div>

            <!-- Celular -->
            <div>
                <x-label for="celular" :value="__('Celular')" />

                <x-input id="celular" class="block mt-1 w-full" type="text" name="celular" :value="old('celular')" required autofocus />
            </div>

            <!-- Fecha Nacimiento -->
            <div>
                <x-label for="fecha_nacimiento" :value="__('Fecha Nacimiento')" />

                <x-input id="fecha_nacimiento" class="block mt-1 w-full" type="date" name="fecha_nacimiento" :value="old('fecha_nacimiento')" required autofocus />
            </div>

            <!-- Sexo -->
            <div class="row mb-3">
                <label for="sexo" class="col-md-4 col-form-label text-md-end">{{ __('sexo') }}</label>

                <div class="col-md-6">
                    <select name="sexo" id="sexo" class="form-control">
                        <option value="" disabled>Sexo</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                    </select>

                    @error('sexo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
