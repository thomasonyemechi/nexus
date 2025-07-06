@extends('layouts.admin02')

@section('page_content')
    <div class="container-fluid content-inner pb-0">
        <div class="row mb-4">
            <div class="col-lg-12">

                <div class="col-lg-12">
                    <div class="card card-block card-stretch custom-scroll">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <div class="caption">
                                <h4 class="font-weight-bold mb-2">All Earnings</h4>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0 text-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0">Wallet Address</th>
                                            <th scope="col" class="border-0">Amount</th>

                                            <th scope="col" class="border-0">Status</th>
                                            <th scope="col" class="border-0">Timestamp</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($earnings as $dep)
                                            <tr>
                                                <td class="align-middle border-top-0">
                                                    {{ putwallet($dep->user->wallet ?? '') }}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    {{ $dep->amount }}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    {{ $dep->action }}
                                                    {{-- {!! depositStatus($dep->action) !!} --}}
                                                </td>

                                                <td class="align-middle border-top-0">
                                                    {{ $dep->created_at }}
                                                </td>


                                                <th>


                                                    @if ($dep->action == 'pending')
                                                        <a href="/admin/approve_earning/{{ $dep->id }}" class="btn btn-sm btn-success" >Approve Earning </a>
                                                    @endif


                                                </th>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Pagination -->
                                <div class="d-flex justify-content-center  pt-3">
                                    {{ $earnings->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
