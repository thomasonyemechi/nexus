@extends('layouts.app')


@section('page_title')
    Invites Others
@endsection


@section('page_content')
    @php
        $link = 'https://nexuscontract.com/signup?ref=' . auth()->user()->ref;
    @endphp


    <div class="page__content page__content--with-header page__content--with-bottom-nav">

        <h2 class="page__title">Copy Invite Link</h2>
        <div class="fieldset">

            <div class="radio-option radio-option--full d-flex justify-content-between ">
                <input type="text" class="login-form__input " value="{{ $link }}">
                <button type="submit" name="submit" class="form__submit  copy_wallet  button button--main "
                    data-link="{{ $link }}"> <i class="bi fw-bold h4 bi-copy"></i> </button>
            </div>


        </div>


        <h2 class="page__title">Your Invites </h2>


        @foreach ($direct_downlines as $user)
            <a class="card-coin" href="#">
                <div class="card-coin__logo">
                    <img src="{{ asset('assets/images/icons/plus-bold.svg') }}" alt="" title="">
                    <span>
                        {{ substr($user->wallet, 0, 6) . '...' . substr($user->wallet, -6) }}
                        <b> Joined: {{ formatDate($user->created_at) }} </b>
                    </span>
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
                alert('Invite Link has been copied')
            } else {
                console.warn("Input element not found.");
            }
        }


        $('.copy_wallet').on('click', function() {
            wallet = $(this).data('link')
            copyFunc(wallet);
        })
    </script>
@endpush
