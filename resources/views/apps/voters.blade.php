@extends('apps.layouts.blank')

@section('title')
    Vote !
@endsection


@section('plugins-head')

@endsection

@section('content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content">
    <!--begin::About card-->
    <div class="card">
        <!--begin::Body-->
        <div class="card-body p-lg-17">
            <!--begin::Team-->
            <div class="mb-18">
                <!--begin::Heading-->
                <div class="text-center mb-17">
                    <!--begin::Title-->
                    <h3 class="fs-2hx text-gray-900 mb-5">Our Candidate</h3>
                    <!--end::Title-->
                    <!--begin::Sub-title-->
                    <div class="fs-5 text-muted fw-semibold">Choose your preferred candidate below and make your voice heard in shaping the future!</div>
                    <!--end::Sub-title=-->
                
            </div>
                <!--end::Heading-->

                <!--begin::Wrapper-->
                {{-- <div class="row row-cols-2 row-cols-sm-2 row-cols-xl-12 gy-10">
                    <!--begin::Item-->
                    <div class="col text-center border rounded mb-9">
                        <!--begin::Photo-->
                        <div class="octagon mx-auto mb-2 d-flex w-150px h-150px bgi-no-repeat bgi-size-contain bgi-position-center" style="background-image:url('{{ asset('templates/assets/media/avatars/300-1.jpg')}}')"></div>
                        <!--end::Photo-->
                        <!--begin::Person-->
                        <div class="mb-0">
                            <!--begin::Name-->
                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-3">Paul Miles</a>
                            <!--end::Name-->
                            <!--begin::Position-->
                            <div class="text-muted fs-6 fw-semibold">Development Lead</div>
                            <!--begin::Position-->
                        </div>
                        <!--end::Person-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="col text-center border rounded mb-9">
                        <!--begin::Photo-->
                        <div class="octagon mx-auto mb-2 d-flex w-150px h-150px bgi-no-repeat bgi-size-contain bgi-position-center" style="background-image:url('{{ asset('templates/assets/media/avatars/300-2.jpg')}}')"></div>
                        <!--end::Photo-->
                        <!--begin::Person-->
                        <div class="mb-0">
                            <!--begin::Name-->
                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-3">Jania Garnbet</a>
                            <!--end::Name-->
                            <!--begin::Position-->
                            <div class="text-muted fs-6 fw-semibold">Creative Director</div>
                            <!--begin::Position-->
                        </div>
                        <!--end::Person-->
                    </div>
                    <!--end::Item-->
                </div> --}}
                <!--end::Wrapper-->
                
                <!--begin::Wrapper-->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-2 gy-10">
                    @if ($candidates->isEmpty())
                        <div class="text-center mb-17">
                            <h4 class="text-muted">Candidates are not available yet.</h4>
                        </div>
                    @else
                        @foreach ($candidates as $candidate)
                            <div class="col text-center border rounded mb-9 p-5">
                                <!-- Paslon Number -->
                                <div class="mb-3">
                                    <h4 class="fw-bold">Paslon No. {{ $candidate->candidate_number }}</h4>
                                </div>

                                <!-- Foto Ketua dan Wakil -->
                                <div class="d-flex justify-content-center mb-4">
                                    <!-- Ketua -->
                                    <div class="mx-2 d-flex flex-column align-items-center">
                                        <div class="w-150px h-150px bgi-no-repeat bgi-size-cover bgi-position-center" 
                                            style="background-image:url('{{ asset('storage/' . $candidate->ketua_image_path) }}')">
                                        </div>
                                        <span class="mt-2 fw-semibold">Ketua</span>
                                    </div>

                                    <!-- Wakil -->
                                    <div class="mx-2 d-flex flex-column align-items-center">
                                        <div class="w-150px h-150px bgi-no-repeat bgi-size-cover bgi-position-center" 
                                            style="background-image:url('{{ asset('storage/' . $candidate->wakil_image_path) }}')">
                                        </div>
                                        <span class="mt-2 fw-semibold">Wakil</span>
                                    </div>
                                </div>

                                <!-- Nama Ketua & Wakil -->
                                <div class="mb-3">
                                    <h5 class="text-gray-900 fw-bold">{{ $candidate->ketua_name }} & {{ $candidate->wakil_name }}</h5>
                                </div>

                                <!-- Deskripsi -->
                                <div class="text-muted fs-6 fw-semibold">
                                    {{ $candidate->description }}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <!--end::Wrapper-->



                
            </div>
            <!--end::Team-->

            <!--begin::Join-->
            <div class="text-center mb-20">
                <!--begin::Top-->
                <div class="mb-13">
                    <!--begin::Title-->
                    <h3 class="fs-2hx text-gray-900 mb-5">Vote Now !</h3>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="fs-5 text-muted fw-semibold">Make your choice count and contribute to a brighter tomorrow. 
                    <br />Your vote is your voice, let it be heard!</div>
                    <!--end::Text-->
                </div>
                <!--end::Top-->
               
                <!--begin::Action-->
                <a href="#" data-bs-toggle="modal" data-bs-target="#modal_verify" class="btn btn-danger mb-5">Vote</a>
                <!--end::Action-->
            </div>
            <!--end::Join-->
            <!--begin::Card-->
            <div class="card mb-4 bg-light text-center">
                <!--begin::Body-->
                <div class="card-body py-12">
                    <!--begin::Icon-->
                    <a href="#" class="mx-4">
                        <img src="{{ asset('templates/assets/media/svg/brand-logos/facebook-4.svg')}}" class="h-30px my-2" alt="" />
                    </a>
                    <!--end::Icon-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Body-->

        <!--begin::Modal Verify-->
        <div class="modal fade" tabindex="-1" id="modal_verify">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Verify your identity</h3>
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>
            
                    <div class="modal-body">
                        <div class="mb-5">
                            <label class="required form-label">Email</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Example input" name="email" id="email" required/>
                        </div>
                        <div class="mb-5">
                            <label class="required form-label">ID University</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Example input" name="id_university" id="id_university" required/>
                        </div>
                        <div class="mb-5">
                            <label class="required form-label">Birth Date</label>

                            <div class="input-group" id="kt_td_picker_date_only" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                <input id="kt_td_picker_date_only_input" type="text" class="form-control" data-td-target="#kt_td_picker_date_only" name="birth_date" id="birth_date" required/>
                                <span class="input-group-text" data-td-target="#kt_td_picker_date_only" data-td-toggle="datetimepicker">
                                    <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                                </span>
                            </div>
                        </div>
                    </div>
            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary me-10" id="kt_button_verify">
                            <span class="indicator-label">
                                Verify
                            </span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Modal Verify-->

       <!--begin::Modal Vote-->
        <div class="modal fade" tabindex="-1" id="modal_vote">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Pilih Pasangan Calon</h3>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"></i>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="mb-5">
                            <label class="required form-label">Pilih Kandidat :</label>
                            <select class="form-select" name="candidate_id" id="candidate_id_select" data-control="select2" data-placeholder="Pilih pasangan calon">
                                <option></option> <!-- placeholder kosong -->
                                @foreach ($candidates as $candidate)
                                    <option value="{{ $candidate->id }}">
                                        No. {{ $candidate->candidate_number }} - {{ $candidate->ketua_name }} & {{ $candidate->wakil_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-danger me-10" id="kt_button_vote">
                            <span class="indicator-label">Vote</span>
                            <span class="indicator-progress">Please wait... 
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Modal Vote-->

    </div>
    <!--end::About card-->
</div>
<!--end::Content-->


@endsection

@section('plugins-last')
<script>
    $(document).ready(function() {
        $('#candidate_id_select').select2({
            dropdownParent: $('#modal_vote')
        });
    });
</script>

<script>
    // Tombol verify di modal verify
    var verifyButton = document.querySelector("#kt_button_verify");

    verifyButton.addEventListener("click", function() {
        // Ambil data input
        var email = document.querySelector("[name='email']").value;
        var id_university = document.querySelector("[name='id_university']").value;
        var birth_date = document.querySelector("[name='birth_date']").value;

        // Validasi input kosong
        if (!email || !id_university || !birth_date) {
            Swal.fire({
                icon: 'error',
                title: 'Data Tidak Lengkap!',
                text: 'Pastikan semua data telah diisi.',
            });
            return;
        }

        verifyButton.setAttribute("data-kt-indicator", "on");

        // Kirim AJAX untuk verifikasi voter
        fetch("{{ route('voter.verify') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                email: email,
                id_university: id_university,
                birth_date: birth_date
            })
        })
        .then(response => response.json())
        .then(data => {
            verifyButton.removeAttribute("data-kt-indicator");

            if (data.status === "found") {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Ditemukan!',
                    text: 'Silakan lanjut memilih kandidat.',
                }).then(() => {
                    $('#modal_verify').modal('hide');
                    $('#modal_vote').modal('show');
                });
            } else if (data.status === "already_voted") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sudah Memilih!',
                    text: 'Anda sudah memilih pada ' + data.voted_at,
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Data Tidak Ditemukan!',
                    text: 'Pastikan data yang anda masukkan benar.',
                });
            }
        })
        .catch(error => {
            verifyButton.removeAttribute("data-kt-indicator");
            console.error('Error:', error);
        });
    });
</script>

<script>
    var voteButton = document.querySelector("#kt_button_vote");

    voteButton.addEventListener("click", function() {
        var candidate_id = document.querySelector("[name='candidate_id']").value;

        if (candidate_id === "") {
            Swal.fire({
                icon: 'error',
                title: 'Pilih Pasangan Calon!',
                text: 'Anda harus memilih salah satu pasangan calon.',
            });
            return;
        }

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Pilihan Anda tidak dapat diubah!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Pilih!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim data voting ke server
                fetch("{{ route('voter.vote') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        candidate_id: candidate_id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Voting Berhasil!',
                            text: 'Terima kasih atas partisipasi Anda.',
                        }).then(() => {
                            window.location.href = "{{ route('home') }}"; // Redirect ke halaman default
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Voting Gagal!',
                            text: 'Terjadi kesalahan, silakan coba lagi.',
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    });
</script>

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
@endsection

