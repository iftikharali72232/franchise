@extends('layouts.app')

@section('content')

<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <div class="flex md:flex-row flex-col items-center md:justify-between w-full">
        <div class="flex items-center md:w-auto w-full md:mb-0 mb-3">
            <input type="text" class="px-6 py-2 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:outline-none rounded-full" placeholder="Search a Name">
        </div>

        <div class="flex items-center md:justify-end md:w-auto w-full space-x-3">
            <button type="button" class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white">
                Prev. Rounds
            </button>

            <button type="button" class="bg-[#2E76B0] w-[40px] h-[40px] p-1 rounded-full text-white">
                <i class="fa-solid fa-plus"></i>
            </button>

            <button type="button" class="bg-[#19B2E7] w-[40px] h-[40px] p-1 rounded-full text-white">
                <i class="fa-solid fa-download"></i>
            </button>
        </div>
    </div>

    <div class="overflow-x-auto mt-4">
        <table class="table-auto w-full text-[#1F5077]">
            <thead class="bg-[#BDE8FA]">
                <tr>
                    <th class="whitespace-nowrap">
                        Name
                    </th>
                    <th class="whitespace-nowrap">
                        Function
                    </th>
                    <th class="whitespace-nowrap">
                        Phone Number
                    </th>
                    <th class="whitespace-nowrap">
                        Email
                    </th>
                    <th class="whitespace-nowrap">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-[#F1FAFEB2]">
                    <td class="whitespace-nowrap">
                        Arab Al-Din
                    </td>
                    <td class="whitespace-nowrap">
                        Quality Auditor
                    </td>
                    <td class="whitespace-nowrap">
                        0502360521
                    </td>
                    <td class="whitespace-nowrap">
                        example@hotmail.com
                    </td>
                    <td class="whitespace-nowrap">
                        <div class="flex items-center space-x-3">
                            <a href="#" class="text-red-500">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="#" class="text-gray-300">
                                <i class="fa-solid fa-circle-info"></i>
                            </a>
                        </div>
                    </td>
                </tr>

                <tr class="hover:bg-[#F1FAFEB2] bg-[#F1FAFEB2]">
                <td class="whitespace-nowrap">
                        Arab Al-Din
                    </td>
                    <td class="whitespace-nowrap">
                        Quality Auditor
                    </td>
                    <td class="whitespace-nowrap">
                        0502360521
                    </td>
                    <td class="whitespace-nowrap">
                        example@hotmail.com
                    </td>
                    <td class="whitespace-nowrap">
                        <div class="flex items-center space-x-3">
                            <a href="#" class="text-red-500">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="#" class="text-gray-300">
                                <i class="fa-solid fa-circle-info"></i>
                            </a>
                        </div>
                    </td>
                </tr>

                <tr class="hover:bg-[#F1FAFEB2]">
                <td class="whitespace-nowrap">
                        Arab Al-Din
                    </td>
                    <td class="whitespace-nowrap">
                        Quality Auditor
                    </td>
                    <td class="whitespace-nowrap">
                        0502360521
                    </td>
                    <td class="whitespace-nowrap">
                        example@hotmail.com
                    </td>
                    <td class="whitespace-nowrap">
                        <div class="flex items-center space-x-3">
                            <a href="#" class="text-red-500">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="#" class="text-gray-300">
                                <i class="fa-solid fa-circle-info"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection