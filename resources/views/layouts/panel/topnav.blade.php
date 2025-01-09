<div class="flex items-center justify-between h-16 px-4 pt-4">
    <div class="flex items-center w-full lg:pe-4 pe-2 {{ app()->getLocale() == 'ar' ? 'space-x-reverse space-x-3' : 'lg:space-x-6 md:space-x-4 space-x-2' }}">
        <div class="">
            <button type="button" class="toggleSidebar text-gray-500 text-2xl focus:outline-none">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <div class="hidden md:flex items-center">
            <div class="bg-[#1D3F5D] rounded-full p-2 w-[50px] h-[50px]">
                <img src="{{asset('images/main-user.png')}}" alt="user" class="">
            </div>
            <div class="ps-3">
                <h4 class="text-start text-[#1D3F5D] font-semibold text-xl">Grgir Person</h4>
                <p class="text-start text-gray-400">info@grgirperson.sa</p>
            </div>
        </div>

        <div class="relative w-auto">
            <div class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'right-0 pr-4' : 'left-0 pl-4' }} flex items-center">
                <img src="{{ asset('images/search.png') }}" class="h-[20px]" />
            </div>
            
            <input 
                id="search"
                type="text" 
                placeholder="Quick Search" 
                class="w-full {{ app()->getLocale() == 'ar' ? 'pl-3 pr-12' : 'pr-3 pl-12' }} py-3 border border-gray-300 rounded-full shadow-sm focus:outline-none text-gray-900 @error('email') is-invalid @enderror"
                name="search" 
                required 
            />
        </div>
    </div>

    <div class="flex items-center justify-end w-auto {{ app()->getLocale() == 'ar' ? 'space-x-reverse space-x-3' : 'lg:space-x-6 md:space-x-4 space-x-2' }} " >
        <div class="flex">
            <div class="bg-[#1D3F5D] rounded-full p-3 w-[50px] h-[50px]">
                <img src="{{asset('images/bell.png')}}" alt="notification" class="">
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