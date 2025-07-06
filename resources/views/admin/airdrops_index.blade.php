@extends('layouts.admin02')

@section('page_content')
    <div class="container-fluid content-inner pb-0">
        <div class="row mb-4">
            <div class="col-lg-4">
                <div class="card card-block card-stretch custom-scroll">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div class="caption">
                            <h6 class="font-weight-bold text-sm mb-2">Create Airdrops</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="/admin/airdrops/create" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label">Campaign Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description (optional)</label>
                                <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="target_referrals" class="form-label">Target Referrals (to qualify)</label>
                                <input type="number" name="target_referrals" class="form-control"
                                    value="{{ old('target_referrals', 10) }}" min="1" required>
                            </div>

                            <div class="mb-3">
                                <label for="reward_amount" class="form-label">Reward Amount (in USDT)</label>
                                <input type="number" step="10" name="reward_amount" class="form-control"
                                    value="{{ old('reward_amount', 50.0) }}" min="0" required>
                            </div>

                            <div class="mb-3">
                                <label for="start_at" class="form-label">Start Date & Time</label>
                                <input type="datetime-local" name="start_at" class="form-control"
                                    value="{{ old('start_at') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="end_at" class="form-label">End Date & Time</label>
                                <input type="datetime-local" name="end_at" class="form-control" value="{{ old('end_at') }}"
                                    required>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Airdrop</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="col-lg-12">
                    <div class="card card-block card-stretch custom-scroll">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <div class="caption">
                                <h4 class="font-weight-bold mb-2">All Airdrops</h4>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0 text-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0">Title </th>
                                            <th scope="col" class="border-0">Target</th>
                                            <th scope="col" class="border-0">Reward</th>
                                            <th scope="col" class="border-0">Date </th>
                                            <th scope="col" class="border-0 text-end"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($airdrops as $air)
                                            <tr>
                                                <td class="align-middle text-success border-top-0">
                                                    {{ $air->title }}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    {{ $air->target_referrals }}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    $ {{ number_format($air->reward_amount, 2) }}

                                                </td>
                                                <td class="align-middle border-top-0">
                                                    {{ formatDate($air->start_at) }} -
                                                    {{ formatDate($air->end_at) }}
                                                </td>
                                                <td class="align-middle border-top-0 text-end">
                                                    <button class="btn btn-sm btn-primary" > details </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-3 ">
                                {{-- {{ $credits->links('pagination::bootstrap-4') }} --}}
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
