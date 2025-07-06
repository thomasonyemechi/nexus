@extends('layouts.admin02')

@section('page_content')
    <div class="container-fluid content-inner pb-0">
        <div class="row mb-4">
            <div class="col-lg-12">

                <div class="col-lg-12">
                    <div class="card card-block card-stretch custom-scroll">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <div class="caption">
                                <h4 class="font-weight-bold mb-2">Withdarwals History</h4>
                            </div>

                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table mb-0 text-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0">Sn</th>
                                            <th scope="col" class="border-0">Wallet Address</th>

                                            <th scope="col" class="border-0">Amount</th>
                                            <th scope="col" class="border-0">Status</th>
                                            <th scope="col" class="border-0">Timestamp</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        


                                        @foreach ($withdrawal as $dep)
                                            <tr>
                                                <td class="align-middle border-top-0">
                                                    <span class="fw-bold"> {{ $loop->iteration }} </span>
                                                </td>

                                                <td class="align-middle border-top-0">
                                                    <span class="fw-bold">
                                                        {{ $dep->wallet_address }}
                                                    </span>
                                                </td>

                                                <td class="align-middle border-top-0">
                                                    {{ depositAmount($dep->amount) }}
                                                </td>

                                                <td class="align-middle border-top-0">
                                                    {!! depositStatus($dep->status) !!}
                                                </td>

                                                <td class="align-middle border-top-0">
                                                    {{ $dep->created_at }}
                                                </td>
                                                <td class="text-muted px-4 py-3 align-middle border-top-0">

                                                    @if ($dep->status == 'pending')
                                                        <div class="d-flex justify-content-end">
                                                            <a class="btn btn-success btn-sm me-2 approvebtn"
                                                                data-data='{{ json_encode($dep) }}'
                                                                href="#">Approve</a>
                                                            <a class="btn btn-outline-danger btn-sm rejectbtn"
                                                                data-data='{{ json_encode($dep) }}'
                                                                href="#">Reject</a>
                                                        </div>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach



                             
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center  pt-3">
                                    {{ $withdrawal->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
