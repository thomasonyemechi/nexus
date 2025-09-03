<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, minimal-ui">
    <title>{{ env('APP_NAME') }} - @yield('page_title') </title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper.min.css') }}">

    <link rel="shortcut icon" href="{{ asset('logo.jpg') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/gboot.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    @php
        $announcement = \App\Models\Announcment::get();
        $announcement_count = count($announcement);
    @endphp

</head>


<body>
    <!-- Overlay panel -->
    <div class="body-overlay"></div>
    <!-- Left panel -->
    <div id="panel-">
        <div class="panel panel--left">
            <!-- Slider -->
            <div class="panel__navigation">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="subnav-header closepanel"><img
                                src="{{ asset('assets/images/icons/arrow-back.svg') }}" alt="" title="" />
                        </div>
                        <div class="user-details">

                            <div class="user-details__title"><span>Hello</span> {{ wallet() }} </div>
                        </div>
                        <nav class="main-nav">
                            <ul>
                                <li><a href="/mobile/wallet-overview">
                                        <i class="bi bi-person-circle me-4" style="font-size: 20px;"></i>
                                        <span>My Account</span></a></li>
                                <li><a href="/mobile/airdrops">
                                        <i class="bi bi-gift-fill me-4" style="font-size: 20px;"></i>
                                        <span>Airdrops</span></a></li>

                                <li>
                                    <a href="/mobile/purchase-fiat">
                                        <i class="bi bi-coin me-4" style="font-size: 20px;"></i>
                                        <span>Buy Nexus Token</span></a>
                                </li>


                                <li>
                                    <a href="/mobile/withdrawal">
                                        <i class="bi bi-cash-coin me-4" style="font-size: 20px;"></i>
                                        <span>Withdraw</span></a>
                                </li>


                                <li>
                                    <a href="/mobile/invite">
                                        <i class="bi bi-person-add me-4" style="font-size: 20px;"></i>
                                        <span>Invite</span></a>
                                </li>


                                <li>
                                    <a href="/mobile/earnings">
                                        <i class="bi bi-person-add me-4" style="font-size: 20px;"></i>
                                        <span>Earnings</span></a>
                                </li>


                                <li>
                                    <a href="/mobile/deposit">
                                        <i class="bi bi-arrow-down-square-fill me-4" style="font-size: 20px;"></i>
                                        <span>Deposit </span></a>
                                </li>



                                <li>
                                    <a href="/mobile/royalty">
                                        <i class="bi bi-gem me-4" style="font-size: 20px;"></i>
                                        <span>Royalty  </span></a>
                                </li>




                                




                                @if (in_array(auth()->user()->id, admins()))
                                    <li>
                                        <a href="/admin/dashboard" target="_blank">
                                            <i class="bi bi-arrow-bar-up me-4" style="font-size: 20px;"></i>
                                            <span>Access Admin</span></a>
                                    </li>
                                @endif

                            </ul>
                        </nav>
                        <div class="buttons buttons--centered"><a href="/logout"
                                class="button button--main button--small">LOGOUT</a></div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="page page--main" data-page="main">

        <!-- HEADER -->
        <header class="header header--fixed">
            <div class="header__inner">
                <div class="header__logo header__logo--text"><a class="d-flex" href="/mobile/wallet-overview">

                        <img src="{{ asset('logo.jpg') }}" class="me-2" style=" width: 24px; border-radius: 50%;"
                            alt="" title="" /> Nexus<strong>contract</strong></a>
                </div>
                <div class="header__icon open-panel" data-panel="left"><img
                        src="{{ asset('assets/images/icons/user.svg') }}" alt="image" title="image" /></div>
            </div>
        </header>


        <!-- PAGE CONTENT -->
        @yield('page_content')


    </div>
    <!-- PAGE END -->

    <!-- Bottom navigation -->
    <div id="bottom-" class="bottom-toolbar">
        <div class="bottom-navigation bottom-navigation--gradient">
            <ul class="bottom-navigation__icons">
                <li><a href="/mobile/deposit">
                        <i class="bi bi-arrow-down-square-fill" style="font-size: 22px; color:white "></i></a></li>
                <li><a href="/mobile/earnings"><img src="{{ asset('assets/images/icons/stats.svg') }}" alt=""
                            title="" /></a></li>
                <li class="centered"><a href="/mobile/wallet-overview"><img
                            src="{{ asset('assets/images/icons/wallet.svg') }}" alt="" title="" /></a>
                </li>
                <li><a href="#" class="open-popup" data-popup="notifications"><img
                            src="{{ asset('assets/images/icons/notifications.svg') }}" alt=""
                            title="" /><i>
                            {{ $announcement_count }} </i></a></li>
                <li><a href="/mobile/airdrops">
                        <i class="bi bi-gift" style="font-size: 22px; color:white "></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>


    <!-- Social Icons Popup -->

    <!-- Alert -->

    <!-- Notifications -->
    <div id="popup-">

        <div class="popup popup--notifications">
            <div class="popup__close"><a href="#" class="close-popup" data-popup="notifications"><img
                        src="{{ asset('assets/images/icons/close.svg') }}" alt="" title="" /></a>
            </div>
            <h2 class="popup__title">Your latest notifications!</h2>

            <ul class="notifications pt-20">
                @if ($announcement_count > 0)
                    @foreach ($announcement as $ann)
                        <li>{{ $ann->announcement }}</li>
                    @endforeach
                @endif
            </ul>

        </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom-charts.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-init.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.custom.js') }}"></script>
    <script src="{{ asset('assets/js/header-scroll.js') }}"></script>

    @stack('scripts')



</body>

</html>
