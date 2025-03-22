@extends('layouts.app')

@section('content')

<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <!-- Header Section -->
    <div class="flex md:flex-row flex-col items-center md:justify-between w-full">
        <div class="flex flex-wrap md:flex-nowrap items-center w-full md:w-auto mb-3 space-x-0 md:space-x-3">
            <!-- Back Button -->
            <div class="w-full md:w-auto md:pb-0 pb-2">
                <a href="{{ route('reports_all') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-gradient-to-b from-[#1F5077] to-[#3A95DD]">
                    <img src="{{ asset('images/arrow-left.png') }}" class="w-auto {{ app()->getLocale() == 'ar' ? 'rotate-[180deg]' : '' }}" alt="{{ trans('lang.arrow_left') }}" />
                </a>
            </div>
            
            <!-- Branch Name -->
            <h2 class="text-4xl font-semibold bg-gradient-to-b from-[#1F5077] to-[#3A95DD] bg-clip-text text-transparent">
                {{ $report->branch->branch_name ?? trans('lang.no_branch_assigned') }}
            </h2>
        </div>

        <!-- Buttons for Download and Send Email -->
        <div class="flex items-center md:justify-end md:w-auto w-full space-x-3">
            <!-- Download PDF Button -->
            <button id="download-pdf" type="button" class="bg-[#2E76B0] px-6 py-3 rounded-full text-white">
                <span>{{ trans('lang.save_pdf') }}</span>
                <i class="fa-solid fa-download ps-2"></i>
            </button>

            <!-- Send Email Button -->
            <button id="send-email" type="button" class="bg-[#3A95DD] px-6 py-3 rounded-full text-white">
                <span>{{ trans('lang.send_email') }}</span>
                <i class="fa-solid fa-envelope ps-2"></i>
            </button>

             <!-- Send Email Button -->
             <button id="send-whatsapp" type="button" class="bg-[#3A95DD] px-6 py-3 rounded-full text-white">
                <span>{{ trans('lang.send_whatsapp') }}</span>
                <i class="fa-solid fa-envelope ps-2"></i>
            </button>
        </div>
    </div>

    <!-- Report Details Section -->
    <div class="flex md:flex-row flex-col md:justify-between bg-[#F1FAFE] rounded-[20px] shadow-sm p-3 my-4" id="pdf_div1">
        <!-- Left Column -->
        <div class="md:w-1/2 w-full md:order-1 order-2">
            <div class="flex md:mb-3 mb-2">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">{{ trans('lang.branch_location') }}:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">{{ $report->branch_location ?? trans('lang.not_available') }}</p>
                </div>
            </div>
            
            <div class="flex md:mb-0 mb-2">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">{{ trans('lang.created_date') }}:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">{{ $report->created_at ?? trans('lang.not_available') }}</p>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="md:w-1/2 w-full md:order-2 order-3">
            <div class="flex md:mb-3 mb-2">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">{{ trans('lang.section') }}:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">{{ trans('lang.multiple') }}</p>
                </div>
            </div>
            
            <div class="flex md:mb-0 mb-2">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">{{ trans('lang.created_by') }}:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">{{ $report->user->name ?? trans('lang.unknown_user') }}</p>
                </div>
            </div>
        </div>

        <!-- Branch Image -->
        <div class="md:w-auto w-full flex md:justify-normal justify-center md:order-3 order-1 md:mb-0 mb-3">
            <div class="md:w-[70px] md:h-[70px] w-[100px] h-[100px] overflow-hidden">
                <img src="{{ asset('images/branch_detail_img.png') }}" class="object-fit w-full h-full" />
            </div>
        </div>
    </div>
    <!-- Sections and Questions -->

    @if($report->sections && count($report->sections) > 0)
        @foreach($report->sections as $section)
            <div id="pdf_div2">
                <h4 class="text-xl font-semibold text-[#1D3F5D]">{{ $section->name ?? trans('lang.no_section_name') }}</h4>
                @if($section->questions && count($section->questions) > 0)
                    @foreach($section->questions as $question)
                        @if($question->answer != "")
                            <div class="ml-10">
                                <ol class="list-decimal text-xl text-[#1D3F5D] my-3">
                                    <li>
                                        {{ $question->question ?? trans('lang.no_question_text') }}
                                    </li>
                                </ol>

                                <!-- Answer and User Info -->
                                <div class="flex flex-col bg-black/[2%] border border-[#D9D9D9] rounded-lg p-4 w-full">
                                    <!-- User Info -->
                                    <div class="flex items-center mb-4">
                                        <div class="">
                                            <div class="w-[50px] h-[50px] p-2 rounded-full flex items-center justify-center border border-gray-200">
                                                <img src="{{ asset('images/main-user.png') }}" class="filter invert" />
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="font-semibold text-[#1D3F5D]">{{ $report->user->name ?? trans('lang.unknown_user') }}</p>
                                            <p class="text-sm text-gray-500">{{ $report->created_at ?? trans('lang.not_available') }}</p>
                                        </div>
                                    </div>

                                    <!-- Answered Section -->
                                    <div class="flex lg:flex-row flex-col lg:items-center mb-4 md:ml-16">
                                        <div class="lg:w-[150px]">
                                            <p class="font-semibold text-gray-600">{{ trans('lang.answered') }}:</p>
                                        </div>

                                        <div class="flex md:flex-row flex-col w-full gap-2 py-2">
                                            <!-- Excellent Rating -->
                                            <div @if($question->answer != "Excellent") hidden @endif>
                                                <input class="peer sr-only" value="excellent" name="rating" id="{{ $question->id }}excellent" type="radio" readonly/>
                                                <label for="excellent" class="flex shadow-sm px-4 py-1.5 cursor-pointer flex-col items-center justify-center rounded-lg bg-white transition-transform duration-150 peer-checked:bg-gray-600 peer-checked:text-white text-sm uppercase text-gray-500">
                                                    {{ trans('lang.excellent') }}
                                                </label>
                                            </div>

                                            <!-- Good Rating -->
                                            <div @if($question->answer != "Average") hidden @endif>
                                                <input class="peer sr-only" value="good" name="rating" id="{{ $question->id }}good" type="radio" readonly/>
                                                <label for="good" class="flex shadow-sm px-4 py-1.5 cursor-pointer flex-col items-center justify-center rounded-lg bg-white transition-transform duration-150 peer-checked:bg-gray-600 peer-checked:text-white text-sm uppercase text-gray-500">
                                                    {{ trans('lang.average') }}
                                                </label>
                                            </div>

                                            <!-- Unacceptable Rating -->
                                            <div @if($question->answer != "Unacceptable") hidden @endif>
                                                <input class="peer sr-only" value="unacceptable" name="rating" id="{{ $question->id }}unacceptable" type="radio" readonly/>
                                                <label for="unacceptable" class="flex shadow-sm px-4 py-1.5 cursor-pointer flex-col items-center justify-center rounded-lg bg-white transition-transform duration-150 peer-checked:bg-gray-600 peer-checked:text-white text-sm uppercase text-gray-500">
                                                    {{ trans('lang.unacceptable') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex lg:flex-row flex-col lg:items-center mb-4 md:ml-16">
                                        <div class="lg:w-[150px]">
                                            <p class="font-semibold text-gray-600">{{ trans('lang.description') }}:</p>
                                        </div>

                                        <div class="flex md:flex-row flex-col w-full gap-2 py-2">
                                            <!-- Excellent Rating -->
                                            <div>
                                                {{ $question->description}}
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Admin Note -->
                                    <div class="flex lg:flex-row flex-col lg:items-center mb-4 md:ml-16">
                                        <div class="lg:w-[150px]">
                                            <p class="font-semibold text-gray-600">{{ trans('lang.admin_note') }}:</p>
                                        </div>
                                        <div class="flex md:flex-row flex-col w-full gap-2 py-2">
                                            <input type="text" class="border p-2 rounded w-full" value="{{ $question->admin_note ?? '' }}" data-question-id="{{ $question->result_id }}" onchange="updateAdminNote(this)">
                                        </div>
                                    </div>

                                    <!-- Attachments Section -->
                                    @php
                                        $attachments = json_decode($question->attachments, true) ?? [];
                                        $adminAttachments = json_decode($question->admin_attachments, true) ?? [];
                                    @endphp

                                    <!-- User Attachments -->
                                    <div class="flex lg:flex-row flex-col md:ml-16">
                                        <div class="lg:w-[150px] lg:mb-0 mb-3">
                                            <p class="font-semibold text-gray-600 mt-2">{{ trans('lang.attachments') }}:</p>
                                        </div>
                                        <div class="grid md:grid-cols-6 grid-cols-3 w-full md:gap-4 gap-2">
                                            @if(count($attachments) > 0)
                                                @foreach($attachments as $imgKey => $img)
                                                <div class="relative">
                                                    <a href="{{ url('/' . $img) }}" target="_blank">
                                                        <img class="h-20 w-20 rounded-md object-cover" src="{{ url('/' . $img) }}" alt="{{ trans('lang.attachment') }} {{ $imgKey + 1 }}" />
                                                    </a>
                                                    <button class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 text-xs" onclick="deleteAttachment('{{ $img }}', '{{ $question->result_id }}', 'user')">❌</button>
                                                </div>
                                                @endforeach
                                            @else
                                                <p class="text-sm text-gray-500">{{ trans('lang.no_attachments') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Admin Attachments -->
                                    <div class="flex lg:flex-row flex-col md:ml-16">
                                        <div class="lg:w-[150px] lg:mb-0 mb-3">
                                            <p class="font-semibold text-gray-600 mt-2">{{ trans('lang.admin_attachments') }}:</p>
                                        </div>
                                        <div class="grid md:grid-cols-6 grid-cols-3 w-full md:gap-4 gap-2">
                                            @foreach($adminAttachments as $imgKey => $img)
                                                <div class="relative">
                                                    <a href="{{ url('/' . $img) }}" target="_blank">
                                                        <img class="h-20 w-20 rounded-md object-cover" src="{{ url('/' . $img) }}" />
                                                    </a>
                                                    <button class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 text-xs" onclick="deleteAttachment('{{ $img }}', '{{ $question->result_id }}', 'admin')">❌</button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- File Upload -->
                                    <div class="flex lg:flex-row flex-col md:ml-16 mt-4">
                                        <div class="lg:w-[150px] lg:mb-0 mb-3">
                                            <p class="font-semibold text-gray-600 mt-2">{{ trans('lang.upload_attachments') }}:</p>
                                        </div>
                                        <input type="file" multiple data-question-id="{{ $question->result_id }}" onchange="uploadAttachment(this)">
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        @endforeach
    @endif
</div>
<script>
function uploadAttachment(input) {
    let formData = new FormData();
    formData.append('question_id', input.dataset.questionId);
    for (let file of input.files) {
        formData.append('admin_attachments[]', file);
    }
    fetch('/upload-admin-images', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: formData
    }).then(response => response.json()).then(data => {
        if (data.success) location.reload();
    });
}
function deleteAttachment(imagePath, questionId, type) {
    if (!confirm('<?= trans('lang.is_delete_success') ?>')) return;
    fetch('/delete-attachment', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ image: imagePath, question_id: questionId, type: type })
    }).then(response => response.json()).then(data => {
        if (data.success) location.reload();
    });
}



function updateAdminNote(input) {
    fetch('/update-admin-note', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ question_id: input.dataset.questionId, admin_note: input.value })
    });
}
</script>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>

<script>
document.getElementById('download-pdf').addEventListener('click', async function() {
    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF('p', 'mm', 'a4');
    
    async function addDivToPdf(divId, yOffset) {
        const div = document.getElementById(divId);
        if (!div) return yOffset;

        try {
            const imgData = await domtoimage.toPng(div);
            const imgWidth = 190; // Fit in A4 width
            const imgHeight = (div.clientHeight * imgWidth) / div.clientWidth;
            
            pdf.addImage(imgData, 'PNG', 10, yOffset, imgWidth, imgHeight);
            return yOffset + imgHeight + 10; // Add space for next div
        } catch (error) {
            console.error('Error capturing div:', error);
        }
        return yOffset;
    }

    let yOffset = 10;
    yOffset = await addDivToPdf('pdf_div1', yOffset);
    yOffset = await addDivToPdf('pdf_div2', yOffset);

    pdf.save('report.pdf');
});
</script>


<!-- Send Email Script -->
<script>
    document.getElementById('send-email').addEventListener('click', function() {
        const ownerEmail = "{{ $report->branch->owner_email }}"; // Get the owner's email from the report
        if (!ownerEmail) {
            alert("No owner email found for this branch.");
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch("{{ route('send-report') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                id: "{{ $report->id }}",
                email: ownerEmail // Use the owner's email
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message || "Email sent successfully to " + ownerEmail);
        })
        .catch(error => {
            console.error('Email sending failed:', error);
        });
    });
</script>
<!-- Send Email Script -->
<script>
    document.getElementById('send-whatsapp').addEventListener('click', function() {
        const ownerEmail = "{{ $report->branch->owner_mobile }}"; // Get the owner's email from the report
        if (!ownerEmail) {
            alert("No owner mobile found for this branch.");
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch("{{ route('send-report-watsapp') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                id: "{{ $report->id }}",
                mobile: ownerEmail // Use the owner's email
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message || "Whatsapp sent successfully to " + ownerEmail);
        })
        .catch(error => {
            console.error('Whatsapp sending failed:', error);
        });
    });
</script>
@endsection