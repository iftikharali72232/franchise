@extends('layouts.app')

@section('content')
<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <div class="p-4 border-b border-gray-200">
        <h3 class="text-xl font-semibold">Contact Messages</h3>
    </div>
    
    <div class="overflow-x-auto mt-4">
        <table class="table-auto w-full text-[#1F5077]">
            <thead class="bg-[#BDE8FA]">
                <tr>
                    <th class="whitespace-nowrap py-2 px-4">ID</th>
                    <th class="whitespace-nowrap py-2 px-4">Name</th>
                    <th class="whitespace-nowrap py-2 px-4">Email</th>
                    <th class="whitespace-nowrap py-2 px-4">Message</th>
                    <th class="whitespace-nowrap py-2 px-4">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $msg)
                    <tr class="hover:bg-[#F1FAFEB2]">
                        <td class="whitespace-nowrap py-2 px-4">{{ $msg->id }}</td>
                        <td class="whitespace-nowrap py-2 px-4">{{ $msg->name }}</td>
                        <td class="whitespace-nowrap py-2 px-4">{{ $msg->email }}</td>
                        <td class="whitespace-nowrap py-2 px-4">{{ $msg->message }}</td>
                        <td class="whitespace-nowrap py-2 px-4">{{ $msg->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $messages->links() }}
</div>
@endsection
