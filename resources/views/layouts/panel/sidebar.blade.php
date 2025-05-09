<div id="sidebar" class="hidden lg:relative absolute h-full z-50 lg:flex flex-col w-64 bg-gradient-to-b from-[#1F5077] via-[#2E76B0] via-[#3A95DD] to-[#378ED3]">
    <div class="lg:hidden flex absolute top-0 right-0 px-4 py-2">
        <button type="button" class="toggleSidebar text-white/50 text-xl focus:outline-none">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="flex items-center justify-center w-full h-[150px]">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-cover">
    </div>

    <div class="flex flex-col flex-1 px-2 pb-4 overflow-y-auto">
        <button type="button" onclick="openModal('create_request')" class="w-full flex items-center bg-white rounded-full px-6 py-3 mb-4 font-semibold focus:outline-none">
            <img src="{{ asset('images/pencil.png') }}" alt="create" class="w-5 h-5">
            <span class="text-center w-full pe-10">{{ trans('lang.create') }}</span>
        </button> 

        <div class="flex flex-col justify-between w-full h-full scrollbar-hidden overflow-y-auto">
            <nav class="flex-1">
                <a href="{{ route('home') }}" class="w-full flex text-white hover:text-gray-700 items-center hover:bg-white rounded-xl px-4 py-3 focus:outline-none group">
                    <img src="{{ asset('images/dashboard.png') }}" alt="dashboard" class="w-5 h-5 filter invert brightness-0 group-hover:invert group-hover:brightness-100">
                    <span class="ps-4">{{ trans('lang.dashboard') }}</span>
                </a>

                <a href="{{ route('branches.index') }}" class="w-full flex text-white hover:text-gray-700 items-center hover:bg-white rounded-xl px-4 py-3 focus:outline-none group">
                    <img src="{{ asset('images/branch.png') }}" alt="branches" class="w-5 h-5 filter group-hover:invert group-hover:brightness-100">
                    <span class="ps-4">{{ trans('lang.branches') }}</span>
                </a>

                <a href="/reports" class="w-full flex text-white hover:text-gray-700 items-center hover:bg-white rounded-xl px-4 py-3 focus:outline-none group">
                    <img src="{{ asset('images/chart.png') }}" alt="reports" class="w-5 h-5 filter group-hover:invert group-hover:brightness-100">
                    <span class="ps-4">{{ trans('lang.reports') }}</span>
                </a>

                <a href="{{ route('members.index') }}" class="w-full flex text-white hover:text-gray-700 items-center hover:bg-white rounded-xl px-4 py-3 focus:outline-none group">
                    <img src="{{ asset('images/users.png') }}" alt="members" class="w-5 h-5 filter group-hover:invert group-hover:brightness-100">
                    <span class="ps-4">{{ trans('lang.members') }}</span>
                </a>

                <a href="{{ route('letters.index') }}" class="w-full flex text-white hover:text-gray-700 items-center hover:bg-white rounded-xl px-4 py-3 focus:outline-none group">
                    <img src="{{ asset('images/clipboard-check.png') }}" alt="letters" class="w-5 h-5 filter group-hover:invert group-hover:brightness-100">
                    <span class="ps-4">{{ trans('lang.letters') }}</span>
                </a>

                <a href="{{ route('sectionList.index') }}" class="w-full flex text-white hover:text-gray-700 items-center hover:bg-white rounded-xl px-4 py-3 focus:outline-none group">
                    <img src="{{ asset('images/clipboard-check.png') }}" alt="sections" class="w-5 h-5 filter group-hover:invert group-hover:brightness-100">
                    <span class="ps-4">{{ trans('lang.sections') }}</span>
                </a>

                <a href="/profile" class="w-full flex text-white hover:text-gray-700 items-center hover:bg-white rounded-xl px-4 py-3 focus:outline-none group">
                    <img src="{{ asset('images/gear.png') }}" alt="settings" class="w-5 h-5 filter group-hover:invert group-hover:brightness-100">
                    <span class="ps-4">{{ trans('lang.settings') }}</span>
                </a>
            </nav>

            <div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="w-full flex text-white hover:text-gray-700 items-center hover:bg-white rounded-xl px-4 py-3 focus:outline-none group">
                    <img src="{{ asset('images/exit.png') }}" alt="logout" class="w-5 h-5 filter group-hover:invert group-hover:brightness-100">
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
    <div class="bg-white rounded-xl shadow-lg lg:w-[50%] md:w-[80%] w-[100%] max-h-[90vh] overflow-hidden">
      <div class="px-6 py-4 bg-[#2E76B0] flex justify-between items-center rounded-t-xl">
        <h2 class="text-xl font-semibold text-white">{{ trans('lang.create_new_request') }}</h2>
        <button type="button" class="close-modal text-white">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      
      <div class="modal-body p-6 overflow-y-auto scrollbar-hidden h-[calc(100vh-150px)] create_request">
        <!-- Modal content will be loaded here via AJAX -->
      </div>
    </div>
</div>


<script>
    function openModal(id) {
      $(`#${id}`).removeClass("hidden");
      var requestCreateUrl = "{{ route('requests.create') }}";
      $.ajax({
        url: requestCreateUrl,
        type: 'GET',
        data: { action: "create_request_modal" },
        success: function(response) {
            $(".create_request").html(response);
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('There was an error: ' + error);
        }
      });
    }
</script>
