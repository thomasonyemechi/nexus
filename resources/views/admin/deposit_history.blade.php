@extends('layouts.admin02')

@section('page_content')
    <div class="container-fluid content-inner pb-0">
        <div class="row mb-4">
            <div class="col-lg-12">

                <div class="col-lg-12">
                    <div class="card card-block card-stretch custom-scroll">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <div class="caption">
                                <h4 class="font-weight-bold mb-2">All Deposits</h4>
                            </div>
                          
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">



                                <table class="table mb-0 text-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0">Sn</th>
                                            <th scope="col" class="border-0">Username</th>
                                            <th scope="col" class="border-0">Amount</th>
                                            <th scope="col" class="border-0">Wallet Address</th>
                                            <th scope="col" class="border-0">Status</th>
                                            <th scope="col" class="border-0">Timestamp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($deposits as $dep)
                                            <tr>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0"> {{ $loop->iteration }} </h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    {{ $dep->user->username }}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    {{ depositAmount($dep->amount) }}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    {{ $dep->wallet }}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    {!! depositStatus($dep->status) !!}
                                                </td>

                                                <td class="align-middle border-top-0">
                                                    {{ $dep->created_at }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center  pt-3">
                                    {{ $deposits->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-lg-8">
                <div class="row">
                </div>
            </div>
        </div>

    </div>
@endsection



@push('scripts')
@endpush
