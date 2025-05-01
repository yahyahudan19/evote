<!DOCTYPE html>

<html lang="id">
	<!--begin::Head-->
	<head>
<base href="../../" />
		<title>Welcome E-Voting v1.0</title>
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
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{ asset('templates/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('templates/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
		<!--begin::Theme mode setup on page load-->
        <script>
            var defaultThemeMode = "light";
            var themeMode;

            if (document.documentElement) {
                if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                    themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
                } else {
                    if (localStorage.getItem("data-bs-theme") !== null) {
                        themeMode = localStorage.getItem("data-bs-theme");
                    } else {
                        themeMode = defaultThemeMode;
                    }
                }

                if (themeMode === "system") {
                    themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
                }

                document.documentElement.setAttribute("data-bs-theme", themeMode);
            }
        </script>
        <!--end::Theme mode setup on page load-->
        <!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Page bg image-->
			<style>body { background-image: url('{{ asset('templates/assets/media/auth/bg8.jpg')}}'); } [data-bs-theme="dark"] body { background-image: url('assets/media/auth/bg8-dark.jpg'); }</style>
			<!--end::Page bg image-->
			<!--begin::Authentication - Signup Welcome Message -->
			<div class="d-flex flex-column flex-center flex-column-fluid">
				<!--begin::Content-->
				<div class="d-flex flex-column flex-center text-center p-10">
					<!--begin::Wrapper-->
					<div class="card card-flush w-md-650px py-5">
						<div class="card-body py-15 py-lg-20">
							<!--begin::Logo-->
							<div class="mb-7">
								<a href="/" class="">
									<img alt="Logo" src="{{ asset('templates/assets/media/logos/custom-2.svg')}}" class="h-40px" />
								</a>
							</div>
							<!--end::Logo-->
							<!--begin::Title-->
							<h1 class="fw-bolder text-gray-900 mb-5">Welcome to E-Vote App</h1>
							<!--end::Title-->
							<!--begin::Text-->
                            <div class="fw-semibold fs-6 text-gray-500 mb-7">Welcome to the E-Vote application! 
                            <br />Please use your voting rights wisely for a better future.</div>
							<!--end::Text-->
							<!--begin::Illustration-->
							<div class="mb-0">
								<img src="{{ asset('templates/assets/media/auth/welcome.png')}}" class="mw-100 mh-300px theme-light-show" alt="" />
								<img src="{{ asset('templates/assets/media/auth/welcome-dark.png')}}" class="mw-100 mh-300px theme-dark-show" alt="" />
							</div>
							<!--end::Illustration-->
							<!--begin::Link-->
							<div class="mb-0">
								<a href="/voters" class="btn btn-sm btn-primary">Go To Vote Page</a>
							</div>
							<!--end::Link-->
						</div>
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Authentication - Signup Welcome Message-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{ asset('templates/assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{ asset('templates/assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>