@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Add New Auditor</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Auditor Name*</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="phone_number" class="form-label">Phone Number*</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email*</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password*</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="function" class="form-label">Function*</label>
                        <select name="function" id="function" class="form-control" required>
                            <option value="Quality Auditor">Quality Auditor</option>
                            <option value="Technical Auditor">Technical Auditor</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="job_number" class="form-label">Job Number</label>
                        <input type="text" name="job_number" id="job_number" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="face_id" class="form-label">Face ID</label>
                        <input type="file" name="face_id" id="face_id" class="form-control">
                        <small class="text-muted">Upload a face image or leave blank if not available.</small>
                    </div>
                    <div class="col-md-6">
                        <label for="description" class="form-label">Add Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
