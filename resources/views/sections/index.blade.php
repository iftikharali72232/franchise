@extends('layouts.app')

@section('content')

<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <div class="flex items-center justify-between w-full pb-2 border-b-[3px] border-[#D6E7F54D]">
        <div class="flex items-center space-x-3 w-full">
            <h4 class="text-2xl text-[#1D3F5D] font-semibold">Sections List</h4>
        </div>

        <div class="flex items-center justify-end w-auto">
            <a href="{{route('sections.create')}}" type="button" class="bg-[#1D3F5D] rounded-full text-white flex justify-between items-center">
                <span class="px-6">Add</span>
                <div type="button" class="bg-[#2E76B0] w-[40px] h-[40px] p-1 rounded-full text-white flex justify-center items-center">
                <i class="fa-solid fa-plus"></i>
                </div>
            </a>
        </div>
    </div>

    <div class="overflow-x-auto mt-4">
        <table class="table-auto w-full text-[#1F5077]">
            <thead class="bg-[#BDE8FA]">
                <tr>
                    <th class="whitespace-nowrap">Section Name</th>
                    <th class="whitespace-nowrap">No of Questions</th>
                    <th class="whitespace-nowrap">Created By</th>
                    <th class="whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sections as $section)
                <tr class="hover:bg-[#F1FAFEB2]">
                    <td class="whitespace-nowrap">{{ $section->name }}</td>
                    <td class="whitespace-nowrap">{{ $section->questions->count() }}</td>
                    <td class="whitespace-nowrap">{{ $section->created_by->name ?? 'N/A' }}</td>
                    <td class="whitespace-nowrap">
                        <div class="flex items-center space-x-3">
                            <!-- View Button -->
                            <a href="{{ route('sections.show', $section->id) }}" class="text-[#1D3F5D]">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                            <!-- Edit Button -->
                            <a href="{{ route('sections.edit', $section->id) }}" class="text-blue-500">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <!-- Delete Button -->
                            <form action="{{ route('sections.destroy', $section->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this section?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-gray-500">No sections found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
