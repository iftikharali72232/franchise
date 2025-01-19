@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-2xl font-semibold mb-4">{{ $section->name }}</h2>
    <p class="text-gray-700">Visible to: <strong>{{ $section->shows_to }}</strong></p>

    @if($section->image)
    <div class="mt-4">
        <img src="{{ asset('storage/' . $section->image) }}" alt="Section Image" class="w-48 h-48 rounded-md shadow-md">
    </div>
    @endif

    <div class="mt-6">
        <h3 class="text-lg font-semibold">Questions</h3>
        <ul class="list-disc ml-6">
            @foreach($section->questions as $question)
            <li class="mt-2">
                <strong>{{ $question->question }}</strong>
                <ul class="list-decimal ml-6">
                    <li>{{ $question->answer1 }}</li>
                    <li>{{ $question->answer2 }}</li>
                    <li>{{ $question->answer3 }}</li>
                </ul>
            </li>
            @endforeach
        </ul>
    </div>

    <div class="mt-6">
        <a href="{{ route('sectionList.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Back to List</a>
    </div>
</div>
@endsection
