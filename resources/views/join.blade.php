<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, minimal-ui">
    <title> {{ env('APP_NAME') }} - Create Wallet </title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600&amp;display=swap"
        rel="stylesheet">
</head>

<body>

    <div class="page page--login" data-page="login">

        <!-- HEADER -->
        <header class="header header--fixed">
            <div class="header__inner">
                <div class="header__icon"><a href="/"><img
                            src="{{ asset('assets/images/icons/arrow-back.svg') }}  " alt=""
                            title="" /></a></div>
            </div>
        </header>

        <div class="login">
            <div class="login__content">
                <h2 class="login__title">Create Wallet</h2>
                <div class="login-form">
                    <form id="LoginForm" method="post" action="">
                        <div class="login-form__row">
                            <label class="login-form__label">TRX Wallet</label>
                            <input type="text" name="wallet_address" value=""
                                class="login-form__input required" />
                        </div>
                        <div class="login-form__row">
                            <label class="login-form__label">Pin Code</label>
                            <input type="password" name="pin_code" value="" class="login-form__input required" />
                        </div>
                        <div class="login-form__row">

                            <button class="btn login-form__submit button button--main button--full">Create
                                Wallet</button>
                        </div>
                    </form>

                    <div class="login-form__bottom">
                        <p>Already Have a Wallet? <br /><a href="/login">Access Wallet!</a></p>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <!-- PAGE END -->

    <script src="{{ asset('assets/vendor/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.custom.js') }}"></script>
</body>

</html>
