
@extends('layouts.app')

@section('title', 'Login SIM-Surat')

@section('content')
<div class="login-background">

    <div class="absolute -left-20 -top-20 h-64 w-64 rounded-full bg-blue-200/30 blur-3xl"></div>
    <div class="absolute -bottom-20 -right-20 h-64 w-64 rounded-full bg-indigo-200/40 blur-3xl"></div>

    <div class="login-card">

        <div class="login-icon">
            ✉️
        </div>

        <h1 class="login-heading">
            Selamat Datang!
        </h1>

        <p class="login-description">
            Silakan masuk untuk mengakses Sistem Informasi Surat.
        </p>

        <form method="POST" action="{{ route('login.submit') }}" class="mt-8">
            @csrf

            <div class="form-group">
                <label class="form-label">Alamat Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan alamat email"
                    required
                    autocomplete="email"
                >

                @error('email')
                    <p class="mt-2 text-xs text-red-500">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                    autocomplete="current-password"
                >

                @error('password')
                    <p class="mt-2 text-xs text-red-500">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <button
                type="submit"
                class="primary-button w-full mt-3"
            >
                Login
            </button>
        </form>

        <div class="mt-7 border-t border-slate-100 pt-5 text-center">
            <p class="text-xs text-slate-400">
                SIM-Surat &copy; 2026
            </p>
            <p class="mt-1 text-xs text-slate-400">
                Sistem Informasi Pengelolaan Surat
            </p>
        </div>

    </div>
</div>
@endsection
