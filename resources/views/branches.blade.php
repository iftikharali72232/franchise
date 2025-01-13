@extends('layouts.app')

@section('content')

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
                    <th class="whitespace-nowrap">
                        Branch Name
                    </th>
                    <th class="whitespace-nowrap">
                        Branch No
                    </th>
                    <th class="whitespace-nowrap">
                        City
                    </th>
                    <th class="whitespace-nowrap">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-[#F1FAFEB2]">
                    <td class="whitespace-nowrap">
                        MESHRAQ Sultana
                    </td>
                    <td class="whitespace-nowrap">
                        01
                    </td>
                    <td class="whitespace-nowrap">
                        Medina
                    </td>
                    <td class="whitespace-nowrap">
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

                <tr class="hover:bg-[#F1FAFEB2] bg-[#F1FAFEB2]">
                    <td class="whitespace-nowrap">
                        MESHRAQ Sultana
                    </td>
                    <td class="whitespace-nowrap">
                        01
                    </td>
                    <td class="whitespace-nowrap">
                        Medina
                    </td>
                    <td class="whitespace-nowrap">
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

                <tr class="hover:bg-[#F1FAFEB2]">
                    <td class="whitespace-nowrap">
                        MESHRAQ Sultana
                    </td>
                    <td class="whitespace-nowrap">
                        01
                    </td>
                    <td class="whitespace-nowrap">
                        Medina
                    </td>
                    <td class="whitespace-nowrap">
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

            <div class="grid md:grid-cols-4 grid-cols-1 gap-4">
                <div class="">
                    <label class="text-[#1F5077 pb-1">Branch Name <span class="text-red-500">*</span></label>
                    <input type="text" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Example" />
                </div>

                <div class="">
                    <label class="text-[#1F5077 pb-1">Branch No <span class="text-red-500">*</span></label>
                    <input type="text" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Example" />
                </div>

                <div class="">
                    <label class="text-[#1F5077 pb-1">Region <span class="text-red-500">*</span></label>
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
                    <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3621.243308577344!2d39.61017141514183!3d24.470901966181095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15bdbf3b8aa52c03%3A0x2ef4c1aaf0c8d57a!2sAl%20Masjid%20an%20Nabawi%20(Mosque%20of%20the%20Prophet%20Muhammad)!5e0!3m2!1sen!2s!4v1699020000000!5m2!1sen!2s"
                    width="100%"
                    height="270"
                    style="border:0; border-radius: 10px;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
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

                <div class="md:col-span-4 flex justify-end items-center mb-20">
                    <button type="submit" class="px-[40px] py-[20px] bg-[#1F5077] text-white font-semibold rounded-full">
                        Send
                    </button>
                </div>
            </div>
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
                    <input type="text" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Example" />
                </div>

                <div class="">
                    <label class="text-[#1F5077 pb-1">Branch No <span class="text-red-500">*</span></label>
                    <input type="text" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Example" />
                </div>

                <div class="">
                    <label class="text-[#1F5077 pb-1">Region <span class="text-red-500">*</span></label>
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
                    <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3621.243308577344!2d39.61017141514183!3d24.470901966181095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15bdbf3b8aa52c03%3A0x2ef4c1aaf0c8d57a!2sAl%20Masjid%20an%20Nabawi%20(Mosque%20of%20the%20Prophet%20Muhammad)!5e0!3m2!1sen!2s!4v1699020000000!5m2!1sen!2s"
                    width="100%"
                    height="270"
                    style="border:0; border-radius: 10px;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
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
                    <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3621.243308577344!2d39.61017141514183!3d24.470901966181095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15bdbf3b8aa52c03%3A0x2ef4c1aaf0c8d57a!2sAl%20Masjid%20an%20Nabawi%20(Mosque%20of%20the%20Prophet%20Muhammad)!5e0!3m2!1sen!2s!4v1699020000000!5m2!1sen!2s"
                    width="100%"
                    height="270"
                    style="border:0; border-radius: 10px;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
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
