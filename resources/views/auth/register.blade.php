@extends('layout')

@section('title', 'Register')

@section('container')

<div class="container float-right">
        <x-auth-card>
            <x-slot name="logo">
            </x-slot>

            <div class="ml-5" style="width: 18rem;">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <x-label for="name" :value="__('Name')" />

                        <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus />
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <x-label for="email" :value="__('Email')" />

                        <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <x-label for="password" :value="__('Password')" />

                        <x-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <x-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required />
                    </div>

                    <!-- Role -->

                    <div class="form-check">
                        <x-input id="role" class="form-check-input" type="checkbox" name="role" />

                        <x-label class="form-check-label" for="role" :value="__('Developer')" />
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

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

            </div>
        </x-auth-card>
</div>

@endsection