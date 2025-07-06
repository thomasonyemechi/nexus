@extends('layouts.admin02')

@section('page_content')
    <div class="container-fluid content-inner pb-0">
        <div class="row mb-4">
            <div class="col-lg-12">

                <div class="col-lg-12">
                    <div class="card card-block card-stretch custom-scroll">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <div class="caption">
                                <h4 class="font-weight-bold mb-2">withdrawals History</h4>
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
                                            <th scope="col" class="border-0"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($withdrawals as $dep)
                                            <tr>
                                                <td class="align-middle border-top-0">
                                                    <span class="fw-bold"> {{ $loop->iteration }} </span>
                                                </td>

                                                <td class="align-middle border-top-0">
                                                 <span class="fw-bold" >
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
                                                    <div class="d-flex justify-content-end">
                                                        <a class="btn btn-success btn-sm me-2 approvebtn"
                                                            data-data='{{ json_encode($dep) }}' href="#">Approve</a>
                                                        <a class="btn btn-outline-danger btn-sm rejectbtn"
                                                            data-data='{{ json_encode($dep) }}' href="#">Reject</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center  pt-3">
                                    {{ $withdrawals->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="rejectDepositModal" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    <form method="POST" action="/admin/withdrawal/reject_withdrawal"> @csrf
                        <h3>Reject Deposit</h3>
                        <p class="text-danger"></p>
                        <div class="form-group">
                            <label for="">State Reason For Rejection</label>
                            <input type="text" class="form-control" name="remark">
                            <input type="hidden" class="form-control" name="id">
                        </div>

                        <div class="mt-2 d-flex justify-content-end">
                            <button class="btn btn-sm btn-danger">Reject Deposit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="approveDepositModal" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    <form method="POST" action="/admin/withdrawal/approve_withdrawal"> @csrf
                        <h3>Approve</h3>
                        <p class="text-success"></p>

                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id">
                        </div>

                        <div class="mt-2 d-flex justify-content-end">
                            <button class="btn btn-sm btn-success">Approve</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(function() {

            $('body').on('click', '.rejectbtn', function() {
                data = $(this).data('data');
                console.log(data);

                modal = $('#rejectDepositModal')
                modal.modal('show');
                modal.find('p').html(`Reject this withdrawal `)
                modal.find('input[name="id"]').val(data.id);
            })


            $('body').on('click', '.approvebtn', function() {
                data = $(this).data('data');
                console.log(data);

                modal = $('#approveDepositModal')
                modal.modal('show');
                modal.find('p').html(`You will transfer  ${data.amount} USDT to  ${data.wallet_address} `)
                modal.find('input[name="id"]').val(data.id);
            })
        })
    </script>
@endpush
