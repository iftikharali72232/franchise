@extends('layouts.app')
<?php
use App\Helpers\CommonHelper;
?>
@section('content')

<div class="h-screen bg-[#F3F7FC]">
    <div class="grid grid-cols-7 gap-4">
        <div class="col-span-2 h-screen bg-[#1F5077] relative">
            <div class="absolute bg-[url('/public/images/design-pattern.png')] bg-repeat-x h-[235px] w-full"></div>
            <div class="flex justify-center items-center h-full">
                <div class="w-[400px] h-[400px]">
                    <img src="{{ asset('images/logo.png') }}" class="object-fit w-full h-full" />
                </div>
            </div>
            <div class="absolute bottom-0 bg-[url('/public/images/design-pattern.png')] bg-repeat-x h-[235px] w-full"></div>
        </div>

        <div class="col-span-5 p-20">
            <div class="bg-white rounded-2xl">
                <div class="flex justify-between">
                    <div class="w-[40%]">
                        <div class="bg-[#F3F7FC] p-10 w-full rounded-bl-[100px]">
                            <h2 class="text-4xl font-bold bg-gradient-to-b from-[#1F5077] to-[#3A95DD] bg-clip-text text-transparent">Welcome</h2>
                        </div>
                    </div>
                    <div class="px-10 pt-4">
                        <label class="switch btn-color-mode-switch">
                            <input 
                                value="1" 
                                id="color_mode" 
                                name="color_mode" 
                                type="checkbox"
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

                <div class="p-10">
                    <div class="">
                        <h5 class="card-title text-center pb-0 fs-4">{{trans('lang.login_to_account')}}</h5>
                        <p class="text-center small">{{trans('lang.enter_username_password')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection