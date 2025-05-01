@extends('apps.layouts.app')

@section('title')
    Dashboard
@endsection



@section('content')
<div id="kt_app_content" class="app-content">
    <!--begin::Row-->
    <div class="row g-5 gx-xl-12 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-xl-12">
            <!--begin::Engage widget 6-->
            <div class="card flex-grow-1 bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color:#020202;background-image:url('{{ asset('templates/assets/media/stock/600x600/img-62.jpg')}}')">
                <!--begin::Body-->
                <div class="card-body d-flex justify-content-between flex-column ps-xl-18">
                    <!--begin::Heading-->
                    <div class="mb-20 pt-xl-13">
                        <!--begin::Title-->
                        <h3 class="fw-bold text-white fs-4x mb-5 ms-n1">Hello, Welcome Back !</h3>
                        <!--end::Title-->
                        <!--begin::Description-->
                        @php
                            $hour = now('Asia/Jakarta')->hour;
                            $greeting = '';

                            if ($hour >= 5 && $hour < 12) {
                                $greeting = 'Good Morning';
                            } elseif ($hour >= 12 && $hour < 18) {
                                $greeting = 'Good Afternoon';
                            } elseif ($hour >= 18 && $hour < 22) {
                                $greeting = 'Good Evening';
                            } else {
                                $greeting = 'Good Night';
                            }
                        @endphp

                        <span class="fw-bold text-white fs-4 mb-8 d-block lh-0">{{ $greeting }}, Mr. {{ auth()->user()->name }}</span>
                        <!--end::Description-->
                        <!--begin::Items-->
                        <div class="d-flex align-items-center">
                            <!--begin::Item-->
                            <div class="d-flex align-items-center me-6">
                                <!--begin::Icon-->
                                <a href="#" class="me-2">
                                    <i class="bi bi-play-fill text-primary fs-3"></i>
                                </a>
                                <!--end::Icon-->
                                <!--begin::Info-->
                                <span class="fw-semibold text-white fs-6">70,000+ plays</span>
                                <!--end::Info-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center">
                                <!--begin::Icon-->
                                <a href="#" class="me-2">
                                    <i class="bi bi-headset text-primary fs-3"></i>
                                </a>
                                <!--end::Icon-->
                                <!--begin::Info-->
                                <span class="fw-semibold text-white fs-6">372 listening now</span>
                                <!--end::Info-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Items-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Action-->
                    <div class="mb-xl-10 mb-3">
                        <a href='#' class="btn btn-primary fw-semibold me-2" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">Listen Now</a>
                        <a href="apps/support-center/overview.html" class="btn btn-color-white bg-transparent btn-outline fw-semibold" style="border: 1px solid rgba(255, 255, 255, 0.3)">Save for Later</a>
                    </div>
                    <!--begin::Action-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Engage widget 6-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
   <!--begin::Row-->
   <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
    <!--begin::Col-->
    <div class="col-xl-3">
        <!--begin::Card widget 3-->
        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #F1416C;background-image:url('{{ asset('templates/assets/media/svg/shapes/wave-bg-red.svg')}}')">
            <!--begin::Header-->
            <div class="card-header pt-5 mb-3">
                <!--begin::Icon-->
                <div class="d-flex flex-center rounded-circle h-80px w-80px" style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #F1416C">
                    <i class="ki-outline ki-call text-white fs-2qx lh-0"></i>
                </div>
                <!--end::Icon-->
            </div>
            <!--end::Header-->
            <!--begin::Card body-->
            <div class="card-body d-flex align-items-end mb-3">
                <!--begin::Info-->
                <div class="d-flex align-items-center">
                    <span class="fs-4hx text-white fw-bold me-6">{{$votersNotVoted}}</span>
                    
                </div>
                <!--end::Info-->
            </div>
            <!--end::Card body-->
            <!--begin::Card footer-->
            <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                <!--begin::Progress-->
                <div class="fw-bold text-white py-2">
                    <span class="fs-1 d-block">Voters </span>
                    <span class="opacity-50">Not Voted Yet</span>
                </div>
                <!--end::Progress-->
            </div>
            <!--end::Card footer-->
        </div>
        <!--end::Card widget 3-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-3">
        <!--begin::Card widget 3-->
        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #328E6E;background-image:url('{{ asset('templates/assets/media/svg/shapes/wave-bg-dark.svg')}}')">
            <!--begin::Header-->
            <div class="card-header pt-5 mb-3">
                <!--begin::Icon-->
                <div class="d-flex flex-center rounded-circle h-80px w-80px" style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #328E6E">
                    <i class="ki-outline ki-call text-white fs-2qx lh-0"></i>
                </div>
                <!--end::Icon-->
            </div>
            <!--end::Header-->
            <!--begin::Card body-->
            <div class="card-body d-flex align-items-end mb-3">
                <!--begin::Info-->
                <div class="d-flex align-items-center">
                    <span class="fs-4hx text-white fw-bold me-6">{{$votersVoted}}</span>
                    <div class="fw-bold fs-6 text-white">
                       
                    </div>
                </div>
                <!--end::Info-->
            </div>
            <!--end::Card body-->
            <!--begin::Card footer-->
            <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                <!--begin::Progress-->
                <div class="fw-bold text-white py-2">
                    <span class="fs-1 d-block">Voters</span>
                    <span class="opacity-50">Already Voted</span>
                </div>
                <!--end::Progress-->
            </div>
            <!--end::Card footer-->
        </div>
        <!--end::Card widget 3-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-6">
        <!--begin::Chart widget 36-->
        <div class="card card-flush overflow-hidden h-lg-100">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-900">Vote Result</span>
                    <span class="text-gray-500 mt-1 fw-semibold fs-6">
                        {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('d F Y, H:i') }}
                    </span>
                </h3>
                <!--end::Title-->
                
            </div>
            <!--end::Header-->
            <!--begin::Card body-->
            <div class="card-body d-flex align-items-end p-0">
                <!--begin::Chart-->
                <div id="voteChart" class="min-h-auto w-100 ps-4 pe-6 mb-6" style="width: 100%; height: 400px;"></div>
                <!--end::Chart-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Chart widget 36-->
    </div>
    <!--end::Col-->
    </div>
    <!--end::Row-->
</div>
@endsection

@section('plugins-last')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var options = {
            chart: {
                type: 'donut',
                height: 400
            },
            series: @json($series),
            labels: @json($labels),
            colors: ['#3E97FF', '#F1416C', '#50CD89', '#FFC700', '#7239EA', '#00A3FF'],
            legend: {
                position: 'bottom'
            },
            dataLabels: {
                enabled: true,
                formatter: function (val, opts) {
                    return opts.w.config.series[opts.seriesIndex] + ' suara';
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " suara";
                    }
                }
            }
        };

        const chart = new ApexCharts(document.querySelector("#voteChart"), options);
        chart.render();
    });
</script>




@endsection