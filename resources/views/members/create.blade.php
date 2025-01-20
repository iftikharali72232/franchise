@extends('layouts.app')

@section('content')
<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <div class="p-4 border-b border-gray-200">
        <h3 class="text-xl font-semibold">Add New Auditor</h3>
    </div>

    <div class="p-4">
        <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid md:grid-cols-3 grid-cols-1 gap-4">
                <div class="">
                    <label for="name" class="form-label">Auditor Name*</label>
                    <input type="text" name="name" id="name" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" required>
                </div>

                <div class="">
                    <label for="phone_number" class="form-label">Phone Number*</label>
                    <input type="text" name="phone_number" id="phone_number" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" required>
                </div>
                
                <div class="">
                    <label for="email" class="form-label">Email*</label>
                    <input type="email" name="email" id="email" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" required>
                </div>
                
                <div class="">
                    <label for="password" class="form-label">Password*</label>
                    <input type="password" name="password" id="password" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" required>
                </div>
                
                <div class="">
                    <label for="function" class="form-label">Function*</label>
                    <select name="function" id="function" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" required>
                        <option value="Quality Auditor">Quality Auditor</option>
                        <option value="Technical Auditor">Technical Auditor</option>
                    </select>
                </div>

                <div class="">
                    <label for="job_number" class="form-label">Job Number</label>
                    <input type="text" name="job_number" id="job_number" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full">
                </div>
                
                <div class="">
                    <label for="face_id" class="form-label">Face ID</label>
                    <label for="file-input">
                        <div id="drop-zone" class="flex flex-col items-center justify-center bg-[#D6E7F5] border border-[#1D3F5D] rounded-[35px] py-[74px] px-6 cursor-pointer">
                            <input id="file-input" type="file" accept="image/*" name="face_id" id="face_id" class="hidden">
                            <img src="{{ asset('images/faceid.png') }}" />
                            <img id="image-preview" src="" alt="Image Preview" class="hidden max-h-48 rounded-lg">
                            <p class="text-gray-600 text-center text-sm mt-2">
                                When the face is scanned at the beginning of the first round, the image of the face will be added here
                            </p>
                        </div>
                    </label>

                    <!-- <input type="file" name="face_id" id="face_id" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full"> -->
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="form-label">Add Description</label>
                    <textarea name="description" id="description" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-xl" rows="10"></textarea>
                </div>
                
                <div class="md:col-span-3 flex justify-end">
                    <button type="submit" class="px-[40px] py-[20px] bg-[#1F5077] text-white font-semibold rounded-full">Save</button>
                </div>
            </div>
        </form>
    </div>
        
</div>
@endsection
