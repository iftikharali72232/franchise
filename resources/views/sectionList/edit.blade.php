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

                <!-- Image Upload & Delete -->
                <div class="">
                    <input type="file" name="image" accept="image/*" class="w-full px-6 py-2 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full">
                    <input type="hidden" name="delete_image" id="delete_image" value="0">
                </div>
                <div id="img">
                    <label class="">{{ trans('lang.section_image') }}</label>
                        @if($section->image_path)
                        <div class="relative w-24 h-24 ">
                            <img src="{{ asset($section->image_path) }}" alt="Section Image" class="w-24 h-24 mb-2 rounded">
                            <button type="button" onclick="deleteImage()" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center">X</button>
                        </div>
                        @endif
                    </div>
                </div>

            <!-- Questions Section -->
            <div class="mt-4">
                <h4 class="text-lg font-semibold mb-2">{{ trans('lang.questions') }}</h4>

                <div id="questions-container">
                    @foreach($section->questions as $index => $question)
                    <div class="mb-4 pb-4 border-b border-gray-200">
                        <input type="hidden" name="questions[{{ $index }}][id]" value="{{ $question->id }}">

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

                <!-- Add Question Button -->
                <button type="button" onclick="addQuestion()" class="px-6 py-2 text-sm rounded-full bg-gray-200 hover:bg-gray-700 hover:text-white">{{ trans('lang.add_question') }}</button>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-4">
                <button type="submit" class="px-[40px] py-[20px] bg-[#1F5077] text-white font-semibold rounded-full">{{ trans('lang.update_section') }}</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Image Delete and Add Questions -->
<script>
function deleteImage() {
    document.getElementById('delete_image').value = "1";
    document.getElementById('img').remove();
}

// Add New Question Function
function addQuestion() {
    const index = document.querySelectorAll('#questions-container > div').length;
    const container = document.getElementById('questions-container');
    const html = `
        <div class="mb-4 pb-4 border-b border-gray-200 new-question">
            <div class="bg-gray-100 p-3 flex items-center">
                <label class="w-auto me-3 whitespace-nowrap">{{ trans('lang.question') }} ${index + 1}</label>
                <input type="text" name="questions[${index}][question]" class="bg-transparent w-full focus:outline-none" placeholder="{{ trans('lang.example') }}">
            </div>

            <div class="grid grid-cols-3 gap-4 p-4">
                <div>
                    <label class="w-auto me-3">{{ trans('lang.answer1') }}</label>
                    <input type="text" name="questions[${index}][answer1]" class="bg-transparent focus:outline-none focus:border-b focus:border-gray-200" value="Excellent">
                </div>

                <div>
                    <label class="w-auto me-3">{{ trans('lang.answer2') }}</label>
                    <input type="text" name="questions[${index}][answer2]" class="bg-transparent focus:outline-none focus:border-b focus:border-gray-200" value="Average">
                </div>

                <div>
                    <label class="w-auto me-3">{{ trans('lang.answer3') }}</label>
                    <input type="text" name="questions[${index}][answer3]" class="bg-transparent focus:outline-none focus:border-b focus:border-gray-200" value="Unacceptable">
                </div>
            </div>

            <!-- Delete Button for New Questions -->
            <button type="button" class="px-3 py-1 bg-red-500 text-white rounded mt-2" onclick="this.parentElement.remove()">
                {{ trans('lang.delete_question') }}
            </button>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
}
</script>
@endsection
