@extends('layouts.app')

@section('content')

<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <div class="flex md:flex-row flex-col items-center md:justify-between w-full">
        <div class="flex flex-wrap md:flex-nowrap items-center w-full md:w-auto mb-3 space-x-0 md:space-x-3">
            <div class="w-full md:w-auto md:pb-0 pb-2">
                <a href="#" 
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-gradient-to-b from-[#1F5077] to-[#3A95DD]">
                    <img src="{{ asset('images/arrow-left.png') }}" class="w-auto {{ app()->getLocale() == 'ar' ? 'rotate-[180deg]' : '' }}" alt="Arrow Left" />
                </a>
            </div>
            
            <h2 class="text-4xl font-semibold bg-gradient-to-b from-[#1F5077] to-[#3A95DD] bg-clip-text text-transparent">
                MESHRAQ Sultana
            </h2>
        </div>


        <div class="flex items-center md:justify-end md:w-auto w-full space-x-3">
            <button type="button" class="bg-[#2E76B0] px-6 py-3 rounded-full text-white">
                <span>Save PDF</span>
                <i class="fa-solid fa-download ps-2"></i>
            </button>
        </div>
    </div>

    <div class="flex justify-between bg-[#F1FAFE] rounded-[20px] shadow-sm p-3 my-4">
        <div class="w-1/2">
            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Branch Location:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Second Ring Rd Medina</p>
                </div>
            </div>
            
            <div class="flex">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Created Date:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">06/11/2022</p>
                </div>
            </div>
        </div>

        <div class="w-1/2">
            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Section:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Multiple</p>
                </div>
            </div>
            
            <div class="flex">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Created By:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Turki Hisham</p>
                </div>
            </div>
        </div>

        <div class="w-auto">
            <div class="w-[70px] h-[70px] overflow-hidden">
                <img src="{{ asset('images/branch_detail_img.png') }}" class="object-fit w-full h-full" />
            </div>
        </div>
    </div>

    <div class="">
        <h4 class="text-xl font-semibold text-[#1D3F5D]">A - Food Section</h4>

        <div class="ml-10">
            <ol class="list-decimal text-xl text-[#1D3F5D] my-3">
                <li>
                    What are the steps for ensuring that fittings are correctly secured during the installation of pipes?
                </li>
            </ol>

            <div class="flex flex-col bg-black/[2%] border border-[#D9D9D9] rounded-lg p-4 w-full">
                <!-- User Info -->
                <div class="flex items-center mb-4">
                    <div class="">
                        <div class="w-[50px] h-[50px] p-2 rounded-full flex items-center justify-center border border-gray-200">
                            <img src="{{ asset('images/main-user.png') }}" class="filter invert" />
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="font-semibold text-[#1D3F5D]">Turki Hisham</p>
                        <p class="text-sm text-gray-500">20:34 PM</p>
                    </div>
                </div>

                <!-- Answered Section -->
                <div class="flex items-center mb-4 ml-16">
                    <div class="w-[150px]">
                        <p class="font-semibold text-gray-600">Answered:</p>
                    </div>

                    <div class="flex w-full gap-2 p-2">
                        <!-- Excellent Rating -->
                        <div>
                            <input class="peer sr-only" value="excellent" name="rating" id="excellent" type="radio" />
                            <label
                                for="excellent"
                                class="flex shadow-sm px-4 py-1.5 cursor-pointer flex-col items-center justify-center rounded-lg bg-white transition-transform duration-150 peer-checked:bg-gray-600 peer-checked:text-white text-sm uppercase text-gray-500">
                                Excellent
                            </label>
                        </div>

                        <!-- Good Rating -->
                        <div>
                            <input class="peer sr-only" value="good" name="rating" id="good" type="radio" />
                            <label
                                for="good"
                                class="flex shadow-sm px-4 py-1.5 cursor-pointer flex-col items-center justify-center rounded-lg bg-white transition-transform duration-150 peer-checked:bg-gray-600 peer-checked:text-white text-sm uppercase text-gray-500">
                                Good
                            </label>
                        </div>

                        <!-- Unacceptable Rating -->
                        <div>
                            <input class="peer sr-only" value="unacceptable" name="rating" id="unacceptable" type="radio" />
                            <label
                                for="unacceptable"
                                class="flex shadow-sm px-4 py-1.5 cursor-pointer flex-col items-center justify-center rounded-lg bg-white transition-transform duration-150 peer-checked:bg-gray-600 peer-checked:text-white text-sm uppercase text-gray-500">
                                Unacceptable
                            </label>
                        </div>
                    </div>

                </div>

                <!-- Attachments Section -->
                <div class="flex ml-16">
                    <div class="w-[150px]">
                        <p class="font-semibold text-gray-600 mt-2">Attachments:</p>
                    </div>
                    <div class="flex w-full space-x-2">
                        <img class="h-20 w-20 rounded-md object-cover" src="https://gratisography.com/wp-content/uploads/2024/10/gratisography-cool-cat-800x525.jpg" alt="Attachment 1">
                        <img class="h-20 w-20 rounded-md object-cover" src="https://gratisography.com/wp-content/uploads/2024/10/gratisography-cool-cat-800x525.jpg" alt="Attachment 2">
                        <img class="h-20 w-20 rounded-md object-cover" src="https://gratisography.com/wp-content/uploads/2024/10/gratisography-cool-cat-800x525.jpg" alt="Attachment 3">
                        <img class="h-20 w-20 rounded-md object-cover" src="https://gratisography.com/wp-content/uploads/2024/10/gratisography-cool-cat-800x525.jpg" alt="Attachment 4">
                        <img class="h-20 w-20 rounded-md object-cover" src="https://gratisography.com/wp-content/uploads/2024/10/gratisography-cool-cat-800x525.jpg" alt="Attachment 5">
                        <img class="h-20 w-20 rounded-md object-cover" src="https://gratisography.com/wp-content/uploads/2024/10/gratisography-cool-cat-800x525.jpg" alt="Attachment 6">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection