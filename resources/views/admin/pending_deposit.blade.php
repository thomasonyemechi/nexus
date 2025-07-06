@extends('layouts.admin02')

@section('page_content')
    <div class="container-fluid content-inner pb-0">
        <div class="row mb-4">
            <div class="col-lg-12">

                <div class="col-lg-12">
                    <div class="card card-block card-stretch custom-scroll">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <div class="caption">
                                <h4 class="font-weight-bold mb-2">All Pending Deposits</h4>
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
                                            <th scope="col" class="border-0"></th>
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
                                                <td class="text-muted px-4 py-3 align-middle border-top-0">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="dropdown ms-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" role="tablist"
                                                                width="20" id="dropdownMenuButton{{ $loop->iteration }}"
                                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                            </svg>
                                                            <ul class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton{{ $loop->iteration }}">
                                                                <li><a class="dropdown-item approvebtn"
                                                                        data-data='{{ json_encode($dep) }}'
                                                                        href="#">Approve</a></li>
                                                                <li><a class="dropdown-item rejectbtn"
                                                                        data-data='{{ json_encode($dep) }}'
                                                                        href="#">Reject</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Pagination -->
                                <div class="d-flex justify-content-center  pt-3">
                                    {{ $deposits->links('pagination::bootstrap-4') }}
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
                    <form method="POST" action="/admin/deposit/reject_deposit"> @csrf
                        <h3>Reject Deposit</h3>
                        <p class="text-danger"></p>
                        <div class="form-group">
                            <label for="">State Reason For Rejection</label>
                            <input type="text" class="form-control" name="remark">
                            <input type="hidden" class="form-control" name="deposit_id">
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
                    <form method="POST" action="/admin/deposit/approve_deposit"> @csrf
                        <h3>Approve Deposit</h3>
                        <p class="text-success"></p>

                        <div class="form-group">
                            <label for="">Remark</label>
                            <input type="text" class="form-control" name="remark">
                            <input type="hidden" class="form-control" name="deposit_id">
                        </div>

                        <div class="mt-2 d-flex justify-content-end">
                            <button class="btn btn-sm btn-success">Approve Deposit</button>
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
                modal.find('p').html(
                    `This deposit of ${data.amount} USDT will be rejected and no funds will be transfer to  ${data.user.username} `
                    )
                modal.find('input[name="deposit_id"]').val(data.id);
            })


            $('body').on('click', '.approvebtn', function() {
                data = $(this).data('data');
                console.log(data);

                modal = $('#approveDepositModal')
                modal.modal('show');
                modal.find('p').html(
                    `This deposit will be aproved and  ${data.amount} USDT will be transfer to  ${data.user.username} `
                    )
                modal.find('input[name="deposit_id"]').val(data.id);
            })
        })
    </script>
@endpush
