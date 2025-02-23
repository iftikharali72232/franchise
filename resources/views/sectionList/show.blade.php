@extends('layouts.app')

@section('content')
<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <div class="p-4 border-b border-gray-200">
        <h2 class="text-2xl font-semibold mb-4">{{ $section->name }}</h2>
        <p class="text-gray-700">{{ trans('lang.visible_to') }}: <strong>{{ $section->shows_to }}</strong></p>
    </div>

    @if($section->image)
    <div class="mt-4">
        <img src="{{ asset('storage/' . $section->image) }}" alt="{{ trans('lang.section_image') }}" class="w-48 h-48 rounded-md shadow-md">
    </div>
    @endif

    <div class="p-4">
        <h3 class="text-lg font-semibold">{{ trans('lang.questions') }}</h3>
        <ul class="list-disc ml-6">
            @foreach($section->questions as $question)
            <li class="mt-2">
                <strong class="py-2">{{ $question->question }}</strong>
                <ul class="list-decimal ml-6">
                    <li class="py-1">{{ $question->answer1 }}</li>
                    <li class="py-1">{{ $question->answer2 }}</li>
                    <li class="py-1">{{ $question->answer3 }}</li>
                </ul>
            </li>
            @endforeach
        </ul>

        <div class="mt-6">
            <a href="{{ route('sectionList.index') }}" class="px-[30px] py-[10px] bg-[#1F5077] text-white font-semibold rounded-full">{{ trans('lang.back_to_list') }}</a>
        </div>
    </div>

</div>
@endsection
