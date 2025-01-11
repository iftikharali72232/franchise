@extends('layouts.app')

@section('content')

<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <div class="flex items-center justify-between w-full pb-2 border-b-[3px] border-[#D6E7F54D]">
        <div class="flex items-center space-x-3 w-full">
            <h4 class="text-2xl text-[#1D3F5D] font-semibold">Sections List</h4>
        </div>

        <div class="flex items-center justify-end w-auto">
            <button type="button" class="bg-[#1D3F5D] rounded-full text-white flex justify-between items-center">
                <span class="px-6">Add</span>
                <div type="button" class="bg-[#2E76B0] w-[40px] h-[40px] p-1 rounded-full text-white flex justify-center items-center">
                <i class="fa-solid fa-plus"></i>
                </div>
            </button>
        </div>
    </div>

    <div class="overflow-x-auto mt-4">
        <table class="table-auto w-full text-[#1F5077]">
            <thead class="bg-[#BDE8FA]">
                <tr>
                    <th class="whitespace-nowrap">
                        Section Name
                    </th>
                    <th class="whitespace-nowrap">
                        No of Questions
                    </th>
                    <th class="whitespace-nowrap">
                        Add By
                    </th>
                    <th class="whitespace-nowrap">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-[#F1FAFEB2]">
                    <td class="whitespace-nowrap">
                        Food Quality & Safety Audit
                    </td>
                    <td class="whitespace-nowrap">
                        17
                    </td>
                    <td class="whitespace-nowrap">
                        info@grgirperson.sa
                    </td>
                    <td class="whitespace-nowrap">
                        <div class="flex items-center space-x-3">
                            <a href="#" class="text-[#1D3F5D]">
                                <i class="fa-regular fa-eye"></i>
                            </a>

                            <a href="#" class="text-red-500">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </div>
                    </td>
                </tr>

                <tr class="hover:bg-[#F1FAFEB2]">
                    <td class="whitespace-nowrap">
                        Food Quality & Safety Audit
                    </td>
                    <td class="whitespace-nowrap">
                        17
                    </td>
                    <td class="whitespace-nowrap">
                        info@grgirperson.sa
                    </td>
                    <td class="whitespace-nowrap">
                        <div class="flex items-center space-x-3">
                            <a href="#" class="text-[#1D3F5D]">
                                <i class="fa-regular fa-eye"></i>
                            </a>

                            <a href="#" class="text-red-500">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </div>
                    </td>
                </tr>

                <tr class="hover:bg-[#F1FAFEB2]">
                    <td class="whitespace-nowrap">
                        Food Quality & Safety Audit
                    </td>
                    <td class="whitespace-nowrap">
                        17
                    </td>
                    <td class="whitespace-nowrap">
                        info@grgirperson.sa
                    </td>
                    <td class="whitespace-nowrap">
                        <div class="flex items-center space-x-3">
                            <a href="#" class="text-[#1D3F5D]">
                                <i class="fa-regular fa-eye"></i>
                            </a>

                            <a href="#" class="text-red-500">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </div>
                    </td>
                </tr>

                <tr class="hover:bg-[#F1FAFEB2]">
                    <td class="whitespace-nowrap">
                        Food Quality & Safety Audit
                    </td>
                    <td class="whitespace-nowrap">
                        17
                    </td>
                    <td class="whitespace-nowrap">
                        info@grgirperson.sa
                    </td>
                    <td class="whitespace-nowrap">
                        <div class="flex items-center space-x-3">
                            <a href="#" class="text-[#1D3F5D]">
                                <i class="fa-regular fa-eye"></i>
                            </a>

                            <a href="#" class="text-red-500">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection