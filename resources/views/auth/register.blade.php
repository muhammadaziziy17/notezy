@extends('layouts.app')

@section('sign_page')
    <div class="card w-full max-w-md shadow-2xl bg-base-100 items-center">
        <div class="card-body">
            <h2 class="text-3xl font-bold text-center mb-2 text-primary">Notezy</h2>
            <p class="text-center text-sm text-gray-500 mb-6">Yangi akkaunt yarating</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Ism --}}
                <div class="form-control mb-4">
                    <label for="name" class="label">
                        <span class="label-text font-semibold">Ismingiz</span>
                    </label>
                    <label class="input input-bordered flex items-center gap-2 @error('name') input-error @enderror">
                        <i class="fa-solid fa-user text-gray-400"></i>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required
                            autocomplete="name" autofocus class="grow focus:outline-none focus:ring-0"
                            placeholder="Ism kiriting" />
                    </label>
                    @error('name')
                        <span class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-control mb-4">
                    <label for="email" class="label">
                        <span class="label-text font-semibold">Email manzil</span>
                    </label>
                    <label class="input input-bordered flex items-center gap-2 @error('email') input-error @enderror">
                        <i class="fa-solid fa-envelope text-gray-400"></i>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autocomplete="email" class="grow focus:outline-none focus:ring-0"
                            placeholder="example@email.com" />
                    </label>
                    @error('email')
                        <span class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Parol --}}
                <div class="form-control mb-4">
                    <label for="password" class="label">
                        <span class="label-text font-semibold">Parol</span>
                    </label>
                    <label class="input input-bordered flex items-center gap-2 @error('password') input-error @enderror">
                        <i class="fa-solid fa-lock text-gray-400"></i>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="grow focus:outline-none focus:ring-0" placeholder="••••••••" />
                    </label>
                    @error('password')
                        <span class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Parolni tasdiqlang --}}
                <div class="form-control mb-6">
                    <label for="password-confirm" class="label">
                        <span class="label-text font-semibold">Parolni tasdiqlang</span>
                    </label>
                    <label class="input input-bordered flex items-center gap-2">
                        <i class="fa-solid fa-shield-halved text-gray-400"></i>
                        <input id="password-confirm" type="password" name="password_confirmation" required
                            autocomplete="new-password" class="grow focus:outline-none focus:ring-0"
                            placeholder="••••••••" />
                    </label>
                </div>

                {{-- Ro‘yxatdan o‘tish tugmasi --}}
                <div class="form-control mt-4">
                    <button type="submit" class="btn btn-primary w-full transition-all duration-200 hover:scale-[1.02]">
                        <i class="fa-solid fa-user-plus mr-2"></i> Ro'yhatdan o'tish
                    </button>
                </div>

                {{-- Login havolasi --}}
                <div class="text-center mt-4">
                    <p class="text-sm text-gray-500">
                        Hisobingiz bormi?
                        <a href="{{ route('login') }}" class="link link-primary font-semibold">Kirish</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('title')
    Ro'yhatdan o'tish
@endsection
