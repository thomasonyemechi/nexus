<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, minimal-ui">
    <title>Cryptex - Crypto Exchange Wallet Premium Mobile Template</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600&display=swap" rel="stylesheet">
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
                            <div class="user-details__thumb"><img src="{{ asset('assets/images/photos/avatar-5.jpg') }}"
                                    alt="" title="" /></div>
                            <div class="user-details__title"><span>Hello</span> Pieter Vanderbeld</div>
                        </div>
                        <nav class="main-nav">
                            <ul>
                                <li><a href="user-profile.html"><img src="{{ asset('assets/images/icons/user.svg') }}"
                                            alt="" title="" /><span>My Account</span></a></li>
                                <li><a href="forms.html"><img src="{{ asset('assets/images/icons/settings.svg') }}"
                                            alt="" title="" /><span>Settings</span></a></li>
                                <li class="subnav opensubnav"><a href="#"><img
                                            src="{{ asset('assets/images/icons/listing.svg') }}" alt=""
                                            title="" /><span>More Sections</span></a></li>
                                <li><a href="wallet.html"><img src="{{ asset('assets/images/icons/wallet.svg') }}"
                                            alt="" title="" /><span>My Wallet</span></a></li>
                                <li><a href="contact.html"><img src="{{ asset('assets/images/icons/contact.svg') }}"
                                            alt="" title="" /><span>Help &amp; Support</span></a></li>
                            </ul>
                        </nav>
                        <div class="buttons buttons--centered"><a href="#"
                                class="button button--main button--small">LOGOUT</a></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="subnav-header backtonav"><img
                                src="{{ asset('assets/images/icons/arrow-back.svg') }}" alt="" title="" />
                        </div>
                        <nav class="main-nav">
                            <ul>
                                <li><a href="cards.html"><img src="{{ asset('assets/images/icons/blocks.svg') }}"
                                            alt="" title="" /><span>Cards</span></a></li>
                                <li><a href="sliders.html"><img src="{{ asset('assets/images/icons/slider.svg') }}"
                                            alt="" title="" /><span>Sliders</span></a></li>
                                <li><a href="forms.html"><img src="{{ asset('assets/images/icons/form.svg') }}"
                                            alt="" title="" /><span>Forms</span></a></li>
                                <li><a href="tables.html"><img src="{{ asset('assets/images/icons/tables.svg') }}"
                                            alt="" title="" /><span>Tables</span></a></li>
                                <li><a href="tabs-toggles.html"><img src="{{ asset('assets/images/icons/tabs.svg') }}"
                                            alt="" title="" /><span>Tabs</span></a></li>
                                <li><a href="#" data-popup="social" class="open-popup"><img
                                            src="{{ asset('assets/images/icons/love.svg') }}" alt=""
                                            title="" /><span>Social</span></a></li>
                                <li><a href="#" data-popup="notifications" class="open-popup"><img
                                            src="{{ asset('assets/images/icons/popup.svg') }}" alt=""
                                            title="" /><span>Popups</span></a></li>
                                <li><a href="#" data-popup="alert" class="open-popup"><img
                                            src="{{ asset('assets/images/icons/notifications.svg') }}" alt=""
                                            title="" /><span>Notifications</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="page page--main" data-page="main">

        <!-- HEADER -->
        <header class="header header--fixed">
            <div class="header__inner">
                <div class="header__logo header__logo--text"><a href="index.html">Crypt<strong>EX</strong></a></div>
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
                <li><a href="main.html"><img src="{{ asset('assets/images/icons/blocks.svg') }}" alt=""
                            title="" /></a></li>
                <li><a href="list.html"><img src="{{ asset('assets/images/icons/stats.svg') }}" alt=""
                            title="" /></a></li>
                <li class="centered"><a href="wallet.html"><img src="{{ asset('assets/images/icons/wallet.svg') }}"
                            alt="" title="" /></a></li>
                <li><a href="#" class="open-popup" data-popup="notifications"><img
                            src="{{ asset('assets/images/icons/notifications.svg') }}" alt=""
                            title="" /><i>3</i></a></li>
                <li><a href="contact.html"><img src="{{ asset('assets/images/icons/contact.svg') }}" alt=""
                            title="" /></a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Social Icons Popup -->
    <div id="popup-">
        <div class="popup popup--half popup--social">
            <div class="popup__close"><a href="#" class="close-popup" data-popup="social"><img
                        src="{{ asset('assets/images/icons/close.svg') }}" alt="" title="" /></a>
            </div>
            <h2 class="popup__title">Share</h2>
            <nav class="social-nav">
                <ul>
                    <li><a href="#"><img src="{{ asset('assets/images/icons/twitter.svg') }}" alt=""
                                title="" /><span>TWITTER</span></a></li>
                    <li><a href="#"><img src="{{ asset('assets/images/icons/facebook.svg') }}" alt=""
                                title="" /><span>FACEBOOK</span></a></li>
                    <li><a href="#"><img src="{{ asset('assets/images/icons/instagram.svg') }}" alt=""
                                title="" /><span>INSTAGRAM</span></a></li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Alert -->
    <div id="popup-">
        <div class="popup popup--centered popup--shadow popup--alert">
            <div class="popup__close"><a href="#" class="close-popup" data-popup="alert"><img
                        src="{{ asset('assets/images/icons/close.svg') }}" alt="" title="" /></a>
            </div>
            <div class="popup__icon"><img src="{{ asset('assets/images/icons/alert.svg') }}" alt=""
                    title="" /></div>
            <h2 class="popup__title">Hey there !</h2>
            <p class="popup__text">This is an alert example. Creativity is breaking out of established patterns to look
                at things in a different way.</p>
        </div>
    </div>

    <!-- Notifications -->
    <div id="popup-">

        <div class="popup popup--notifications">
            <div class="popup__close"><a href="#" class="close-popup" data-popup="notifications"><img
                        src="{{ asset('assets/images/icons/close.svg') }}" alt="" title="" /></a>
            </div>
            <h2 class="popup__title">Your latest notifications!</h2>
            <ul class="notifications pt-20">
                <li><a href="details.html">Bitcoin</a> is up 10%</li>
                <li><a href="details.html">Ethereum</a> is down 5% in the last 7 days</li>
                <li>Your BTC - ETH swap was succesfully done!</li>
                <li>Received a $100 payment from <a href="#">Robert J.</a></li>
                <li><a href="#">Jenifer F.</a> replied to your message</li>
            </ul>
            <a href="#" class="button button--full button--main">View All Notifications</a>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom-charts.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-init.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.custom.js') }}"></script>
    <script src="{{ asset('assets/js/header-scroll.js') }}"></script>
</body>

</html>
