@extends('layouts.app')

@section('title', 'Update Exchange Rate')

@section('content')
<div class="container-fluid">
    <form class="m-t-20" role="form" method="POST" action="{{ route('currency.exchange.rate.update', [$currency->uuid]) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Update Exchange Rate
                            <a href="{{ route('currency.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group form-group-default required @error('currency_id') has-error @enderror">
                            <label>Currency</label>
                            <div class="controls">
                                <input type="hidden" class="form-control" name="currency_id" value="{{ $currency->id }}">
                                <input type="text" class="form-control @error('currency_id') error @enderror" value="{{ $currency->currency }}" style="color:black;" readonly>
                                @error('currency_id')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group form-group-default required @error('rate') has-error @enderror">
                            <label>Exchange Rate</label>
                            <div class="controls">
                                <input type="text" class="form-control @error('rate') error @enderror custom-decimal-field" name="rate" autocomplete="off" value="{{ ($exchange_rate != null) ? $exchange_rate->rate : old('rate') }}">
                                @error('rate')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right" type="submit">
                                    UPDATE <span class="visible-x-inline m-l-5">EXCHANGE RATE</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Exchange Rate History</div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-responsive-block">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Exchange Rate</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody data-title="currency">
                                @if ($exchange_rates->count() > 0)
                                @php $i = ($exchange_rates->currentPage() - 1) * $exchange_rates->perPage(); @endphp
                                @foreach ($exchange_rates as $row)
                                @php $i++; @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $row->rate ?? 'N/A' }}</td>
                                    <td class="change-status">
                                        @if ($row->is_active == 10)
                                        <strong class="text-success">ACTIVE<strong>
                                                @else
                                                <strong class="text-danger">INACTIVE<strong>
                                                        @endif
                                    </td>
                                    <td>{{ $row->user->name }}</td>
                                    <td>{{ $row->created_at }}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5">No data to display</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @include('includes.pagination', ['page' => $exchange_rates])
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
<script>
    $('[data-init-plugin=select2]').select2();
</script>
@endpush