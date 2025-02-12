<?php

namespace App\Http\Controllers;

use App\Mail\MyMailable;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;
use App\Models\User;
use App\Models\Section;
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
                    <select name="branch_id" id="branch_id" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full">
                        <option value="" selected disabled>Select Branch</option>
                        <?php foreach($branches as $branch) { ?>
                            <option value="<?= $branch->id ?>"><?= $branch->branch_name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="">
                    <select name="auditor_id" id="auditor_id" onchange="getEmail()" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full">
                        <option value="" selected disabled>Select Auditor</option>
                        <?php foreach($users as $user) { ?>
                            <option value="<?= $user->id ?>" data-email="<?= $user->email ?>"><?= $user->name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="">
                    <input type="email" id="user_email" name="email" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Email">
                </div>

                <div class="">
                    <input type="date" name="date" id="date" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" >
                </div>

                <div class="">
                    <input type="time" name="time" id="time" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" value="<?= date('H:i') ?>">
                </div>

                <div class="">
                    <input type="text" name="code" id="code" class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full" placeholder="Code">
                </div>

                <div class="md:col-span-3">
                    <select name="section_id[]" multiple class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-lg select2 ">
                        <option value="" disabled>Select Section</option>
                        <?php foreach($sections as $section) { ?>
                            <option value="<?= $section->id ?>"><?= $section->name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="md:col-span-3 flex justify-end items-center">
                    <button type="submit" class="px-[30px] py-[10px] bg-[#1F5077] text-white font-semibold rounded-full">
                        Send
                    </button>
                </div>
            </div>
        </form>
        <script>
            $(document).ready(function () {
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

                    // Get form data
                    let formData = $(this).serialize();

                    // Send AJAX request
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
                                $("#create_request").addClass("hidden");
                                $('form')[0].reset(); // Clear form
                            }
                        },
                        error: function (xhr) {
                            // Handle errors
                            let errors = xhr.responseJSON.errors;
                            alert(Object.values(errors).join('\n'));
                        }
                    });
                });
            });
        </script>
    <?php
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => 'nullable|exists:branches,id',
            'auditor_id' => 'nullable|exists:users,id',
            'email' => 'nullable|email',
            'date' => 'nullable|date',
            'time' => 'nullable|date_format:H:i',
            'code' => 'nullable|string|max:255',
            'section_id' => 'nullable',
        ]);

        $auditor = User::find($request->auditor_id);
        $branch = Branch::find($request->branch_id);
        $validated['section_id'] = json_encode($request->section_id);
         // Prepare the data to pass to the email view
        $data = [
            'name' => $auditor->name,
            'message' => 'This is your approval code ('.$request->code.') for '.$branch->branch_name.' Branch.',
        ];
        // print_r($data); exit;
        // Send the email
        Mail::to($validated['email'] ?? $auditor->email)->send(new MyMailable($data));

        \App\Models\Request::create($validated);

        return response()->json(['success' => true, 'message' => 'Request submitted successfully.']);
    }

}
