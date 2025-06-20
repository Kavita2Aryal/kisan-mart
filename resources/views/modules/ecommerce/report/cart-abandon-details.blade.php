@extends('layouts.app')

@section('title', 'Cart Abandon Report')

@section('content')
@php $domain = get_setting('website-domain');
@endphp

<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card m-b-15">
                <div class="card-header">
                    <h5 class="no-margin">Cart Abandon Detail Report ({{ count($data) }})
                        
                        <a href="{{ route('report.cart.abandon') }}" class="m-r-10 normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                    </h5>
                </div>
                <div class="card-body">
                    <div>
                        <div class="pull-left">
                            <p class="text-left">{{ $customer['name'] }}</p>
                            <p class="text-left">{{ $customer['email'] }}</p>
                            <p class="text-left">{{ $customer['phone'] }}</p>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <table class="table table-hover table-responsive-block dataTable with-export custom-table">
                        <thead>
                            <tr>
                                <th width="27">#</th>
                                <th width="50">Date</th>
                                <th width="50">Abandon Product / Gift Voucher List In Cart (Qty)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($data) > 0)
                                @php $i = 0; @endphp
                                @foreach ($data as $key => $row)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $row['date'] }}</td>
                                    <td>
                                        @foreach($row['details'] as $r_row)
                                            <a href="{{ $domain . $r_row['alias'] }}">{{ $r_row['name'] }}</a>
                                            @if(isset($r_row['variant']) && $r_row['variant'] != null)<span class="text-danger">({{ $r_row['variant'] }})</span>@endif
                                            <strong>({{ $r_row['qty'] }})</strong>,
                                        @endforeach
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
