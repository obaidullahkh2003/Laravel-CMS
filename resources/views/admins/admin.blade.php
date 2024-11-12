<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">
    <script src="https://cdn.tiny.cloud/1/t3g8q3go1ujq0hww6xaek5li8cfk5tp8hut8pmtmfg24c4xj/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: [
                'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
                'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
                'importword', 'exportword', 'exportpdf'
            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
            exportpdf_converter_options: { 'format': 'Letter', 'margin_top': '1in', 'margin_right': '1in', 'margin_bottom': '1in', 'margin_left': '1in' },
            exportword_converter_options: { 'document': { 'size': 'Letter' } },
            importword_converter_options: { 'formatting': { 'styles': 'inline', 'resets': 'inline',	'defaults': 'inline', } },
        });
    </script>
</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/admin') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Admin</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Nav::isRoute('home') }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>{{ __('Dashboard') }}</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            {{ __('Settings') }}
        </div>


        <!-- Nav Item - Users Collapse Menu -->
        @if(in_array('View Users users', array_keys($permissionsArray))==true || in_array('View Users admins', array_keys($permissionsArray))==true)
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
               aria-expanded="false" aria-controls="collapseUsers">
                <i class="fas fa-fw fa-users"></i>
                <span>Users</span>
            </a>
            <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @if(in_array('View Users users', array_keys($permissionsArray)))
                    <a class="collapse-item" href="{{ url('admin/user') }}">
                        <i class="fas fa-fw fa-user-circle"></i>
                        <span>Users</span>
                    </a>
                    @endif

                    @if(in_array('View Users admins', array_keys($permissionsArray)))
                        <a class="collapse-item" href="{{ url('admin/admin') }}">
                        <i class="fas fa-fw fa-user-shield"></i>
                        <span>Admins</span>
                        </a>
                    @endif
                </div>
            </div>
        </li>
        @endif

        <li class="nav-item">
            @if(in_array('View Roles', array_keys($permissionsArray)))
            <a class="nav-link" href="{{url('admin/roles')}}">
                <i class="fas fa-user-shield"></i>
                <span>{{ __('Roles') }}</span>
            </a>

            @endif
        </li>

        <li class="nav-item">
            @if(in_array('View Article', array_keys($permissionsArray)))
            <a class="nav-link" href="{{url('admin/article')}}">
                <i class="fas fa-newspaper"></i>
                <span>{{ __('Article') }}</span>
            </a>
            @endif
        </li>

        <li class="nav-item">
            @if(in_array('View Permissions', array_keys($permissionsArray)))
            <a class="nav-link" href="{{url('admin/permissions')}}">
                <i class="fas fa-fw fa-wrench"></i>
                <span>{{ __('Permissions') }}</span>
            </a>
            @endif
        </li>

        <li class="nav-item">
            @if(in_array('View Regions', array_keys($permissionsArray)))
            <a class="nav-link" href="{{url('admin/blockRegions')}}">
                <i class="fas fa-fw fa-table"></i>
                <span>{{ __('Regions') }}</span>
            </a>
            @endif
        </li>

        <li class="nav-item">
            @if(in_array('View Blocks', array_keys($permissionsArray)))
            <a class="nav-link" href="{{url('admin/blocks')}}">
                <i class="fas fa-fw fa-cubes"></i>
                <span>{{ __('Blocks') }}</span>
            </a>
            @endif
        </li>
        <!-- Nav Item - Pages Collapse Menu -->
        @if(in_array('View Page Content navigations', array_keys($permissionsArray))==true||
            in_array('View Page Content carousels', array_keys($permissionsArray))==true||
            in_array('View Page Content services', array_keys($permissionsArray))==true||
            in_array('View Page Content portfolio', array_keys($permissionsArray))==true||
            in_array('View Page Content timeline', array_keys($permissionsArray))==true)
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePageContent"
               aria-expanded="false" aria-controls="collapsePageContent">
                <i class="fas fa-fw fa-folder"></i>
                <span>Page Content</span>
            </a>

            <div id="collapsePageContent" class="collapse" aria-labelledby="headingPageContent" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @if(in_array('View Page Content navigations', array_keys($permissionsArray)))
                    <a class="collapse-item" href="{{url('admin/navigations')}}"><i class="fas fa-fw fa-cogs"></i> Navigations</a>
                    @endif
                    @if(in_array('View Page Content carousels', array_keys($permissionsArray)))
                    <a class="collapse-item" href="{{url('admin/carousels')}}"><i class="fas fa-fw fa-images"></i> Carousels</a>
                    @endif
                    @if(in_array('View Page Content services', array_keys($permissionsArray)))
                    <a class="collapse-item" href="{{url('admin/services')}}"><i class="fas fa-fw fa-briefcase"></i> Services</a>
                    @endif
                    @if(in_array('View Page Content portfolio', array_keys($permissionsArray)))
                    <a class="collapse-item" href="{{url('admin/portfolio')}}"><i class="fas fa-fw fa-folder"></i> Portfolio</a>
                    @endif
                    @if(in_array('View Page Content timeline', array_keys($permissionsArray)))
                    <a class="collapse-item" href="{{url('admin/timeline-events')}}"><i class="fas fa-fw fa-clock"></i> Timeline</a>
                    @endif
                </div>
            </div>
        </li>
        @endif






        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>


                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::guard('admin')->user()->name}}</span>
                            <figure class="img-profile rounded-circle avatar font-weight-bold" data-initial="{{ Auth::guard('admin')->user()->name[0] }}"></figure>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Profile') }}
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Settings') }}
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Activity Log') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('main-content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Maintained by Obaidullah {{ now()->year }}</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>
