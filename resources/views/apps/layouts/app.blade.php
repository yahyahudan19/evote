<!DOCTYPE html>
<html lang="is">
	<!--begin::Head-->
	<head>
		<title>@yield('title') | E-Voting v1.0</title>
		<meta charset="utf-8" />
		<meta name="description" content="E-Vote is a modern and secure voting application designed to simplify the voting process with advanced features and user-friendly interfaces." />
		<meta name="keywords" content="e-vote, voting application, secure voting, online voting, election software, digital voting, voting system, e-voting platform" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="id_ID" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="E-Vote - Simplifying the Voting Process" />
		<meta property="og:url" content="https://e-vote.edycorp.id" />
		<meta property="og:site_name" content="E-Vote by Edy Corporation" />
		<link rel="shortcut icon" href="{{ asset('templates/assets/media/logos/favicon.ico')}}" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		@yield('plugins-head')
		<!--begin::Vendor Stylesheets(used for this page only)-->
		<link href="{{ asset('templates/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('templates/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{ asset('templates/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('templates/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
		<meta name="csrf-token" content="{{ csrf_token() }}">
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true" data-kt-app-toolbar-enabled="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
        <script>
            var defaultThemeMode = "light";
            var themeMode;

            if (document.documentElement) {
                if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                    themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
                } else {
                    themeMode = localStorage.getItem("data-bs-theme") !== null 
                        ? localStorage.getItem("data-bs-theme") 
                        : defaultThemeMode;
                }

                if (themeMode === "system") {
                    themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
                }

                document.documentElement.setAttribute("data-bs-theme", themeMode);
            }
        </script>
        <!--end::Theme mode setup on page load-->

		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Header-->
				<div id="kt_app_header" class="app-header align-items-stretch">
					<!--begin::Header container-->
					<div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
						<!--begin::Header-->
						<div class="d-flex align-items-center justify-content-between flex-row-fluid" id="kt_app_header_wrapper">
							<!--begin::Header logo-->
							<div class="app-header-logo d-flex align-items-center">
								<!--begin::Header mobile toggle-->
								<div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
									<div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_header_menu_toggle">
										<i class="ki-outline ki-abstract-14 fs-2"></i>
									</div>
								</div>
								<!--end::Header mobile toggle-->
								<!--begin::Logo image-->
								<a href="#" class="me-5 me-lg-9">
									<img alt="Logo" src="{{ asset('templates/assets/media/logos/demo53.svg')}}" class="h-25px h-lg-30px theme-light-show" />
									<img alt="Logo" src="{{ asset('templates/assets/media/logos/demo53-dark.svg')}}" class="h-25px h-lg-30px theme-dark-show" />
								</a>
								<!--end::Logo image-->
							</div>
							<!--end::Header logo-->

							<!--begin::Menu wrapper-->
							@include('apps.layouts.header')
							<!--end::Menu wrapper-->
							
							<!--begin::Navbar-->
							@include('apps.layouts.nav')
							<!--end::Navbar-->
						</div>
						<!--end::Header-->
					</div>
					<!--end::Header container-->
				</div>
				<!--end::Header-->
				
				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<!--begin::Toolbar-->
					@yield('toolbar')
					
					<!--end::Toolbar-->

					<!--begin::Wrapper container-->
					<div class="app-container container-xxl">
						<!--begin::Main-->
						<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
							<!--begin::Content wrapper-->
							<div class="d-flex flex-column flex-column-fluid">
								<!--begin::Content-->
								@yield('content')
								<!--end::Content-->
							</div>
							<!--end::Content wrapper-->

							<!--begin::Footer-->
							<div id="kt_app_footer" class="app-footer d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
								<!--begin::Copyright-->
								<div class="text-gray-900 order-2 order-md-1">
									<span class="text-muted fw-semibold me-1">{{ date('Y') }}&copy;</span>
									<a href="https://edycorp.id" target="_blank" class="text-gray-800 text-hover-primary">Edy Software House Corporation.</a>
								</div>
								<!--end::Copyright-->
								<!--begin::Menu-->
								<ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
									<li class="menu-item">
										<a href="https://edycorp.id" target="_blank" class="menu-link px-2">About</a>
									</li>
									<li class="menu-item">
										<a href="https://dev.edycorp.id" target="_blank" class="menu-link px-2">Support</a>
									</li>
									<li class="menu-item">
										<a href="https://market.edycorp.id" target="_blank" class="menu-link px-2">Purchase</a>
									</li>
								</ul>
								<!--end::Menu-->
							</div>
							<!--end::Footer-->
						</div>
						<!--end:::Main-->
					</div>
					<!--end::Wrapper container-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
			
		</div>
		<!--end::App-->

		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-outline ki-arrow-up"></i>
		</div>
		<!--end::Scrolltop-->
	
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{ asset('templates/assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{ asset('templates/assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used for this page only)-->
		@yield('plugins-last')
		
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				// Cek status pemilihan
				const electionStatus = "{{ $election->status }}"; // 'Y' untuk aktif, 'N' untuk belum dimulai
		
				if (electionStatus === 'Y') {
					// Ambil waktu selesai pemilihan yang dikirim dari controller
					const endTime = new Date("{{ $election->end_time }}"); // Format: YYYY-MM-DD HH:MM:SS
		
					// Fungsi untuk memperbarui waktu yang tersisa
					function updateCountdown() {
						const now = new Date();
						const timeLeft = endTime - now;
		
						const daysLeft = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
						const hoursLeft = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
						const minutesLeft = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
						const secondsLeft = Math.floor((timeLeft % (1000 * 60)) / 1000);
		
						// Update text untuk waktu yang tersisa
						let timeText = `${daysLeft}d ${hoursLeft}h ${minutesLeft}m ${secondsLeft}s`;
		
						document.getElementById("time_remaining").innerText = `Time Remaining: ${timeText}`;
		
						// Ganti warna button berdasarkan waktu yang tersisa
						const button = document.getElementById("time_remaining_button");
		
						if (timeLeft <= 0) {
							button.classList.remove("btn-success", "btn-warning", "btn-danger");
							button.classList.add("btn-danger");
							document.getElementById("time_remaining").innerText = "Pemilihan Selesai";
						} else if (daysLeft > 1) {
							button.classList.remove("btn-warning", "btn-danger");
							button.classList.add("btn-success");
						} else if (hoursLeft >= 1) {
							button.classList.remove("btn-success", "btn-danger");
							button.classList.add("btn-warning");
						} else {
							button.classList.remove("btn-success", "btn-warning");
							button.classList.add("btn-danger");
						}
					}
		
					// Memperbarui waktu setiap detik
					setInterval(updateCountdown, 1000);
				} else {
					// Jika status pemilihan adalah 'N'
					document.getElementById("time_remaining").innerText = "Election Not Started";
					const button = document.getElementById("time_remaining_button");
					button.classList.remove("btn-success", "btn-warning", "btn-danger");
					button.classList.add("btn-secondary");
				}
			});
		</script>
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>