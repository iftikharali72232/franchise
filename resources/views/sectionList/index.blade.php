@extends('layouts.app')

@section('content')

<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <div class="flex items-center justify-between w-full pb-2 border-b-[3px] border-[#D6E7F54D]">
        <div class="flex items-center space-x-3 rtl:space-x-reverse w-full">
            <h4 class="text-2xl text-[#1D3F5D] font-semibold">{{ trans('lang.sections_list') }}</h4>
        </div>

        <div class="flex items-center justify-end w-auto">
            <a href="{{ route('sectionList.create') }}" type="button" class="bg-[#1D3F5D] rounded-full text-white flex justify-between items-center">
                <span class="px-6">{{ trans('lang.add') }}</span>
                <div class="bg-[#2E76B0] w-[40px] h-[40px] p-1 rounded-full text-white flex justify-center items-center">
                    <i class="fa-solid fa-plus"></i>
                </div>
            </a>
        </div>
    </div>

    <div class="overflow-x-auto mt-4">
        <table class="table-auto w-full text-[#1F5077]">
            <thead class="bg-[#BDE8FA]">
                <tr>
                    <th class="whitespace-nowrap">{{ trans('lang.section_name') }}</th>
                    <th class="whitespace-nowrap">{{ trans('lang.no_of_questions') }}</th>
                    <th class="whitespace-nowrap">{{ trans('lang.created_by') }}</th>
                    <th class="whitespace-nowrap">{{ trans('lang.default') }}</th>
                    <th class="whitespace-nowrap">{{ trans('lang.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sections as $section)
                <tr class="hover:bg-[#F1FAFEB2]">
                    <td class="whitespace-nowrap">{{ $section->name }}</td>
                    <td class="whitespace-nowrap">{{ $section->questions->count() }}</td>
                    <td class="whitespace-nowrap">{{ $section->created_by->name ?? trans('lang.na') }}</td>
                    <td class="whitespace-nowrap">
                        @if($section->default_section)
                            <span class="text-green-600 font-semibold">{{ trans('lang.default') }}</span>
                        @else
                            <form action="{{ route('sectionList.setDefault', $section->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-md text-sm">
                                    {{ trans('lang.set_as_default') }}
                                </button>
                            </form>
                        @endif
                    </td>
                    <td class="whitespace-nowrap">
                        <div class="flex items-center space-x-3 rtl:space-x-reverse">
                            <a href="{{ route('sectionList.show', $section->id) }}" class="text-[#1D3F5D]">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                            <a href="{{ route('sectionList.edit', $section->id) }}" class="text-blue-500">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('sectionList.destroy', $section->id) }}" method="POST" onsubmit="return confirm('{{ trans('lang.delete_section_confirm') }}');">
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
                    <td colspan="5" class="text-center text-gray-500">{{ trans('lang.no_sections_found') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
