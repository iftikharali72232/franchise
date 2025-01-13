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
            
            <select class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white w-1/2 md:w-auto mb-3 md:mb-0">
                <option>City</option>
                <option>C1</option>
                <option>C2</option>
            </select>

            <select class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white w-1/2 md:w-auto mb-3 md:mb-0">
                <option>Branch</option>
                <option>B1</option>
                <option>B2</option>
            </select>

            <select class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white w-1/2 md:w-auto mb-3 md:mb-0">
                <option>From</option>
                <option>Date 1</option>
                <option>Date 2</option>
            </select>

            <select class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white w-1/2 md:w-auto mb-3 md:mb-0">
                <option>To</option>
                <option>Date 1</option>
                <option>Date 2</option>
            </select>
        </div>


        <div class="flex items-center md:justify-end md:w-auto w-full space-x-3">
            <button type="button" class="bg-[#2E76B0] w-[40px] h-[40px] p-1 rounded-full text-white">
                <i class="fa-solid fa-download"></i>
            </button>
        </div>
    </div>

    <div class="pt-2 pb-4 w-full">
        <div class="border-b-2 border-[#D6E7F5]"></div>
    </div>

    <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4">
        <!-- card 1 -->
        <div class="bg-[#F1FAFE] rounded-[30px] shadow-sm p-6">
            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Branch Name:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">MESHRAQ Ring.Rd</p>
                </div>
            </div>

            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Branch Location:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Sec. Ring Road, Medina</p>
                </div>
            </div>

            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Section:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Food</p>
                </div>
            </div>

            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Created:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Turki Hisham</p>
                </div>
            </div>

            <div class="w-full bg-[#1D3F5D] mt-10 mb-3">
                <div class="relative bg-[#93C3E6] w-[58%] py-[1px]">
                    <p class="absolute text-[#93C3E6] top-[-25px] right-[-25px]">58%</p>
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

        <!-- card 2 -->
        <div class="bg-[#F1FAFE] rounded-[30px] shadow-sm p-6">
            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Branch Name:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">MESHRAQ Ring.Rd</p>
                </div>
            </div>

            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Branch Location:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Sec. Ring Road, Medina</p>
                </div>
            </div>

            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Section:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Food</p>
                </div>
            </div>

            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Created:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Turki Hisham</p>
                </div>
            </div>

            <div class="w-full bg-[#1D3F5D] mt-10 mb-3">
                <div class="relative bg-[#93C3E6] w-[58%] py-[1px]">
                    <p class="absolute text-[#93C3E6] top-[-25px] right-[-25px]">58%</p>
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

        <!-- card 3 -->
        <div class="bg-[#F1FAFE] rounded-[30px] shadow-sm p-6">
            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Branch Name:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">MESHRAQ Ring.Rd</p>
                </div>
            </div>

            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Branch Location:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Sec. Ring Road, Medina</p>
                </div>
            </div>

            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Section:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Food</p>
                </div>
            </div>

            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Created:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Turki Hisham</p>
                </div>
            </div>

            <div class="w-full bg-[#1D3F5D] mt-10 mb-3">
                <div class="relative bg-[#93C3E6] w-[58%] py-[1px]">
                    <p class="absolute text-[#93C3E6] top-[-25px] right-[-25px]">58%</p>
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

        <!-- card 4 -->
        <div class="bg-[#F1FAFE] rounded-[30px] shadow-sm p-6">
            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Branch Name:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">MESHRAQ Ring.Rd</p>
                </div>
            </div>

            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Branch Location:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Sec. Ring Road, Medina</p>
                </div>
            </div>

            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Section:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Food</p>
                </div>
            </div>

            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Created:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Turki Hisham</p>
                </div>
            </div>

            <div class="w-full bg-[#1D3F5D] mt-10 mb-3">
                <div class="relative bg-[#93C3E6] w-[58%] py-[1px]">
                    <p class="absolute text-[#93C3E6] top-[-25px] right-[-25px]">58%</p>
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

        <!-- card 5 -->
        <div class="bg-[#F1FAFE] rounded-[30px] shadow-sm p-6">
            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Branch Name:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">MESHRAQ Ring.Rd</p>
                </div>
            </div>

            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Branch Location:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Sec. Ring Road, Medina</p>
                </div>
            </div>

            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Section:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Food</p>
                </div>
            </div>

            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Created:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Turki Hisham</p>
                </div>
            </div>

            <div class="w-full bg-[#1D3F5D] mt-10 mb-3">
                <div class="relative bg-[#93C3E6] w-[58%] py-[1px]">
                    <p class="absolute text-[#93C3E6] top-[-25px] right-[-25px]">58%</p>
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

        <!-- card 6 -->
        <div class="bg-[#F1FAFE] rounded-[30px] shadow-sm p-6">
            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Branch Name:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">MESHRAQ Ring.Rd</p>
                </div>
            </div>

            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Branch Location:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Sec. Ring Road, Medina</p>
                </div>
            </div>

            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Section:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Food</p>
                </div>
            </div>

            <div class="flex mb-3">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Created:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Turki Hisham</p>
                </div>
            </div>

            <div class="w-full bg-[#1D3F5D] mt-10 mb-3">
                <div class="relative bg-[#93C3E6] w-[58%] py-[1px]">
                    <p class="absolute text-[#93C3E6] top-[-25px] right-[-25px]">58%</p>
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
    </div>

</div>
@endsection