@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Create Section</h2>
    <form action="{{ route('sections.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Section Information -->
        <div class="card p-4 mb-4">
            <h4 class="mb-3">Section Information</h4>
            <div class="mb-3">
                <label for="name" class="form-label">Section Name*</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Example" required>
            </div>

            <div class="mb-3">
                <label for="shows_to" class="form-label">Shows to*</label>
                <select name="shows_to" id="shows_to" class="form-select" required>
                    <option value="All Members">All Members</option>
                    <option value="Admins">Admins</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Section Image</label>
                <div class="border p-3 text-center" style="border-radius: 8px;">
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    <small class="text-muted">Maximum image size 100MB</small>
                </div>
            </div>
        </div>

        <!-- Section Questions -->
        <div class="card p-4">
            <h4 class="mb-3">Section Questions</h4>
            <div id="questions-container">
                <!-- Initial Question 1 -->
                <div class="mb-4 question-item">
                    <h5>Question 1</h5>
                    <div class="mb-3">
                        <label for="questions[0][question]" class="form-label">Question</label>
                        <input type="text" name="questions[0][question]" class="form-control" placeholder="Example">
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="questions[0][answer1]" class="form-label">Answer 1</label>
                            <input type="text" name="questions[0][answer1]" class="form-control" placeholder="Example">
                        </div>
                        <div class="col">
                            <label for="questions[0][answer2]" class="form-label">Answer 2</label>
                            <input type="text" name="questions[0][answer2]" class="form-control" placeholder="Example">
                        </div>
                        <div class="col">
                            <label for="questions[0][answer3]" class="form-label">Answer 3</label>
                            <input type="text" name="questions[0][answer3]" class="form-control" placeholder="Example">
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary" id="add-question-btn">Add Question</button>
        </div>

        <button type="submit" class="btn btn-success mt-4">Submit</button>
    </form>
</div>

<script>
    let questionIndex = 1; // Start with the next question index

    document.getElementById('add-question-btn').addEventListener('click', function() {
        const container = document.getElementById('questions-container');

        const questionHtml = `
            <div class="mb-4 question-item">
                <h5>Question ${questionIndex + 1}</h5>
                <div class="mb-3">
                    <label for="questions[${questionIndex}][question]" class="form-label">Question</label>
                    <input type="text" name="questions[${questionIndex}][question]" class="form-control" placeholder="Example">
                </div>
                <div class="row">
                    <div class="col">
                        <label for="questions[${questionIndex}][answer1]" class="form-label">Answer 1</label>
                        <input type="text" name="questions[${questionIndex}][answer1]" class="form-control" placeholder="Example">
                    </div>
                    <div class="col">
                        <label for="questions[${questionIndex}][answer2]" class="form-label">Answer 2</label>
                        <input type="text" name="questions[${questionIndex}][answer2]" class="form-control" placeholder="Example">
                    </div>
                    <div class="col">
                        <label for="questions[${questionIndex}][answer3]" class="form-label">Answer 3</label>
                        <input type="text" name="questions[${questionIndex}][answer3]" class="form-control" placeholder="Example">
                    </div>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', questionHtml);
        questionIndex++; // Increment the question index
    });
</script>
@endsection
