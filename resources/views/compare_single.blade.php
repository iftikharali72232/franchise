@extends('layouts.app')

@section('content')

<div class="w-full rounded-xl bg-white bg-clip-border shadow-md p-4">
    <div class="flex md:flex-row flex-col items-center md:justify-between w-full">
        <div class="flex flex-wrap md:flex-nowrap items-center w-full md:w-auto md:mb-3 space-x-0 md:space-x-3">
            <div class="w-full md:w-auto md:pb-0 pb-2">
                <a href="#" 
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-gradient-to-b from-[#1F5077] to-[#3A95DD]">
                    <img src="{{ asset('images/arrow-left.png') }}" class="w-auto {{ app()->getLocale() == 'ar' ? 'rotate-[180deg]' : '' }}" alt="Arrow Left" />
                </a>
            </div>
            
            <select class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white w-1/2 md:w-auto mb-3 md:mb-0">
                <option>Btwn 2 Branch</option>
                <option>C1</option>
                <option>C2</option>
            </select>
            
            <select class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white w-1/2 md:w-auto mb-3 md:mb-0">
                <option>Select Branch</option>
                <option>C1</option>
                <option>C2</option>
            </select>

            <select class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white w-1/2 md:w-auto mb-3 md:mb-0">
                <option>Select Branch</option>
                <option>B1</option>
                <option>B2</option>
            </select>

            <select class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white w-1/2 md:w-auto mb-3 md:mb-0">
                <option>From</option>
                <option>Date 1</option>
                <option>Date 2</option>
            </select>

            <select class="bg-[#1D3F5D] px-6 py-2 rounded-full text-white w-1/2 md:w-auto mb-3 md:mb-0">
                <option>To</option>
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

    <div class="">
        <div class="relative flex flex-col w-full text-gray-700">
            <div class="px-6 pt-4">
                <select class="px-6 py-2 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:outline-none rounded-full" name="category" id="category">
                    <option selected>Select Selection</option>
                    <option>Select 1</option>
                    <option>Select 2</option>
                </select>
            </div>

            <div class="pt-6 px-2 pb-0">
                <div id="bar-chart"></div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="overflow-x-auto mt-4">
            <table class="table-auto w-full text-[#1F5077]">
                <thead class="bg-[#BDE8FA]">
                    <tr>
                        <th class="whitespace-nowrap">
                            Symbol
                        </th>
                        <th class="whitespace-nowrap">
                            Description
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-[#F1FAFEB2]">
                        <td class="whitespace-nowrap">
                            Q1
                        </td>
                        <td class="whitespace-nowrap">
                            What are the steps for ensuring that fittings are correctly secured during the installation of pipes?
                        </td>
                    </tr>

                    <tr class="hover:bg-[#F1FAFEB2] bg-[#F1FAFEB2]">
                        <td class="whitespace-nowrap">
                            Q2
                        </td>
                        <td class="whitespace-nowrap">
                            What are the steps for ensuring that fittings are correctly secured during the installation of pipes?
                        </td>
                    </tr>

                    <tr class="hover:bg-[#F1FAFEB2]">
                        <td class="whitespace-nowrap">
                            Q3
                        </td>
                        <td class="whitespace-nowrap">
                            What are the steps for ensuring that fittings are correctly secured during the installation of pipes?
                        </td>
                    </tr>

                    <tr class="hover:bg-[#F1FAFEB2] bg-[#F1FAFEB2]">
                        <td class="whitespace-nowrap">
                            Q4
                        </td>
                        <td class="whitespace-nowrap">
                            What are the steps for ensuring that fittings are correctly secured during the installation of pipes?
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-6 px-2">
            <div id="hbar-chart"></div>
        </div>
    </div>

</div>

<script>
    const chartConfig = {
    series: [
        {
        name: "Asir",
        data: [10, 22, 16, 43, 63, 47, 43, 63, 47, 10, 22, 16, 16, 43, 63, 47, 43],
        },
        {
        name: "Abha",
        data: [93, 100, 59, 100, 63, 100, 43, 63, 47, 10, 22, 56, 63, 47, 10, 22, 56],
        },
    ],
    chart: {
        type: "bar",
        height: 320,
        stacked: false,
        toolbar: {
        show: false,
        },
    },
    colors: ["#1D3F5D", "#93C3E6"],
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
        categories: ["Q1", "Q2", "Q3", "Q4", "Q5", "Q6", "Q7", "Q8", "Q9", "Q10", "Q11", "Q12", "Q13", "Q14", "Q15", "Q16", "Q17"],
        labels: {
        style: {
            fontSize: "12px",
            fontFamily: "Arial, sans-serif",
        },
        },
    },
    yaxis: {
        tickAmount: 10, // Divide the axis into 10 intervals
        labels: {
            formatter: function (value) {
            // Convert the value to the corresponding label
            const labels = ["0", "10", "20", "30", "40", "50", "60", "70", "80", "90", "100"];
            const index = Math.round(value / 10); // Calculate index based on the step value (10 in this case)
            return labels[index] || ""; // Return the corresponding label or an empty string
            },
            style: {
            colors: "#374151",
            fontSize: "12px",
            textAlign: "left",
            fontFamily: "Arial, sans-serif",
            },
        },
        max: 100, // Ensure the maximum value is set correctly
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

    // horizontal chart
        var options = {
            series: [{
                name: 'Excellent', // Label for series-1
                data: [44, 55, 41, 64, 22, 43, 21, 55, 41, 64, 22]
            }, {
                name: 'Good', // Label for series-2
                data: [53, 32, 33, 52, 13, 44, 32, 53, 32, 33, 52]
            }],
            chart: {
                type: 'bar',
                height: 430
            },
            plotOptions: {
            bar: {
                horizontal: true,
                dataLabels: {
                position: 'top',
                },
                borderRadius: 5, // Add border radius for rounded bar tops
                barHeight: '90%', // Increase bar width (default is '50%')
                borderRadiusApplication: 'end',
            }
                },
                colors: ['#1D3F5D', '#93C3E6'], // Set bar colors
                dataLabels: {
                enabled: false,
                offsetX: -6,
                style: {
                    fontSize: '12px',
                    colors: ['#fff'] //bar text-color
                }
                },
                stroke: {
                show: true,
                width: 1,
                colors: ['#fff'] // bar border color
                },
                tooltip: {
                shared: true,
                intersect: false
                },
                xaxis: {
                categories: [
                    "Medina",
                    "Jeddah",
                    "Makkah",
                    "Taif",
                    "Asir",
                    "Yanbu",
                    "Al-Ula",
                    "Bisha",
                    "Tabuk",
                    "Al-Qurayyat",
                    "AL-Qunfudhah"
                ],
            },
        };

    var chart2 = new ApexCharts(document.querySelector("#hbar-chart"), options);
    chart2.render();


</script>
@endsection