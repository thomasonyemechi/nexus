@extends('layouts.app')

@section('page_title', 'Wallet Overview')

@section('page_content')
    <div class="page__content page__content--full page__content--with-bottom-nav">
        <div class="account-info">
            <div class="account-info__title">TOTAL BALANCE</div>
            <div class="account-info__total">$ {{ number_format($total, 2) }}</div>
            <div class="account-info__stats"><span class="plus"> {{ number_format($pc_balance, 4) }} NXT
            </div>
            <svg class="account-info__svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0,0 Q50,201 100,0 L100,100 0,100 Z" fill="#13252a" />
            </svg>
        </div>

        <div class="account-buttons">
            <a href="/mobile/deposit"><img src="{{ asset('assets/images/icons/bottom.svg') }}" alt=""
                    title=""><span>FUND</span></a>

            <a href="/mobile/purchase-fiat"><img src="{{ asset('assets/images/icons/swap.svg') }}" alt=""
                    title=""><span>BUY</span></a>
        </div>

        <div class="page-inner">
            <div class="page__title-bar">
                <h3>Balance Detials</h3>

                <div class="page__title-right">
                    <div class="swiper-button-prev slider-portfolio__prev"></div>
                    <div class="swiper-button-next slider-portfolio__next"></div>
                </div>
            </div>

            <!-- SLIDER AUTO 2 -->
            <div class="swiper-container slider-portfolio slider-portfolio--round-corners slider-init mb-40"
                data-paginationtype="progressbar" data-spacebetweenitems="10" data-itemsperview="auto">
                <div class="swiper-wrapper">
                    <div class="swiper-slide slider-portfolio__slide slider-portfolio__slide--1h">
                        <div class="slider-portfolio__caption caption">
                            <div class="caption__content">
                                <a href="#">
                                    <h2 class="caption__title"><img src="{{ asset('logo.jpg') }}" style="border-radius: 50%;" 
                                            alt="" title="" /><span>Nexus Token</span><strong>/ NXT</strong>
                                    </h2>
                                    <div class="caption__chart"><canvas class="chartup" width="100%"
                                            height="60"></canvas></div>
                                    <div class="caption__info"><b>{{ number_format($pc_balance, 4) }} NXT</b> <b> </b>
                                    </div>
                                    <div class="caption__info"><strong>$ {{ number_format($pc_total, 4) }}</strong> <span
                                            class="plus"> {{ number_format(1 / $rate, 4) }}</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="swiper-slide slider-portfolio__slide slider-portfolio__slide--1h">
                        <div class="slider-portfolio__caption caption">
                            <div class="caption__content">
                                <a href="d">
                                    <h2 class="caption__title"><img src="{{ asset('assets/images/logos/tether.png') }}"
                                            alt="" title="" /><span>USDT</span><strong>/ USDT</strong>
                                    </h2>
                                    <div class="caption__chart"><canvas class="chartup" width="100%"
                                            height="60"></canvas></div>
                                    <div class="caption__info"><b>{{ number_format($usdt_balance, 2) }} USDT</b> <b> </b>
                                    </div>
                                    <div class="caption__info"><strong>$ {{ number_format($usdt_balance, 2) }} </strong>
                                        <span class="plus"> 1.00 </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination slider-portfolio__pagination"></div>
            </div>


            <div class="page__title-bar">
                <h3>Recent Transactions</h3>
                <div class="page__title-right">
                    <a href="/mobile/transactions" class="button button--main button--ex-small">VIEW ALL</a>
                </div>
            </div>

            <div class="cards cards--11">

                @foreach ($transactions as $trno)
                    <a class="card-coin" href="#">
                        <div class="card-coin__logo">
                            <img src="{{ asset('assets/images/icons/plus-bold.svg') }}" alt="" title="">
                            <span>

                                <span class="{{ $trno->amount > 0 ? '' : 'minus' }} ">
                                    {{ number_format($trno->amount, 2) }} {{ $trno->currency }}</span>

                                <b> {{ formatDate($trno->created_at) }} </b>
                            </span>
                        </div>
                        <div class="card-coin__price">
                            <span class="plus fw-bold">{{ $trno->remark }} </span>
                        </div>
                    </a>
                @endforeach

            </div>


        </div>
    </div>
@endsection
