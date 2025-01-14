<div id="sidebar" class="hidden lg:relative absolute h-full z-50 lg:flex flex-col w-64 bg-gradient-to-b from-[#1F5077] via-[#2E76B0] via-[#3A95DD] to-[#378ED3]">
    <div class="lg:hidden flex absolute top-0 right-0 px-4 py-2">
        <button type="button" class="toggleSidebar text-white/50 text-xl focus:outline-none">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="flex items-center justify-center w-full h-[150px]">
        <img src="{{asset('images/logo.png')}}" alt="Logo" class="w-full h-full object-cover">
    </div>

    <div class="flex flex-col flex-1  px-2 pb-4 overflow-y-auto">
        <button type="button" onclick="openModal('create_request')" class="w-full flex items-center bg-white rounded-full px-6 py-3 mb-4 font-semibold focus:outline-none">
            <img src="{{asset('images/pencil.png')}}" alt="create" class="w-5 h-5">
            <span class="text-center w-full pe-10">Create</span>
        </button> 

        <div class="flex flex-col justify-between w-full h-full scrollbar-hidden overflow-y-auto">
            <nav class="flex-1">
                <a href="#" class="w-full flex text-white hover:text-gray-700 items-center hover:bg-white rounded-xl px-4 py-3 focus:outline-none group">
                    <img src="{{asset('images/dashboard.png')}}" alt="dashboard" class="w-5 h-5 filter invert brightness-0 group-hover:invert group-hover:brightness-100">
                    <span class="ps-4">Dashboard</span>
                </a>

                <a href="{{route('branches.index')}}" class="w-full flex text-white hover:text-gray-700 items-center hover:bg-white rounded-xl px-4 py-3 focus:outline-none group">
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


<div id="create_request" class="modal fixed z-50 inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-lg lg:w-[50%] md:w-[80%] w-[100%] md:h-auto h-screen">
      <div class="px-6 py-4 bg-[#2E76B0] flex justify-between items-center rounded-t-xl">
        <h2 class="text-xl font-semibold text-white">Create a new request</h2>
        <button type="button" class="close-modal text-white">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      
      <div class="modal-body p-6 overflow-y-auto scrollbar-hidden h-full">
        <div class="grid md:grid-cols-3 grid-cols-1 gap-4">
            <div class="">
                <select class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full">
                    <option class="text-sm">Branch No.</option>
                    <option>Branch No1</option>
                    <option>Branch No3</option>
                    <option>Branch No4</option>
                </select>
            </div>

            <div class="">
                <select class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full">
                    <option>Auditor Name</option>
                    <option>Name 1</option>
                    <option>Name 3</option>
                    <option>Name 4</option>
                </select>
            </div>

            <div class="">
                <select class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full">
                    <option>Auditor Email</option>
                    <option>Email 1</option>
                    <option>Email 3</option>
                    <option>Email 4</option>
                </select>
            </div>

            <div class="">
                <select class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full">
                    <option>Date</option>
                    <option>Date 1</option>
                    <option>Date 3</option>
                    <option>Date 4</option>
                </select>
            </div>

            <div class="">
                <select class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full">
                    <option>Time</option>
                    <option>Time 1</option>
                    <option>Time 3</option>
                    <option>Time 4</option>
                </select>
            </div>

            <div class="">
                <select class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full">
                    <option>Code</option>
                    <option>Code 1</option>
                    <option>Code 3</option>
                    <option>Code 4</option>
                </select>
            </div>

            <div class="md:col-span-3">
                <select class="w-full px-6 py-3 border border-[#1F5077] bg-[#D6E7F5] text-[#1F5077] focus:bg-[#D6E7F5]/30 focus:border-[#1F5077]/70 focus:outline-none rounded-full">
                    <option>Sections</option>
                    <option>Section 1</option>
                    <option>Section 3</option>
                    <option>Section 4</option>
                </select>
            </div>

            <div class="md:col-span-3">
                <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3621.243308577344!2d39.61017141514183!3d24.470901966181095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15bdbf3b8aa52c03%3A0x2ef4c1aaf0c8d57a!2sAl%20Masjid%20an%20Nabawi%20(Mosque%20of%20the%20Prophet%20Muhammad)!5e0!3m2!1sen!2s!4v1699020000000!5m2!1sen!2s"
                width="100%"
                height="250"
                style="border:0; border-radius: 10px;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
            </div>

            <div class="md:col-span-3 flex justify-end items-center">
                <button type="submit" class="px-[30px] py-[10px] bg-[#1F5077] text-white font-semibold rounded-full">
                    Send
                </button>
            </div>
        </div>
      </div>
    </div>
</div>