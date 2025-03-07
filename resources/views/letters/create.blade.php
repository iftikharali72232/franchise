@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded-lg border-0">
        <div class="card-header bg-gradient-primary text-white text-center py-3">
            <h2 class="mb-0">{{ trans('lang.new_message') }}</h2>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('letters.send') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="branch_id" class="form-label fw-bold">{{ trans('lang.select_branch') }}</label>
                    <select name="branch_id" id="branch_id" class="form-select" required>
                        <option value="">{{ trans('lang.select_branch_placeholder') }}</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" data-email="{{ $branch->owner_email }}">
                                {{ $branch->branch_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="owner_email" class="form-label fw-bold">{{ trans('lang.owner_email') }}</label>
                    <input type="email" id="owner_email" class="form-control bg-light" readonly>
                </div>

                <div class="mb-3">
                    <label for="offer_title" class="form-label fw-bold">{{ trans('lang.offer_title') }}</label>
                    <input type="text" name="offer_title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="offer_message" class="form-label fw-bold">{{ trans('lang.offer_message') }}</label>
                    <textarea name="offer_message" class="form-control" rows="5" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="attachment" class="form-label fw-bold">{{ trans('lang.attachment') }} ({{ trans('lang.optional') }})</label>
                    <input type="file" name="attachment" class="form-control">
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-4 py-2 shadow-sm">{{ trans('lang.send') }}</button>
                </div>
            </form>
        </div>
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
