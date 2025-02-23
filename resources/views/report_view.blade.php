@extends('layouts.app')

@section('content')

<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <div class="flex md:flex-row flex-col items-center md:justify-between w-full">
        <div class="flex flex-wrap md:flex-nowrap items-center w-full md:w-auto mb-3 space-x-0 md:space-x-3">
            <div class="w-full md:w-auto md:pb-0 pb-2">
                <a href="#" 
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-gradient-to-b from-[#1F5077] to-[#3A95DD]">
                    <img src="{{ asset('images/arrow-left.png') }}" class="w-auto {{ app()->getLocale() == 'ar' ? 'rotate-[180deg]' : '' }}" alt="Arrow Left" />
                </a>
            </div>
            
            <h2 class="text-4xl font-semibold bg-gradient-to-b from-[#1F5077] to-[#3A95DD] bg-clip-text text-transparent">
                <?= $report->branch->branch_name ?>
            </h2>
        </div>


        <div class="flex items-center md:justify-end md:w-auto w-full space-x-3">
            <button id="download-pdf" type="button" class="bg-[#2E76B0] px-6 py-3 rounded-full text-white">
                <span>Save PDF</span>
                <i class="fa-solid fa-download ps-2"></i>
            </button>
        </div>
    </div>

    <div class="flex md:flex-row flex-col md:justify-between bg-[#F1FAFE] rounded-[20px] shadow-sm p-3 my-4">
        <div class="md:w-1/2 w-full md:order-1 order-2">
            <div class="flex md:mb-3 mb-2">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Branch Location:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]"><?= $report->branch_location ?></p>
                </div>
            </div>
            
            <div class="flex md:mb-0 mb-2">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Created Date:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]"><?= $report->created_at ?></p>
                </div>
            </div>
        </div>

        <div class="md:w-1/2 w-full md:order-2 order-3">
            <div class="flex md:mb-3 mb-2">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Section:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]">Multiple</p>
                </div>
            </div>
            
            <div class="flex md:mb-0 mb-2">
                <div class="w-1/2">
                    <p class="text-sm font-semibold text-[#1D3F5D]">Created By:</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-[#3A95DD]"><?= $report->user->name ?></p>
                </div>
            </div>
        </div>

        <div class="md:w-auto w-full flex md:justify-normal justify-center md:order-3 order-1 md:mb-0 mb-3">
            <div class="md:w-[70px] md:h-[70px] w-[100px] h-[100px] overflow-hidden">
                <img src="{{ asset('images/branch_detail_img.png') }}" class="object-fit w-full h-full" />
            </div>
        </div>
    </div>
<?php foreach($report->sections as $section) { ?>
    <div class="">
        <h4 class="text-xl font-semibold text-[#1D3F5D]"><?= $section->name ?></h4>
        <?php foreach($section->questions as $question) { 
            if($question->answer != ""){ ?>
        <div class="ml-10">
            <ol class="list-decimal text-xl text-[#1D3F5D] my-3">
                <li>
                    <?= $question->question ?>
                </li>
            </ol>

            <div class="flex flex-col bg-black/[2%] border border-[#D9D9D9] rounded-lg p-4 w-full">
                <!-- User Info -->
                <div class="flex items-center mb-4">
                    <div class="">
                        <div class="w-[50px] h-[50px] p-2 rounded-full flex items-center justify-center border border-gray-200">
                            <img src="{{ asset('images/main-user.png') }}" class="filter invert" />
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="font-semibold text-[#1D3F5D]"><?= $report->user->name ?></p>
                        <p class="text-sm text-gray-500"><?= $report->created_at ?></p>
                    </div>
                </div>

                <!-- Answered Section -->
                <div class="flex lg:flex-row flex-col lg:items-center mb-4 md:ml-16">
                    <div class="lg:w-[150px]">
                        <p class="font-semibold text-gray-600">Answered:</p>
                    </div>

                    <div class="flex md:flex-row flex-col w-full gap-2 py-2">
                        <!-- Excellent Rating -->
                        <div <?= $question->answer == "Excellent" ? '' : "hidden" ?>>
                            <input class="peer sr-only" value="excellent" name="rating" id="<?= $question->id ?>excellent" type="radio" readonly/>
                            <label
                                for="excellent"
                                class="flex shadow-sm px-4 py-1.5 cursor-pointer flex-col items-center justify-center rounded-lg bg-white transition-transform duration-150 peer-checked:bg-gray-600 peer-checked:text-white text-sm uppercase text-gray-500">
                                Excellent
                            </label>
                        </div>

                        <!-- Good Rating -->
                        <div <?= $question->answer == "Good" ? '' : "hidden" ?> >
                            <input class="peer sr-only" value="good" name="rating" id="<?= $question->id ?>good" type="radio" readonly/>
                            <label
                                for="good"
                                class="flex shadow-sm px-4 py-1.5 cursor-pointer flex-col items-center justify-center rounded-lg bg-white transition-transform duration-150 peer-checked:bg-gray-600 peer-checked:text-white text-sm uppercase text-gray-500">
                                Good
                            </label>
                        </div>

                        <!-- Unacceptable Rating -->
                        <div <?= $question->answer == "Unacceptable" ? '' : "hidden" ?>>
                            <input class="peer sr-only" value="unacceptable" name="rating" id="<?= $question->id ?>unacceptable" type="radio"  readonly/>
                            <label
                                for="unacceptable"
                                class="flex shadow-sm px-4 py-1.5 cursor-pointer flex-col items-center justify-center rounded-lg bg-white transition-transform duration-150 peer-checked:bg-gray-600 peer-checked:text-white text-sm uppercase text-gray-500">
                                Unacceptable
                            </label>
                        </div>
                    </div>

                </div>
                <?php $attachments = json_decode($question->attachments, true); ?>
                <!-- Attachments Section -->
                <div class="flex lg:flex-row flex-col md:ml-16">
                    <div class="lg:w-[150px] lg:mb-0 mb-3">
                        <p class="font-semibold text-gray-600 mt-2">Attachments:</p>
                    </div>
                    <div class="grid md:grid-cols-6 grid-cols-3 w-full md:gap-4 gap-2">
                        <?php if(count($attachments) > 0) {
                            foreach($attachments as $imgKey => $img)
                            {
                                echo '<img class="h-20 w-20 rounded-md object-cover" src="'.(url("/".$img)).'" alt="Attachment '.($imgKey+1).'" />';
                            }
                        } ?>
                        <!-- <img class="h-20 w-20 rounded-md object-cover" src="https://gratisography.com/wp-content/uploads/2024/10/gratisography-cool-cat-800x525.jpg" alt="Attachment 1">
                        <img class="h-20 w-20 rounded-md object-cover" src="https://gratisography.com/wp-content/uploads/2024/10/gratisography-cool-cat-800x525.jpg" alt="Attachment 2">
                        <img class="h-20 w-20 rounded-md object-cover" src="https://gratisography.com/wp-content/uploads/2024/10/gratisography-cool-cat-800x525.jpg" alt="Attachment 3">
                        <img class="h-20 w-20 rounded-md object-cover" src="https://gratisography.com/wp-content/uploads/2024/10/gratisography-cool-cat-800x525.jpg" alt="Attachment 4">
                        <img class="h-20 w-20 rounded-md object-cover" src="https://gratisography.com/wp-content/uploads/2024/10/gratisography-cool-cat-800x525.jpg" alt="Attachment 5">
                        <img class="h-20 w-20 rounded-md object-cover" src="https://gratisography.com/wp-content/uploads/2024/10/gratisography-cool-cat-800x525.jpg" alt="Attachment 6"> -->
                    </div>
                </div>
            </div>
        </div>
        <?php }} ?>
    </div>
<?php } ?>
</div>


  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- Vendor JS Files -->
  <script src="{{asset('vendor/apexcharts/apexcharts.min.js')}}"></script>
  <!-- <script src="{{asset('js/query.js')}}"></script> -->
  <!-- <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script> -->
  <script src="{{asset('vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('vendor/php-email-form/validate.js')}}"></script>
  

  <!-- Template Main JS File -->
  <script>
    document.getElementById('download-pdf').addEventListener('click', function() {
    // Current page ka HTML content capture karein
    const htmlContent = document.documentElement.outerHTML;

    // CSRF token meta tag se lekar
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Server par HTML content bhejein
    fetch("http://127.0.0.1:8000/generate-current-page-pdf", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken // CSRF token ko headers mein include karein
        },
        body: JSON.stringify({ html: htmlContent })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.blob(); // Response ko blob mein convert karein
    })
    .then(blob => {
        // PDF download karein
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'current-page.pdf';
        link.click();
    })
    .catch(error => {
        console.error('PDF generation failed:', error);
    });
});
</script>
  <script src="{{asset('js/main.js')}}"></script>
