
<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GYM APP</title>

    <!--plugins-->
    <link href="{{  asset('frontend/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{  asset('frontend/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{  asset('frontend/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet">
    <!-- loader-->
    <link href="{{  asset('frontend/css/pace.min.css') }}" rel="stylesheet">
    <script src="{{  asset('frontend/js/pace.min.js') }}"></script>
    <!--Styles-->
    <link href="{{  asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('frontend/css/icons.css')}}" >

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="{{  asset('frontend/css/main.css' )}}" rel="stylesheet">
    <link href="{{  asset('frontend/css/dark-theme.css' )}}" rel="stylesheet">
    <link href="{{  asset('frontend/css/semi-dark-theme.css' )}}" rel="stylesheet">
    <link href="{{  asset('frontend/css/minimal-theme.css' )}}" rel="stylesheet">
    <link href="{{  asset('frontend/css/shadow-theme.css' )}}" rel="stylesheet">

    <link href="{{  asset('frontend/css/extra-icons.css' )}}" rel="stylesheet">



    @vite(['resources/js/app.js', 'resources/css/app.css' ])


</head>
<body>

{{--<!--start header-->--}}
<header class="top-header">
    <nav class="navbar navbar-expand justify-content-between">
        <div class="btn-toggle-menu">
            <span class="material-symbols-outlined">menu</span>
        </div>
        <div class="position-relative search-bar d-lg-block d-none" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <input class="form-control form-control-sm rounded-5 px-5" disabled type="search" placeholder="Search">
            <span class="material-symbols-outlined position-absolute ms-3 translate-middle-y start-0 top-50">search</span>
        </div>
        <ul class="navbar-nav top-right-menu gap-2">
            <li class="nav-item d-lg-none d-block" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <a class="nav-link" href="javascript:;"><span class="material-symbols-outlined">
                  search
                  </span></a>
            </li>
            <li class="nav-item dark-mode">
                <a class="nav-link dark-mode-icon" href="javascript:;"><span class="material-symbols-outlined">dark_mode</span></a>
            </li>
            <li class="nav-item dropdown dropdown-app">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" href="javascript:;"><span class="material-symbols-outlined">
                  apps
                  </span></a>
                <div class="dropdown-menu dropdown-menu-end mt-lg-2 p-0">
                    <div class="app-container p-2 my-2">
                        <div class="row gx-0 gy-2 row-cols-3 justify-content-center p-2">
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="frontend/images/icons/slack.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Slack</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="frontend/images/icons/behance.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Behance</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="frontend/images/icons/google-drive.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Dribble</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="frontend/images/icons/outlook.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Outlook</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="frontend/images/icons/github.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">GitHub</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="frontend/images/icons/stack-overflow.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Stack</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="frontend/images/icons/figma.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Stack</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="frontend/images/icons/twitter.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Twitter</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="frontend/images/icons/google-calendar.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Calendar</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="frontend/images/icons/spotify.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Spotify</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="frontend/images/icons/google-photos.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Photos</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="frontend/images/icons/pinterest.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Photos</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="frontend/images/icons/linkedin.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">linkedin</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="frontend/images/icons/dribble.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Dribble</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="frontend/images/icons/youtube.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">YouTube</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="frontend/images/icons/google.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">News</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="frontend/images/icons/envato.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Envato</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="frontend/images/icons/safari.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Safari</p>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div><!--end row-->

                    </div>
                </div>
            </li>
            <li class="nav-item dropdown dropdown-large">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <span class="notify-badge">8</span>
                        <span class="material-symbols-outlined">
                      notifications_none
                      </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end mt-lg-2">
                    <a href="javascript:;">
                        <div class="msg-header">
                            <p class="msg-header-title">Notifications</p>
                            <p class="msg-header-clear ms-auto">Marks all as read</p>
                        </div>
                    </a>
                    <div class="header-notifications-list">
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="notify text-primary border">
                          <span class="material-symbols-outlined">
                            add_shopping_cart
                            </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name">New Orders <span class="msg-time float-end">2 min
                              ago</span></h6>
                                    <p class="msg-info">You have recived new orders</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="notify text-danger border">
                          <span class="material-symbols-outlined">
                            account_circle
                            </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name">New Customers<span class="msg-time float-end">14 Sec
                              ago</span></h6>
                                    <p class="msg-info">5 new user registered</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="notify text-success border">
                          <span class="material-symbols-outlined">
                            picture_as_pdf
                            </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name">24 PDF File<span class="msg-time float-end">19 min
                              ago</span></h6>
                                    <p class="msg-info">The pdf files generated</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="notify text-info border">
                          <span class="material-symbols-outlined">
                            store
                            </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name">New Product Approved <span class="msg-time float-end">2 hrs ago</span></h6>
                                    <p class="msg-info">Your new product has approved</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="notify text-warning border">
                          <span class="material-symbols-outlined">
                            event_available
                            </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name">Time Response <span class="msg-time float-end">28 min
                              ago</span></h6>
                                    <p class="msg-info">5.1 min avarage time response</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="notify text-danger border">
                          <span class="material-symbols-outlined">
                            forum
                            </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name">New Comments <span class="msg-time float-end">4 hrs
                              ago</span></h6>
                                    <p class="msg-info">New customer comments recived</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="notify text-primary border">
                          <span class="material-symbols-outlined">
                            local_florist
                            </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name">New 24 authors<span class="msg-time float-end">1 day
                              ago</span></h6>
                                    <p class="msg-info">24 new authors joined last week</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="notify text-success border">
                          <span class="material-symbols-outlined">
                            park
                            </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name">Your item is shipped <span class="msg-time float-end">5 hrs
                              ago</span></h6>
                                    <p class="msg-info">Successfully shipped your item</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="notify text-warning border">
                          <span class="material-symbols-outlined">
                            elevation
                            </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name">Defense Alerts <span class="msg-time float-end">2 weeks
                              ago</span></h6>
                                    <p class="msg-info">45% less alerts last 4 weeks</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <a href="javascript:;">
                        <div class="text-center msg-footer">View All</div>
                    </a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="offcanvas" href="#ThemeCustomizer"><span class="material-symbols-outlined">
                  settings
                  </span></a>
            </li>
        </ul>
    </nav>
</header>
<!--end header-->


<!--start sidebar-->
<aside class="sidebar-wrapper">
    <div class="sidebar-header">
        <div class="logo-icon">
            <img src="{{ asset('frontend/images/logo-icon.png') }}" class="logo-img" alt="">
        </div>
        <div class="logo-name flex-grow-1">
            <h5 class="mb-0">Roksyn</h5>
        </div>
        <div class="sidebar-close ">
            <span class="material-symbols-outlined">close</span>
        </div>
    </div>
    <div class="sidebar-nav" data-simplebar="true">

        <!--navigation-->
        <ul class="metismenu" id="menu">
            <li>
                <a href="/">
                    <div class="parent-icon"><span class="material-symbols-outlined">home</span>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>

            <li>
                <a href="/add-client">
                    <div class="parent-icon"><span class="material-symbols-outlined">person_add</span>
                    </div>
                    <div class="menu-title">Create Client</div>
                </a>
            </li>

            <li>
                <a href="/create-exercise">
                    <div class="parent-icon"><span class="material-symbols-outlined">exercise</span>
                    </div>
                    <div class="menu-title">Create Exercise</div>
                </a>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><span class="material-symbols-outlined">apps</span>
                    </div>
                    <div class="menu-title">Application</div>
                </a>
                <ul>
                    <li> <a href="app-emailbox.html"><span class="material-symbols-outlined">arrow_right</span>Email</a>
                    </li>
                    <li> <a href="app-chat-box.html"><span class="material-symbols-outlined">arrow_right</span>Chat Box</a>
                    </li>
                    <li> <a href="app-file-manager.html"><span class="material-symbols-outlined">arrow_right</span>File Manager</a>
                    </li>
                    <li> <a href="app-contact-list.html"><span class="material-symbols-outlined">arrow_right</span>Contatcs</a>
                    </li>
                    <li> <a href="app-to-do.html"><span class="material-symbols-outlined">arrow_right</span>Todo List</a>
                    </li>
                    <li> <a href="app-invoice.html"><span class="material-symbols-outlined">arrow_right</span>Invoice</a>
                    </li>
                    <li> <a href="app-fullcalender.html"><span class="material-symbols-outlined">arrow_right</span>Calendar</a>
                    </li>
                </ul>
            </li>
            <li class="menu-label">UI Elements</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><span class="material-symbols-outlined">widgets</span>
                    </div>
                    <div class="menu-title">Widgets</div>
                </a>
                <ul>
                    <li> <a href="widget-data.html"><span class="material-symbols-outlined">arrow_right</span>Data Widget</a>
                    </li>
                    <li> <a href="widget-static.html"><span class="material-symbols-outlined">arrow_right</span>Widget Static</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><span class="material-symbols-outlined">shopping_cart</span>
                    </div>
                    <div class="menu-title">eCommerce</div>
                </a>
                <ul>
                    <li> <a href="ecommerce-add-product.html"><span class="material-symbols-outlined">arrow_right</span>Add Product</a>
                    </li>
                    <li> <a href="ecommerce-products.html"><span class="material-symbols-outlined">arrow_right</span>Products</a>
                    </li>
                    <li> <a href="ecommerce-customers.html"><span class="material-symbols-outlined">arrow_right</span>Customers</a>
                    </li>
                    <li> <a href="ecommerce-customer-details.html"><span class="material-symbols-outlined">arrow_right</span>Customer Details</a>
                    </li>
                    <li> <a href="ecommerce-orders.html"><span class="material-symbols-outlined">arrow_right</span>Orders</a>
                    </li>
                    <li> <a href="ecommerce-customer-details.html"><span class="material-symbols-outlined">arrow_right</span>Order Details</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><span class="material-symbols-outlined">redeem</span>
                    </div>
                    <div class="menu-title">Components</div>
                </a>
                <ul>
                    <li> <a href="component-alerts.html"><span class="material-symbols-outlined">arrow_right</span>Alerts</a>
                    </li>
                    <li> <a href="component-accordions.html"><span class="material-symbols-outlined">arrow_right</span>Accordions</a>
                    </li>
                    <li> <a href="component-badges.html"><span class="material-symbols-outlined">arrow_right</span>Badges</a>
                    </li>
                    <li> <a href="component-buttons.html"><span class="material-symbols-outlined">arrow_right</span>Buttons</a>
                    </li>
                    <li> <a href="component-cards.html"><span class="material-symbols-outlined">arrow_right</span>Cards</a>
                    </li>
                    <li> <a href="component-lightbox.html"><span class="material-symbols-outlined">arrow_right</span>Lightbox</a>
                    </li>
                    <li> <a href="component-carousels.html"><span class="material-symbols-outlined">arrow_right</span>Carousels</a>
                    </li>
                    <li> <a href="component-list-groups.html"><span class="material-symbols-outlined">arrow_right</span>List Groups</a>
                    </li>
                    <li> <a href="component-media-object.html"><span class="material-symbols-outlined">arrow_right</span>Media Objects</a>
                    </li>
                    <li> <a href="component-modals.html"><span class="material-symbols-outlined">arrow_right</span>Modals</a>
                    </li>
                    <li> <a href="component-navs-tabs.html"><span class="material-symbols-outlined">arrow_right</span>Navs & Tabs</a>
                    </li>
                    <li> <a href="component-paginations.html"><span class="material-symbols-outlined">arrow_right</span>Pagination</a>
                    </li>
                    <li> <a href="component-popovers-tooltips.html"><span class="material-symbols-outlined">arrow_right</span>Popovers & Tooltips</a>
                    </li>
                    <li> <a href="component-progress-bars.html"><span class="material-symbols-outlined">arrow_right</span>Progress</a>
                    </li>
                    <li> <a href="component-spinners.html"><span class="material-symbols-outlined">arrow_right</span>Spinners</a>
                    </li>
                    <li> <a href="component-notifications.html"><span class="material-symbols-outlined">arrow_right</span>Notifications</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><span class="material-symbols-outlined">add_reaction</span>
                    </div>
                    <div class="menu-title">Icons</div>
                </a>
                <ul>
                    <li> <a href="icons-line-icons.html"><span class="material-symbols-outlined">arrow_right</span>Line Icons</a>
                    </li>
                    <li> <a href="icons-boxicons.html"><span class="material-symbols-outlined">arrow_right</span>Boxicons</a>
                    </li>
                    <li> <a href="icons-feather-icons.html"><span class="material-symbols-outlined">arrow_right</span>Feather Icons</a>
                    </li>
                </ul>
            </li>
            <li class="menu-label">Forms & Tables</li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><span class="material-symbols-outlined">diamond</span>
                    </div>
                    <div class="menu-title">Forms</div>
                </a>
                <ul>
                    <li> <a href="form-elements.html"><span class="material-symbols-outlined">arrow_right</span>Form Elements</a>
                    </li>
                    <li> <a href="form-input-group.html"><span class="material-symbols-outlined">arrow_right</span>Input Groups</a>
                    </li>
                    <li> <a href="form-radios-and-checkboxes.html"><span class="material-symbols-outlined">arrow_right</span>Radios & Checkboxes</a>
                    </li>
                    <li> <a href="form-layouts.html"><span class="material-symbols-outlined">arrow_right</span>Forms Layouts</a>
                    </li>
                    <li> <a href="form-validations.html"><span class="material-symbols-outlined">arrow_right</span>Form Validation</a>
                    </li>
                    <li> <a href="form-wizard.html"><span class="material-symbols-outlined">arrow_right</span>Form Wizard</a>
                    </li>
                    <li> <a href="form-file-upload.html"><span class="material-symbols-outlined">arrow_right</span>File Upload</a>
                    </li>
                    <li> <a href="form-date-time-pickes.html"><span class="material-symbols-outlined">arrow_right</span>Date Pickers</a>
                    </li>
                    <li> <a href="form-select2.html"><span class="material-symbols-outlined">arrow_right</span>Select2</a>
                    </li>
                    <li> <a href="form-repeater.html"><span class="material-symbols-outlined">arrow_right</span>Form Repeater</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><span class="material-symbols-outlined">backup_table</span>
                    </div>
                    <div class="menu-title">Tables</div>
                </a>
                <ul>
                    <li> <a href="table-basic-table.html"><span class="material-symbols-outlined">arrow_right</span>Basic Table</a>
                    </li>
                    <li> <a href="table-datatable.html"><span class="material-symbols-outlined">arrow_right</span>Data Table</a>
                    </li>
                </ul>
            </li>
            <li class="menu-label">Pages</li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><span class="material-symbols-outlined">lock_open</span>
                    </div>
                    <div class="menu-title">Authentication</div>
                </a>
                <ul>
                    <li><a class="has-arrow" href="javascript:;"><span class="material-symbols-outlined">arrow_right</span>Basic</a>
                        <ul>
                            <li><a href="auth-basic-login.html" target="_blank"><span class="material-symbols-outlined">arrow_right</span>Login</a></li>
                            <li><a href="auth-basic-register.html" target="_blank"><span class="material-symbols-outlined">arrow_right</span>Register</a></li>
                            <li><a href="auth-basic-forgot-password.html" target="_blank"><span class="material-symbols-outlined">arrow_right</span>Forgot Password</a></li>
                            <li><a href="auth-basic-reset-password.html" target="_blank"><span class="material-symbols-outlined">arrow_right</span>Reset Password</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:;"><span class="material-symbols-outlined">arrow_right</span>Cover</a>
                        <ul>
                            <li><a href="auth-cover-login.html" target="_blank"><span class="material-symbols-outlined">arrow_right</span>Login</a></li>
                            <li><a href="auth-cover-reset-password.html" target="_blank"><span class="material-symbols-outlined">arrow_right</span>Register</a></li>
                            <li><a href="auth-cover-forgot-password.html" target="_blank"><span class="material-symbols-outlined">arrow_right</span>Forgot Password</a></li>
                            <li><a href="auth-cover-reset-password.html" target="_blank"><span class="material-symbols-outlined">arrow_right</span>Reset Password</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:;"><span class="material-symbols-outlined">arrow_right</span>Boxed</a>
                        <ul>
                            <li><a href="auth-boxed-login.html" target="_blank"><span class="material-symbols-outlined">arrow_right</span>Login</a></li>
                            <li><a href="auth-boxed-register.html" target="_blank"><span class="material-symbols-outlined">arrow_right</span>Register</a></li>
                            <li><a href="auth-boxed-forgot-password.html" target="_blank"><span class="material-symbols-outlined">arrow_right</span>Forgot Password</a></li>
                            <li><a href="auth-boxed-reset-password.html" target="_blank"><span class="material-symbols-outlined">arrow_right</span>Reset Password</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="user-profile.html">
                    <div class="parent-icon"><span class="material-symbols-outlined">account_circle</span>
                    </div>
                    <div class="menu-title">User Profile</div>
                </a>
            </li>
            <li>
                <a href="timeline.html">
                    <div class="parent-icon"><span class="material-symbols-outlined">hotel_class</span>
                    </div>
                    <div class="menu-title">Timeline</div>
                </a>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><span class="material-symbols-outlined">warning</span>
                    </div>
                    <div class="menu-title">Errors</div>
                </a>
                <ul>
                    <li> <a href="pages-error-403.html" target="_blank"><span class="material-symbols-outlined">arrow_right</span>403 Error</a>
                    </li>
                    <li> <a href="pages-error-404.html" target="_blank"><span class="material-symbols-outlined">arrow_right</span>404 Error</a>
                    </li>
                    <li> <a href="pages-error-500.html" target="_blank"><span class="material-symbols-outlined">arrow_right</span>500 Error</a>
                    </li>
                    <li> <a href="pages-coming-soon.html" target="_blank"><span class="material-symbols-outlined">arrow_right</span>Coming Soon</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="faq.html">
                    <div class="parent-icon"><span class="material-symbols-outlined">call</span>
                    </div>
                    <div class="menu-title">FAQ</div>
                </a>
            </li>
            <li>
                <a href="pricing-table.html">
                    <div class="parent-icon"><span class="material-symbols-outlined">currency_bitcoin</span>
                    </div>
                    <div class="menu-title">Pricing</div>
                </a>
            </li>
            <li class="menu-label">Charts & Maps</li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><span class="material-symbols-outlined">monitoring</span>
                    </div>
                    <div class="menu-title">Charts</div>
                </a>
                <ul>
                    <li> <a href="charts-apex.html"><span class="material-symbols-outlined">arrow_right</span>Apex</a>
                    </li>
                    <li> <a href="charts-chartjs.html"><span class="material-symbols-outlined">arrow_right</span>Chartjs</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><span class="material-symbols-outlined">distance</span>
                    </div>
                    <div class="menu-title">Maps</div>
                </a>
                <ul>
                    <li> <a href="map-google-maps.html"><span class="material-symbols-outlined">arrow_right</span>Google Maps</a>
                    </li>
                    <li> <a href="map-vector-maps.html"><span class="material-symbols-outlined">arrow_right</span>Vector Maps</a>
                    </li>
                </ul>
            </li>
            <li class="menu-label">Others</li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><span class="material-symbols-outlined">toc</span>
                    </div>
                    <div class="menu-title">Menu Levels</div>
                </a>
                <ul>
                    <li> <a class="has-arrow" href="javascript:;"><span class="material-symbols-outlined">arrow_right</span>Level One</a>
                        <ul>
                            <li> <a class="has-arrow" href="javascript:;"><span class="material-symbols-outlined">arrow_right</span>Level Two</a>
                                <ul>
                                    <li> <a href="javascript:;"><span class="material-symbols-outlined">arrow_right</span>Level Three</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <div class="parent-icon"><span class="material-symbols-outlined">receipt_long</span>
                    </div>
                    <div class="menu-title">Documentation</div>
                </a>
            </li>
            <li>
                <a href="javascript:;">
                    <div class="parent-icon"><span class="material-symbols-outlined">shop</span>
                    </div>
                    <div class="menu-title">Support</div>
                </a>
            </li>
        </ul>
        <!--end navigation-->


    </div>
    <div class="sidebar-bottom dropdown dropup-center dropup">
        <div class="dropdown-toggle d-flex align-items-center px-3 gap-3 w-100 h-100" data-bs-toggle="dropdown">
            <div class="user-img">
                <img src="frontend/images/avatars/01.png" alt="">
            </div>
            <div class="user-info">
                <h5 class="mb-0 user-name">Jhon Maxwell</h5>
                <p class="mb-0 user-designation">UI Engineer</p>
            </div>
        </div>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="javascript:;"><span class="material-symbols-outlined me-2">
                  account_circle
                  </span><span>Profile</span></a>
            </li>
            <li><a class="dropdown-item" href="javascript:;"><span class="material-symbols-outlined me-2">
                  tune
                  </span><span>Settings</span></a>
            </li>
            <li><a class="dropdown-item" href="javascript:;"><span class="material-symbols-outlined me-2">
                  dashboard
                  </span><span>Dashboard</span></a>
            </li>
            <li><a class="dropdown-item" href="javascript:;"><span class="material-symbols-outlined me-2">
                  account_balance
                  </span><span>Earnings</span></a>
            </li>
            <li><a class="dropdown-item" href="javascript:;"><span class="material-symbols-outlined me-2">
                  cloud_download
                  </span><span>Downloads</span></a>
            </li>
            <li>
                <div class="dropdown-divider mb-0"></div>
            </li>
            <li><a class="dropdown-item" href="javascript:;"><span class="material-symbols-outlined me-2">
                  logout
                  </span><span>Logout</span></a>
            </li>
        </ul>
    </div>
</aside>
<!--end sidebar-->


<!--start main content-->
<main class="page-content" id="app">



</main>
<!--end main content-->



<!--start theme customization-->

<!--end theme customization-->


<!--plugins-->
<script src="{{asset('frontend/js/jquery.min.js') }}"></script>
{{--<script src="../../public/{{asset('rontend/js/jquery.min.') }}js"></script>--}}
<script src="{{  asset('frontend/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<script src="{{  asset('frontend/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{  asset('frontend/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('frontend/js/index.js') }}"></script>
<script src="{{asset('frontend/js/dateFormat.js') }}"></script>

<!--BS Scripts-->
<script src="{{asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{asset('frontend/js/main.js') }}"></script>





</body>
</html>
