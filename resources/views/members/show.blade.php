@extends('layouts.app')

@section('content')
<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <div class="p-4 border-b border-gray-200">
        <h3 class="text-xl font-semibold">{{ trans('lang.edit_member') }}</h3>
    </div>

    <div class="p-4">
        <form action="{{ route('members.update', $member->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid md:grid-cols-3 grid-cols-1 gap-4">
                <div>
                    <label for="name" class="form-label">{{ trans('lang.name') }}*</label>
                    <input type="text" name="name" id="name" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" value="{{ $member->name }}" required>
                </div>

                <div>
                    <label for="mobile" class="form-label">{{ trans('lang.phone_number') }}*</label>
                    <input type="text" name="mobile" id="mobile" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" value="{{ $member->mobile }}" required>
                </div>
                
                <div>
                    <label for="email" class="form-label">{{ trans('lang.email') }}*</label>
                    <input type="email" name="email" id="email" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" value="{{ $member->email }}" required>
                </div>

                <div>
                    <label for="function" class="form-label">{{ trans('lang.function') }}*</label>
                    <select name="function" id="function" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" required>
                        <option value="Quality Auditor" {{ $member->function == 'Quality Auditor' ? 'selected' : '' }}>{{ trans('lang.quality_auditor') }}</option>
                        <option value="Technical Auditor" {{ $member->function == 'Technical Auditor' ? 'selected' : '' }}>{{ trans('lang.technical_auditor') }}</option>
                    </select>
                </div>
                
                <div>
                    <label for="job_number" class="form-label">{{ trans('lang.job_number') }}</label>
                    <input type="text" name="job_number" id="job_number" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" value="{{ $member->job_number }}">
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="form-label">{{ trans('lang.description') }}</label>
                    <textarea name="description" id="description" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-xl" rows="10">{{ $member->description }}</textarea>
                </div>
                
                <!-- <div class="md:col-span-3 flex justify-end">
                    <button type="submit" class="px-[40px] py-[20px] bg-[#1F5077] text-white font-semibold rounded-full">{{ trans('lang.update') }}</button>
                </div> -->
            </div>
        </form>
    </div>
</div>
@endsection
