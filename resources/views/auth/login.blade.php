@extends('layouts.app')
<?php
use App\Helpers\CommonHelper;
?>
@section('content')

<div class="h-screen bg-[#F3F7FC]">
    <div class="grid lg:grid-cols-7 grid-cols-1 lg:gap-4 lg:h-screen">
        <div class="lg:col-span-2 lg:h-screen bg-[#1F5077] relative">
            <div class="absolute bg-[url('/images/design-pattern.png')] bg-repeat h-[100%] w-full"></div>
            <div class="flex justify-center items-center h-full">
                <div class="w-full h-[250px] bg-[#1F5077] z-40">
                    <img src="{{ asset('images/logo.png') }}" class="object-contain w-full h-full" />
                </div>
            </div>
        </div>

        <div class="lg:col-span-5 lg:p-20 p-10 h-full overflow-y-auto scrollbar-hidden">
            <div class="bg-white rounded-2xl">
                <div class="flex md:flex-row flex-col md:justify-between">
                    <div class="md:w-[40%]">
                        <div class="bg-[#F3F7FC] p-10 w-full {{ app()->getLocale() == 'ar' ? 'rounded-bl-[100px]' : 'rounded-br-[100px]' }} ">
                            <h2 class="text-4xl font-bold bg-gradient-to-b from-[#1F5077] to-[#3A95DD] bg-clip-text text-transparent">Welcome</h2>
                        </div>
                    </div>
                    <div class="md:px-10 pt-4 flex md:justify-start justify-center">
                        <label class="switch btn-color-mode-switch">
                            <input 
                                value="1" 
                                id="color_mode" 
                                name="color_mode" 
                                type="checkbox"
                                onchange="changeLanguage()"
                                {{ app()->getLocale() == 'ar' ? 'checked' : '' }}>
                            <label 
                                class="btn-color-mode-switch-inner" 
                                data-off="EN" 
                                data-on="AR" 
                                for="color_mode">
                            </label>
                        </label>
                    </div>
                </div>

                <div class="md:p-10 p-6">
                    <div class="">
                        <h5 class="md:text-3xl text-2xl md:text-start text-center font-bold text-[#1F5077]">{{trans('lang.login_to_account')}}</h5>
                        <p class="text-[#1F507799] md:text-start text-center mt-2">{{trans('lang.enter_username_password')}}</p>
                    </div>

                    <form class="needs-validation" method="POST" action="{{ route('login') }}">
                        <div class="flex flex-col items-center mt-10">
                            <div class="bg-[#D6E7F5] rounded-[40px] md:w-[70%] w-[95%] md:p-10 p-6">
                                @csrf
                                <div class="">
                                    <label for="yourUsername" class="text-[#1F507780]">{{trans('lang.username')}}</label>
                                    <div class="relative w-full mt-2">
                                        <!-- Overlapping Icon -->
                                        <div class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'right-0 pr-4' : 'left-0 pl-4' }} flex items-center">
                                            <img src="{{ asset('images/user.png') }}" class="h-[20px]" />
                                        </div>
                                        <!-- Input Field -->
                                        <input 
                                            id="email"
                                            type="email" 
                                            placeholder="{{trans('lang.username')}}" 
                                            class="w-full {{ app()->getLocale() == 'ar' ? 'pl-3 pr-12' : 'pr-3 pl-12' }} py-4 border border-gray-300 rounded-full shadow-sm focus:outline-none text-gray-900 @error('email') is-invalid @enderror"
                                            name="email" 
                                            value="{{ old('email') }}" 
                                            required 
                                            autocomplete="email" 
                                            autofocus
                                        />
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <label for="yourPassword" class="text-[#1F507780]">{{trans('lang.password')}}</label>
                                    <div class="relative w-full mt-2">
                                        <!-- Overlapping Icon -->
                                        <div class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'right-0 pr-4' : 'left-0 pl-4' }} flex items-center">
                                            <img src="{{ asset('images/lock.png') }}" class="h-[20px]" />
                                        </div>
                                        <!-- Input Field -->
                                        <input 
                                            id="password" 
                                            type="password" 
                                            placeholder="Password" 
                                            class="w-full {{ app()->getLocale() == 'ar' ? 'pl-10 pr-12' : 'pr-10 pl-12' }} py-4 border border-gray-300 rounded-full shadow-sm focus:outline-none text-gray-900 @error('password') is-invalid @enderror"
                                            name="password" 
                                            required 
                                            autocomplete="current-password"
                                        />
                                        
                                        <div class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center">
                                            <button type="button" id="togglePassword" class="focus:outline-none">
                                            <img src="{{ asset('images/showeye.svg') }}" id="eyeOpen" class="h-5 w-5 opacity-[0.3]" />
                                            <img src="{{ asset('images/hideye.svg') }}" id="eyeClosed" class="hidden h-5 w-5 opacity-[0.3]" />
                                            </button>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mt-2">
                                    <!-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{trans('lang.remember_me') }}
                                            </label>
                                        </div>
                                    </div> -->

                                    @if (Route::has('password.request'))
                                        <a class="text-[#19B2E7]" href="{{ route('password.request') }}">
                                            {{ trans('lang.forgot_password') }}
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="flex items-center flex-col justify-center mt-4">
                                    <button type="submit" class="px-[30px] py-[10px] bg-[#1F5077] text-white font-semibold rounded-full">
                                        {{ trans('lang.login') }}
                                    </button>

                                    <p class="text-[#1F507799] mt-3 md:text-start text-center md:px-0 px-4">
                                        If you do not have an account,
                                        <span> 
                                            <a class="text-[#1F5077]" href="{{ route('register') }}">
                                                Register Now
                                            </a>
                                        </span>
                                    </p>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection