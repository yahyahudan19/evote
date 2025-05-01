<div class="app-navbar flex-shrink-0">
   

    <!--begin::Action-->
    <div class="app-navbar-item ms-2">
        {{-- <button id="theme-toggle" class="btn btn-flex btn-icon btn-secondary align-self-center fw-bold h-35px w-md-100 py-2 px-4">
            <i id="theme-icon" class="ki-outline ki-moon fs-4"></i>
            <span id="theme-text" class="d-none d-md-inline ms-1 fs-7">Dark Mode</span>
        </button> --}}
        <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-end" data-kt-menu-offset="-15px, 0">
            <a href="#" class="btn btn-outline btn-outline-dashed me-2 mb-2 btn-sm">
                <span class="menu-title position-relative">Mode</span>
            </a>
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                <!--begin::Menu item-->
                <div class="menu-item px-3 my-0">
                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                        <span class="menu-icon" data-kt-element="icon">
                            <i class="ki-outline ki-night-day fs-2"></i>
                        </span>
                        <span class="menu-title">Light</span>
                    </a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3 my-0">
                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                        <span class="menu-icon" data-kt-element="icon">
                            <i class="ki-outline ki-moon fs-2"></i>
                        </span>
                        <span class="menu-title">Dark</span>
                    </a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3 my-0">
                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                        <span class="menu-icon" data-kt-element="icon">
                            <i class="ki-outline ki-screen fs-2"></i>
                        </span>
                        <span class="menu-title">System</span>
                    </a>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::Menu-->
        </div>
    </div>

   
    <!--end::Action-->
</div>