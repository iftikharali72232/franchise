@extends('layouts.app')

@section('content')

<div class="md:p-10 p-4">
    <div class="grid md:grid-cols-2 grid-cols-1 gap-6">
        <div class="bg-[#D6E7F5] shadow-sm rounded-3xl px-2 pt-4 pb-2 relative overflow-hidden">
            <img src="{{asset('images/report-blue.png')}}" alt="img" class="absolute {{ app()->getLocale() == 'ar' ? 'left-6' : 'right-6' }} top-6 z-10 lg:h-[120px] h-[80px]">

            <div class="px-4 lg:py-16 py-10 relative z-50">              
                <h4 class="text-[#2E76B0] lg:text-[40px] text-[30px] font-[500]"> Reports </h4>
            </div>
            
            <div class="mt-2 relative z-50">
                <a type="button" href="{{route('reports_all')}}" class="bg-[#2E76B0] flex items-center justify-between w-full ps-4 pe-2 py-1 rounded-full group transition">
                    <span class="text-white font-[600]">View</span>
                    <div class="bg-white rounded-full text-[#2E76B0] p-2 w-[30px] h-[30px] text-[14px] flex items-cener justify-center ">
                        <i class="fa-solid fa-arrow-right-long rotate-[-45deg] group-hover:rotate-[0deg] origin-center transition duration-300"></i>
                    </div>
                </a>
            </div>
        </div>

        <div class="bg-[#D6E7F5] shadow-sm rounded-3xl px-2 pt-4 pb-2 relative overflow-hidden">
            <img src="{{asset('images/compare.png')}}" alt="img" class="absolute {{ app()->getLocale() == 'ar' ? 'left-6' : 'right-6' }} top-6 z-10 lg:h-[120px] h-[80px]">

            <div class="px-4 lg:py-16 py-10 relative z-50">              
                <h4 class="text-[#2E76B0] lg:text-[40px] text-[30px] font-[500]"> Compare </h4>
            </div>
            
            <div class="mt-2 relative z-50">
                <button class="bg-[#2E76B0] flex items-center justify-between w-full ps-4 pe-2 py-1 rounded-full group transition">
                    <span class="text-white font-[600]">View</span>
                    <div class="bg-white rounded-full text-[#2E76B0] p-2 w-[30px] h-[30px] text-[14px] flex items-cener justify-center ">
                        <i class="fa-solid fa-arrow-right-long rotate-[-45deg] group-hover:rotate-[0deg] origin-center transition duration-300"></i>
                    </div>
                </button>
            </div>
        </div>

        <div class="bg-[#D6E7F5] shadow-sm rounded-3xl px-2 pt-4 pb-2 relative overflow-hidden">
            <img src="{{asset('images/archive.png')}}" alt="img" class="absolute {{ app()->getLocale() == 'ar' ? 'left-6' : 'right-6' }} top-6 z-10 lg:h-[120px] h-[80px]">

            <div class="px-4 lg:py-16 py-10 relative z-50">              
                <h4 class="text-[#2E76B0] lg:text-[40px] text-[30px] font-[500]"> Archives </h4>
            </div>
            
            <div class="mt-2 relative z-50">
                <button class="bg-[#2E76B0] flex items-center justify-between w-full ps-4 pe-2 py-1 rounded-full group transition">
                    <span class="text-white font-[600]">View</span>
                    <div class="bg-white rounded-full text-[#2E76B0] p-2 w-[30px] h-[30px] text-[14px] flex items-cener justify-center ">
                        <i class="fa-solid fa-arrow-right-long rotate-[-45deg] group-hover:rotate-[0deg] origin-center transition duration-300"></i>
                    </div>
                </button>
            </div>
        </div>

        <div class="bg-[#D6E7F5] shadow-sm rounded-3xl px-2 pt-4 pb-2 relative overflow-hidden">
            <img src="{{asset('images/compare.png')}}" alt="img" class="absolute {{ app()->getLocale() == 'ar' ? 'left-6' : 'right-6' }} top-6 z-10 lg:h-[120px] h-[80px]">

            <div class="px-4 lg:py-16 py-10 relative z-50">              
                <h4 class="text-[#2E76B0] lg:text-[40px] text-[30px] font-[500]"> Compare </h4>
            </div>
            
            <div class="mt-2 relative z-50">
                <button class="bg-[#2E76B0] flex items-center justify-between w-full ps-4 pe-2 py-1 rounded-full group transition">
                    <span class="text-white font-[600]">View</span>
                    <div class="bg-white rounded-full text-[#2E76B0] p-2 w-[30px] h-[30px] text-[14px] flex items-cener justify-center ">
                        <i class="fa-solid fa-arrow-right-long rotate-[-45deg] group-hover:rotate-[0deg] origin-center transition duration-300"></i>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection