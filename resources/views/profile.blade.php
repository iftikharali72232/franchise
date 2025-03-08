@extends('layouts.app')

@section('content')

<div class="w-full rounded-xl bg-white bg-clip-border text-gray-700 shadow-md p-6">
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="w-full rounded-xl bg-white bg-clip-border text-gray-700 shadow-md p-8">
            <h4 class="text-[#1D3F5D] font-semibold text-2xl md:text-start text-center">{{ trans('lang.basic_details') }}</h4>

            <div class="flex flex-col md:items-start items-center justify-center my-4">
                <!-- Image Preview Container -->
                <div class="relative px-6">
                    <img
                        id="imagePreview"
                        src="{{ asset(auth()->user()->image ?? 'images/profile-placeholder.jpg') }}"
                        alt="Preview"
                        class="w-[130px] h-[130px] rounded-full border border-[#1F5077] object-cover"
                    />
                    <input
                        type="file"
                        id="imageInput"
                        name="image"
                        accept="image/*"
                        class="absolute inset-0 opacity-0 cursor-pointer"
                        onchange="previewImage(event)"
                    />
                </div>

                <div class="flex items-center w-auto md:mt-0 mt-1">
                    <button
                        type="button"
                        onclick="document.getElementById('imageInput').click()"
                        class="bg-[#1F5077] rounded-full p-3 shadow"
                    >
                        <img src="{{ asset('images/choose-img.png') }}" alt="{{ trans('lang.choose_image') }}" />
                    </button>
                </div>
            </div>

            <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                <div class="flex flex-col justify-center w-full">
                    <label class="text-[#1D3F5D] font-semibold ps-2 pb-2">
                        {{ trans('lang.name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}" class="px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:outline-none rounded-full">
                </div>

                <div class="flex flex-col justify-center w-full">
                    <label class="text-[#1D3F5D] font-semibold ps-2 pb-2">
                        {{ trans('lang.email') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" value="{{ auth()->user()->email }}" class="px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:outline-none rounded-full">
                </div>

                <div class="flex flex-col justify-center w-full">
                    <label class="text-[#1D3F5D] font-semibold ps-2 pb-2">{{ trans('lang.password') }}</label>
                    <input type="password" name="password" placeholder="{{ trans('lang.leave_blank') }}" class="px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:outline-none rounded-full">
                </div>

                <div class="flex flex-col justify-center w-full">
                    <label class="text-[#1D3F5D] font-semibold ps-2 pb-2">{{ trans('lang.confirm_password') }}</label>
                    <input type="password" name="password_confirmation" placeholder="{{ trans('lang.confirm_password') }}" class="px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:outline-none rounded-full">
                </div>
            </div>

            <div class="py-10">
                <div class="border-b-[3px] border-[#D6E7F5]"></div>
            </div>

            <div class="">
                <h4 class="text-[#1D3F5D] font-semibold text-2xl mb-2">{{ trans('lang.notifications') }}</h4>

                <div class="flex justify-between items-center mb-5">
                    <p class="text-[#1D3F5D]">{{ trans('lang.email_notifications') }}</p>
                    <input type="checkbox" name="notification_status" value="1" {{ auth()->user()->notification_status ? 'checked' : '' }}>
                </div>
            </div>
        </div>

        <div class="flex justify-end py-4">
            <button type="submit" class="px-[30px] py-[10px] bg-[#1F5077] text-white font-semibold rounded-full">
                {{ trans('lang.save_updates') }}
            </button>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('imagePreview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
