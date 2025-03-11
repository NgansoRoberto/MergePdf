<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MergePDF - Fusionner PDF</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/pickers/form-pickadate.css') }}">

    {{-- <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/pickers/form-flat-pickr.css"> --}}

    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/horizontal-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-ecommerce.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <style>
        :root {
            --smallpdf-primary: #2196F3 !important;
            --smallpdf-dark: #0c2950 !important;
            --smallpdf-banner: #e3f1fd !important;
            --smallpdf-yellow: #f9ca24 !important;
        }

        body {
            background-color: #f5f7fa !important;
            overflow-x: hidden !important;
        }

        .top-banner {
            background-color: var(--smallpdf-banner) !important;
            color: #2a5885 !important;
            text-align: center !important;
            padding: 12px !important;
            font-size: 14px !important;
        }

        .pro-text {
            font-weight: 600 !important;
        }

        .left-sidebar {
            width: 70px !important;
            background-color: var(--smallpdf-dark) !important;
            height: 100vh !important;
            position: fixed !important;
            left: 0 !important;
            top: 0 !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            color: white !important;
            z-index: 1030 !important;
        }

        .sidebar-item {
            padding: 15px 0 !important;
            width: 100% !important;
            text-align: center !important;
            font-size: 11px !important;
            cursor: pointer !important;
            transition: background-color 0.2s !important;
        }

        .sidebar-item:hover {
            background-color: #1e3d68 !important;
        }

        .sidebar-icon {
            font-size: 20px !important;
            margin-bottom: 5px !important;
            display: block !important;
        }

        .logo {
            width: 100% !important;
            height: 70px !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
        }

        .main-content {
            margin-left: 70px !important;
        }

        .header {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            padding: 15px 20px !important;
            border-bottom: 1px solid #eaeaea !important;
            background-color: white !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05) !important;
        }

        .tool-title {
            display: flex !important;
            align-items: center !important;
            font-size: 18px !important;
            font-weight: 600 !important;
        }

        .user-avatar {
            width: 40px !important;
            height: 40px !important;
            border-radius: 50% !important;
            background-color: #ff6a00 !important;
            color: white !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-weight: bold !important;
        }

        .toolbar {
            display: flex !important;
            padding: 15px 20px !important;
            background-color: white !important;
            border-bottom: 1px solid #eaeaea !important;
            flex-wrap: wrap !important;
        }

        .tool-button {
            margin-right: 10px !important;
            padding: 8px 12px !important;
            border-radius: 4px !important;
            font-size: 14px !important;
            cursor: pointer !important;
            transition: all 0.2s !important;
        }

        .pages-switch {
            display: flex !important;
            align-items: center !important;
            margin-left: 10px !important;
            color: #6c757d !important;
        }

        .form-check-input:checked {
            background-color: var(--smallpdf-primary) !important;
            border-color: var(--smallpdf-primary) !important;
        }

        .pro-badge {
            background-color: var(--smallpdf-yellow) !important;
            color: white !important;
            padding: 2px 6px !important;
            border-radius: 3px !important;
            font-size: 12px !important;
            margin-left: 5px !important;
        }

        .dropzone {
            margin: 20px !important;
            border: 2px dashed #ccc !important;
            border-radius: 10px !important;
            background-color: #f0f8ff !important;
            min-height: 500px !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
            text-align: center !important;
            transition: all 0.3s !important;
        }

        .dropzone:hover {
            border-color: var(--smallpdf-primary) !important;
            background-color: #e6f7ff !important;
        }

        .format-badge {
            font-size: 12px !important;
            font-weight: normal !important;
            padding: 3px 8px !important;
            margin: 0 3px !important;
        }

        .footer {
            text-align: center !important;
            padding: 20px !important;
            color: #adb5bd !important;
            font-size: 20px !important;
            font-weight: 600 !important;
        }

        /* Styles pour le mode sombre */
        .dark-mode {
            background-color: #283046 !important;
            color: #b4b7bd !important;
        }

        .dark-mode .header,
        .dark-mode .toolbar,
        .dark-mode .dropzone {
            background-color: #283046 !important;
            border-color: #3b4253 !important;
            color: #b4b7bd !important;
        }

        .dark-mode .tool-button {
            color: #b4b7bd !important;
            border-color: #3b4253 !important;
        }
    </style>
    @yield('style')
</head>
{{-- <body> --}}
    {{-- <div class="top-banner">
        <i class="bi bi-crown-fill text-warning me-1"></i> Déverrouille l'accès illimité et toutes les fonctionnalités Pro avec un essai gratuit de <span class="pro-text">MergePDF Pro</span>.
    </div> --}}

      <!-- change langue -->
      {{-- <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
      </div> --}}



    {{-- <div class="main-content">
        <div class="header">
            <div class="tool-title">
                <i class="bi bi-arrow-left me-2"></i>
                @yield('page-title', 'MergePDF')
            </div>
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-crown-fill text-warning me-1"></i>
                    <span class="fw-medium">Essai gratuit</span>
                </div>
                <div class="user-avatar">
                    @php
                        $nom = substr(Auth::user()->name, 0, 2);
                        echo strtoupper($nom);
                    @endphp
                </div>
            </div>
        </div>

        @yield('content')

        <div class="footer">
            MergePDF
        </div>
    </div> --}}

    <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="hover" data-menu="vertical-menu-modern" data-col="" <?php if(session()->has('message')){ ?> onload="success()" <?php } ?>>


        <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
            <div class="navbar-container d-flex content">


                <div class="bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav d-xl-none">
                        <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                    </ul>
                </div>

                <li  class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>

                <ul class="nav navbar-nav align-items-center ml-auto">



                    <li class="nav-item dropdown  dropdown-user" data-menu="dropdown"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{Auth::user()->name}}</span><span class="user-status badge badge-light-dark round">{{Auth::user()->type}}</span></div><span data-toggle="tooltip" data-placement="bottom" title="options" class="avatar"><span class="avatar-content bg-dark" style="width:37px; height:37px;">
                            @php
                                $nom = get_initials(Auth::user()->name);
                                echo "<span class='text-light'> $nom </span>"
                            @endphp
                            </span><span class="avatar-status-online"></span></span>

                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="#"> <i class="mr-50" data-feather="user"></i> Profile</a>
                        <a class="dropdown-item" href="#"> <i class="mr-50" data-feather="settings"></i> Settings</a>

                        <form id="logout-form2" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item" data-toggle="tooltip" data-placement="bottom" title="Disconnect" type="submit">
                                <i class="mr-50" data-feather="power"></i> Logout
                            </button>
                        </form>


                        <li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                <button class=" btn  btn-icon " id="logout-button" data-toggle="tooltip" data-placement="bottom" title="Disconnect" style="margin-bottom:0px !important;">
                                    <i class="redable" data-feather="power" style="width: 25px; height: 25px"></i>
                                </button>
                            </form>
                        </li>
                    </div>
                </li>
                </ul>
            </div>
        </nav>

        <div class="text-center" hidden id="spinner">
            <div class="col-12 text-center">
                <div class="spinner-border text-dark" role="status">
                    <span class="sr-only"></span>
            </div>
        </div>
        </div>
        <!-- END: Header-->

        @include('includes/menu')

        <!-- BEGIN: Content-->
            @yield('content')
        <!-- END: Content-->

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>





    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Feather Icons (si nécessaire) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js"></script>

        <!-- BEGIN: Vendor JS-->
        <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
        <!-- BEGIN Vendor JS-->
    {{-- COMMONS JS --}}

    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>

    @yield('javascript')

    <script>
        // Initialisation des icônes Feather si nécessaire
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
    </script>
</body>
</html>
