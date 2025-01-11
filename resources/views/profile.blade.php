
@extends('layouts.app')

@section('content')

<div class="w-full rounded-xl bg-white bg-clip-border text-gray-700 shadow-md p-6">
    <form>
        <div class="w-full rounded-xl bg-white bg-clip-border text-gray-700 shadow-md p-8">
            <h4 class="text-[#1D3F5D] font-semibold text-2xl md:text-start text-center">Basic Details</h4>

            <div class="flex flex-col md:items-start items-center justify-center my-4">
                <!-- Image Preview Container -->
                <div class="relative px-6">
                    <img
                    id="imagePreview"
                    src="/images/profile-placeholder.jpg"
                    alt="Preview"
                    class="w-[130px] h-[130px] rounded-full border border-[#1F5077] object-cover"
                    />
                    <input
                    type="file"
                    id="imageInput"
                    accept="image/*"
                    class="absolute inset-0 opacity-0 cursor-pointer"
                    onchange="previewImage(event)"
                    />
                </div>

                <div class="flex items-center w-auto md:mt-0 mt-1">
                    <button
                        type="button"
                        onclick="document.getElementById('imageInput').click()"
                        class="bg-[#1F5077] rounded-full p-3 shadow"
                    >
                        <img src="{{asset('images/choose-img.png')}}" alt="choose image" />
                    </button>
                </div>
            </div>

            <div class="">
                <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                    <div class="flex flex-col justify-center w-full">
                        <label class="text-[#1D3F5D] font-semibold ps-2 pb-2">Name <span class="text-red-500">*</span></label>
                        <input type="text" class="px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:outline-none rounded-full" placeholder="Grgir Person">
                    </div>

                    <div class="flex flex-col justify-center w-full">
                        <label class="text-[#1D3F5D] font-semibold ps-2 pb-2">Email <span class="text-red-500">*</span></label>
                        <input type="email" class="px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:outline-none rounded-full" placeholder="info@grgirperson.com">
                    </div>

                    <div class="flex flex-col justify-center w-full">
                        <label class="text-[#1D3F5D] font-semibold ps-2 pb-2">Passwrod <span class="text-red-500">*</span></label>

                        <div class="relative w-full">
                            <input 
                                id="password" 
                                type="password" 
                                placeholder="*****" 
                                class="{{ app()->getLocale() == 'ar' ? 'pl-10' : 'pr-10' }} pl-6 py-3 w-full border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:outline-none rounded-full"
                            />
                            
                            <div class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center">
                                <button type="button" class="togglePassword focus:outline-none">
                                <img src="{{ asset('images/showeye.svg') }}" id="eyeOpen" class="h-5 w-5 opacity-[0.3]" />
                                <img src="{{ asset('images/hideye.svg') }}" id="eyeClosed" class="hidden h-5 w-5 opacity-[0.3]" />
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col justify-center w-full">
                        <label class="text-[#1D3F5D] font-semibold ps-2 pb-2">Confirm Passwrod <span class="text-red-500">*</span></label>
                        <div class="relative w-full">
                            <input 
                                id="confirm-password" 
                                type="password" 
                                placeholder="*****" 
                                class="{{ app()->getLocale() == 'ar' ? 'pl-10' : 'pr-10' }} pl-6 py-3 w-full border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:outline-none rounded-full"
                            />
                            
                            <div class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center">
                                <button type="button" class="toggleConfirmPassword focus:outline-none">
                                <img src="{{ asset('images/showeye.svg') }}" id="eyeOpen2" class="h-5 w-5 opacity-[0.3]" />
                                <img src="{{ asset('images/hideye.svg') }}" id="eyeClosed2" class="hidden h-5 w-5 opacity-[0.3]" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-10">
                    <div class="border-b-[3px] border-[#D6E7F5]"></div>
                </div>

                <div class="">
                    <h4 class="text-[#1D3F5D] font-semibold text-2xl mb-2">Notifications</h4>

                    <div class="flex justify-between items-center mb-5">
                        <p class="text-[#1D3F5D]">Email notifications of significant occurrences or modifications</p>
                        
                        <label class="group relative inline-flex cursor-pointer flex-col items-center">
                            <input class="peer sr-only" type="checkbox" />
                            <div
                                class="relative h-8 w-16 rounded-full bg-gray-300 shadow-[inset_0_2px_8px_rgba(0,0,0,0.6)] transition-all duration-500 after:absolute after:left-1 after:top-1 after:h-6 after:w-6 after:rounded-full after:bg-gradient-to-br after:from-gray-100 after:to-gray-300 after:shadow-[2px_2px_8px_rgba(0,0,0,0.3)] after:transition-all after:duration-500 peer-checked:bg-[#1D3F5D] peer-checked:after:translate-x-8 peer-checked:after:from-white peer-checked:after:to-gray-100 hover:after:scale-95 active:after:scale-90"
                            >
                                <span
                                class="absolute inset-1 rounded-full bg-gradient-to-tr from-white/20 via-transparent to-transparent"
                                ></span>

                                <span
                                class="absolute inset-0 rounded-full opacity-0 transition-opacity duration-500 peer-checked:animate-glow peer-checked:opacity-100 [box-shadow:0_0_15px_rgba(29,63,93,0.5)]"
                                ></span>
                            </div>
                        </label>
                    </div>

                    <div class="flex justify-between items-center">
                        <p class="text-[#1D3F5D]">Get alerts regarding emergencies or performance</p>
                        
                        <label class="group relative inline-flex cursor-pointer flex-col items-center">
                            <input class="peer sr-only" type="checkbox" />
                            <div
                                class="relative h-8 w-16 rounded-full bg-gray-300 shadow-[inset_0_2px_8px_rgba(0,0,0,0.6)] transition-all duration-500 after:absolute after:left-1 after:top-1 after:h-6 after:w-6 after:rounded-full after:bg-gradient-to-br after:from-gray-100 after:to-gray-300 after:shadow-[2px_2px_8px_rgba(0,0,0,0.3)] after:transition-all after:duration-500 peer-checked:bg-[#1D3F5D] peer-checked:after:translate-x-8 peer-checked:after:from-white peer-checked:after:to-gray-100 hover:after:scale-95 active:after:scale-90"
                            >
                                <span
                                class="absolute inset-1 rounded-full bg-gradient-to-tr from-white/20 via-transparent to-transparent"
                                ></span>

                                <span
                                class="absolute inset-0 rounded-full opacity-0 transition-opacity duration-500 peer-checked:animate-glow peer-checked:opacity-100 [box-shadow:0_0_15px_rgba(29,63,93,0.5)]"
                                ></span>
                            </div>
                        </label>
                    </div>
                </div>

            </div>
        </div>

        <div class="flex justify-end py-4">
            <button type="submit" class="px-[30px] py-[10px] bg-[#1F5077] text-white font-semibold rounded-full">
                Save Updates
            </button>
        </div>
    </form>
</div>

@endsection