@extends('layouts.app')

@section('content')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdwlGhZKKQqYyw9f9iME40MzMgC9RL4ko&libraries=places"></script>
<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <div class="flex md:flex-row flex-col items-center md:justify-between w-full">
        <div class="flex items-center space-x-3 md:w-auto w-full md:mb-0 mb-3">
            <select class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white md:w-auto w-1/2">
                <option>Region</option>
                <option>R1</option>
                <option>R2</option>
            </select>

            <select class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white md:w-auto w-1/2">
                <option>City</option>
                <option>C1</option>
                <option>C2</option>
            </select>
        </div>

        <div class="flex items-center md:justify-end md:w-auto w-full space-x-3">
            <button type="button" class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white">
                Previous Visits
            </button>

            <button type="button" onclick="openModal('create_branch')" class="bg-[#2E76B0] w-[40px] h-[40px] p-1 rounded-full text-white">
                <i class="fa-solid fa-plus"></i>
            </button>

            <button type="button" class="bg-[#19B2E7] w-[40px] h-[40px] p-1 rounded-full text-white">
                <i class="fa-solid fa-download"></i>
            </button>
        </div>
    </div>

    <div class="overflow-x-auto mt-4">
    <table class="table-auto w-full text-[#1F5077]">
        <thead class="bg-[#BDE8FA]">
            <tr>
                <th class="whitespace-nowrap py-2 px-4">Branch Name</th>
                <th class="whitespace-nowrap py-2 px-4">Branch No</th>
                <th class="whitespace-nowrap py-2 px-4">City</th>
                <th class="whitespace-nowrap py-2 px-4">Action</th>
            </tr>
        </thead>
        <tbody id="branch_list_data">
            @forelse ($branches as $branch)
                <tr class="hover:bg-[#F1FAFEB2] {{ $loop->odd ? 'bg-[#F1FAFEB2]' : '' }}">
                    <td class="whitespace-nowrap py-2 px-4">{{ $branch->branch_name }}</td>
                    <td class="whitespace-nowrap py-2 px-4">{{ $branch->branch_no }}</td>
                    <td class="whitespace-nowrap py-2 px-4">{{ $branch->city }}</td>
                    <td class="whitespace-nowrap py-2 px-4">
                        <div class="flex items-center space-x-3">
                            <a href="#" onclick="openModal('edit_branch')" class="text-red-500">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="#" onclick="openModal('branch_information')" class="text-gray-300">
                                <i class="fa-solid fa-circle-info"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">No branches available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>

<!-- Create Branch Modal -->
<div id="create_branch" class="modal md:p-4 p-0 fixed z-50 inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-lg lg:w-[70%] md:w-[80%] w-[100%] overflow-hidden md:h-full h-screen">
        <div class="px-6 py-4 bg-[#2E76B0] flex justify-between items-center rounded-t-xl">
            <h2 class="text-xl font-semibold text-white">Add a New Branch</h2>
            <button type="button" class="close-modal text-white">
            <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        
        <div class="modal-body p-6 h-full overflow-y-auto overflow-x-hidden scrollbar-hidden">
            <div class="pb-4">
                <h4 class="text-xl text-[#1F5077] font-semibold text-uppercase">Branch Information</h4>
            </div>
            <form id="create_branch" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid md:grid-cols-4 grid-cols-1 gap-4">
                    <div class="">
                        <label class="text-[#1F5077 pb-1">Branch Name <span class="text-red-500">*</span></label>
                        <input type="text" name="branch_name" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Example" />
                    </div>

                    <div class="">
                        <label class="text-[#1F5077 pb-1">Branch No <span class="text-red-500">*</span></label>
                        <input type="text" name="branch_no" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Example" />
                    </div>

                    <div class="">
                        <label class="text-[#1F5077 pb-1">Region <span class="text-red-500">*</span></label>
                        <input type="text" name="region" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Example" />
                    </div>

                    <div class="">
                        <label class="text-[#1F5077 pb-1">City <span class="text-red-500">*</span></label>
                        <select name="city" id="city" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full">
                            <option value="">All Cities</option>
                            @foreach ($cities as $sno => $city_name)
                                <option value="{{ $sno }}">
                                    {{ $city_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-4">
                        <label class="text-[#1F5077 pb-1">Location <span class="text-red-500">*</span></label>
                        <input type="text" name="location" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Example" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-[#1F5077 pb-1">Location on the map</label>
                        <div id="map" style="width: 100%; height: 270px; border-radius: 10px;"></div>
                    </div>
 
                    <div class="md:col-span-2">
                        <label class="text-[#1F5077 pb-1">Header Image</label>
                        <label for="file-input">
                            <div id="drop-zone" class="flex flex-col items-center justify-center bg-[#F2F8FD] border border-[#1D3F5D] rounded-[35px] py-20 cursor-pointer">
                                <input id="file-input" name="header_image" type="file" accept="image/*" class="hidden">
                                <svg id="upload-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-400 mb-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <img id="image-preview" src="" alt="Image Preview" class="hidden max-h-48 rounded-lg">
                                <p id="upload-text" class="text-[#1D3F5D] text-lg ">Add or drag an image here</p>
                                <p class="text-gray-400 text-sm font-light mt-1">Maximum image size 100MB</p>
                            </div>
                        </label>
                    </div>

                    <div class="md:col-span-4 flex justify-end items-center mb-20">
                        <button type="submit" class="px-[40px] py-[20px] bg-[#1F5077] text-white font-semibold rounded-full">
                            Send
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Branch Modal -->
<div id="edit_branch" class="modal md:p-4 p-0 fixed z-50 inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-lg lg:w-[70%] md:w-[80%] w-[100%] overflow-hidden md:h-full h-screen">
        <div class="px-6 py-4 bg-[#E51D1D] flex justify-between items-center rounded-t-xl">
            <h2 class="text-xl font-semibold text-white">Data Modification</h2>
            <button type="button" class="close-modal text-white">
            <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        
        <div class="modal-body p-6 h-full overflow-y-auto overflow-x-hidden scrollbar-hidden">
            <div class="pb-4">
                <h4 class="text-xl text-[#1F5077] font-semibold text-uppercase">Branch Information</h4>
            </div>

            <div class="grid md:grid-cols-4 grid-cols-1 gap-4">
                <div class="">
                    <label class="text-[#1F5077 pb-1">Branch Name <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_branch_name" name="branch_name" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Example" />
                </div>

                <div class="">
                    <label class="text-[#1F5077 pb-1">Branch No <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_branch_no" name="branch_no" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Example" />
                </div>

                <div class="">
                    <label class="text-[#1F5077 pb-1">Region <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_region" name="region" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Example" />
                </div>

                <div class="">
                    <label class="text-[#1F5077 pb-1">City <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_city" name="city" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Example" />
                </div>

                <div class="md:col-span-4">
                    <label class="text-[#1F5077 pb-1">Location <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_location" name="location" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Example" />
                </div>

                <div class="md:col-span-2">
                    <label class="text-[#1F5077 pb-1">Location on the map</label>
                    <div id="map" style="width: 100%; height: 270px; border-radius: 10px;"></div>
                </div>

                <div class="md:col-span-2">
                    <label class="text-[#1F5077 pb-1">Header Image</label>
                    <label for="file-input">
                        <div id="drop-zone" class="flex flex-col items-center justify-center bg-[#F2F8FD] border border-[#1D3F5D] rounded-[35px] py-20 cursor-pointer">
                            <input id="file-input" name="header_image" type="file" accept="image/*" class="hidden">
                            <svg id="upload-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-400 mb-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <img class="edit_image_preview" id="image-preview"  src="" alt="Image Preview" class="hidden max-h-48 rounded-lg">
                            <p id="upload-text" class="text-[#1D3F5D] text-lg ">Add or drag an image here</p>
                            <p class="text-gray-400 text-sm font-light mt-1">Maximum image size 100MB</p>
                        </div>
                    </label>
                </div>

                <div class="md:col-span-4 flex justify-between items-center mb-20">
                    <button type="button" class="px-[20px] py-[15px] bg-[#E51D1D] text-white font-semibold rounded-xl">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>

                    <button type="submit" class="px-[40px] py-[20px] bg-[#1F5077] text-white font-semibold rounded-full">
                        Send
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Branch Information Modal -->
<div id="branch_information" class="modal md:p-4 p-0 fixed z-50 inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-lg lg:w-[50%] md:w-[80%] w-[100%] overflow-hidden md:h-full h-screen">
        <div class="px-6 py-4 bg-[#2E76B0] flex justify-between items-center rounded-t-xl">
            <h2 class="text-xl font-semibold text-white">Information</h2>
            <button type="button" class="close-modal text-white">
            <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        
        <div class="modal-body p-6 h-full overflow-y-auto overflow-x-hidden scrollbar-hidden">
            <div class="pb-4">
                <h4 class="text-xl text-[#1F5077] font-semibold text-uppercase">Branch Information</h4>
            </div>

            <div class="grid md:grid-cols-4 grid-cols-1 gap-4">
                <div class="md:col-span-2">
                    <label class="text-[#1F5077 pb-1">Branch Name <span class="text-red-500">*</span></label>
                    <input type="text" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Example" />
                </div>

                <div class="">
                    <label class="text-[#1F5077 pb-1">Branch No <span class="text-red-500">*</span></label>
                    <input type="text" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Example" />
                </div>

                <div class="">
                    <label class="text-[#1F5077 pb-1">City <span class="text-red-500">*</span></label>
                    <input type="text" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Example" />
                </div>

                <div class="md:col-span-4">
                    <label class="text-[#1F5077 pb-1">Location <span class="text-red-500">*</span></label>
                    <input type="text" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Example" />
                </div>

                <div class="md:col-span-2">
                    <label class="text-[#1F5077 pb-1">Location on the map</label>
                    <div id="map" style="width: 100%; height: 270px; border-radius: 10px;"></div>
                </div>

                <div class="md:col-span-2">
                    <label class="text-[#1F5077 pb-1">Header Image</label>
                    <label for="file-input">
                        <div id="drop-zone" class="flex flex-col items-center justify-center bg-[#F2F8FD] border border-[#1D3F5D] rounded-[35px] py-20 cursor-pointer">
                            <input id="file-input" type="file" accept="image/*" class="hidden">
                            <svg id="upload-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-400 mb-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <img id="image-preview" src="" alt="Image Preview" class="hidden max-h-48 rounded-lg">
                            <p id="upload-text" class="text-[#1D3F5D] text-lg ">Add or drag an image here</p>
                            <p class="text-gray-400 text-sm font-light mt-1">Maximum image size 100MB</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="md:col-span-2">
    <label class="text-[#1F5077 pb-1">Location on the map</label>
    <div id="map" style="width: 100%; height: 270px; border-radius: 10px;"></div>
</div> -->
<script>
    document.querySelector('#create_branch').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form default submission

    const form = e.target; // `e.target` is the form element that triggered the event
    const formData = new FormData(form); // Pass the form element to FormData

    fetch('{{ route('branches.store') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            fetchBranchList();
            form.reset(); // Reset the form if needed
        } else {
            alert('Failed to add branch. Please check the form.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
});

function fetchBranchList() {
    // Make an AJAX request to fetch the branch list
    fetch('{{ route('branches.list') }}', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
        .then(response => response.json())
        .then(branches => {
            const branchList = document.getElementById('branch_list_data');
            branchList.innerHTML = ''; // Clear existing rows

            if (branches.length > 0) {
                branches.forEach(branch => {
                    const row = `
                        <tr class="hover:bg-[#F1FAFEB2]">
                            <td class="whitespace-nowrap py-2 px-4">${branch.branch_name}</td>
                            <td class="whitespace-nowrap py-2 px-4">${branch.branch_no}</td>
                            <td class="whitespace-nowrap py-2 px-4">${branch.city}</td>
                            <td class="whitespace-nowrap py-2 px-4">
                                <div class="flex items-center space-x-3">
                                    <a href="#" onclick="openModal('edit_branch', ${branch.id})" class="text-red-500">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="#" onclick="openModal('branch_information', ${branch.id})" class="text-gray-300">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    `;
                    branchList.insertAdjacentHTML('beforeend', row);
                });
            } else {
                branchList.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center py-4">No branches available.</td>
                    </tr>
                `;
            }
        })
        .catch(error => {
            console.error('Error fetching branch list:', error);
        });
}
function openModal(modalId, branchId) {
    const modal = document.getElementById(modalId);

    if (modalId === 'edit_branch' && branchId) {
        // Fetch branch details
        fetch(`/branches/${branchId}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
            .then(response => response.json())
            .then(branch => {
                if (branch.error) {
                    alert(branch.error);
                    return;
                }

                // Populate modal fields
                document.querySelector('#edit_branch_name').value = branch.branch_name;
                document.querySelector('#edit_branch_no').value = branch.branch_no;
                document.querySelector('#edit_region').value = branch.region;
                document.querySelector('#edit_city').value = branch.city;
                document.querySelector('#edit_location').value = branch.location;

                // Set header image preview
                const imagePreview = document.querySelector('#edit_image_preview');
                if (branch.header_image) {
                    imagePreview.src = `/storage/${branch.header_image}`;
                    imagePreview.classList.remove('hidden');
                } else {
                    imagePreview.classList.add('hidden');
                }

                // Update map location
                const mapFrame = document.getElementById('edit_map');
                const encodedLocation = encodeURIComponent(branch.location);
                mapFrame.src = `https://www.google.com/maps?q=${encodedLocation}&output=embed`;

                // Show the modal
                modal.classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error fetching branch data:', error);
                alert('Unable to fetch branch details.');
            });
    } else {
        modal.classList.remove('hidden');
    }
}

</script>
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
</script>

@endsection
