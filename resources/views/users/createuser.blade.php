@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{ __('Registrar Usuario') }}</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="/register" method="POST" role="form text-left">
                        @csrf
                        <!-- Mostrar errores de validación -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name" class="form-control-label">{{ __('Nombre') }}</label>
                                    <input class="form-control @error('first_name') is-invalid @enderror" type="text"
                                        placeholder="Nombre" id="first-name" name="first_name"
                                        value="{{ old('first_name') }}">
                                    @error('first_name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last-name" class="form-control-label">{{ __('Apellido') }}</label>
                                    <input class="form-control @error('last_name') is-invalid @enderror" type="text"
                                        placeholder="Apellido" id="last-name" name="last_name"
                                        value="{{ old('last_name') }}">
                                    @error('last_name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-control-label">{{ __('Correo') }}</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email"
                                        placeholder="Correo" id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-control-label">{{ __('Contraseña') }}</label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                        placeholder="Contraseña" id="password" name="password">
                                    @error('password')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password-confirm"
                                        class="form-control-label">{{ __('Verificar Contraseña') }}</label>
                                    <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                        type="password" placeholder="Verificar Contraseña" id="password-confirm"
                                        name="password_confirmation">
                                    @error('password_confirmation')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                    <p id="password-error" class="text-danger text-xs mt-2"></p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4"
                                id="submit-button">{{ 'Registrar' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript para verificar contraseñas -->
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const password = document.getElementById('password');
            const passwordConfirm = document.getElementById('password-confirm');
            const passwordError = document.getElementById('password-error');
            const submitButton = document.getElementById('submit-button');

            function checkPasswords() {
                if (password.value !== passwordConfirm.value) {
                    passwordConfirm.setCustomValidity('Las contraseñas no coinciden.');
                    passwordError.textContent = 'Las contraseñas no coinciden.';
                    submitButton.disabled = true;
                } else {
                    passwordConfirm.setCustomValidity('');
                    passwordError.textContent = '';
                    submitButton.disabled = false;
                }
            }

            password.addEventListener('input', checkPasswords);
            passwordConfirm.addEventListener('input', checkPasswords);
        });
    </script>
@endsection
