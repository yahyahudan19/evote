@extends('apps.layouts.app')

@section('title')
    Reminders
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
            <div class="page-title gap-4 me-3 mb-0 mb-lg-5">
                <!--begin::Title-->
                <h1 class="text-gray-900 fw-bolder m-0">Reminders Management</h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
            
            {{-- <!--begin::Toolbar wrapper=-->
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
            <!--end::Toolbar wrapper=--> --}}
        </div>
        <!--end::Toolbar container=-->
    </div>
    <!--end::Toolbar container-->
</div>
@endsection

@section('content')
<div id="kt_app_content" class="app-content">
    <!--begin::Navbar-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::User-->
                        <div class="d-flex flex-column">
                            <!--begin::Name-->
                            <div class="d-flex align-items-center mb-2">
                                <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">Election Reminders Summary</a>
                                <a href="#">
                                    <i class="ki-outline ki-send fs-1 text-primary"></i>
                                </a>
                            </div>
                            <!--end::Name-->
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                <i class="ki-outline ki-profile-circle fs-4 me-1"></i>{{ $voterCount }} Voters Registered</a>
                                <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                <i class="ki-outline ki-geolocation fs-4 me-1"></i>Online Vote</a>
                                <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                <i class="ki-outline ki-sms fs-4"></i>app@ynemedia.biz.id</a>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->
                        <!--begin::Actions-->
                        <div class="d-flex my-4">
                            <button type="button" class="btn btn-danger btn-sm me-3" id="clear_data_email_sent">
                                <i class="ki-outline ki-trash-square fs-2"></i>Clear Data
                            </button>
                            <button type="button" class="btn btn-success btn-sm me-3" id="send-whatsapp">
                                <i class="ki-outline ki-whatsapp fs-2"></i>Send Whatsapp Reminder</button>
                            <button type="button" class="btn btn-warning btn-sm me-3" id="send-bulk-email">
                                <i class="ki-outline ki-send fs-2"></i>Send Email Code</button>
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Title-->
                    <!--begin::Stats-->
                    <div class="d-flex flex-wrap flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap">
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        {{-- <i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i> --}}
                                        <div class="fs-2 fw-bold" data-kt-countup="true">{{ $votersMailSentCount }}</div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-semibold fs-6 text-gray-500">Email Sent</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3" id="email-quota-container">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bold" id="email-quota-count" data-kt-countup="true">0</div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-semibold fs-6 text-gray-500">Email Quota</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bold" data-kt-countup="true">∞</div>
                                        
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-semibold fs-6 text-gray-500">Whatsapp Quota</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        {{-- <i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i> --}}
                                        <div class="fs-2 fw-bold" data-kt-countup="true"id="job-queue-count">{{ $jobQueueCount }}</div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-semibold fs-6 text-gray-500">Job Queue</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                <span class="fw-semibold fs-6 text-gray-500">Queue Progress</span>
                                <span class="fw-bold fs-6" id="queue-progress-text">0%</span>
                            </div>
                            <div class="h-5px mx-3 w-100 bg-light mb-3">
                                <div class="bg-success rounded h-5px"
                                    id="queue-progress-bar" 
                                    role="progressbar" 
                                    style="width: 100%;" 
                                    aria-valuenow="50" 
                                    aria-valuemin="0" 
                                    aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->
        </div>
    </div>
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <table class="table table-striped" id="job-queue-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Queue</th>
                        <th>Attempts</th>
                        <th>Available At</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('plugins-last')
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{ asset('templates/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('templates/assets/js/custom/evote/votersjs/table.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function fetchEmailQuota() {
            fetch('/email/bulk-info')
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        document.getElementById('email-quota-count').textContent = data.remaining_quota;
                    }
                })
                .catch(err => console.error('Error fetching email quota:', err));
        }

        // Fetch email quota initially
        fetchEmailQuota();

        // Set interval to auto-reload every 5 seconds
        setInterval(fetchEmailQuota, 5000);
    });
</script>
<!-- Send Bulk Email -->
<script>
    document.querySelector('#send-bulk-email').addEventListener('click', function (e) {
        e.preventDefault();

        // Fetch bulk email info
        fetch('/email/bulk-info')
            .then(res => res.json())
            .then(data => {
                if (!data.status || data.target === 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'No Emails',
                        text: 'No voters will receive emails today (quota exhausted or all emails already sent).'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Send Bulk Email?',
                    html: `This will send emails to <b>${data.target}</b> participants.<br>
                        Remaining quota for today: <b>${data.remaining_quota}</b>`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Send!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {

                        Swal.fire({
                            title: 'Sending Emails...',
                            text: 'Please wait, this process will run in the background.',
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
                                        title: 'Success!',
                                        text: resp.message
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Failed!',
                                        text: resp.message
                                    });
                                }
                            })
                            .catch(err => {
                                Swal.close();
                                console.error(err);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Unable to process the request.'
                                });
                            });
                    }
                });
            });
    });
</script>
<!-- Clear Email Sent Data -->
<script>
    document.getElementById('clear_data_email_sent').addEventListener('click', function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "All email sent data for voters will be deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/email/clear-email-sent",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire(
                                'Success!',
                                'Email sent data has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload(); // refresh the page
                            });
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'An error occurred', 'error');
                    }
                });
            }
        });
    });
</script>
<!-- Send WhatsApp Reminder -->
<script>
    document.getElementById('send-whatsapp').addEventListener('click', function () {

        let diff = @json($diff);
        // Determine options based on diff
        let options = {};
        if (diff === 3) {
            options = { 'h-3': 'Reminder H-3' };
        } else if (diff === 1) {
            options = { 'h-1': 'Reminder H-1' };
        } else if (diff === 0) {
            options = { 'hari-h': 'Reminder Day-H' };
        }

        // "Not Voted Yet" is always available
        options['belum-vote'] = 'Reminder Not Voted Yet';

        let selectOptions = Object.entries(options).map(([value, label]) => `<option value="${value}">${label}</option>`).join('');

        Swal.fire({
            title: 'Send WhatsApp Reminder',
            html: `
                <select id="reminder-select" class="swal2-select">
                    ${selectOptions}
                </select>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Send',
            preConfirm: () => {
                const selected = document.getElementById('reminder-select').value;
                if (!selected) {
                    Swal.showValidationMessage('Please select a reminder!');
                }
                return selected;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                let selected = result.value;

                // Send request to the server
                fetch(`/whatsapp/bulk?type=${selected}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({})
                })
                .then(res => res.json())
                .then(data => {
                    Swal.fire('Success', data.message || 'Message sent!', 'success').then(() => {
                        location.reload(); // Reload the page
                    });
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire('Error', `An error occurred: ${err.message || 'Unknown'}`, 'error');
                });
            }
        });
    });
</script>
<!-- Job Queue Table -->
<script>
    $(document).ready(function() {
        let table = $('#job-queue-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/jobs/datatables",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'queue', name: 'queue' },
                { data: 'attempts', name: 'attempts' },
                { data: 'available_at', render: function(data){
                    return new Date(data * 1000).toLocaleString();
                }},
                { data: 'created_at', render: function(data){
                    return new Date(data * 1000).toLocaleString();
                }},
            ],
            pageLength: 10
        });

        // Refresh otomatis tiap 5 detik
        setInterval(function() {
            table.ajax.reload(null, false); // false supaya tidak reset pagination
            // Update count juga
            fetch("/jobs/count")
                .then(r => r.text())
                .then(count => document.getElementById('job-queue-count').textContent = count);
        }, 5000);
    });
</script>
<!-- Update Queue Progress -->
<script>
    let totalJobs = {{ $jobQueueCount }};
        function updateProgress() {
            fetch("/jobs/count")
                .then(r => r.text())
                .then(count => {
                    let remaining = parseInt(count);
                    let progress = 0;

                    if (totalJobs > 0) {
                        progress = ((totalJobs - remaining) / totalJobs) * 100;
                        if (remaining <= 0) {
                            progress = 100;
                        }
                    } else {
                        // jika awalnya tidak ada job
                        progress = 100;
                    }

                    progress = Math.round(progress);

                    // update text dan bar
                    document.getElementById('queue-progress-text').textContent = progress + '%';
                    let bar = document.getElementById('queue-progress-bar');
                    bar.style.width = progress + '%';
                    bar.setAttribute('aria-valuenow', progress);
                });
        }
        setInterval(updateProgress, 5000);
        updateProgress();
</script>


@endsection