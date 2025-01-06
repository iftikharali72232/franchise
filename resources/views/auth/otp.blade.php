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
                                OTP Verification
                            </h5>
                        </div>
                        <p class="text-[#1F507799] md:text-start text-center mt-2 md:ps-14 md:pe-20">
                        To confirm your account & complete the registration process, an activation code has been sent to your email
                        </p>
                    </div>

                    <div class="">
                        <form id="otp-form" class="space-y-10">
                            <div class="flex justify-center my-6 gap-2">
                                <input
                                    type="text"
                                    maxlength="1"
                                    class="bg-[#F3F7FC] shadow-xs flex md:w-[80px] w-[40px] md:h-[80px] h-[50px] items-center justify-center md:rounded-2xl rounded-lg p-2 text-center text-2xl font-medium text-gray-5 outline-none sm:text-4xl"
                                />
                                <input
                                    type="text"
                                    maxlength="1"
                                    class="bg-[#F3F7FC] shadow-xs flex md:w-[80px] w-[40px] md:h-[80px] h-[50px] items-center justify-center md:rounded-2xl rounded-lg p-2 text-center text-2xl font-medium text-gray-5 outline-none sm:text-4xl"
                                />
                                <input
                                    type="text"
                                    maxlength="1"
                                    class="bg-[#F3F7FC] shadow-xs flex md:w-[80px] w-[40px] md:h-[80px] h-[50px] items-center justify-center md:rounded-2xl rounded-lg p-2 text-center text-2xl font-medium text-gray-5 outline-none sm:text-4xl"
                                />
                                <input
                                    type="text"
                                    maxlength="1"
                                    class="bg-[#F3F7FC] shadow-xs flex md:w-[80px] w-[40px] md:h-[80px] h-[50px] items-center justify-center md:rounded-2xl rounded-lg p-2 text-center text-2xl font-medium text-gray-5 outline-none sm:text-4xl"
                                />
                                <input
                                    type="text"
                                    maxlength="1"
                                    class="bg-[#F3F7FC] shadow-xs flex md:w-[80px] w-[40px] md:h-[80px] h-[50px] items-center justify-center md:rounded-2xl rounded-lg p-2 text-center text-2xl font-medium text-gray-5 outline-none sm:text-4xl"
                                />
                                <input
                                    type="text"
                                    maxlength="1"
                                    class="bg-[#F3F7FC] shadow-xs flex md:w-[80px] w-[40px] md:h-[80px] h-[50px] items-center justify-center md:rounded-2xl rounded-lg p-2 text-center text-2xl font-medium text-gray-5 outline-none sm:text-4xl"
                                />
                            </div>

                            <div class="flex justify-center pb-4">
                                <button
                                    type="submit"
                                    class="px-[30px] py-[10px] bg-[#1F5077] text-white font-semibold rounded-full"
                                >
                                    Verify
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