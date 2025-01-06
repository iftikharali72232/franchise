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
                    <div class="">

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
                                Forgot Password
                            </h5>
                        </div>
                        <p class="text-[#1F507799] md:text-start text-center mt-2 md:ps-14 md:pe-20">
                            Enter your email to reset the password
                        </p>
                    </div>

                    <div class="pt-10">
                        <form id="otp-form" class="space-y-10">
                            <div class="md:px-[15%] px-[5%]">
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
                                        class="w-full {{ app()->getLocale() == 'ar' ? 'pl-3 pr-12' : 'pl-12 pr-3' }} py-4 border border-gray-300 rounded-full shadow-sm focus:outline-none text-gray-900"
                                        name="email" 
                                        required 
                                        autocomplete="email" 
                                        autofocus
                                    />
                                </div>
                            </div>

                            <div class="flex justify-center pb-4">
                                <button
                                    type="submit"
                                    class="px-[30px] py-[10px] bg-[#1F5077] text-white font-semibold rounded-full"
                                >
                                    Reset
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection