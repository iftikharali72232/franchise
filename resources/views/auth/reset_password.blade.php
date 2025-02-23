@extends('layouts.app')
<?php
use App\Helpers\CommonHelper;
?>
@section('content')

<div class="h-screen w-full bg-[#F3F7FC]">
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
                    <div class="">
                        <!-- Additional content if needed -->
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
                        <div class="flex md:justify-start justify-center items-center">
                            <a href="{{ route('login') }}" 
                                class="w-10 h-10 flex items-center justify-center rounded-full bg-gradient-to-b from-[#1F5077] to-[#3A95DD]">
                                <img src="{{ asset('images/arrow-left.png') }}" class="w-auto {{ app()->getLocale() == 'ar' ? 'rotate-[180deg]' : '' }}" alt="Arrow Left" />
                            </a>
                            <h5 class="ps-4 md:text-3xl text-2xl md:text-start text-center font-bold text-[#1F5077]">
                                {{ trans('lang.reset_password') }}
                            </h5>
                        </div>
                        <p class="text-[#1F507799] md:text-start text-center mt-2 md:ps-14">
                            {{ trans('lang.enter_new_password') }}
                        </p>
                    </div>

                    <form class="needs-validation" method="POST" action="{{ route('login') }}">
                        <div class="flex flex-col items-center mt-10">
                            <div class="grid grid-cols-1 bg-[#D6E7F5] rounded-[40px] md:w-[90%] w-[95%] md:p-10 p-6 md:gap-6">
                                @csrf
                                <div class="">
                                    <div class="relative w-full mt-2">
                                        <!-- Overlapping Icon -->
                                        <div class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'right-0 pr-4' : 'left-0 pl-4' }} flex items-center">
                                            <img src="{{ asset('images/lock.png') }}" class="h-[20px]" />
                                        </div>
                                        <!-- Input Field -->
                                        <input 
                                            id="new-password" 
                                            type="password" 
                                            placeholder="{{ trans('lang.new_password') }}" 
                                            class="w-full {{ app()->getLocale() == 'ar' ? 'pl-10 pr-12' : 'pl-12 pr-10' }} py-4 border border-gray-300 rounded-full shadow-sm focus:outline-none text-gray-900"
                                            name="new-password" 
                                            required 
                                            autocomplete="new-password"
                                        />
                                        
                                        <div class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center">
                                            <button type="button" id="togglePassword" class="focus:outline-none">
                                                <img src="{{ asset('images/showeye.svg') }}" id="eyeOpen" class="h-5 w-5 opacity-[0.3]" />
                                                <img src="{{ asset('images/hideye.svg') }}" id="eyeClosed" class="hidden h-5 w-5 opacity-[0.3]" />
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="relative w-full mt-2">
                                        <!-- Overlapping Icon -->
                                        <div class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'right-0 pr-4' : 'left-0 pl-4' }} flex items-center">
                                            <img src="{{ asset('images/lock.png') }}" class="h-[20px]" />
                                        </div>
                                        <!-- Input Field -->
                                        <input 
                                            id="confirm-new-password" 
                                            type="password" 
                                            placeholder="{{ trans('lang.confirm_new_password') }}" 
                                            class="w-full {{ app()->getLocale() == 'ar' ? 'pl-10 pr-12' : 'pl-12 pr-10' }} py-4 border border-gray-300 rounded-full shadow-sm focus:outline-none text-gray-900"
                                            name="confirm-new-password" 
                                            required 
                                            autocomplete="confirm-new-password"
                                        />
                                        
                                        <div class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center">
                                            <button type="button" id="togglePassword" class="focus:outline-none">
                                                <img src="{{ asset('images/showeye.svg') }}" id="eyeOpen" class="h-5 w-5 opacity-[0.3]" />
                                                <img src="{{ asset('images/hideye.svg') }}" id="eyeClosed" class="hidden h-5 w-5 opacity-[0.3]" />
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="flex items-center flex-col justify-center mt-4">
                                <button type="submit" class="px-[30px] py-[10px] bg-[#1F5077] text-white font-semibold rounded-full">
                                    {{ trans('lang.submit') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
