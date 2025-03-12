@extends('layouts.app')

@section('content')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdwlGhZKKQqYyw9f9iME40MzMgC9RL4ko&libraries=places"></script>
<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <form action="{{ route('branches.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid md:grid-cols-4 grid-cols-1 gap-4">
            <div class="">
                <label class="text-[#1F5077] pb-1">
                    {{ trans('lang.branch_name') }} <span class="text-red-500">*</span>
                </label>
                <input type="text" name="branch_name" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="{{ trans('lang.branch_name') }}" />
            </div>
            <div class="">
                <label class="text-[#1F5077] pb-1">
                    {{ trans('lang.branch_no') }} <span class="text-red-500">*</span>
                </label>
                <input type="text" name="branch_no" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="{{ trans('lang.branch_no') }}" />
            </div>
            <div class="">
                <label class="text-[#1F5077] pb-1">
                    {{ trans('lang.mobile') }} <span class="text-red-500">*</span>
                </label>
                <input type="text" name="owner_mobile" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="{{ trans('lang.mobile') }}" />
            </div>
            <div class="">
                <label class="text-[#1F5077] pb-1">
                    {{ trans('lang.owner_email') }} <span class="text-red-500">*</span>
                </label>
                <input type="email" name="owner_email" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="{{ trans('lang.owner_email') }}" />
            </div>
            <div class="">
                <label class="text-[#1F5077] pb-1">
                    {{ trans('lang.region') }} <span class="text-red-500">*</span>
                </label>
                <select name="region" id="region" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full">
                    <option value="">{{ trans('lang.select_region') }}</option>
                    <option value="Riyadh">Riyadh (الرياض)</option>
                    <option value="Makkah">Makkah (مكة المكرمة)</option>
                    <option value="Madinah">Madinah (المدينة المنورة)</option>
                    <option value="Eastern Province">Eastern Province (المنطقة الشرقية)</option>
                    <option value="Qassim">Qassim (القصيم)</option>
                    <option value="Asir">Asir (عسير)</option>
                    <option value="Tabuk">Tabuk (تبوك)</option>
                    <option value="Hail">Hail (حائل)</option>
                    <option value="Northern Borders">Northern Borders (الحدود الشمالية)</option>
                    <option value="Jazan">Jazan (جازان)</option>
                    <option value="Najran">Najran (نجران)</option>
                    <option value="Al-Baha">Al-Baha (الباحة)</option>
                    <option value="Al-Jawf">Al-Jawf (الجوف)</option>
                </select>
            </div>
            <div class="">
                <label class="text-[#1F5077] pb-1">
                    {{ trans('lang.city') }} <span class="text-red-500">*</span>
                </label>
                <select name="city" id="city" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full">
                    <option value="">{{ trans('lang.all_cities') }}</option>
                    @foreach ($cities as $sno => $city_name)
                        <option value="{{ $sno }}">
                            {{ $city_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-4">
                <label class="text-[#1F5077] pb-1">
                    {{ trans('lang.location') }} <span class="text-red-500">*</span>
                </label>
                <input type="text" name="location" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="{{ trans('lang.location') }}" />
            </div>
            <div class="md:col-span-2">
                <label class="text-[#1F5077] pb-1">{{ trans('lang.location_on_map') }}</label>
                <div id="map" style="width: 100%; height: 270px; border-radius: 10px;"></div>
            </div>
            <div class="md:col-span-2">
                <label class="text-[#1F5077] pb-1">{{ trans('lang.header_image') }}</label>
                <label for="file-input">
                    <div id="drop-zone" class="flex flex-col items-center justify-center bg-[#F2F8FD] border border-[#1D3F5D] rounded-[35px] py-20 cursor-pointer">
                        <input id="file-input" name="header_image" type="file" accept="image/*" class="hidden">
                        <svg id="upload-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-400 mb-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <img id="image-preview" src="" alt="Image Preview" class="hidden max-h-48 rounded-lg">
                        <p id="upload-text" class="text-[#1D3F5D] text-lg ">{{ trans('lang.add_or_drag_image') }}</p>
                        <p class="text-gray-400 text-sm font-light mt-1">{{ trans('lang.max_image_size') }}</p>
                    </div>
                </label>
            </div>
            <div class="md:col-span-4 flex justify-end items-center mb-20">
                <button type="submit" class="px-[40px] py-[20px] bg-[#1F5077] text-white font-semibold rounded-full">
                    {{ trans('lang.send') }}
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    let map, marker;

    function initMap() {
        // Default location (e.g., Medina)
        const defaultLocation = { lat: 24.4709019, lng: 39.6101714 };

        // Initialize the map
        map = new google.maps.Map(document.getElementById("map"), {
            center: defaultLocation,
            zoom: 14,
        });

        // Add a marker
        marker = new google.maps.Marker({
            position: defaultLocation,
            map: map,
            draggable: true, // Allow marker to be dragged
        });

        // Update location input when marker is dragged
        google.maps.event.addListener(marker, 'dragend', function () {
            const position = marker.getPosition();
            console.log(position);
            document.querySelector('input[name="location"]').value = `${position.lat()}, ${position.lng()}`;
        });

        // Update location input on map click
        google.maps.event.addListener(map, 'click', function (event) {
            const position = event.latLng;
            marker.setPosition(position);
            document.querySelector('input[name="location"]').value = `${position.lat()}, ${position.lng()}`;
        });
    }

    // Initialize map after page load
    window.onload = initMap;
</script>

<script>
    $(document).ready(function () {
        const fileInput = $('#file-input');
        const dropZone = $('#drop-zone');
        const uploadIcon = $('#upload-icon');
        const uploadText = $('#upload-text');
        const imagePreview = $('#image-preview');

        dropZone.on('dragover', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('border-blue-500');
        });

        dropZone.on('dragleave', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('border-blue-500');
        });

        dropZone.on('drop', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('border-blue-500');

            const files = e.originalEvent.dataTransfer.files;
            if (files.length > 0) {
                displayImage(files[0]);
            }
        });

        dropZone.on('click', function () {
            console.log('Drop zone clicked'); // Debug: Verify click event
            fileInput.trigger('click');
        });

        fileInput.on('change', function () {
            console.log('File input changed'); // Debug: Verify file input change
            if (this.files && this.files[0]) {
                displayImage(this.files[0]);
            }
        });

        function displayImage(file) {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    uploadIcon.addClass('hidden');
                    uploadText.addClass('hidden');
                    imagePreview.attr('src', e.target.result).removeClass('hidden');
                    dropZone.css('border-color', '#D1D5DB'); // Reset border color
                };
                reader.readAsDataURL(file);
            } else {
                alert('Please upload a valid image file.');
            }
        }
    });
    
    document.querySelector('#create_branch').addEventListener('submit', function (e) {
        e.preventDefault(); // Stop the form from redirecting

        const form = e.target;
        const formData = new FormData(form);

        fetch("{{ route('branches.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json' // Tell Laravel to return JSON instead of redirecting
            },
            body: formData,
        })
        .then(response => response.json()) // Convert response to JSON
        .then(data => {
            if (data.success) {
                fetchBranchList(); // Refresh the list of branches
                form.reset();
                alert('Branch added successfully!');
            } else {
                alert('Failed to add branch.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    });
</script>
@endsection
