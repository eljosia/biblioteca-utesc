@extends('layouts.auth')

@section('content')
    <div class="px-5 py-5 p-lg-0">
        <div class="d-flex justify-content-center">
            <div
                class="col-12 col-md-9 col-lg-7 min-h-lg-screen d-flex flex-column justify-content-center py-lg-16 px-lg-20 position-relative">
                <div class="card shadow p-10 row">
                    <div class="col-lg-10 col-md-9 col-xl-7 mx-auto">
                        <div class="text-center mb-5">
                            <img src="{{ image('logo.png') }}" class="img-fluid" alt="" width="100">
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-5">
                                <label class="form-label" for="email">Correo Electrónico</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label class="form-label" for="password">Contraseña</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="check_example">
                                        Recuerdame
                                    </label>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary w-full">
                                    {{ __('Iniciar Sesión') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
