@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-2xl font-semibold mb-4">Edit Section</h2>
    <form action="{{ route('sectionList.update', $section->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700">Section Name*</label>
            <input type="text" name="name" value="{{ $section->name }}" required class="w-full p-2 border border-gray-300 rounded-md">
        </div>

        <div class="mt-4">
            <label class="block text-gray-700">Shows to*</label>
            <select name="shows_to" required class="w-full p-2 border border-gray-300 rounded-md">
                <option value="All Members" {{ $section->shows_to == 'All Members' ? 'selected' : '' }}>All Members</option>
                <option value="Admins" {{ $section->shows_to == 'Admins' ? 'selected' : '' }}>Admins</option>
            </select>
        </div>

        <div class="mt-4">
            <label class="block text-gray-700">Section Image</label>
            @if($section->image)
            <img src="{{ asset('storage/' . $section->image) }}" alt="Section Image" class="w-24 h-24 mb-2 rounded">
            @endif
            <input type="file" name="image" accept="image/*" class="w-full p-2 border border-gray-300 rounded-md">
        </div>

        <div class="mt-4">
            <h4 class="text-lg font-semibold">Questions</h4>
            <div id="questions-container">
                @foreach($section->questions as $index => $question)
                <div class="mb-4 border-b border-gray-200 pb-4">
                    <label>Question {{ $index + 1 }}</label>
                    <input type="text" name="questions[{{ $index }}][question]" value="{{ $question->question }}" class="w-full p-2 border border-gray-300 rounded-md">
                    <label>Answer 1</label>
                    <input type="text" name="questions[{{ $index }}][answer1]" value="{{ $question->answer1 }}" class="w-full p-2 border border-gray-300 rounded-md">
                    <label>Answer 2</label>
                    <input type="text" name="questions[{{ $index }}][answer2]" value="{{ $question->answer2 }}" class="w-full p-2 border border-gray-300 rounded-md">
                    <label>Answer 3</label>
                    <input type="text" name="questions[{{ $index }}][answer3]" value="{{ $question->answer3 }}" class="w-full p-2 border border-gray-300 rounded-md">
                </div>
                @endforeach
            </div>
            <button type="button" onclick="addQuestion()" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md">Add Question</button>
        </div>

        <button type="submit" class="mt-6 bg-green-500 text-white px-6 py-2 rounded-md">Update Section</button>
    </form>
</div>

<script>
function addQuestion() {
    const index = document.querySelectorAll('#questions-container > div').length;
    const container = document.getElementById('questions-container');
    const html = `
        <div class="mb-4 border-b border-gray-200 pb-4">
            <label>Question ${index + 1}</label>
            <input type="text" name="questions[${index}][question]" class="w-full p-2 border border-gray-300 rounded-md">
            <label>Answer 1</label>
            <input type="text" name="questions[${index}][answer1]" class="w-full p-2 border border-gray-300 rounded-md">
            <label>Answer 2</label>
            <input type="text" name="questions[${index}][answer2]" class="w-full p-2 border border-gray-300 rounded-md">
            <label>Answer 3</label>
            <input type="text" name="questions[${index}][answer3]" class="w-full p-2 border border-gray-300 rounded-md">
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
}
</script>
@endsection
