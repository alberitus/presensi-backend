<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Alberitus">

    <title>@yield('title', 'Dashboard')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('import/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('import/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('import/assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('import/assets/css/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('import/assets/css/select2/select2-bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('import/assets/css/select2/select2-bootstrap4.min.css') }}" rel="stylesheet" />

    <!-- Custom styles -->
    <link href="{{ asset('import/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('import/assets/css/applicationStyle.css') }}" rel="stylesheet" />
    <link href="{{ asset('import/assets/css/loader.css') }}" rel="stylesheet" />
</head>

<body id="page-top">
    <div id="loading-overlay">
        <div class="loader"></div>
    </div>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layout.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layout.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            {{-- @include('layout.footer') --}}
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('layout.modal-logout')

    {{-- <div class="color-switcher">
        <button id="colorToggle" class="main-btn">
            <i class="fas fa-cog"></i>
        </button>
        <div class="color-options">
            <button class="color-btn bg-gradient-primary" data-color="bg-gradient-primary"></button>
            <button class="color-btn bg-gradient-success" data-color="bg-gradient-success"></button>
            <button class="color-btn bg-gradient-orange" data-color="bg-gradient-orange"></button>
            <button class="color-btn bg-gradient-danger" data-color="bg-gradient-danger"></button>
            <button class="color-btn bg-gradient-dark" data-color="bg-gradient-dark"></button>
        </div>
    </div> --}}

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('import/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('import/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('import/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('import/assets/js/sb-admin-2.min.js') }}"></script>

    <!-- datatables -->
    <script src="{{ asset('import/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('import/assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('import/assets/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('import/assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('import/assets/js/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('import/assets/js/search.js') }}"></script>
    <script src="{{ asset('import/assets/js/application.js') }}"></script>
    <script src="{{ asset('import/assets/js/datatables.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').each(function() {
                const $this = $(this);
                const parentModal = $this.closest('.modal');
                const isMultiple = $this.hasClass('multiple');

                $this.select2({
                    dropdownParent: parentModal.length ? parentModal : $('body'),
                    placeholder: $(this).data('placeholder') || 'Select an option',
                    width: '100%',
                    theme: 'bootstrap4',
                    allowClear: true,
                    dropdownAutoWidth: true,
                    dropdownCssClass: isMultiple ? 'multi-column' : ''
                });
            });

            $('.modal').on('shown.bs.modal', function() {
                $(this).find('.select2').select2({
                    dropdownParent: $(this),
                    width: '100%',
                    theme: 'bootstrap4'
                });
            });

            $(document).on('select2:open', function() {
                let searchField = document.querySelector('.select2-container--open .select2-search__field');
                if (searchField) {
                    searchField.focus();
                }
            });

        });
    </script>

    <script>
        document.querySelectorAll('.btn-delete').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data ini akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus Data!',
                    cancelButtonText: 'Kembali'
                }).then((result) => {
                    if (result.isConfirmed) {
                        button.closest('form').submit();
                    }
                });
            });
        });

        document.querySelectorAll('.btn-sumbit').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Yakin melakukan transksi ini?',
                    text: "Setelah melakukan transaksi, data tidak dapat dikembalikan. cek data terlebih dahulu!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6aa84f',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Simpan!',
                    cancelButtonText: 'Kembali'
                }).then((result) => {
                    if (result.isConfirmed) {
                        button.closest('form').submit();
                    }
                });
            });
        });

        document.querySelectorAll('.btn-unavailable').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                let modulName = button.getAttribute('data-modul') || 'Modul ini';

                Swal.fire({
                    title: 'Modul Belum Tersedia',
                    text: modulName + ' masih dalam tahap pengembangan.',
                    icon: 'info',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6',
                    allowOutsideClick: false,
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const overlay = document.getElementById('loading-overlay');
            let ajaxCount = 0;

            function showLoading() {
                overlay.style.display = 'flex';
            }

            function hideLoading() {
                if (ajaxCount <= 0) {
                    overlay.style.display = 'none';
                }
            }

            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function() {
                    showLoading();
                });
            });

            $(document).ajaxStart(function() {
                ajaxCount++;
                showLoading();
            });

            $(document).ajaxStop(function() {
                ajaxCount--;
                setTimeout(() => {
                    hideLoading();
                }, 500);
            });

            window.onload = function() {
                setTimeout(hideLoading, 300);
            };

            if (window.location.href.endsWith('.pdf')) {
                setTimeout(hideLoading, 800);
            }
        });
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: @json(session('success')),
                timer: 4000,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                toast: true,
                position: 'top-end',
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: @json(session('error')),
                timer: 4000,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                toast: true,
                position: 'top-end',
            });
        </script>
    @endif
    @if (session('info'))
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Informasi',
                html: @json(session('info')),
                showCloseButton: true,
                confirmButtonText: 'Tutup',
                allowOutsideClick: false,
                allowEscapeKey: true,
                focusConfirm: true,
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                timer: 4000,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                toast: true,
                position: 'top-end',
            });
        </script>
    @endif
    <script>
        function showError(message) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: message,
                timer: 4000,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                toast: true,
                position: 'top-end',
            });
        }

        window.alert = function(message) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: message,
                timer: 4000,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                toast: true,
                position: 'top-end',
            });
        };
    </script>
    @stack('scripts')

    <script>
        document.getElementById('colorToggle').addEventListener('click', function() {
            document.querySelector('.color-switcher').classList.toggle('active');
        });

        document.querySelectorAll('.color-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                let color = this.getAttribute('data-color');
                let sidebar = document.getElementById("accordionSidebar");

                sidebar.className = sidebar.className.replace(/\bbg-gradient-\S+/g, '');
                sidebar.classList.add(color);
                localStorage.setItem('sidebarColor', color);
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            let savedColor = localStorage.getItem('sidebarColor');
            if (savedColor) {
                let sidebar = document.getElementById("accordionSidebar");
                sidebar.className = sidebar.className.replace(/\bbg-gradient-\S+/g, '');
                sidebar.classList.add(savedColor);
            }
        });
    </script>

</body>

</html>
