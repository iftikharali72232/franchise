@extends('layouts.app')

@section('content')

<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <div class="flex md:flex-row flex-col items-center md:justify-between w-full">
        <div class="flex items-center space-x-3 md:w-auto w-full md:mb-0 mb-3">
            <select class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white md:w-auto w-1/2">
                <option>Region</option>
                <option>R1</option>
                <option>R2</option>
            </select>

            <select class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white md:w-auto w-1/2">
                <option>City</option>
                <option>C1</option>
                <option>C2</option>
            </select>
        </div>

        <div class="flex items-center md:justify-end md:w-auto w-full space-x-3">
            <button type="button" class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white">
                Previous Visits
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
                        Branch Name
                    </th>
                    <th class="whitespace-nowrap">
                        Branch No
                    </th>
                    <th class="whitespace-nowrap">
                        City
                    </th>
                    <th class="whitespace-nowrap">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-[#F1FAFEB2]">
                    <td class="whitespace-nowrap">
                        MESHRAQ Sultana
                    </td>
                    <td class="whitespace-nowrap">
                        01
                    </td>
                    <td class="whitespace-nowrap">
                        Medina
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
                        MESHRAQ Sultana
                    </td>
                    <td class="whitespace-nowrap">
                        01
                    </td>
                    <td class="whitespace-nowrap">
                        Medina
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
                        MESHRAQ Sultana
                    </td>
                    <td class="whitespace-nowrap">
                        01
                    </td>
                    <td class="whitespace-nowrap">
                        Medina
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