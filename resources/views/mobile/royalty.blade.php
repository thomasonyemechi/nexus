@extends('layouts.app')


@section('page_title')
    Royalty
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


        .bottom-toolbar {
            display: none;
        }
    </style>


    <div class="page__content page__content--with-header page__content--with-bottom-nav">
        <h2 class="page__title ">
            <img src="{{ asset('assets/images/crystal2.png') }}" style="width: 20px" alt="">
            <span>Purchase CRYSTAL MEMEBRSHIP</span>
        </h2>
        <div class="fieldset">
            <div class="form">

                <div class="fw-bold h4 fw-bold mb-3">
                    Min Prucahse: <span class="plus-bold"> $ {{ number_format(2000, 2) }}</span>
                </div>



                <form id="buypmc" method="post" action="/mobile/purchase-fiat">
                    @csrf
                    <div class="form__row d-flex align-items-center justify-space">
                        <input type="number" inputmode="numeric" name="usdt_amount" value="" id="usdt"
                            class="form__input form__input--23" placeholder="Enter Amount" min="2000" step="200"
                            max="{{ $usdt_balance }}">
                        <div class="form__coin-icon"><img src="{{ asset('assets/images/logos/tether.png') }}" alt=""
                                title=""><span>USDT</span></div>

                    </div>

                    @error('usdt_amount')
                        <span class="mt-0 minus " style="font-size: 10px"> {{ $message }} </span> <br>
                    @enderror

                    <div class="fw-bold h4 fw-bold mt-4 nxt" style="display: none">
                        You get: <span class="plus "> <span class="val"> 0.00 </span> NXT</span>
                    </div>


                </form>
            </div>
        </div>


        @if ($royalty)
            <div class="fieldset">
                <div class="form">



                    <small>Congratulations !!</small>



                    <div class="fw-bold h4 fw-bold mt-2 nxt" style="displa">
                        <img src="{{ asset('assets/images/crystal2.png') }}" style="width: 20px" alt="">

                        <span class="plus "> You Purchase CRYSTAL MEMEBRSHIP!! </span>
                    </div>


                </div>
            </div>
        @endif






        <h2 class="page__title">CRYSTAL Rewards</h2>


        @foreach ($royalties as $dep)
            <a class="card-coin" href="#">
                <div class="card-coin__logo"><img src="{{ asset('assets/images/icons/plus-bold.svg') }}" alt=""
                        title=""><span>
                        <span class="plus">
                            USDT {{ number_format($dep->amount, 2) }}
                        </span>
                        <b>
                            {{ formatDate($dep->created_at) }}
                        </b>

                        @if ($dep->action == 'approved')
                            <i class="small plus" style="font-size: 10px;">Claim Bonus</i>
                        @elseif($dep->action == 'claimed')
                            <i class="small plus" style="font-size: 10px;"> Claimed</i>
                        @elseif($dep->action == 'pending')
                            <i class="small minus" style="font-size: 10px;"> Pending Bonus</i>
                        @endif

                    </span>

                </div>
                <div class="card-coin__price">
                    <span class="plus"> + {{ number_format($dep->amount, 2) }} USDT </span>
                    @if ($dep->action == 'approved')
                        <button class="mt-2 button button--main claim_bonus button--small py-2"
                            data-id={{ $dep->id }}>Claim</button>
                    @endif
                </div>
            </a>
        @endforeach


        @if (count($royalties) == 0)
            <div class="alert alert-warning">
                <span>
                    No Royalty has been credited
                </span>
            </div>
        @endif


    </div>

    <div class="bottom-fixed-button">
        <button class="button button--full button--main open-popup buypmcbtn">
            Purchase Crystal
        </button>
    </div>
@endsection


@push('scripts')
    <script>
        $(function() {

            $('#buypmc').on('submit', function() {
                $('.buypmcbtn').attr('disabled', 'disabled');
                $('.buypmcbtn').html(`
                                                <div class="spinner-border" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            `);
            })

            $('.buypmcbtn').on('click', function() {
                $('#buypmc').submit();
            })


            const formatter = new Intl.NumberFormat('en-US', {
                style: 'decimal', // or 'currency'
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });



            $('#usdt').on('keyup', function() {
                usdt = $('#usdt');

                amt_usdt = parseInt(usdt.val());




                $.ajax({
                    method: 'get',
                    url: '/get_price'
                }).done(function(res) {
                    price = amt_usdt * res.price

                    price = (price == NaN) ? 0 : price;

                    section = $('.nxt');
                    section.show();
                    if (!price) {
                        price = 0;
                    }

                    section.find('.val').html(formatter.format(price));

                }).fail(function(res) {
                    console.log(res);
                })
            })

        })
    </script>


    <script>
        $(function() {
            $('body').on('click', '.claim_bonus', function() {
                id = $(this).data('id');
                console.log(id);
                confirm('Bonus will be added to your USDT Balance')
                $.ajax({
                    method: 'get',
                    url: '/mobile/claim_royal/' + id
                }).done(function(res) {
                    alert('Congratulations!! Your earning has been Claimed')
                    setTimeout(function() {
                        window.location.href = '/mobile/wallet-overview';
                    }, 1000);
                }).fail(function(res) {
                    alert('an error occured while claiming your earnings');
                    setTimeout(function() {
                        // code to run after delay
                        location.reload();
                    }, 1000);
                })
            })
        })
    </script>
@endpush
