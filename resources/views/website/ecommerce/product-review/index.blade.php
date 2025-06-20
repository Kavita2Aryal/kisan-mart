@extends('layout.app')

@section('title')
Products To be Reviewed
@endsection
@push('seo')
@include('includes.seo.seo',
[
'seo' => null,
'url' => url()->current()
]
)
@endpush
@section('frontend-content')
@include('includes.cms.headers.header_1')


@include('includes.customer-nav',
[
'title' => 'Products To be Reviewed',
]
)
<div class="uk-section-default uk-section uk-padding-remove-top">
    <div class="uk-container">
        <div class="uk-grid-margin uk-container">
            <div class="tm-grid-expand uk-child-width-1-1" uk-grid>
                <div>
                    <div>
                        <div class="uk-card uk-card-body uk-card-default uk-h6" style="overflow:auto;">
                            <table class="uk-table uk-table-hover uk-table-middle uk-table-divider" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <thead>
                                    <tr>
                                        <th>
                                            <h5 class="uk-margin-remove">Order Code</h5>
                                        </th>
                                        <th>
                                            <h5 class="uk-margin-remove">Order Date</h5>
                                        </th>
                                        <th>
                                            <h5 class="uk-margin-remove">Product Name</h5>
                                        </th>
                                        <th>
                                            <h5 class="uk-margin-remove">Product Sku Code</h5>
                                        </th>

                                        <th>
                                            <h5 class="uk-margin-remove">Action</h5>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($data) > 0 && $data != null)
                                    @foreach($data as $row)
                                    <tr>
                                        <td>{{ $row['order']['order_code'] }}</td>
                                        <td>{{ date("M j, Y", strtotime($row['order']['created_at'])) }}</td>
                                        <td>{{ $row['product']['name'] }}
                                        </td>
                                        <td>{{ $row['product_sku'] }}</td>
                                        @if(in_array($row['product_id'], $reviews))
                                            @php $text = "Edit Review"; @endphp
                                        @else
                                            @php $text = "Write Review"; @endphp
                                        @endif
                                        <td>
                                            <a href="{{ route('product.review.store', [$row['product']['uuid'], $row['order']['uuid']]) }}" class="uk-button uk-button-small">{{ $text }}</a>
                                        </td>
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
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.cms.footers.footer_1')
@endsection

@push('styles')
@endpush

@push('scripts')

@endpush