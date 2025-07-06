@extends('layouts.app')


@section('page_title')
    Desosit Funds
@endsection


@section('page_content')
    <style>
        .step-item {
            display: flex;
            align-items: start;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .step-item i {
            font-size: 1.25rem;
            color: #d4af37;
            margin-top: 2px;
        }
    </style>


    <div class="page__content page__content--with-header page__content--with-bottom-nav">
        <h2 class="page__title">Make Deposit</h2>
        <div class="fieldset">

            <h4 class="mb-3">Steps to Depposit</h4>

            <div class="card-selector">
                <label for="c1" style="background-image: none !important;">Copy Your Wallet Address
                    <span>
                        Copy the unique TRX (TRON TRC-20) wallet address provided on your dashboard.
                        Make sure to copy it accurately — this is the address you’ll be sending your funds to.
                    </span>
                </label>
            </div>

            <div class="card-selector">
                <label for="c1" style="background-image: none !important;">Send TRX
                    <span>
                        Send the amount of TRX you wish to deposit to the copied address.
                        You can use any trusted crypto wallet or exchange (e.g., Binance, Trust Wallet).


                        <br> <br>
                        <strong> Note:</strong> Only send TRX using the TRC-20 network.
                        Sending any other coin or using another network may result in loss of funds.
                    </span>
                </label>
            </div>


            <div class="card-selector">
                <label for="c1" style="background-image: none !important;">Wait for Confirmation
                    <span>
                        Once the transaction is sent, wait a few minutes for blockchain confirmation.
                        Your deposit will be automatically detected and credited to your wallet in USDT equivalent.
                    </span>
                </label>
            </div>

        </div>
        <h2 class="page__title">Copy Wallet Address</h2>
        <div class="fieldset">





            <div class="radio-option radio-option--full d-flex justify-content-between ">

                {{-- <label for="op5"><span class="" style="color: white"></span> </label> --}}

                <input type="text" class="login-form__input wallet_address " >


                <button type="submit" name="submit" class="form__submit  copy_wallet  button button--main "> <i
                        class="bi fw-bold h4 bi-copy"></i> </button>
            </div>


        </div>


        <h2 class="page__title">Recent Deposit</h2>


        @foreach ($deposits as $dep)
            <a class="card-coin" href="#">
                <div class="card-coin__logo">
                    <img src="{{ asset('assets/images/icons/plus-bold.svg') }}" alt="" title="">
                    <span>
                        sucesssful Deposit
                        <b> {{ formatDate($dep->created_at) }} </b>
                    </span>
                </div>
                <div class="card-coin__price">
                    <span class="plus fw-bold">+ {{ number_format($dep->amount, 2) }} {{ $dep->currency }}</span>
                </div>
            </a>
        @endforeach



    </div>
@endsection



@push('scripts')
    <script>
        function copyFunc(string) {
            if (string) {
                navigator.clipboard.writeText(string)
                    .then(() => console.log("Copied: " + string))
                    .catch(err => console.error("Failed to copy text: ", err));


                alert('Deposit Wallet has been copied')
            } else {
                console.warn("Input element not found.");
            }



        }




        function getStorage(key) {

            expire_time = localStorage.getItem('dep_wallet_expire');
            current_time = `{{ time() }}`

            console.log(current_time - expire_time);
            if (current_time > expire_time) {
                // expire time has reahed 
                //  get new key
                return walletnew();
            } else {
                // use old key
                var value = localStorage.getItem(key);
                return value;
            }
        }


        function walletnew() {

            new_wallet = '';
            // load wallet
            $.ajax({
                method: 'get',
                url: `/validate_wallet`
            }).done(function(res) {
                new_wallet = res.new_wallet
                console.log(res);
                setStorage('dep_wallet', res.new_wallet);
                loadWallet()
            }).fail(function(res) {
                console.log(res);
            })
            return new_wallet;
        }


        function setStorage(key, value) {
            try {
                localStorage.setItem(key, value);
                localStorage.setItem('dep_wallet_expire', `{{ time() + 86400 }}`);
            } catch (e) {
                console.log('setStorage: Error setting key [' + key + '] in localStorage: ' + JSON.stringify(e));
                return false;
            }
            return true;
        }




        function loadWallet() {
            wallet = getStorage('dep_wallet')
            loadString(wallet);
        }


        function loadString(old_wallet) {

            $('.wallet_address').val(old_wallet)

            $('.copy_wallet').attr('data-wallet', old_wallet);
        }


        $('.copy_wallet').on('click', function() {
            wallet = $(this).data('wallet')
            copyFunc(wallet);

            // alert('Wallet Address has been copied!');
        })

        loadWallet();






        // return new_wallet;
        // }
    </script>
@endpush
