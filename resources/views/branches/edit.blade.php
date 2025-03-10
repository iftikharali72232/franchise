@extends('layouts.app')

@section('content')
<div class="w-full rounded-xl bg-white shadow-md p-4">
    <form action="{{ route('branches.update', $branch->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-4 grid-cols-1 gap-4">
            <div>
                <label class="text-[#1F5077] pb-1">{{ trans('lang.branch_name') }} <span class="text-red-500">*</span></label>
                <input type="text" name="branch_name" value="{{ $branch->branch_name }}" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] rounded-full" required />
            </div>

            <div>
                <label class="text-[#1F5077] pb-1">{{ trans('lang.branch_no') }} <span class="text-red-500">*</span></label>
                <input type="text" name="branch_no" value="{{ $branch->branch_no }}" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] rounded-full" required />
            </div>

            <div>
                <label class="text-[#1F5077] pb-1">{{ trans('lang.owner_email') }} <span class="text-red-500">*</span></label>
                <input type="email" name="owner_email" value="{{ $branch->owner_email }}" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] rounded-full" required />
            </div>

            <div>
                <label class="text-[#1F5077] pb-1">{{ trans('lang.region') }} <span class="text-red-500">*</span></label>
                <select name="region" id="region" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" required>
                    <option value="">{{ trans('lang.select_region') }}</option>
                    <option value="Riyadh" {{ $branch->region == 'Riyadh' ? 'selected' : '' }}>{{ trans('lang.riyadh') }}</option>
                    <option value="Makkah" {{ $branch->region == 'Makkah' ? 'selected' : '' }}>{{ trans('lang.makkah') }}</option>
                    <option value="Madinah" {{ $branch->region == 'Madinah' ? 'selected' : '' }}>{{ trans('lang.madinah') }}</option>
                    <option value="Eastern Province" {{ $branch->region == 'Eastern Province' ? 'selected' : '' }}>{{ trans('lang.eastern_province') }}</option>
                    <option value="Qassim" {{ $branch->region == 'Qassim' ? 'selected' : '' }}>{{ trans('lang.qassim') }}</option>
                    <option value="Asir" {{ $branch->region == 'Asir' ? 'selected' : '' }}>{{ trans('lang.asir') }}</option>
                    <option value="Tabuk" {{ $branch->region == 'Tabuk' ? 'selected' : '' }}>{{ trans('lang.tabuk') }}</option>
                    <option value="Hail" {{ $branch->region == 'Hail' ? 'selected' : '' }}>{{ trans('lang.hail') }}</option>
                    <option value="Northern Borders" {{ $branch->region == 'Northern Borders' ? 'selected' : '' }}>{{ trans('lang.northern_borders') }}</option>
                    <option value="Jazan" {{ $branch->region == 'Jazan' ? 'selected' : '' }}>{{ trans('lang.jazan') }}</option>
                    <option value="Najran" {{ $branch->region == 'Najran' ? 'selected' : '' }}>{{ trans('lang.najran') }}</option>
                    <option value="Al-Baha" {{ $branch->region == 'Al-Baha' ? 'selected' : '' }}>{{ trans('lang.al_baha') }}</option>
                    <option value="Al-Jawf" {{ $branch->region == 'Al-Jawf' ? 'selected' : '' }}>{{ trans('lang.al_jawf') }}</option>
                </select>
            </div>

            <div>
                <label class="text-[#1F5077] pb-1">{{ trans('lang.city') }} <span class="text-red-500">*</span></label>
                <select name="city" id="city" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full">
                    <option value="">{{ trans('lang.all_cities') }}</option>
                    @foreach ($cities as $sno => $city_name)
                        <option value="{{ $sno }}" {{ old('city', $branch->city) == $sno ? 'selected' : '' }}>
                            {{ $city_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-4">
                <label class="text-[#1F5077] pb-1">{{ trans('lang.location') }} <span class="text-red-500">*</span></label>
                <input type="text" id="location-input" name="location" value="{{ $branch->location }}" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] rounded-full" required />
                <div id="map" class="w-full h-64 mt-2 rounded-lg"></div>
            </div>

            <div class="md:col-span-4">
                <label class="text-[#1F5077] pb-1">{{ trans('lang.header_image') }}</label>
                <input type="file" name="header_image" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] rounded-full">

                @if ($branch->header_image)
                    <img src="{{ asset('uploads/' . $branch->header_image) }}" alt="{{ trans('lang.current_image') }}" class="mt-2 h-32 rounded-lg">
                @endif
            </div>

            <div class="md:col-span-4 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-[#1F5077] text-white rounded-full">
                    {{ trans('lang.update') }}
                </button>
            </div>
        </div>
    </form>
</div>
{{-- Google Maps API for Location Picker --}}
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdwlGhZKKQqYyw9f9iME40MzMgC9RL4ko&libraries=places&callback=initMap"></script>

@endsection
