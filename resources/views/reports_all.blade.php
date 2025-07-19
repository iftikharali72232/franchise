@extends('layouts.app')

@section('content')

<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <div class="flex md:flex-row flex-col items-center md:justify-between w-full">
        <div class="flex flex-wrap md:flex-nowrap items-center w-full md:w-auto md:mb-3 space-x-0 md:space-x-3">
            <div class="w-full md:w-auto md:pb-0 pb-2">
                <a href="/reports" 
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-gradient-to-b from-[#1F5077] to-[#3A95DD]">
                    <img src="{{ asset('images/arrow-left.png') }}" class="w-auto {{ app()->getLocale() == 'ar' ? 'rotate-[180deg]' : '' }}" alt="Arrow Left" />
                </a>
            </div>
            
            <select class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white w-1/2 md:w-auto mb-3 md:mb-0">
                <option>{{ trans('lang.city') }}</option>
                <option>C1</option>
                <option>C2</option>
            </select>

            <select class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white w-1/2 md:w-auto mb-3 md:mb-0">
                <option>{{ trans('lang.branch') }}</option>
                <option>B1</option>
                <option>B2</option>
            </select>

            <select class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white w-1/2 md:w-auto mb-3 md:mb-0">
                <option>{{ trans('lang.from') }}</option>
                <option>Date 1</option>
                <option>Date 2</option>
            </select>

            <select class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white w-1/2 md:w-auto mb-3 md:mb-0">
                <option>{{ trans('lang.to') }}</option>
                <option>Date 1</option>
                <option>Date 2</option>
            </select>
        </div>

        <div class="flex items-center md:justify-end md:w-auto w-full space-x-3">
            <button type="button" class="bg-[#2E76B0] w-[40px] h-[40px] p-1 rounded-full text-white">
                <i class="fa-solid fa-download"></i>
            </button>
        </div>
    </div>

    <div class="pt-2 pb-4 w-full">
        <div class="border-b-2 border-[#D6E7F5]"></div>
    </div>

    <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4">
        <!-- card 1 -->
        <?php foreach($res as $report){ ?>
            <div class="bg-[#F1FAFE] rounded-[30px] shadow-sm p-6 report-card">
                <a href="{{ route('report_detail', $report->id) }}">
                    <div class="flex mb-3">
                        <div class="w-1/2">
                            <p class="text-sm font-semibold text-[#1D3F5D]">{{ trans('lang.branch_name') }}:</p>
                        </div>
                        <div class="w-1/2">
                            <p class="text-sm text-[#3A95DD] branch-name"><?= $report->branch->branch_name ?? "" ?></p>
                        </div>
                    </div>

                    <div class="flex mb-3">
                        <div class="w-1/2">
                            <p class="text-sm font-semibold text-[#1D3F5D]">{{ trans('lang.auditor_name') }}:</p>
                        </div>
                        <div class="w-1/2">
                            <p class="text-sm text-[#3A95DD] auditor-name"><?= $report->user->name ?? "" ?></p>
                        </div>
                    </div>

                    <div class="flex mb-3">
                        <div class="w-1/2">
                            <p class="text-sm font-semibold text-[#1D3F5D]">{{ trans('lang.branch_location') }}:</p>
                        </div>
                        <div class="w-1/2">
                            <p class="text-sm text-[#3A95DD]"><?= $report->branch_location ?? "" ?></p>
                        </div>
                    </div>

                    <div class="flex mb-3">
                        <div class="w-1/2">
                            <p class="text-sm font-semibold text-[#1D3F5D]">{{ trans('lang.section') }}:</p>
                        </div>
                        <div class="w-1/2">
                            <p class="text-sm text-[#3A95DD] section-name"><?= $report->section ?? "" ?></p>
                        </div>
                    </div>

                    <div class="flex mb-3">
                        <div class="w-1/2">
                            <p class="text-sm font-semibold text-[#1D3F5D]">{{ trans('lang.created') }}:</p>
                        </div>
                        <div class="w-1/2">
                            <p class="text-sm text-[#3A95DD]">Admin</p>
                        </div>
                    </div>

                    <div class="w-full bg-[#1D3F5D] mt-10 mb-3">
                        <div class="relative bg-[#93C3E6] w-[0%] py-[1px]">
                            <p class="absolute text-[#93C3E6] top-[-25px] right-[-25px]">0%</p>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="w-1/2">
                            <p class="text-sm font-semibold text-[#1D3F5D]">{{ trans('lang.created_date') }}:</p>
                        </div>
                        <div class="w-1/2">
                            <p class="text-sm text-[#3A95DD] date"><?= $report->created_at ?? "" ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>

@endsection
