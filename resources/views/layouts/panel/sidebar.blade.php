<div id="sidebar" class="hidden md:flex flex-col w-64 bg-gradient-to-b from-[#1F5077] via-[#2E76B0] via-[#3A95DD] to-[#378ED3]">
    <div class="flex items-center justify-center w-full h-[150px]">
        <img src="{{asset('images/logo.png')}}" alt="Logo" class="w-full h-full object-cover">
    </div>
    <div class="flex flex-col flex-1  px-2 pb-4 overflow-y-auto">
        <button type="button" class="w-full flex items-center bg-white rounded-full px-6 py-3 mb-4 font-semibold focus:outline-none">
            <img src="{{asset('images/pencil.png')}}" alt="create" class="w-5 h-5">
            <span class="text-center w-full pe-10">Create</span>
        </button> 

        <div class="flex flex-col justify-space-between w-full h-full scrollbar-hidden overflow-y-auto">
            <nav class="flex-1">
                <a href="#" class="w-full flex text-white hover:text-gray-700 items-center hover:bg-white rounded-xl px-4 py-3 focus:outline-none group">
                    <img src="{{asset('images/dashboard.png')}}" alt="dashboard" class="w-5 h-5 filter invert brightness-0 group-hover:invert group-hover:brightness-100">
                    <span class="ps-4">Dashboard</span>
                </a>

                <a href="#" class="w-full flex text-white hover:text-gray-700 items-center hover:bg-white rounded-xl px-4 py-3 focus:outline-none group">
                    <img src="{{asset('images/branch.png')}}" alt="branches" class="w-5 h-5 filter group-hover:invert group-hover:brightness-100">
                    <span class="ps-4">Branches</span>
                </a>

                <a href="#" class="w-full flex text-white hover:text-gray-700 items-center hover:bg-white rounded-xl px-4 py-3 focus:outline-none group">
                    <img src="{{asset('images/chart.png')}}" alt="reports" class="w-5 h-5 filter group-hover:invert group-hover:brightness-100">
                    <span class="ps-4">Reports</span>
                </a>

                <a href="#" class="w-full flex text-white hover:text-gray-700 items-center hover:bg-white rounded-xl px-4 py-3 focus:outline-none group">
                    <img src="{{asset('images/users.png')}}" alt="members" class="w-5 h-5 filter group-hover:invert group-hover:brightness-100">
                    <span class="ps-4">Members</span>
                </a>

                <a href="#" class="w-full flex text-white hover:text-gray-700 items-center hover:bg-white rounded-xl px-4 py-3 focus:outline-none group">
                    <img src="{{asset('images/clipboard-check.png')}}" alt="letters" class="w-5 h-5 filter group-hover:invert group-hover:brightness-100">
                    <span class="ps-4">Letters</span>
                </a>

                <a href="#" class="w-full flex text-white hover:text-gray-700 items-center hover:bg-white rounded-xl px-4 py-3 focus:outline-none group">
                    <img src="{{asset('images/gear.png')}}" alt="settings" class="w-5 h-5 filter group-hover:invert group-hover:brightness-100">
                    <span class="ps-4">Settings</span>
                </a>
            </nav>

            <div class="">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="w-full flex text-white hover:text-gray-700 items-center hover:bg-white rounded-xl px-4 py-3 focus:outline-none group">
                    <img src="{{asset('images/exit.png')}}" alt="logout" class="w-5 h-5 filter group-hover:invert group-hover:brightness-100">
                    <span class="ps-4">{{ trans('lang.logout') }}</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>

        </div>
        
    </div>
</div>