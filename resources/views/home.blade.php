@extends('layouts.app')

@section('content')

<div class="flex space-x-4 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
    <div class="relative flex flex-col w-[80%] rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
        <div class="pt-6 px-2 pb-0">
            <div id="bar-chart"></div>
        </div>
    </div>

    <div class="w-[20%] p-4 rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
        Branches
    </div>
</div>

 
<script>
const chartConfig = {
  series: [
    {
      name: "Excellent",
      data: [10, 22, 16, 43, 63, 47, 43, 63, 47, 10, 22, 16],
    },
    {
      name: "Good",
      data: [93, 100, 59, 100, 63, 100, 43, 63, 47, 10, 22, 56],
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
      const labels = ["Abha", "Asir", "Taif", "Mec", "Jed", "Med"];
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
</script>



@endsection


