<?php

namespace App\Http\Controllers;

use App\Mail\MyMailable;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;
use App\Models\User;
use App\Models\Section;
use App\Models\SectionQuestion;
use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{
    public function create()
    { 
        $branches = Branch::all();
        $users = User::where('user_type', 1)->get();
        $sections = Section::all();
        ?>

        <form action="#" method="POST">
            <div class="grid md:grid-cols-3 grid-cols-1 gap-4">
                <div class="">
                    <select name="branch_id" id="branch_id" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" required>
                        <option value="" selected disabled>Select Branch</option>
                        <?php foreach($branches as $branch) { ?>
                            <option value="<?= $branch->id ?>"><?= $branch->branch_name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="">
                    <select name="auditor_id" id="auditor_id" onchange="getEmail()" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" required>
                        <option value="" selected disabled>Select Auditor</option>
                        <?php foreach($users as $user) { ?>
                            <option value="<?= $user->id ?>" data-email="<?= $user->email ?>"><?= $user->name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="">
                    <input type="email" id="user_email" name="email" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Email" required>
                </div>

                <div class="">
                    <input type="date" name="date" id="request_date" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" required>
                </div>

                <div class="">
                    <input type="time" name="time" id="time" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" value="<?= date('H:i') ?>" required>
                </div>

                <div class="flex items-center gap-2">
                    <input type="text" name="code" id="code" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Code" readonly required>
                    <button id="generate-code" type="button" class="px-6 py-3 bg-[#1F5077] text-white rounded-full hover:bg-[#1F5077]/90 focus:outline-none">+</button>
                </div>

                <div class="md:col-span-3">
                    <label for="section_id" class="block text-sm font-medium text-[#1F5077]">Select Section</label>
                    <select name="section_id[]" id="section_id" multiple class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-lg select2">
                        <option value="" disabled>Select Section</option>
                        <?php foreach ($sections as $section) { ?>
                            <option value="<?= $section->id ?>"><?= $section->name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Display selected sections -->
                <div id="selected-sections" class="md:col-span-3 mt-4">
                    <label class="block text-sm font-medium text-[#1F5077]">Selected Sections</label>
                    <div id="section-labels" class="mt-2"></div>
                </div>

                <!-- Hidden input for selected section IDs -->
                <input type="hidden" name="section_ids" id="section_ids">

                <!-- Display questions for selected sections -->
                <div id="questions-container" class="md:col-span-3 mt-4">
                    <label class="block text-sm font-medium text-[#1F5077]">Questions</label>
                    <div id="questions-list" class="mt-2"></div>
                </div>

                <div class="md:col-span-3 flex justify-end items-center">
                    <button type="submit" class="px-[30px] py-[10px] bg-[#1F5077] text-white font-semibold rounded-full submitbtn">
                        Send
                    </button>
                </div>
            </div>
             <!-- Loader (Hidden by default) -->
            <div class="loader hidden mt-2">
                <img src="https://i.gifer.com/4V0b.gif" alt="Loading..." width="40">
                Processing...
            </div>
        </form>
        <script>
            $(document).ready(function () {
                // Initialize Select2
                $('#section_id').select2({
                    placeholder: "Select Section",
                    allowClear: true,
                    width: '100%'
                });

                // Onchange event for section selection
                $('#section_id').on('change', function () {
                    const selectedSections = $(this).val(); // Get selected section IDs
                    $('#section_ids').val(selectedSections.join(',')); // Update hidden input with selected section IDs

                    // Display selected section labels
                    const sectionLabels = $('#section-labels');
                    sectionLabels.empty();
                    if (selectedSections && selectedSections.length > 0) {
                        selectedSections.forEach(sectionId => {
                            const sectionName = $(`#section_id option[value="${sectionId}"]`).text();
                            sectionLabels.append(`<span class="inline-block bg-[#1F5077] text-white px-3 py-1 rounded-full mr-2 mb-2">${sectionName}</span>`);
                        });
                    }

                    // Load questions for selected sections
                    if (selectedSections && selectedSections.length > 0) {
                        loadQuestions(selectedSections);
                    } else {
                        $('#questions-list').empty(); // Clear questions if no sections are selected
                    }
                });

                // Function to load questions for selected sections
                function loadQuestions(sectionIds) {
                    let url = new URL(window.location.href);
                    let segments = url.pathname.split('/');
                    let franchiseUrl = url.origin; // "http://localhost/franchise"
                    console.log(franchiseUrl);
                    $.ajax({
                        url: franchiseUrl+'/get-questions', // Replace with your route to fetch questions
                        method: 'POST',
                        data: { section_ids: sectionIds },
                        success: function (response) {
                            const questionsList = $('#questions-list');
                            questionsList.empty();
                            if (response.success && response.questions.length > 0) {
                                response.questions.forEach(question => {
                                    questionsList.append(`
                                        <div class="flex items-center mb-2">
                                            <input type="checkbox" name="questions[]" value="${question.id}" id="question-${question.id}" class="mr-2" checked>
                                            <label for="question-${question.id}" class="text-[#1F5077]">${question.question}</label>
                                        </div>
                                    `);
                                });
                            } else {
                                questionsList.append('<p class="text-[#1F5077]">No questions found for the selected sections.</p>');
                            }
                        },
                        error: function () {
                            alert('An error occurred while loading questions.');
                        }
                    });
                }
            });
        </script>
        <script>
            $(document).ready(function () {
                 // Get the current date in the format YYYY-MM-DD
                const today = new Date().toISOString().split('T')[0];

                // Set the min attribute of the date input to today's date using jQuery
                $('#request_date').attr('min', today);

                $('.select2').select2({
                    placeholder: "Select Section",
                    allowClear: true, // Adds a clear button
                    width: '100%' // Ensures the dropdown matches the width of the container
                });
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('form').on('submit', function (e) {
                    e.preventDefault();
                    
                    // Disable button and show loader
                    $(".loader").removeClass("hidden"); // Show loader

                    let formData = $(this).serialize();

                    $.ajax({
                        url: "<?= route('requests.store') ?>",
                        type: "POST",
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            if (response.success) {
                                alert(response.message);
                                $(".modal").addClass("hidden");
                                $('form')[0].reset(); // Clear form
                            }
                        },
                        error: function (xhr) {
                            let errors = xhr.responseJSON.errors;
                            alert(Object.values(errors).join('\n'));
                        },
                        complete: function () {
                            // Hide loader and enable button
                            $(".loader").addClass("hidden");
                        }
                    });
                });


            });
            
            $(document).ready(function() {
                // Array to store generated codes (for uniqueness check)
                let generatedCodes = [];

                // Function to generate a random 6-digit code
                function generateRandomCode() {
                    return String(Math.floor(100000 + Math.random() * 900000)); // Generates a 6-digit number
                }

                // Function to check if a code is unique
                function isCodeUnique(code) {
                    return !generatedCodes.includes(code); // Returns true if the code is unique
                }

                // Button click event
                $('#generate-code').click(function() {
                    let code;
                    do {
                        code = generateRandomCode(); // Generate a random code
                    } while (!isCodeUnique(code)); // Ensure the code is unique

                    // Add the generated code to the list of used codes
                    generatedCodes.push(code);

                    // Populate the input field with the generated code
                    $('#code').val(code);
                });
            });
            function getEmail() {
                var select = document.getElementById("auditor_id"); // Get the select element
                var selectedOption = select.options[select.selectedIndex]; // Get the selected option
                var email = selectedOption.getAttribute("data-email"); // Get the data-email attribute
                document.getElementById("user_email").value = email; // Set the email input field value
            }
        </script>
    <?php
    }
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'branch_id' => 'nullable|exists:branches,id',
    //         'auditor_id' => 'nullable|exists:users,id',
    //         'email' => 'nullable|email',
    //         'date' => 'nullable|date',
    //         'time' => 'nullable|date_format:H:i',
    //         'code' => 'nullable|string|max:255',
    //         'section_id' => 'nullable',
    //     ]);

    //     $auditor = User::find($request->auditor_id);
    //     $branch = Branch::find($request->branch_id);
    //     $validated['section_id'] = json_encode($request->section_id);
    //      // Prepare the data to pass to the email view
    //     $data = [
    //         'name' => $auditor->name,
    //         'message' => 'This is your approval code ('.$request->code.') for '.$branch->branch_name.' Branch.',
    //     ];
    //     // print_r($data); exit;
    //     // Send the email
    //     Mail::to($validated['email'] ?? $auditor->email)->send(new MyMailable($data));

    //     \App\Models\Request::create($validated);

    //     return response()->json(['success' => true, 'message' => 'Request submitted successfully.']);
    // }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => 'nullable|exists:branches,id',
            'auditor_id' => 'nullable|exists:users,id',
            'email' => 'nullable|email',
            'date' => 'nullable|date',
            'time' => 'nullable|date_format:H:i',
            'code' => 'nullable|string|max:255',
            'section_id' => 'nullable|array',
            'questions' => 'nullable|array',
        ]);

        //    print_r($_POST); exit;
        $auditor = User::find($request->auditor_id);
        $branch = Branch::find($request->branch_id);

        // Convert section IDs and question IDs to comma-separated strings
        $validated['section_id'] = json_encode($request->section_id ?? []);
        $validated['questions'] = json_encode($request->questions ?? []);

        // Prepare the data to pass to the email view
        $data = [
            'name' => $auditor->name,
            'message' => 'This is your approval code (' . $request->code . ') for ' . $branch->branch_name . ' Branch.',
        ];

        // Send the email
        Mail::to($validated['email'] ?? $auditor->email)->send(new MyMailable($data));

        \App\Models\Request::create($validated);

        return response()->json(['success' => true, 'message' => 'Request submitted successfully.']);
    }
    public function generateCode()
    {
        echo "success"; exit;
        do {
            // Generate a random 6-digit code
            $code = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (Request::where('code', $code)->exists()); // Check if the code already exists

        return response()->json([
            'success' => true,
            'code' => $code,
        ]);
    }

    public function getQuestions(Request $request)
    {
        $sectionIds = $request->input('section_ids');
        $questions = SectionQuestion::whereIn('section_id', $sectionIds)->get();

        return response()->json([
            'success' => true,
            'questions' => $questions,
        ]);
    }
}
