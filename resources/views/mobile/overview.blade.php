@extends('layouts.app')


@section('page_content')
    <div class="page__content page__content--full page__content--with-bottom-nav">
        <div class="account-info">
            <div class="account-info__title">TOTAL BALANCE</div>
            <div class="account-info__total">$1,400.00</div>
            <div class="account-info__stats"><span class="plus">+$235</span> | <span class="plus">+12%</span>
            </div>
            <svg class="account-info__svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0,0 Q50,201 100,0 L100,100 0,100 Z" fill="#0f0638" />
            </svg>
        </div>

        <div class="account-buttons">
            <a href="buy.html"><img src="{{ asset('assets/images/icons/bottom.svg') }}" alt=""
                    title="" /><span>BUY</span></a>
            <a href="sell.html"><img src="{{ asset('assets/images/icons/top.svg') }}" alt=""
                    title="" /><span>SELL</span></a>
            <a href="transfer.html"><img src="{{ asset('assets/images/icons/swap.svg') }}" alt=""
                    title="" /><span>SWAP</span></a>
        </div>

        <div class="page-inner">
            <div class="page__title-bar">
                <h3>My Portfolio</h3>

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
                                <a href="details.html">
                                    <h2 class="caption__title"><img src="{{ asset('assets/images/logos/bitcoin.png') }}"
                                            alt="" title="" /><span>Bitcoin</span><strong>/ BTC</strong></h2>
                                    <div class="caption__chart"><canvas class="chartup" width="100%"
                                            height="60"></canvas></div>
                                    <div class="caption__info"><b>2.5 BTC</b> <b>$41,904</b></div>
                                    <div class="caption__info"><strong>$104,750</strong> <span class="plus">+12%</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="swiper-slide slider-portfolio__slide slider-portfolio__slide--1h">
                        <div class="slider-portfolio__caption caption">
                            <div class="caption__content">
                                <a href="details.html">
                                    <h2 class="caption__title"><img src="{{ asset('assets/images/logos/ethereum.png') }}"
                                            alt="" title="" /><span>Ethereum</span><strong>/ ETH</strong></h2>
                                    <div class="caption__chart"><canvas class="chartdown" width="100%"
                                            height="60"></canvas></div>
                                    <div class="caption__info"><b>23 ETH</b> <b>$3,150</b></div>
                                    <div class="caption__info"><strong>$72,500</strong> <span class="minus">-2%</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="swiper-slide slider-portfolio__slide slider-portfolio__slide--1h">
                        <div class="slider-portfolio__caption caption">
                            <div class="caption__content">
                                <a href="details.html">
                                    <h2 class="caption__title"><img src="{{ asset('assets/images/logos/tether.png') }}"
                                            alt="" title="" /><span>Tether</span><strong>/ USDT</strong></h2>
                                    <div class="caption__chart"><canvas class="chartup" width="100%"
                                            height="60"></canvas></div>
                                    <div class="caption__info"><b>10,096 USDT</b> <b>$1,04</b></div>
                                    <div class="caption__info"><strong>$10,500</strong> <span class="plus">+1%</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="swiper-slide slider-portfolio__slide slider-portfolio__slide--1h">
                        <div class="slider-portfolio__caption caption">
                            <div class="caption__content">
                                <a href="details.html">
                                    <h2 class="caption__title"><img src="{{ asset('assets/images/logos/polkadot.png') }}"
                                            alt="" title="" /><span>Polkadot</span><strong>/
                                            DOT</strong></h2>
                                    <div class="caption__chart"><canvas class="chartdown" width="100%"
                                            height="60"></canvas></div>
                                    <div class="caption__info"><b>120 DOT</b> <b>$24</b></div>
                                    <div class="caption__info"><strong>$2,880</strong> <span class="minus">-1%</span></div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="swiper-pagination slider-portfolio__pagination"></div>

            </div>


            <div class="page__title-bar">
                <h3>Trending</h3>
                <div class="page__title-right">
                    <a href="list.html" class="button button--main button--ex-small">VIEW ALL</a>
                </div>
            </div>

            <div class="cards cards--11">
                <a class="card-coin" href="details.html">
                    <div class="card-coin__logo"><img src="{{ asset('assets/images/logos/bitcoin.png') }}" alt=""
                            title="" /><span>Bitcoin <b>BTC</b></span></div>
                    <div class="card-coin__chart"><canvas class="chartup" width="50" height="30"></canvas></div>
                    <div class="card-coin__price"><strong>$41,827.71</strong><span class="plus">+10%</span>
                    </div>
                </a>
                <a class="card-coin" href="details.html">
                    <div class="card-coin__logo"><img src="{{ asset('assets/images/logos/ethereum.png') }}"
                            alt="" title="" /><span>Ethereum <b>ETH</b></span></div>
                    <div class="card-coin__chart"><canvas class="chartup" width="50" height="30"></canvas></div>
                    <div class="card-coin__price"><strong>$3,250.30</strong><span class="plus">+8%</span></div>
                </a>
                <a class="card-coin" href="details.html">
                    <div class="card-coin__logo"><img src="{{ asset('assets/images/logos/elrond.png') }}" alt=""
                            title="" /><span>Elrond <b>EGLD</b></span></div>
                    <div class="card-coin__chart"><canvas class="chartup" width="50" height="30"></canvas></div>
                    <div class="card-coin__price"><strong>$320</strong><span class="plus">+5%</span></div>
                </a>
                <a class="card-coin" href="details.html">
                    <div class="card-coin__logo"><img src="{{ asset('assets/images/logos/sandbox.png') }}"
                            alt="" title="" /><span>The Sandbox <b>SAND</b></span></div>
                    <div class="card-coin__chart"><canvas class="chartup" width="50" height="30"></canvas></div>
                    <div class="card-coin__price"><strong>$6,5</strong><span class="plus">+5%</span></div>
                </a>
                <a class="card-coin" href="details.html">
                    <div class="card-coin__logo"><img src="{{ asset('assets/images/logos/solana.png') }}" alt=""
                            title="" /><span>Solana <b>SOL</b></span></div>
                    <div class="card-coin__chart"><canvas class="chartup" width="50" height="30"></canvas></div>
                    <div class="card-coin__price"><strong>$140</strong><span class="plus">+4%</span></div>
                </a>
            </div>

            <div class="w-100 text-center"><a href="list.html">View all trending coins</a></div>





        </div>
    </div>
@endsection
