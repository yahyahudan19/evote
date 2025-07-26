@extends('apps.layouts.app')

@section('title')
    Reminders Management
@endsection

@section('plugins-head')
<link href="{{ asset('templates/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('toolbar')
<div id="kt_app_toolbar" class="app-toolbar py-7 pt-lg-15 pb-lg-5">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex align-items-stretch">
        <!--begin::Toolbar container-->
        <div class="app-toolbar-container d-flex flex-column flex-row-fluid">
            <!--begin::Page title-->
            <div class="page-title gap-4 me-3 mb-3 mb-lg-5">
                <!--begin::Title-->
                <h1 class="text-gray-900 fw-bolder m-0">Reminders Management</h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
            
            <!--begin::Toolbar wrapper=-->
            <div class="d-flex justify-content-between flex-wrap gap-4 gap-lg-10">
                <!--begin::Toolbar menu-->
                <div class="app-toolbar-menu menu menu-title-gray-800 menu-state-primary flex-wrap fs-5 fw-semibold w-100">
                    <!--begin::Menu item-->
                    <div class="menu-item">
                        <a class="menu-link py-4 active" href="/reminders">
                            <span class="menu-title">Summary</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--begin::Toolbar menu-->
            </div>
            <!--end::Toolbar wrapper=-->
        </div>
        <!--end::Toolbar container=-->
    </div>
    <!--end::Toolbar container-->
</div>
@endsection

@section('content')
<div id="kt_app_content" class="app-content">
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                    <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search user" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                     <!--begin::Delete All Voters-->
                    <button type="button" class="btn btn-danger me-3" id="delete_all_voters_button">
                        <i class="ki-outline ki-trash-square fs-2"></i>Clear Data
                    </button>
                    <!--end::Delete All Voters-->
                    <!--begin::Filter-->
                    <button type="button" class="btn btn-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="ki-outline ki-filter fs-2"></i>Filter</button>
                    <!--begin::Menu 1-->
                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                        <!--begin::Header-->
                        <div class="px-7 py-5">
                            <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Separator-->
                        <div class="separator border-gray-200"></div>
                        <!--end::Separator-->
                        <!--begin::Content-->
                        <div class="px-7 py-5" data-kt-user-table-filter="form">
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-semibold">Status Voting :</label>
                                <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-user-table-filter="role" data-hide-search="true">
                                    <option></option>
                                    <option value="Sudah Voting">Sudah Voting</option>
                                    <option value="Belum Voting">Belum Voting</option>
                                </select>
                            </div>
                            <!--end::Input group-->
                           
                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">Reset</button>
                                <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-user-table-filter="filter">Apply</button>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Menu 1-->
                    <!--end::Filter-->
                    <!--begin::Export-->
                    <button type="button" class="btn btn-success me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_users">
                        <i class="ki-outline ki-whatsapp fs-2"></i>Whatsapp</button>
                    <!--begin::Export-->
                    <button type="button" class="btn btn-warning me-3" id="send-bulk-email">
                        <i class="ki-outline ki-send fs-2"></i>Email</button>
                    <!--end::Export-->
                   
                    {{-- <!--begin::Add user-->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                    <i class="ki-outline ki-plus fs-2"></i>Add Voters</button>
                    <!--end::Add user--> --}}
                </div>
                <!--end::Toolbar-->
                <!--begin::Group actions-->
                <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                    <div class="fw-bold me-5">
                    <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
                    <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
                </div>
                <!--end::Group actions-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="min-w-125px">Name</th>
                        <th class="min-w-125px">ID Number</th>
                        <th class="min-w-125px">Phone</th>
                        <th class="min-w-125px">Code</th>
                        <th class="min-w-125px">Status</th>
                        <th class="min-w-125px">Email</th>
                        <th class="text-end min-w-100px">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                    
                </tbody>
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>

@endsection

@section('plugins-last')
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{ asset('templates/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('templates/assets/js/custom/evote/votersjs/table.js')}}"></script>
<script src="{{ asset('templates/assets/js/custom/evote/votersjs/add.js')}}"></script>

<script>
document.querySelector('#send-bulk-email').addEventListener('click', function (e) {
    e.preventDefault();

    // Ambil info jumlah peserta
    fetch('/email/bulk-info')
        .then(res => res.json())
        .then(data => {
            if (!data.status || data.target === 0) {
                Swal.fire({
                    icon: 'info',
                    title: 'Tidak Ada Email',
                    text: 'Tidak ada voter yang akan dikirimkan email hari ini (quota habis atau semua sudah terkirim).'
                });
                return;
            }

            Swal.fire({
                title: 'Kirim Email Massal?',
                html: `Akan mengirim email ke <b>${data.target}</b> peserta.<br>
                       Sisa quota hari ini: <b>${data.sisa_quota}</b>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Kirim!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    Swal.fire({
                        title: 'Mengirim Email...',
                        text: 'Mohon tunggu, proses ini akan berjalan di background.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    fetch('/email/send-bulk')
                        .then(response => response.json())
                        .then(resp => {
                            Swal.close();
                            if (resp.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: resp.message
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: resp.message
                                });
                            }
                        })
                        .catch(err => {
                            Swal.close();
                            console.error(err);
                            Swal.fire({
                                icon: 'error',
                                title: 'Kesalahan',
                                text: 'Tidak dapat memproses permintaan.'
                            });
                        });
                }
            });
        });
});
</script>


@endsection