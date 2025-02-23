<div class="flex items-center justify-between h-16 px-4 pt-4">
    <div class="flex items-center w-full lg:pe-4 pe-2 {{ app()->getLocale() == 'ar' ? 'space-x-reverse space-x-3' : 'lg:space-x-6 md:space-x-4 space-x-2' }}">
        <div class="">
            <button type="button" class="toggleSidebar text-gray-500 text-2xl focus:outline-none">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <div class="hidden md:flex items-center">
            <div class="bg-[#1D3F5D] rounded-full p-2 w-[50px] h-[50px]">
                <img src="{{ asset('images/main-user.png') }}" alt="{{ trans('lang.user') }}">
            </div>
            <div class="ps-3">
                <h4 class="text-start text-[#1D3F5D] font-semibold text-xl">{{ trans('lang.user_name') }}</h4>
                <p class="text-start text-gray-400">{{ trans('lang.user_email') }}</p>
            </div>
        </div>

        <div class="relative w-auto">
            <div class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'right-0 pr-4' : 'left-0 pl-4' }} flex items-center">
                <img src="{{ asset('images/search.png') }}" class="h-[20px]" alt="{{ trans('lang.search') }}">
            </div>
            
            <input 
                id="search"
                type="text" 
                placeholder="{{ trans('lang.quick_search') }}" 
                class="w-full {{ app()->getLocale() == 'ar' ? 'pl-3 pr-12' : 'pr-3 pl-12' }} py-3 border border-gray-300 rounded-full shadow-sm focus:outline-none text-gray-900"
                name="search" 
                required 
            />
        </div>
    </div>

    <div class="flex items-center justify-end w-auto {{ app()->getLocale() == 'ar' ? 'space-x-reverse space-x-3' : 'lg:space-x-6 md:space-x-4 space-x-2' }}">
        <div class="relative flex items-center">
            <!-- Notification Button -->
            <button type="button" id="notificationButton" class="bg-[#1D3F5D] rounded-full p-3 w-[50px] h-[50px] relative focus:outline-none">
                <img src="{{ asset('images/bell.png') }}" alt="{{ trans('lang.notifications') }}">
            </button>

            <!-- Dropdown Menu -->
            <div id="notificationDropdown" class="hidden md:absolute md:w-[450px] fixed w-full md:top-14 top-0 right-0 z-50">
                <div class="md:block hidden absolute z-10 top-[-8px] right-[16px] w-4 h-4 bg-gray-200 border border-gray-300 rotate-45"></div>
                
                <div class="bg-[#F7FCFE] border border-gray-300 rounded-lg relative z-50 px-4 py-4">
                    <div class="md:block hidden absolute z-10 top-[-7px] right-[16px] w-4 h-4 bg-white rotate-45"></div>
                    <div class="flex justify-between pb-3">
                        <h3 class="text-md font-semibold text-[#1D3F5D]">{{ trans('lang.notifications') }}</h3>
                        
                        <button type="button" id="notificationClose" class="text-black/50 focus:outline-none">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
    
                    <div class="">
                        <ul class="md:h-[500px] h-screen overflow-y-auto scrollbar-hidden">
                            <li>
                                <div class="flex items-center gap-3 py-3 border-b border-gray-300">
                                    <div class="">
                                        <div class="w-[50px] h-[50px] p-2 rounded-full bg-white flex items-center justify-center border border-gray-200">
                                            <img src="{{ asset('images/main-user.png') }}" alt="{{ trans('lang.user') }}" class="filter invert" />
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <p class="text-md font-semibold text-[#1D3F5D]">
                                            {{ trans('lang.notification_text1') }}
                                        </p>
                                        <a href="#" class="text-sm text-[#93C3E6]">
                                            {{ trans('lang.click_to_open_report') }}
                                        </a>
                                        <p class="absolute bottom-0 right-0 text-gray-400 text-xs">20:58</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="flex gap-3 py-3 border-b border-gray-300">
                                    <div class="">
                                        <div class="w-[50px] h-[50px] p-2 rounded-full bg-white flex items-center justify-center border border-gray-200">
                                            <img src="{{ asset('images/main-user.png') }}" alt="{{ trans('lang.user') }}" class="filter invert" />
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <p class="text-md font-semibold text-[#1D3F5D]">
                                            {{ trans('lang.notification_text2') }}
                                        </p>
                                        <a href="#" class="text-sm text-[#93C3E6]">
                                            {{ trans('lang.click_to_confirm') }}
                                        </a>
                                        <p class="absolute bottom-0 right-0 text-gray-400 text-xs">20:58</p>
                                    </div>
                                </div>
                            </li>
                            <!-- Additional notifications can be added similarly -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center">
            <label class="switch-round btn-color-mode-switch-round">
                <input 
                    value="1" 
                    id="color_mode_round" 
                    name="color_mode_round" 
                    type="checkbox"
                    onchange="changeLanguage('color_mode_round')"
                    {{ app()->getLocale() == 'ar' ? 'checked' : '' }}>
                <label 
                    class="btn-color-mode-round-switch-inner" 
                    data-off="EN" 
                    data-on="AR" 
                    for="color_mode_round">
                </label>
            </label>
        </div>
    </div>
</div>
