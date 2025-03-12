@extends('layouts.app')

@section('content')
<div class="space-y-5 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
    <div class="flex lg:flex-row flex-col lg:space-x-4 lg:space-y-0 space-y-4 {{ app()->getLocale() == 'ar' ? 'lg:space-x-reverse' : '' }}">
        <div class="relative flex flex-col lg:w-[80%] w-full rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
            <div class="flex md:flex-row flex-col justify-between px-6 pt-4">
                <div class="flex items-center justify-center lg:mb-0 mb-2">
                    <h2 class="md:text-[30px] text-[22px] font-600 text-[#93C3E6] flex items-center">
                        <span class="text-shadow">{{ trans('lang.' . Str::snake($selectedRegion)) }}</span>
                        <i class="fa-solid fa-chevron-right {{ app()->getLocale() == 'ar' ? 'rotate-[180deg]' : '' }} md:text-[20px] text-[16px] ms-4"></i>
                    </h2>
                </div>

                <form method="GET" action="{{ route('home') }}">
                    <div class="flex items-center md:justify-end justify-center space-x-4 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                        <select class="bg-[#F3F7FC] border border-[#D6E7F5] rounded-lg px-4 py-2 shadow-sm focus:outline-none text-gray-900" name="section" onchange="this.form.submit()">
                            @forelse($sections as $section)
                                <option value="{{ $section->id }}" {{ $selectedSectionID == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @empty
                                <option>{{ trans('lang.no_sections_found') }}</option>
                            @endforelse
                        </select>

                        <select class="bg-[#F3F7FC] border border-[#D6E7F5] rounded-lg px-4 py-2 shadow-sm focus:outline-none text-gray-900" name="region" onchange="this.form.submit()">
                            <option value="">{{ trans('lang.select_region') }}</option>
                            <option value="Riyadh" {{ $selectedRegion == 'Riyadh' ? 'selected' : '' }}>Riyadh ({{ trans('lang.riyadh') }})</option>
                            <option value="Makkah" {{ $selectedRegion == 'Makkah' ? 'selected' : '' }}>Makkah ({{ trans('lang.makkah') }})</option>
                            <option value="Madinah" {{ $selectedRegion == 'Madinah' ? 'selected' : '' }}>Madinah ({{ trans('lang.madinah') }})</option>
                            <option value="Eastern Province" {{ $selectedRegion == 'Eastern Province' ? 'selected' : '' }}>Eastern Province ({{ trans('lang.eastern_province') }})</option>
                            <option value="Qassim" {{ $selectedRegion == 'Qassim' ? 'selected' : '' }}>Qassim ({{ trans('lang.qassim') }})</option>
                            <option value="Asir" {{ $selectedRegion == 'Asir' ? 'selected' : '' }}>Asir ({{ trans('lang.asir') }})</option>
                            <option value="Tabuk" {{ $selectedRegion == 'Tabuk' ? 'selected' : '' }}>Tabuk ({{ trans('lang.tabuk') }})</option>
                            <option value="Hail" {{ $selectedRegion == 'Hail' ? 'selected' : '' }}>Hail ({{ trans('lang.hail') }})</option>
                            <option value="Northern Borders" {{ $selectedRegion == 'Northern Borders' ? 'selected' : '' }}>Northern Borders ({{ trans('lang.northern_borders') }})</option>
                            <option value="Jazan" {{ $selectedRegion == 'Jazan' ? 'selected' : '' }}>Jazan ({{ trans('lang.jazan') }})</option>
                            <option value="Najran" {{ $selectedRegion == 'Najran' ? 'selected' : '' }}>Najran ({{ trans('lang.najran') }})</option>
                            <option value="Al-Baha" {{ $selectedRegion == 'Al-Baha' ? 'selected' : '' }}>Al-Baha ({{ trans('lang.al_baha') }})</option>
                            <option value="Al-Jawf" {{ $selectedRegion == 'Al-Jawf' ? 'selected' : '' }}>Al-Jawf ({{ trans('lang.al_jawf') }})</option>
                        </select>
                    </div>
                </form>

            </div>

            <div class="pt-6 px-2 pb-0">
                <div id="bar-chart"></div>
            </div>
        </div>

        <div class="lg:w-[20%] w-full p-4 rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
            <h2 class="text-[24px] font-600 text-[#93C3E6] flex items-center">
                <span class="text-shadow">{{ trans('lang.branches') }}</span>
                <i class="fa-solid fa-chevron-right {{ app()->getLocale() == 'ar' ? 'rotate-[180deg]' : '' }} text-[20px] ms-4"></i>
            </h2>

            <div class="mt-4">
                <ul class="list-none">
                    @forelse($sidebranches as $sBranch)
                        @php
                            // Validate location string
                            $location = explode(',', $sBranch->location ?? '');
                            $lat = count($location) >= 2 ? trim($location[0]) : null;
                            $long = count($location) >= 2 ? trim($location[1]) : null;
                            $city = ($lat && $long) ? getCityFromCoordinates($lat, $long) : trans('lang.city_not_available');
                        @endphp
                        <li>
                        <a href="branches/{{$sBranch->id}}">
                            <div class="flex flex-row">
                                <div class="items-center flex flex-col justify-around">
                                    <div class="bg-[#F3F7FC] border border-[#D6E7F5] rounded-full h-[50px] w-[50px] p-3">
                                        <img src="{{ asset('images/map.png') }}" alt="branch">
                                    </div>
                                    <div class="border-l-[6px] h-full border-[#246DA5]"></div>
                                </div>
                                
                                <div class="{{ app()->getLocale() == 'ar' ? 'mr-2' : 'ml-2' }} pb-10">
                                    <h3 class="text-[#246DA5] text-[18px] font-semibold">
                                        {{ $sBranch->branch_name ?? trans('lang.na') }}
                                    </h3>
                                    <p class="text-gray-400 text-[16px]">{{ $city }}</p>
                                </div>
                            </div>
                            
                            </a>
                        </li>
                    @empty
                        <li>{{ trans('lang.no_branches_found') }}</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <!-- Similar improvements applied to Reports and Members sections -->
    <div class="flex lg:flex-row flex-col lg:space-x-4 lg:space-y-0 space-y-4 {{ app()->getLocale() == 'ar' ? 'lg:space-x-reverse' : '' }}">
        <div class="relative flex flex-col lg:w-[80%] w-full rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
            <div class="flex md:flex-row flex-col justify-between px-6 pt-4">
                <div class="flex justify-center items-center lg:mb-0 mb-2">
                    <h2 class="md:text-[30px] text-[24px] font-600 text-[#93C3E6] flex items-center">
                        <span class="text-shadow">{{ trans('lang.reports') }}</span>
                        <i class="fa-solid fa-chevron-right {{ app()->getLocale() == 'ar' ? 'rotate-[180deg]' : '' }} text-[20px] ms-4"></i>
                    </h2>
                </div>

                <!-- <div class="flex items-center md:justify-end justify-center space-x-4 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                    <select class="bg-[#F3F7FC] border border-[#D6E7F5] rounded-lg px-4 py-2 shadow-sm focus:outline-none text-gray-900" name="category" id="category">
                        <option>{{ trans('lang.food') }}</option>
                        <option selected>{{ trans('lang.health') }}</option>
                    </select>

                    <select class="bg-[#F3F7FC] border border-[#D6E7F5] rounded-lg px-4 py-2 shadow-sm focus:outline-none text-gray-900" name="year" id="year">
                        <option value="">{{ trans('lang.select_region') }}</option>
                        <!-- Options as before 
                        <option value="Riyadh">Riyadh ({{ trans('lang.riyadh') }})</option>
                        <option value="Makkah">Makkah ({{ trans('lang.makkah') }})</option>
                        <option value="Madinah" selected>Madinah ({{ trans('lang.madinah') }})</option>
                        <option value="Eastern Province">Eastern Province ({{ trans('lang.eastern_province') }})</option>
                        <option value="Qassim">Qassim ({{ trans('lang.qassim') }})</option>
                        <option value="Asir">Asir ({{ trans('lang.asir') }})</option>
                        <option value="Tabuk">Tabuk ({{ trans('lang.tabuk') }})</option>
                        <option value="Hail">Hail ({{ trans('lang.hail') }})</option>
                        <option value="Northern Borders">Northern Borders ({{ trans('lang.northern_borders') }})</option>
                        <option value="Jazan">Jazan ({{ trans('lang.jazan') }})</option>
                        <option value="Najran">Najran ({{ trans('lang.najran') }})</option>
                        <option value="Al-Baha">Al-Baha ({{ trans('lang.al_baha') }})</option>
                        <option value="Al-Jawf">Al-Jawf ({{ trans('lang.al_jawf') }})</option>
                    </select>
                </div> -->
            </div>

            <div class="pt-6 px-2 pb-0">
                <ul id="lightSlider">
                    @forelse($branches as $branch)
                        @php
                            $report = \App\Models\Report::where('branch_id', $branch->id)->where('status', 1)->orderBy('id', 'desc')->first();
                            if($report)
                            {
                                
                            $user = \App\Models\User::find($report->user_id);

                            @endphp
                            <li>
                                <a href="{{ route('report_detail', $report->id) }}">
                                <div class="bg-gradient-to-b from-[#0B3146] to-[#3A95DD] rounded-3xl px-2 pt-4 pb-2 relative overflow-hidden">
                                    <img src="{{ asset('images/report.png') }}" alt="img" class="absolute {{ app()->getLocale() == 'ar' ? 'left-[-35px]' : 'right-[-25px]' }} top-[-18px] z-10 h-[140px]">
                                    <div class="px-4 relative z-50">
                                        <div class="flex items-center space-x-4 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                                            <div class="bg-white p-2 rounded-lg">
                                                <img src="{{ asset(!empty($branch->header_image) ? 'uploads/'.$branch->header_image : 'images/shop.png') }}" style="height:30px; width:40px;" alt="img" class="filter invert"> 
                                            </div>
                                            <h4 class="text-white font-semibold">{{ $branch->branch_name ?? trans('lang.na') }}</h4>
                                        </div>
                                        
                                        <div class="my-2">
                                            @php $userName = $user ? $user->name : trans('lang.na'); @endphp
                                            <h4 class="text-white text-[20px] font-[500]">{{ $userName }}</h4>
                                            <p class="text-white/50 text-[16px] font-[400]">{{ ($user && $user->user_type == 0) ? trans('lang.admin') : trans('lang.auditor') }}</p>
                                            <p class="text-white/50 text-[12px] font-[400]">{{ $branch->created_at }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-2 relative z-50">
                                        <button class="bg-white flex items-center justify-between w-full ps-4 pe-2 py-1 rounded-full group transition">
                                            <span class="text-[#2E76B0] font-[600] text-sm">{{ trans('lang.view_report') }}</span>
                                            <div class="bg-[#2E76B0] rounded-full text-white p-2 w-[30px] h-[30px] text-[14px] flex items-cener justify-center">
                                                <i class="fa-solid fa-arrow-right-long rotate-[-45deg] group-hover:rotate-[0deg] origin-center transition duration-300"></i>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                </a>
                            </li>
                            @php  } @endphp
                    @empty
                        <li>{{ trans('lang.no_reports_found') }}</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="lg:w-[20%] w-full p-4 rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
            <h2 class="text-[24px] font-600 text-[#93C3E6] flex items-center">
                <span class="text-shadow">{{ trans('lang.members') }}</span>
                <i class="fa-solid fa-chevron-right {{ app()->getLocale() == 'ar' ? 'rotate-[180deg]' : '' }} text-[20px] ms-4"></i>
            </h2>

            <div class="mt-4">
                <ul class="list-none">
                    @forelse($members as $member)
                        <li>
                        <a href="members/{{$member->id}}">
                            <div class="flex flex-row border-b border-gray-300 pb-4 mb-4">
                                <div class="items-center flex flex-col justify-around">
                                    <div class="bg-[#F3F7FC] border border-[#D6E7F5] rounded-full h-[50px] w-[50px] p-3">
                                        <img src="{{ asset(!empty($member->image) ? 'images/'.$member->image : 'images/user.png') }}" alt="branch">
                                    </div>
                                </div>
                                
                                <div class="{{ app()->getLocale() == 'ar' ? 'mr-2' : 'ml-2' }}">
                                    <h3 class="text-[#246DA5] text-[18px] font-semibold">{{ $member->name ?? trans('lang.na') }}</h3>
                                    <p class="text-gray-400 text-[16px]">{{ $member->function }}</p>
                                </div>
                            </div>
                        </a>
                        </li>
                    @empty
                        <li>{{ trans('lang.no_members_found') }}</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
const chartConfig = {
    series : <?= json_encode($series) ?>,
    chart: {
        type: "bar",
        height: 320,
        stacked: false,
        toolbar: { show: false },
    },
    colors: ["#1D3F5D", "#93C3E6", "red", "green"],
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: "60%",
            borderRadius: 10,
            borderRadiusApplication: 'end',
        },
    },
    dataLabels: {
        enabled: true,
        style: { fontSize: "8px", fontWeight: "bold" },
        formatter: function (val) { return val + "%"; },
    },
    xaxis: {
        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        labels: { style: { fontSize: "12px", fontFamily: "Arial, sans-serif" } },
    },
    yaxis: {
        labels: {
            formatter: function (value, index) {
                const labels = ["0", "20", "40", "60", "80", "100"];
                return labels[index] || "";
            },
            style: { colors: "#374151", fontSize: "12px", textAlign: "left", fontFamily: "Arial, sans-serif" },
        },
        max: 100,
    },
    legend: {
        position: "bottom",
        horizontalAlign: "center",
        markers: { radius: 12 },
        labels: { colors: "#374151" },
    },
    grid: {
        borderColor: "#e5e7eb",
        strokeDashArray: 4,
    },
    tooltip: {
        theme: "light",
        y: { formatter: (val) => `${val}%` },
    },
};

const chart = new ApexCharts(document.querySelector("#bar-chart"), chartConfig);
chart.render();

$(document).ready(function() {
    $('#lightSlider').lightSlider({
        item:3,
        loop:false,
        slideMove:2,
        easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        speed:600,
        responsive: [
            { breakpoint:800, settings: { item:2, slideMove:1, slideMargin:6 } },
            { breakpoint:480, settings: { item:1, slideMove:1 } }
        ]
    });  
});

function reportsGraph(id) {
    $(`#${id}`).removeClass("hidden");
    $.ajax({
        url: '{{ route('requests.create') }}',
        type: 'GET',
        data: { action: "create_request_modal" },
        success: function(response) { $(".create_request").html(response); },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('There was an error: ' + error);
        }
    });
}
</script>
@endsection
