<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'KUI UNIDA') }}</title>
    <link rel="apple-touch-icon" href="{{ $adminLayoutSettings['favicon_logo'] ?? '/favicon.ico' }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ $adminLayoutSettings['favicon_logo'] ?? '/favicon.ico' }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/extensions/sweetalert2.min.css') }}">
    @stack('styles')


    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/dashboard-analytics.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/card-analytics.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/tour/tour.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    <x-layout.navbar/>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <x-layout.sidebar/>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->    
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            {{-- Judul Dinamis --}}
                            <h2 class="content-header-title float-left mb-0">@yield('title', 'Default Title')</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    {{-- Breadcrumb bisa di-yield juga kalau mau dinamis --}}
                                    @yield('breadcrumbs')
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- ... bagian footer & scripts ... --}}

    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <x-layout.footer/>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('assets/js/core/app.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/components.js') }}"></script>
    <!-- END: Theme JS-->

    <script>
        (() => {
            const swal = window.Swal;

            if (!swal) {
                console.error('SweetAlert2 belum termuat. Cek asset assets/vendors/js/extensions/sweetalert2.all.min.js.');
                return;
            }

            window.handleDelete = (actionUrl) => {
                if (!actionUrl) {
                    return;
                }

                const submitDelete = () => {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    const form = document.createElement('form');

                    form.method = 'POST';
                    form.action = actionUrl;
                    form.style.display = 'none';

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);

                    if (csrfToken) {
                        const tokenInput = document.createElement('input');
                        tokenInput.type = 'hidden';
                        tokenInput.name = '_token';
                        tokenInput.value = csrfToken;
                        form.appendChild(tokenInput);
                    }

                    document.body.appendChild(form);
                    form.submit();
                };

                swal.fire({
                    title: 'Hapus data ini?',
                    text: 'Data yang sudah dihapus tidak bisa dikembalikan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ea5455',
                    cancelButtonColor: '#82868b',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    focusCancel: true,
                }).then((result) => {
                    if (!result.isConfirmed) {
                        return;
                    }

                    swal.fire({
                        title: 'Menghapus data...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => swal.showLoading(),
                    });

                    submitDelete();
                });
            };

            const flashMessage = {
                success: @json(session('success')),
                error: @json(session('error')),
            };

            if (flashMessage.success) {
                swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: flashMessage.success,
                    timer: 2400,
                    showConfirmButton: false,
                });
            }

            if (flashMessage.error) {
                swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: flashMessage.error,
                });
            }
        })();
    </script>

    <!-- BEGIN: Page JS-->
    @stack('scripts')

    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
