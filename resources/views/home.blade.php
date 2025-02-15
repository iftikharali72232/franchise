@extends('layouts.app')

@section('content')

<div class="space-y-5 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
    <div class="flex lg:flex-row flex-col lg:space-x-4 lg:space-y-0 space-y-4 {{ app()->getLocale() == 'ar' ? 'lg:space-x-reverse' : '' }}">
        <div class="relative flex flex-col lg:w-[80%] w-full rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
            <div class="flex md:flex-row flex-col justify-between px-6 pt-4">
                <div class="flex items-center justify-center lg:mb-0 mb-2">
                    <h2 class="md:text-[30px] text-[22px] font-600 text-[#93C3E6] flex items-center">
                    <span class="text-shadow">Western Region Branches</span>
                    <i class="fa-solid fa-chevron-right {{ app()->getLocale() == 'ar' ? 'rotate-[180deg]' : '' }} md:text-[20px] text-[16px] ms-4"></i>
                    </h2>
                </div>

                <div class="flex items-center md:justify-end justify-center space-x-4 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                    <select class="bg-[#F3F7FC] border border-[#D6E7F5] rounded-lg px-4 py-2 shadow-sm focus:outline-none text-gray-900" name="category" id="category">
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}" {{ $section->defaul_section == 1 ? "selected" : "" }}>{{ $section->name }}</option>
                        @endforeach
                    </select>

                    <select class="bg-[#F3F7FC] border border-[#D6E7F5] rounded-lg px-4 py-2 shadow-sm focus:outline-none text-gray-900" name="year" id="year">
                            <option value="">Select Region</option>
                            <option value="Riyadh">Riyadh (الرياض)</option>
                            <option value="Makkah">Makkah (مكة المكرمة)</option>
                            <option value="Madinah" selected>Madinah (المدينة المنورة)</option>
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
            </div>

            <div class="pt-6 px-2 pb-0">
                <div id="bar-chart"></div>
            </div>
        </div>

        <div class="lg:w-[20%] w-full p-4 rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
            <h2 class="text-[24px] font-600 text-[#93C3E6] flex items-center">
            <span class="text-shadow">Branches</span>
            <i class="fa-solid fa-chevron-right {{ app()->getLocale() == 'ar' ? 'rotate-[180deg]' : '' }} text-[20px] ms-4"></i>
            </h2>

            <div class="mt-4">

            <ul class="list-none">
                <?php

use App\Models\User;

                    foreach($sidebranches as $sBranch)
                    {
                        $location = explode(',', $sBranch->location);
                        $lat = $location[0];
                        $long = $location[1];
                        $city = getCityFromCoordinates($lat, $long);
                        ?>
                    
                <li class="">
                <div class="flex flex-row">
                    <div class="items-center flex flex-col justify-around">
                    <div class="bg-[#F3F7FC] border border-[#D6E7F5] rounded-full h-[50px] w-[50px] p-3">
                        <img src="{{asset('images/map.png')}}" alt="branch" class="">
                    </div>
                    <div class="border-l-[6px] h-full border-[#246DA5]"></div>
                    </div>
                    
                    <div class="{{ app()->getLocale() == 'ar' ? 'mr-2' : 'ml-2' }}  pb-10">
                        <h3 class="text-[#246DA5] text-[18px] font-semibold"><?= $sBranch->branch_name ?></h3>
                        <p class="text-gray-400 text-[16px]"><?= $city ?></p>
                    </div>
                </div>
                </li>
                <?php }
                 ?>
                
            </ul>

            </div>
        </div>
    </div>

    <div class="flex lg:flex-row flex-col lg:space-x-4 lg:space-y-0 space-y-4 {{ app()->getLocale() == 'ar' ? 'lg:space-x-reverse' : '' }}">
        <div class="relative flex flex-col lg:w-[80%] w-full rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
            <div class="flex md:flex-row flex-col justify-between px-6 pt-4">
                <div class="flex justify-center items-center lg:mb-0 mb-2">
                    <h2 class="md:text-[30px] text-[24px] font-600 text-[#93C3E6] flex items-center">
                    <span class="text-shadow">Reports</span>
                    <i class="fa-solid fa-chevron-right {{ app()->getLocale() == 'ar' ? 'rotate-[180deg]' : '' }} text-[20px] ms-4"></i>
                    </h2>
                </div>

                <div class="flex items-center md:justify-end justify-center space-x-4 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                    <select class="bg-[#F3F7FC] border border-[#D6E7F5] rounded-lg px-4 py-2 shadow-sm focus:outline-none text-gray-900" name="category" id="category">
                    <option>Food</option>
                    <option selected>Health</option>
                    </select>

                    <select class="bg-[#F3F7FC] border border-[#D6E7F5] rounded-lg px-4 py-2 shadow-sm focus:outline-none text-gray-900" name="year" id="year">
                            <option value="">Select Region</option>
                            <option value="Riyadh">Riyadh (الرياض)</option>
                            <option value="Makkah">Makkah (مكة المكرمة)</option>
                            <option value="Madinah" selected>Madinah (المدينة المنورة)</option>
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
            </div>

            <div class="pt-6 px-2 pb-0">
                <ul id="lightSlider">
                    <?php foreach($branches as $branch){ 
                        $user = User::find($branch->created_by);
                        ?>
                    <li>
                        <div class="bg-gradient-to-b from-[#0B3146] to-[#3A95DD] rounded-3xl px-2 pt-4 pb-2 relative overflow-hidden">
                            <img src="{{asset('images/report.png')}}" alt="img" class="absolute {{ app()->getLocale() == 'ar' ? 'left-[-35px]' : 'right-[-25px]' }} top-[-18px] z-10 h-[140px]">

                            <div class="px-4 relative z-50">
                                <div class="flex items-center space-x-4 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                                    <div class="bg-white p-2 rounded-lg">
                                        <img src="{{asset(!empty($branch->header_image) ? 'uploads/'.$branch->header_image :'images/shop.png')}}" style="height:30px; width:40px;" alt="img" class="filter invert"> 
                                    </div>

                                    <h4 class="text-white font-semibold"> <?= $branch->branch_name ?> </h4>
                                </div>
                                
                                <div class="my-2">
                                    <h4 class="text-white text-[20px] font-[500]"> <?= $user->name ?> </h4>
                                    <p class="text-white/50 text-[16px] font-[400]"><?= ($user->user_type == 0 ? 'Admin' : 'Auditor') ?></p>
                                    <p class="text-white/50 text-[12px] font-[400]"><?= $branch->created_at ?></p>
                                </div>
                            </div>
                            
                            <div class="mt-2 relative z-50">
                                <button class="bg-white flex items-center justify-between w-full ps-4 pe-2 py-1 rounded-full group transition">
                                    <span class="text-[#2E76B0] font-[600] text-sm">View Report</span>
                                    <div class="bg-[#2E76B0] rounded-full text-white p-2 w-[30px] h-[30px] text-[14px] flex items-cener justify-center ">
                                        <i class="fa-solid fa-arrow-right-long rotate-[-45deg] group-hover:rotate-[0deg] origin-center transition duration-300"></i>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </li>
                    <?php  } ?>
                </ul>
            </div>
        </div>

        <div class="lg:w-[20%] w-full p-4 rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
            <h2 class="text-[24px] font-600 text-[#93C3E6] flex items-center">
            <span class="text-shadow">Members</span>
            <i class="fa-solid fa-chevron-right {{ app()->getLocale() == 'ar' ? 'rotate-[180deg]' : '' }} text-[20px] ms-4"></i>
            </h2>

            <div class="mt-4">

            <ul class="list-none">
                <?php foreach($members as $member) {
                    ?>
                <li class="">
                    <div class="flex flex-row border-b border-gray-300 pb-4 mb-4">
                        <div class="items-center flex flex-col justify-around">
                            <div class="bg-[#F3F7FC] border border-[#D6E7F5] rounded-full h-[50px] w-[50px] p-3">
                                <img src="{{asset(!empty($member->image) ? 'images/'.$member->image : 'images/user.png')}}" alt="branch" class="">
                            </div>
                        </div>
                        
                        <div class="{{ app()->getLocale() == 'ar' ? 'mr-2' : 'ml-2' }}">
                            <h3 class="text-[#246DA5] text-[18px] font-semibold"><?= $member->name ?></h3>
                            <p class="text-gray-400 text-[16px]"><?= $member->function ?></p>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>

            </div>
        </div>
    </div>
</div>


<script>

const chartConfig = {
//   series: [
//     {
//       name: "Excellent",
//       data: [10, 22, 16, 43, 63, 47],
//     },
//     {
//       name: "Excellent",
//       data: [10, 22, 16, 43, 63, 47, 43, 63, 47, 10, 22, 16],
//     },
//     {
//       name: "Good",
//       data: [93, 100, 59, 100, 63, 100, 43, 63, 47, 10, 22, 56],
//     },
//     {
//       name: "Poor",
//       data: [93, 100, 59, 100, 63, 100],
//     },
//   ],
series : <?= json_encode($series) ?>,
  chart: {
    type: "bar",
    height: 320,
    stacked: false,
    toolbar: {
      show: false,
    },
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
    style: {
      fontSize: "8px",
      fontWeight: "bold",
    },
    formatter: function (val) {
        return val + "%";
    },    
  },
  xaxis: {
    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    labels: {
      style: {
        fontSize: "12px",
        fontFamily: "Arial, sans-serif",
      },
    },
  },
  yaxis: {
  labels: {
    formatter: function (value, index) {
      const labels = ["0", "20", "40", "60", "80", "100"];
      return labels[index] || ""; // Map the label index to your desired values
    },
    style: {
      colors: "#374151",
      fontSize: "12px",
      textAlign: "left",
      fontFamily: "Arial, sans-serif",
    },
  },
  max: 100,
},

  legend: {
    position: "bottom",
    horizontalAlign: "center",
    markers: {
      radius: 12,
    },
    labels: {
      colors: "#374151",
    },
  },
  grid: {
    borderColor: "#e5e7eb",
    strokeDashArray: 4,
  },
  tooltip: {
    theme: "light",
    y: {
      formatter: (val) => `${val}%`,
    },
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
        responsive : [
            {
                breakpoint:800,
                settings: {
                    item:2,
                    slideMove:1,
                    slideMargin:6,
                  }
            },
            {
                breakpoint:480,
                settings: {
                    item:1,
                    slideMove:1
                  }
            }
        ]
    });  
  });
</script>
<script>    
    function reportsGraph(id) {
      $(`#${id}`).removeClass("hidden");

      $.ajax({
        url: '{{ route('requests.create') }}',  // Replace with your Laravel route
        type: 'GET',  // Prefer GET for retrieving modal content
        data: { action: "create_request_modal" },
        success: function(response) {
            $(".create_request").html(response); // Populate the modal with response HTML
        },
        error: function(xhr, status, error) {
            console.error('Error:', error); // Log the error for debugging
            alert('There was an error: ' + error); // Display an error message
        }
      });
    }
    
  </script>
@endsection