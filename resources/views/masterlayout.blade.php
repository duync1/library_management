<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />

    <script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{ asset('css/fonts.min.css') }}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />
    
</head>
<body>
    <div class="wrapper">
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                        <i class="gg-menu-left"></i>
                    </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <!-- <ul class="nav nav-secondary">
                        
                        <li class="nav-item">
                            <a href="widgets.html">
                                <i class="fas fa-desktop"></i>
                                <p>Books</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../documentation/index.html">
                                <i class="fas fa-file"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../documentation/index.html">
                                <i class="fas fa-file"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    </ul> -->
                    @yield('sidebar')
                </div>
            </div>
        </div>

        <div class="main-panel">
            <div class="main-header">
                <!-- Navbar Header -->
                <nav
                    class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
                >
                    <div class="container-fluid">
                    <nav
                        class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
                    >
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="submit" class="btn btn-search pe-1">
                            <i class="fa fa-search search-icon"></i>
                            </button>
                        </div>
                        <input
                            type="text"
                            placeholder="Search ..."
                            class="form-control"
                        />
                        </div>
                    </nav>
                    </div>
                </nav>
            <!-- End Navbar -->
            </div>

            <div class="container">
                <div class="page-inner">
                    @yield('content')
                </div>
            </div>

            <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
                <nav class="pull-left">
                <ul class="nav">
                    <li class="nav-item">
                    <a class="nav-link" href="http://www.themekita.com">
                        ThemeKita
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#"> Help </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#"> Licenses </a>
                    </li>
                </ul>
                </nav>
                <div class="copyright">
                2024, made with <i class="fa fa-heart heart text-danger"></i> by
                <a href="http://www.themekita.com">ThemeKita</a>
                </div>
                <div>
                Distributed by
                <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
                </div>
            </div>
            </footer>
      </div>
    </div>

    <script src="{{ asset('js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    @if (session('success'))
        <script>
            $(document).ready(function() {
                $.notify({
                    message: "{{ session('success') }}"
                },{
                    type: 'success',
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    delay: 3000,
                    z_index: 2000,
                    animate: {
                        enter: 'animated fadeInDown',
                        exit: 'animated fadeOutUp'
                    }
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            $(document).ready(function() {
                $.notify({
                    message: "{{ session('error') }}"
                },{
                    type: 'danger',
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    delay: 3000,
                    z_index: 2000,
                    animate: {
                        enter: 'animated fadeInDown',
                        exit: 'animated fadeOutUp'
                    }
                });
            });
        </script>
    @endif


    @yield('scripts')
    
</body>
</html>