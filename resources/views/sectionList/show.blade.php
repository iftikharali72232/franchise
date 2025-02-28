@extends('layouts.app')

@section('content')
<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <div class="p-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold">{{ trans('lang.view_section') }}</h2>
    </div>

    <div class="p-4">
        <div class="grid md:grid-cols-3 grid-cols-1 gap-4">
            <div class="md:col-span-3">
                <h4 class="text-lg font-semibold">{{ trans('lang.section_information') }}</h4>
            </div>

            <div>
                <label class="">{{ trans('lang.section_name') }}*</label>
                <input type="text" value="{{ $section->name }}" readonly class="w-full px-6 py-3 border border-gray-300 bg-gray-100 text-gray-700 rounded-full">
            </div>

            <!-- Image Display -->
            <div class="mb-4">
                <label class="">{{ trans('lang.section_image') }}</label>
                @if($section->image_path)
                <div class="relative w-24 h-24">
                    <img src="{{ asset($section->image_path) }}" alt="Section Image" class="w-24 h-24 mb-2 rounded">
                </div>
                @else
                <p class="text-gray-500">{{ trans('lang.no_image_available') }}</p>
                @endif
            </div>
        </div>

        <!-- Questions Section -->
        <div class="mt-4">
            <h4 class="text-lg font-semibold mb-2">{{ trans('lang.questions') }}</h4>

            <div id="questions-container">
                @foreach($section->questions as $index => $question)
                <div class="mb-4 pb-4 border-b border-gray-200">
                    <div class="bg-gray-100 p-3 flex items-center">
                        <label class="w-auto me-3 whitespace-nowrap">{{ trans('lang.question') }} {{ $index + 1 }}</label>
                        <input type="text" value="{{ $question->question }}" readonly class="bg-transparent w-full focus:outline-none">
                    </div>

                    <div class="grid md:grid-cols-3 gap-4 p-4">
                        <div>
                            <label class="w-auto me-3">{{ trans('lang.answer1') }}</label>
                            <input type="text" value="{{ $question->answer1 }}" readonly class="bg-transparent focus:outline-none">
                        </div>

                        <div>
                            <label class="w-auto me-3">{{ trans('lang.answer2') }}</label>
                            <input type="text" value="{{ $question->answer2 }}" readonly class="bg-transparent focus:outline-none">
                        </div>

                        <div>
                            <label class="w-auto me-3">{{ trans('lang.answer3') }}</label>
                            <input type="text" value="{{ $question->answer3 }}" readonly class="bg-transparent focus:outline-none">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
