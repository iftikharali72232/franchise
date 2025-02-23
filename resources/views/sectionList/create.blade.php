@extends('layouts.app')

@section('content')
<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <div class="p-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold">{{ trans('lang.create_section') }}</h2>
    </div>

    <div class="p-4">
        <form action="{{ route('sectionList.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Section Information -->
            <div class="grid md:grid-cols-3 grid-cols-1 gap-4">
                <div class="md:col-span-3">
                    <h4 class="text-lg font-semibold">{{ trans('lang.section_information') }}</h4>
                </div>

                <div class="">
                    <label for="name" class="form-label">{{ trans('lang.section_name') }}*</label>
                    <input type="text" name="name" id="name" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="{{ trans('lang.example') }}" required>
                </div>

                <div class="">
                    <label for="shows_to" class="form-label">{{ trans('lang.shows_to') }}*</label>
                    <select name="shows_to" id="shows_to" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" required>
                        <option value="All Members">{{ trans('lang.all_members') }}</option>
                        <option value="Admins">{{ trans('lang.admins') }}</option>
                    </select>
                </div>

                <div class="">
                    <label for="image" class="form-label">{{ trans('lang.section_image') }}</label>
                    <input type="file" name="image" id="image" class="w-full px-6 py-2 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" accept="image/*">
                    <small class="text-muted">{{ trans('lang.max_image_size') }}</small>
                </div>
            </div>

            <!-- Section Questions -->
            <div class="">
                <h4 class="mb-3">{{ trans('lang.section_questions') }}</h4>

                <div id="questions-container">
                    <!-- Initial Question 1 -->
                    <div class="mb-4 question-item">
                        <h5>{{ trans('lang.question') }} 1</h5>
                        <div class="bg-gray-100 p-3 flex items-center">
                            <label for="questions[0][question]" class="form-label w-auto me-3">{{ trans('lang.question') }}</label>
                            <input type="text" name="questions[0][question]" class="bg-transparent w-full focus:outline-none" placeholder="{{ trans('lang.example') }}">
                        </div>
                        
                        <div class="grid md:grid-cols-3 gap-4 p-4">
                            <div class="">
                                <label for="questions[0][answer1]" class="form-label w-auto me-3">{{ trans('lang.answer1') }}</label>
                                <input type="text" name="questions[0][answer1]" class="bg-transparent focus:outline-none focus:border-b focus:border-gray-200" placeholder="{{ trans('lang.example') }}" disabled value="{{ trans('lang.poor') }}">
                            </div>
                            <div class="">
                                <label for="questions[0][answer2]" class="form-label w-auto me-3">{{ trans('lang.answer2') }}</label>
                                <input type="text" name="questions[0][answer2]" class="bg-transparent focus:outline-none focus:border-b focus:border-gray-200" placeholder="{{ trans('lang.example') }}" disabled value="{{ trans('lang.average') }}">
                            </div>
                            <div class="">
                                <label for="questions[0][answer3]" class="form-label w-auto me-3">{{ trans('lang.answer3') }}</label>
                                <input type="text" name="questions[0][answer3]" class="bg-transparent focus:outline-none focus:border-b focus:border-gray-200" placeholder="{{ trans('lang.example') }}" disabled value="{{ trans('lang.excellent') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" class="px-6 py-2 text-sm rounded-full bg-gray-200 hover:bg-gray-700 hover:text-white" id="add-question-btn">{{ trans('lang.add_question') }}</button>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-[40px] py-[20px] bg-[#1F5077] text-white font-semibold rounded-full">{{ trans('lang.submit') }}</button>
            </div>
        </form>
    </div>
</div>

<script>
    let questionIndex = 1; // Start with the next question index

    document.getElementById('add-question-btn').addEventListener('click', function() {
        const container = document.getElementById('questions-container');

        const questionHtml = `
            <div class="mb-4 question-item">
                <h5>{{ trans('lang.question') }} ${questionIndex + 1}</h5>
                <div class="bg-gray-100 p-3 flex items-center">
                    <label for="questions[${questionIndex}][question]" class="w-auto me-3">{{ trans('lang.question') }}</label>
                    <input type="text" name="questions[${questionIndex}][question]" class="bg-transparent w-full focus:outline-none" placeholder="{{ trans('lang.example') }}">
                </div>

                <div class="grid grid-cols-3 gap-4 p-4">
                    <div class="">
                        <label for="questions[${questionIndex}][answer1]" class="form-label w-auto me-3">{{ trans('lang.answer1') }}</label>
                        <input type="text" name="questions[${questionIndex}][answer1]" class="bg-transparent focus:outline-none focus:border-b focus:border-gray-200" placeholder="{{ trans('lang.example') }}" disabled value="{{ trans('lang.poor') }}">
                    </div>
                    <div class="">
                        <label for="questions[${questionIndex}][answer2]" class="form-label w-auto me-3">{{ trans('lang.answer2') }}</label>
                        <input type="text" name="questions[${questionIndex}][answer2]" class="bg-transparent focus:outline-none focus:border-b focus:border-gray-200" placeholder="{{ trans('lang.example') }}" disabled value="{{ trans('lang.average') }}">
                    </div>
                    <div class="">
                        <label for="questions[${questionIndex}][answer3]" class="form-label w-auto me-3">{{ trans('lang.answer3') }}</label>
                        <input type="text" name="questions[${questionIndex}][answer3]" class="bg-transparent focus:outline-none focus:border-b focus:border-gray-200" placeholder="{{ trans('lang.example') }}" disabled value="{{ trans('lang.excellent') }}">
                    </div>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', questionHtml);
        questionIndex++; // Increment the question index
    });
</script>
@endsection
