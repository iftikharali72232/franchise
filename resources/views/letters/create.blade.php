@extends('layouts.app')

@section('content')
<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    
        <div class="p-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold">{{ trans('lang.new_message') }}</h2>
        </div>

        <div class="p-4">
            <form action="{{ route('letters.send') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                    <div>
                        <label for="branch_id" class="form-label">{{ trans('lang.select_branch') }}</label>
                        <select name="branch_id" id="branch_id" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" required>
                            <option value="">{{ trans('lang.select_branch_placeholder') }}</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" data-email="{{ $branch->owner_email }}">
                                    {{ $branch->branch_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="owner_email" class="form-label">{{ trans('lang.owner_email') }}</label>
                        <input type="email" id="owner_email" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" readonly>
                    </div>

                    <div>
                        <label for="offer_title" class="form-label">{{ trans('lang.offer_title') }}</label>
                        <input type="text" name="offer_title" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" required>
                    </div>

                    <div>
                        <label for="attachment" class="form-label">{{ trans('lang.attachment') }} ({{ trans('lang.optional') }})</label>
                        <input type="file" name="attachment" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full">
                    </div>

                    <div class="md:col-span-2">
                        <label for="offer_message" class="form-label">{{ trans('lang.offer_message') }}</label>
                        <textarea name="offer_message" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-xl" rows="5" required></textarea>
                    </div>

                    <div class="md:col-span-2 flex justify-end">
                        <button type="submit" class="px-[40px] py-[20px] bg-[#1F5077] text-white font-semibold rounded-full">{{ trans('lang.send') }}</button>
                    </div>

                </div>
            </form>
        </div>
        
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(to right, #1D3F5D, #2E76B0);
    }
    .form-control, .form-select {
        border-radius: 10px;
        padding: 10px;
    }
    .btn-success {
        background-color: #28a745;
        border: none;
        transition: 0.3s ease-in-out;
    }
    .btn-success:hover {
        background-color: #218838;
        transform: scale(1.05);
    }
</style>

<script>
    document.getElementById('branch_id').addEventListener('change', function () {
        var emailField = document.getElementById('owner_email');
        var selectedOption = this.options[this.selectedIndex];
        emailField.value = selectedOption.getAttribute('data-email');
    });
</script>
@endsection
