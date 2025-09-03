@extends('layouts.app')


@section('page_title')
    My Earnings
@endsection


@section('page_content')
    <div class="page__content page__content--with-header page__content--with-bottom-nav">
        <h2 class="page__title">Bonus </h2>

        @foreach ($earnings as $dep)
            <a class="card-coin" href="#">
                <div class="card-coin__logo"><img src="{{ asset('assets/images/icons/plus-bold.svg') }}" alt=""
                        title=""><span>
                        <span class="plus">
                            {{ substr($dep->downliner->wallet, 0, 6) . '...' . substr($dep->downliner->wallet, -6) }}</span>
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


@push('scripts')
    <script>
        $(function() {
            $('body').on('click', '.claim_bonus', function() {
                id = $(this).data('id');
                console.log(id);


                confirm('Bonus will be added to your USDT Balance')



                $.ajax({
                    method: 'get',
                    url: '/mobile/claim_bonus/'+id
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
