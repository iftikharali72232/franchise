<div class="h-screen bg-[#F3F7FC]">
    <div class="grid grid-cols-7 gap-4">
        <div class="col-span-2 h-screen bg-[#1F5077] relative">
            <div class="absolute bg-[url('/public/images/design-pattern.png')] bg-repeat-x h-[235px] w-full"></div>
            <div class="flex justify-center items-center h-full">
                <div class="w-[400px] h-[400px]">
                    <img src="{{ asset('images/logo.png') }}" class="object-fit w-full h-full" />
                </div>
            </div>
            <div class="absolute bottom-0 bg-[url('/public/images/design-pattern.png')] bg-repeat-x h-[235px] w-full"></div>
        </div>

        <div class="col-span-5 p-20">
            <div class="bg-white rounded-2xl">
                <div class="flex justify-between items-center">
                    <div class="w-[40%]">
                        <div class="bg-[#F3F7FC] p-10 w-full rounded-bl-[100px]">
                            <h2 class="text-4xl font-bold bg-gradient-to-b from-[#1F5077] to-[#3A95DD] bg-clip-text text-transparent">Welcome</h2>
                        </div>
                    </div>
                    <div class="">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer">
                        <div class="peer outline-none duration-100 after:duration-500 w-28 h-14 bg-blue-300 peer-focus:outline-none after:content-['EN'] after:absolute after:outline-none after:h-12 after:w-12 after:bg-white after:top-1 after:left-1 after:flex after:justify-center after:items-center after:text-sky-800 after:font-bold peer-checked:after:translate-x-14 peer-checked:after:content-['AR'] peer-checked:after:content-['AR'] peer-checked:after:border-white">
                        </div>
                    </label>

                    

                    </div>
                </div>

                <div class="p-10">

                </div>
            </div>
        </div>
    </div>
</div>