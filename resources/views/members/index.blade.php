@extends('layouts.app')

@section('content')

<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <div class="flex md:flex-row flex-col items-center md:justify-between w-full">
        <div class="flex items-center md:w-auto w-full md:mb-0 mb-3">
            <input type="text" class="px-6 py-2 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:outline-none rounded-full" placeholder="{{ trans('lang.search_name') }}">
        </div>

        <div class="flex items-center md:justify-end md:w-auto w-full space-x-3">
            <button type="button" class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white">
                {{ trans('lang.prev_rounds') }}
            </button>

            <a href="{{ route('members.create') }}">
                <button type="button" class="bg-[#2E76B0] w-[40px] h-[40px] p-1 rounded-full text-white">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </a>

            <button type="button" class="bg-[#19B2E7] w-[40px] h-[40px] p-1 rounded-full text-white">
                <i class="fa-solid fa-download"></i>
            </button>
        </div>
    </div>

    <div class="overflow-x-auto mt-4">
        <table class="table-auto w-full text-[#1F5077]">
            <thead class="bg-[#BDE8FA]">
                <tr>
                    <th class="whitespace-nowrap">{{ trans('lang.name') }}</th>
                    <th class="whitespace-nowrap">{{ trans('lang.function') }}</th>
                    <th class="whitespace-nowrap">{{ trans('lang.phone_number') }}</th>
                    <th class="whitespace-nowrap">{{ trans('lang.email') }}</th>
                    <th class="whitespace-nowrap">{{ trans('lang.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                <tr class="hover:bg-[#F1FAFEB2]">
                    <td class="whitespace-nowrap">{{ $member->name }}</td>
                    <td class="whitespace-nowrap">{{ $member->function }}</td>
                    <td class="whitespace-nowrap">{{ $member->phone_number }}</td>
                    <td class="whitespace-nowrap">{{ $member->email }}</td>
                    <td class="whitespace-nowrap">
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('members.edit', $member->id) }}" class="text-red-500">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('{{ trans('lang.are_you_sure') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                            <button class="px-3 py-1 rounded-full toggle-approval {{ $member->status == 1 ? 'bg-green-500' : 'bg-red-500' }} text-white" data-id="{{ $member->id }}" data-status="{{ $member->status }}">
                                {{ $member->status == 1 ? trans('lang.approved') : trans('lang.approve') }}
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".toggle-approval").forEach(button => {
            button.addEventListener("click", function() {
                let memberId = this.getAttribute("data-id");
                let currentStatus = this.getAttribute("data-status");
                let newStatus = currentStatus == 1 ? 0 : 1;
                
                fetch("{{ route('members.status.update') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ id: memberId, status: newStatus })
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        this.setAttribute("data-status", newStatus);
                        this.textContent = newStatus == 1 ? "{{ trans('lang.approved') }}" : "{{ trans('lang.approve') }}";
                        this.classList.toggle("bg-green-500", newStatus == 1);
                        this.classList.toggle("bg-red-500", newStatus == 0);
                    }
                });
            });
        });
    });
</script>
@endsection
