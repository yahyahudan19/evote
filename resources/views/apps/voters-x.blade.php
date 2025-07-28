@extends('apps.layouts.app')

@section('title')
    Voters Management
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
                <h1 class="text-gray-900 fw-bolder m-0">Voters Management</h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
            
            <!--begin::Toolbar wrapper=-->
            <div class="d-flex justify-content-between flex-wrap gap-4 gap-lg-10">
                <!--begin::Toolbar menu-->
                <div class="app-toolbar-menu menu menu-title-gray-800 menu-state-primary flex-wrap fs-5 fw-semibold w-100">
                    <!--begin::Menu item-->
                    <div class="menu-item">
                        <a class="menu-link py-4 active" href="/voters">
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
                    <i class="ki-outline ki-cloud-add fs-2"></i>Import</button>
                    <!--begin::Export-->
                    <button type="button" class="btn btn-warning me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_voters">
                    <i class="ki-outline ki-cloud-download fs-2"></i>Export</button>
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
                <!--begin::Modal - Import User-->
                <div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Import Voters</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                    <i class="ki-outline ki-cross fs-1"></i>
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <!--begin::Form-->
                                <form id="kt_modal_export_users_form" class="form" action="/voters/import" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">Import File:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="file" name="excel_file" class="form-control form-control-solid" accept=".xlsx, .xls" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="text-center">
                                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait... 
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Modal body-->
                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>
                <!--end::Modal - Import User-->

                <!-- Modal - Export User -->
                <div class="modal fade" id="kt_modal_export_voters" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="fw-bold">Export Voters</h2>
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                    <i class="ki-outline ki-cross fs-1"></i>
                                </div>
                            </div>
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <!-- Form -->
                                <form id="kt_modal_export_voters_form" class="form" action="{{ route('voters.export') }}" method="GET">
                                    <!-- Input group -->
                                    <div class="fv-row mb-10">
                                        <label class="fs-6 fw-semibold form-label mb-2">Pilih Status Pemilih:</label>
                                        <select name="voter_status" data-control="select2" class="form-select form-select-solid">
                                            <option value="voted">Sudah Vote</option>
                                            <option value="not_voted">Belum Vote</option>
                                        </select>
                                    </div>

                                    <!-- Actions -->
                                    <div class="text-center">
                                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                            <span class="indicator-label">Export</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal - Export User -->


                <!--begin::Modal - Add task-->
                <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_add_user_header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Add Voters</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                    <i class="ki-outline ki-cross fs-1"></i>
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->

                            <!--begin::Modal body-->
                            <div class="modal-body px-5 my-7">
                                <!--begin::Form-->
                                <form id="kt_modal_add_user_form" class="form" action="/admin/voters/store" method="POST">
                                    @csrf
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-semibold fs-6 mb-2">Full Name</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full name" required/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-semibold fs-6 mb-2">Email</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com"required/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-semibold fs-6 mb-2">Phone</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="phone" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="08123456779"required/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-semibold fs-6 mb-2">ID Card Number</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="id_card_number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com" required/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-semibold fs-6 mb-2">Birth date</label>
                                            <!--end::Label-->
                                            <div class="input-group" id="kt_td_picker_date_only" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                                <input id="kt_td_picker_date_only_input" type="text" class="form-control" data-td-target="#kt_td_picker_date_only" name="birth_date" required/>
                                                <span class="input-group-text" data-td-target="#kt_td_picker_date_only" data-td-toggle="datetimepicker">
                                                    <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Input group-->

                                      
                                    </div>
                                    <!--end::Scroll-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-10">
                                        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait... 
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Modal body-->
                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>
                <!--end::Modal - Add task-->
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
                    @foreach ($voters as $vot)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="1" />
                            </div>
                        </td>
                        <td class="d-flex align-items-center">
                            <!--begin:: Avatar -->
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="#">
                                    <div class="symbol-label">
                                        <img src="{{ asset('templates/assets/media/avatars/300-6.jpg')}}" alt="{{$vot->name}}" class="w-100" />
                                    </div>
                                </a>
                            </div>
                            <!--end::Avatar-->
                            @php
                                $email = $vot->email;
                                $parts = explode('@', $email);
                                if (count($parts) === 2) {
                                    $name = $parts[0];
                                    $domain = $parts[1];

                                    $maskedName = substr($name, 0, 3) . str_repeat('*', max(0, strlen($name) - 3));

                                    $domainParts = explode('.', $domain);
                                    $domainMain = $domainParts[0];
                                    $domainExt = implode('.', array_slice($domainParts, 1));

                                    $maskedDomain = substr($domainMain, 0, 1) . str_repeat('*', max(0, strlen($domainMain) - 1));

                                    $maskedEmail = $maskedName . '@' . $maskedDomain . '.' . $domainExt;
                                } else {
                                    $maskedEmail = $email;
                                }
                            @endphp
                            <!--begin::User details-->
                            <div class="d-flex flex-column">
                                <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$vot->name}}</a>
                                <span>{{$maskedEmail}}</span>
                            </div>
                            <!--begin::User details-->
                        </td>
                        <td>
                            {{ substr($vot->id_card_number, 0, 3) . '***' }}
                        </td>
                        <td>
                            <div class="badge badge-light fw-bold">{{ substr($vot->phone, 0, -4) . '****' }}</div>
                        </td>
                        <td>
                            <div class="badge badge-light fw-bold">
                                {{ substr($vot->code, 0, 2) . '****' }}
                            </div>
                        </td>
                        <td>
                            @if ($vot->status == "voted")
                                <div class="badge badge-success fw-bold">Sudah Voting</div>
                            @else
                                <div class="badge badge-danger fw-bold">Belum Voting</div>
                            @endif
                        </td>
                        <td>
                            @if ($vot->email_sent_at)
                                <div class="badge badge-success fw-bold">{{ \Carbon\Carbon::parse($vot->email_sent_at)->format('d M Y, H:i') }}</div>
                            @else
                                <div class="badge badge-warning fw-bold">Notification not sent</div>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                {{-- <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">Edit</a>
                                </div> --}}
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-users-table-filter="delete_row">Delete</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="/email/voter/{{ $vot->id }}" class="menu-link px-3">Send Email</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="/whatsapp/voter/{{ $vot->id }}" class="menu-link px-3">Send WA</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </td>
                    </tr>
                    @endforeach
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
    new tempusDominus.TempusDominus(document.getElementById("kt_td_picker_date_only"), {
        display: {
            viewMode: "calendar",
            components: {
                decades: true,
                year: true,
                month: true,
                date: true,
                hours: false,
                minutes: false,
                seconds: false
            }
        }
    });
</script>

<script>
    document.querySelector("#delete_all_voters_button").addEventListener("click", function() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Semua data voters dan votes akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus Semua!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading indicator
                var button = this;
                button.setAttribute("disabled", "true"); // Disable button
                button.innerHTML = "Loading..."; // Change button text to Loading

                // Kirim request untuk menghapus data
                fetch("/voters/delete-all", {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Remove loading indicator
                    button.removeAttribute("disabled");
                    button.innerHTML = '<i class="ki-outline ki-trash-square fs-2"></i>Clear Data';

                    // Show success alert
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                        }).then(() => {
                        // Reload the page after success
                        window.location.reload(); // Reload halaman untuk menampilkan data yang terhapus
                    });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message,
                        });
                    }
                })
                .catch(error => {
                    button.removeAttribute("disabled");
                    button.innerHTML = '<i class="ki-outline ki-trash-square fs-2"></i>Clear Data';
                    console.error("Error:", error);
                });
            }
        });
    });
</script>

<script>
    document.querySelectorAll('a[href^="/email/voter/"]').forEach(function(element) {
        element.addEventListener('click', function(event) {
            event.preventDefault();
            const url = this.getAttribute('href');

            Swal.fire({
                title: 'Send Email?',
                text: "Are you sure you want to send an email to this voter?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Send!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading modal
                    Swal.fire({
                        title: 'Sending Email...',
                        text: 'Please wait a moment',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    fetch(url, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.close(); // Close loader

                        if (data.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: data.message,
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed!',
                                text: data.message,
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.close(); // Close loader
                        Swal.fire({
                            icon: 'error',
                            title: 'An Error Occurred!',
                            text: 'Unable to send email.',
                        });
                    });
                }
            });

        });
    });
</script>

<script>
    document.querySelectorAll('a[href^="/whatsapp/voter/"]').forEach(function(element) {
        element.addEventListener('click', function(event) {
            event.preventDefault();
            const url = this.getAttribute('href');

            Swal.fire({
                title: 'Send Whatsapp?',
                text: "Are you sure you want to send a Whatsapp message to this voter?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Send!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading modal
                    Swal.fire({
                        title: 'Sending Whatsapp...',
                        text: 'Please wait a moment',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    fetch(url, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.close(); // Close loader

                        if (data.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: data.message,
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed!',
                                text: data.message,
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.close(); // Close loader
                        Swal.fire({
                            icon: 'error',
                            title: 'An Error Occurred!',
                            text: 'Unable to send Whatsapp message.',
                        });
                    });
                }
            });

        });
    });
</script>

@endsection