<!DOCTYPE html>

<html
        lang="en"
        class="light-style layout-menu-fixed"
        dir="ltr"
        data-theme="theme-default"
        data-assets-path="../assets/"
        data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8"/>
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>BMI | Kurs ishi</title>

    <meta name="description"
          content="TATU UF talabalari bitiruv malakaviy ishlari va kurs ishlari qabul qilish va topshirish uchun yaratilgan">
    <meta name="keywords" content="Kurs ishi , BMI, bmi, ">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://www.ubtuit.uz/img/tuit_logo.png"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}"/>

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
          class="template-customizer-theme-css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}"/>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}"/>

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.1/tinymce.min.js"
            integrity="sha512-eV68QXP3t5Jbsf18jfqT8xclEJSGvSK5uClUuqayUbF5IRK8e2/VSXIFHzEoBnNcvLBkHngnnd3CY7AFpUhF7w=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{--    <script>--}}
{{--        tinymce.init({--}}
{{--            selector: '.tinymce',--}}
{{--            promotion: false,--}}
{{--            branding: false,--}}
{{--        });--}}
{{--    </script>--}}

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>

    {{--    source for select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">


        <?php
        $user = \Illuminate\Support\Facades\Auth::user();
        $selection_role = $user->selected_role;
        $data = json_decode($user->data);
        ?>
                <!-- Menu -->
        @include('admin.sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            @include('admin.navbar')
            <!-- / Navbar -->


            <!-- Content wrapper -->
            <div class="content-wrapper">

                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    @yield('content')

                </div>
                <!-- / Content -->


                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->


<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js')  }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js')  }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/dashboards-analytics.js')  }}"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    let errors = @json($errors->all());
    @if($errors->any())
    let msg = '';
    for (let i = 0; i < errors.length; i++) {
        msg += (i + 1) + '-xatolik ' + errors[i] + '\n';
    }
    Swal.fire({
        icon: 'error',
        title: 'Xatolik',
        text: msg,
    });
    @endif
    @if(session('msg'))
    Swal.fire({
        icon: 'success',
        title: 'Muvaffaqiyatli',
        text: '{{ session('msg') }}',
    });
    @endif
    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Xatolik',
        text: '{{ session('error') }}',
    });
    @endif
    $('.show_confirm').click(function (event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Haqiqatan ham bu yozuvni oʻchirib tashlamoqchimisiz?`,
            text: "Agar siz buni o'chirib tashlasangiz, u abadiy yo'qoladi.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            buttons: ['Yo`q', 'Ha']
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>

@yield('js')
</body>
</html>
