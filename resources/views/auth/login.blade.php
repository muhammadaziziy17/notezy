@extends('layouts.app')

@section('sign_page')
    <div class="card w-full max-w-md bg-base-100 shadow-lg" id="login_page_form">
        <div class="card-body">
            <h2 class="text-2xl font-bold text-center mb-4">Kirish</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email kirish -->
                <div class="form-control mb-3">
                    <label class="label">
                        <span class="label-text">Elektron pochta</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="input input-bordered w-full focus:border-primary focus:outline-none focus:ring-0" require
                        dautofocus>
                    @error('email')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Parol -->
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Parol</span>
                    </label>
                    <input type="password" name="password"
                        class="input input-bordered w-full  focus:border-primary focus:outline-none focus:ring-0" required>
                    @error('password')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Eslab qolish -->
                <div class="form-control mb-4 flex items-center gap-2">
                    <input type="checkbox" id="remember" name="remember" class="checkbox checkbox-primary"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="label-text">Meni eslab qol</label>
                </div>

                <!-- Submit -->
                <div class="form-control">
                    <button type="submit" class="btn btn-primary w-full">Kirish</button>
                </div>
            </form>

            <div class="text-center mt-4 text-sm">
                <p>Agar hisobingiz bo'lmasa, <a href="{{ route('register') }}" class="link link-primary">Ro'yxatdan
                        o'ting</a>.</p>
            </div>
        </div>
    </div>
@endsection
@section('title')
    Notezy kirish
@endsection
