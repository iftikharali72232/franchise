@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Edit Member</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('members.update', $member->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name*</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $member->name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="phone_number" class="form-label">Phone Number*</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $member->phone_number }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email*</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $member->email }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="function" class="form-label">Function*</label>
                        <select name="function" id="function" class="form-control" required>
                            <option value="Quality Auditor" {{ $member->function == 'Quality Auditor' ? 'selected' : '' }}>Quality Auditor</option>
                            <option value="Technical Auditor" {{ $member->function == 'Technical Auditor' ? 'selected' : '' }}>Technical Auditor</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="job_number" class="form-label">Job Number</label>
                        <input type="text" name="job_number" id="job_number" class="form-control" value="{{ $member->job_number }}">
                    </div>
                    <div class="col-md-6">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3">{{ $member->description }}</textarea>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
