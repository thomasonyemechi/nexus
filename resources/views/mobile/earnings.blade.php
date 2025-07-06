@extends('layouts.app')


@section('page_title')
    My Earnings
@endsection


@section('page_content')


    <div class="page__content page__content--with-header page__content--with-bottom-nav">
        <h2 class="page__title">Earnings List</h2>

        @foreach ($earnings as $dep)
            <a class="card-coin" href="#">
                <div class="card-coin__logo"><img src="{{ asset('assets/images/icons/plus-bold.svg') }}" alt=""
                        title=""><span>
                        <span class="plus">
                            {{ substr($dep->downliner->wallet, 0, 6) . '...' . substr($dep->downliner->wallet, -6) }}</span>
                        <b>
                            {{ formatDate($dep->created_at) }}
                        </b></span></div>
                <div class="card-coin__price"><span class="plus"> +
                        {{ number_format($dep->amount, 2) }} {{ $dep->currency }} </span>
                </div>
            </a>
        @endforeach


        @if (count($earnings) == 0)
            <div class="alert alert-warning">
                <b>Warning:</b>

                <span>
                    This section is currently empty because there are no earnings to display at the moment. Once you
                    start receiving earnings from your activities, transactions, or rewards, they will be automatically
                    reflected here in your Real Wallet. Please check back later or continue engaging with the platform
                    to begin accumulating earnings.
                </span>
            </div>
        @endif
    </div>


@endsection

