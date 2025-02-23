@extends('layouts.app')

@section('content')
<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <div class="p-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold">{{ trans('lang.edit_section') }}</h2>
    </div>

    <div class="p-4">
        <form action="{{ route('sectionList.update', $section->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-3 grid-cols-1 gap-4">
                <div class="md:col-span-3">
                    <h4 class="text-lg font-semibold">{{ trans('lang.section_information') }}</h4>
                </div>

                <div>
                    <label class="">{{ trans('lang.section_name') }}*</label>
                    <input type="text" name="name" value="{{ $section->name }}" required class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full">
                </div>

                <div class="">
                    <label class="">{{ trans('lang.shows_to') }}*</label>
                    <select name="shows_to" required class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full">
                        <option value="All Members" {{ $section->shows_to == 'All Members' ? 'selected' : '' }}>{{ trans('lang.all_members') }}</option>
                        <option value="Admins" {{ $section->shows_to == 'Admins' ? 'selected' : '' }}>{{ trans('lang.admins') }}</option>
                    </select>
                </div>

                <div class="">
                    <label class="">{{ trans('lang.section_image') }}</label>
                    @if($section->image)
                    <img src="{{ asset('storage/' . $section->image) }}" alt="{{ trans('lang.section_image') }}" class="w-24 h-24 mb-2 rounded">
                    @endif
                    <input type="file" name="image" accept="image/*" class="w-full px-6 py-2 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full">
                </div>
            </div>

            <div class="mt-4">
                <h4 class="text-lg font-semibold mb-2">{{ trans('lang.questions') }}</h4>

                <div id="questions-container">
                    @foreach($section->questions as $index => $question)
                    <div class="mb-4 pb-4 border-b border-gray-200">
                        <div class="bg-gray-100 p-3 flex items-center">
                            <label class="w-auto me-3 whitespace-nowrap">{{ trans('lang.question') }} {{ $index + 1 }}</label>
                            <input type="text" name="questions[{{ $index }}][question]" value="{{ $question->question }}" class="bg-transparent w-full focus:outline-none">
                        </div>

                        <div class="grid md:grid-cols-3 gap-4 p-4">
                            <div class="">
                                <label class="w-auto me-3">{{ trans('lang.answer1') }}</label>
                                <input type="text" name="questions[{{ $index }}][answer1]" value="{{ $question->answer1 }}" class="bg-transparent focus:outline-none focus:border-b focus:border-gray-200">
                            </div>

                            <div class="">
                                <label class="w-auto me-3">{{ trans('lang.answer2') }}</label>
                                <input type="text" name="questions[{{ $index }}][answer2]" value="{{ $question->answer2 }}" class="bg-transparent focus:outline-none focus:border-b focus:border-gray-200">
                            </div>

                            <div class="">
                                <label class="w-auto me-3">{{ trans('lang.answer3') }}</label>
                                <input type="text" name="questions[{{ $index }}][answer3]" value="{{ $question->answer3 }}" class="bg-transparent focus:outline-none focus:border-b focus:border-gray-200">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <button type="button" onclick="addQuestion()" class="px-6 py-2 text-sm rounded-full bg-gray-200 hover:bg-gray-700 hover:text-white">{{ trans('lang.add_question') }}</button>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-[40px] py-[20px] bg-[#1F5077] text-white font-semibold rounded-full">{{ trans('lang.update_section') }}</button>
            </div>
        </form>
    </div>
</div>

<script>
function addQuestion() {
    const index = document.querySelectorAll('#questions-container > div').length;
    const container = document.getElementById('questions-container');
    const html = `
        <div class="mb-4 pb-4 border-b border-gray-200">
            <div class="bg-gray-100 p-3 flex items-center">
                <label class="w-auto me-3 whitespace-nowrap">{{ trans('lang.question') }} ${index + 1}</label>
                <input type="text" name="questions[${index}][question]" class="bg-transparent w-full focus:outline-none" placeholder="{{ trans('lang.example') }}">
            </div>

            <div class="grid grid-cols-3 gap-4 p-4">
                <div>
                    <label class="w-auto me-3">{{ trans('lang.answer1') }}</label>
                    <input type="text" name="questions[${index}][answer1]" class="bg-transparent focus:outline-none focus:border-b focus:border-gray-200" placeholder="{{ trans('lang.example') }}">
                </div>

                <div>
                    <label class="w-auto me-3">{{ trans('lang.answer2') }}</label>
                    <input type="text" name="questions[${index}][answer2]" class="bg-transparent focus:outline-none focus:border-b focus:border-gray-200" placeholder="{{ trans('lang.example') }}">
                </div>

                <div>
                    <label class="w-auto me-3">{{ trans('lang.answer3') }}</label>
                    <input type="text" name="questions[${index}][answer3]" class="bg-transparent focus:outline-none focus:border-b focus:border-gray-200" placeholder="{{ trans('lang.example') }}">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
}
</script>
@endsection
