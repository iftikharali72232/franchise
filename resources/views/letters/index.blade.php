@extends('layouts.app')

@section('content')

<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <div class="flex md:flex-row flex-col items-center md:justify-between w-full">
        <form method="GET" action="{{ route('letters.index') }}" class="flex flex-wrap md:flex-nowrap items-center w-full md:w-auto mb-3 space-x-0 rtl:space-x-reverse md:space-x-3">
            <select name="city" class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white w-1/2 md:w-auto mb-3 md:mb-0">
                <option value="">{{ trans('lang.city') }}</option>
                @foreach($cities as $city)
                    <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                @endforeach
            </select>

            <select name="branch" class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white w-1/2 md:w-auto mb-3 md:mb-0">
                <option value="">{{ trans('lang.branch') }}</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" {{ request('branch') == $branch->id ? 'selected' : '' }}>{{ $branch->branch_name }}</option>
                @endforeach
            </select>

            <input type="date" name="from" value="{{ request('from') }}" class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white w-1/2 md:w-auto mb-3 md:mb-0">
            <input type="date" name="to" value="{{ request('to') }}" class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white w-1/2 md:w-auto mb-3 md:mb-0">

            <button type="submit" class="bg-[#2E76B0] px-4 py-2 rounded-full text-white">{{ trans('lang.filter') }}</button>
        </form>

        <div class="flex items-center md:justify-end md:w-auto w-full space-x-3 rtl:space-x-reverse">
            <a href="{{ route('letters.create') }}">
                <button type="button" class="bg-[#2E76B0] w-[40px] h-[40px] p-1 rounded-full text-white">
                    <i class="fa-solid fa-pencil"></i>
                </button>
            </a>
        </div>
    </div>

    <div class="overflow-x-auto mt-4">
        <table class="table-auto w-full text-[#1F5077]">
            <thead class="bg-[#BDE8FA]">
                <tr>
                    <th class="whitespace-nowrap">{{ trans('lang.message_recipient') }}</th>
                    <th class="whitespace-nowrap">{{ trans('lang.topic') }}</th>
                    <th class="whitespace-nowrap">{{ trans('lang.date') }}</th>
                    <th class="whitespace-nowrap">{{ trans('lang.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($letters as $letter)
                <tr class="hover:bg-[#F1FAFEB2]">
                    <td class="whitespace-nowrap">{{ $letter->branch->owner_email }}</td>
                    <td class="whitespace-nowrap">{{ $letter->offer_title }}</td>
                    <td class="whitespace-nowrap">{{ $letter->created_at->format('d/m/Y') }}</td>
                    <td class="whitespace-nowrap">
                        <div class="flex items-center space-x-3 rtl:space-x-reverse">
                            <a href="{{ route('letters.show', $letter->id) }}" class="text-gray-300">
                                <i class="fa-solid fa-circle-info"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach

                @if($letters->isEmpty())
                <tr>
                    <td colspan="4" class="text-center text-gray-500">{{ trans('lang.no_letters_found') }}</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection
