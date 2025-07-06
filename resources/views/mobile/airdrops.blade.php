@extends('layouts.app')


@section('page_title')
    Nexus Airdrops
@endsection

@php
    $ratio = 10;
    $progressRatio = ($ratio / $airdrop->target_referrals) * 100;
    $earnedAmount = ($airdrop->reward_amount / $airdrop->target_referrals) * $ratio;
@endphp



{{-- 
    ideas for the airdrop section

    $progressRatio = $airdrop->referral_count 
    $earnedAmount = min($progressRatio, 1) * $airdrop->reward_amount;

    leader boards

--}}

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
        <h2 class="page__title">All Airdrops</h2>
        <div class="fieldset">

            <!-- resources/views/airdrop.blade.php -->
            <div class="card p-4 shadow rounded">
                <h3 class="mb-2 fw-bold ">🎁 {{ $airdrop->title }}</h3>
                <p>{{ $airdrop->description }}</p>

                <div class="mt-3">
                    <strong>Your Airdrop Invite Link:</strong><br>

                    <div class="radio-option radio-option--full d-flex justify-content-between ">

                        <input type="text" class="form__input form__input--23 "
                            value="https://nexuscontract.com/drops{{ auth()->user()->ref }}/{{ $airdrop->id }}/{{ sha1(string: $airdrop->id) }}">
                        <button type="submit" name="submit" class="form__submit button button--main ">
                            <i class="bi fw-bold h4 bi-copy"></i>
                        </button>
                    </div>

                    <code></code>
                </div>

                <div class="mt-4">
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width: {{ $progressRatio }}%;">
                            <span class="mt-2"> {{ $ratio }} referrals </span>
                        </div>
                    </div>
                    <p class="mt-2">
                        You've earned: <strong>${{ number_format($earnedAmount, 2) }}</strong> out of
                        ${{ $airdrop->reward_amount }}
                    </p>
                </div>

                {{-- @if ($user->airdropUser->qualified)
                    <div class="alert alert-success mt-3">
                        ✅ You’ve qualified for the airdrop! Admin will distribute your reward soon.
                    </div>
                @endif --}}
            </div>



        </div>




    </div>
@endsection


@push('scripts')
    <script>
        $(function() {
            // fetch the admin waller address here
        })
    </script>
@endpush
