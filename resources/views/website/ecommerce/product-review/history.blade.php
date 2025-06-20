@extends('layout.app')

@section('title')
Product Review History
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
'title' => 'Product Review History',
]
)

<div class="uk-section-default uk-section uk-padding-remove-top">
    <div class="uk-container">
        <div class="uk-container">
            @if(!$data->isEmpty() && $data != null)
                @php $i=0; @endphp
                @foreach($data as $row)
                @php $i++; @endphp
                <div uk-grid>
                    <div class="uk-width-1-1">
                        <div class="uk-card uk-card-body uk-card-default">
                            <div uk-grid class="uk-grid-small">
                                <div class="uk-width-1-2@s">
                                    <div class="uk-text-lead"><a href="{{ $domain . $row->product->alias->alias }}" target="_blank">{{ ucwords($row->product->name) }}</a></div>
                                    <div class="uk-text-small">{{ $row->order->order_code }}</div>
                                    <div class="star-rating">
                                        <fieldset class="rating uk-padding-remove uk-margin-remove uk-float-left">
                                            @php $rating_count = ($row->temp_comment == null) ? $row->rating_count : $row->temp_rating_count; @endphp
                                            <input type="radio" disabled id="star5" name="rating-{{$i}}" value="5" @if($rating_count ==5) checked @endif />
                                            <label class="full" for="star5" title="5 stars"></label>

                                            <input disabled type="radio" id="star4half" name="rating-{{$i}}" value="4.5" @if($rating_count ==4.5) checked @endif />
                                            <label class="half" for="star4half" title="4.5 stars"></label>

                                            <input type="radio" disabled id="star4" name="rating-{{$i}}" value="4" @if($rating_count ==4) checked @endif />
                                            <label class="full" for="star4" title="4 stars"></label>

                                            <input type="radio" disabled id="star3half" name="rating-{{$i}}" value="3.5" @if($rating_count==3.5) checked @endif />
                                            <label class="half" for="star3half" title="3.5 stars"></label>

                                            <input type="radio" disabled id="star3" name="rating-{{$i}}" value="3" @if($rating_count==3) checked @endif />
                                            <label class="full" for="star3" title="3 stars"></label>

                                            <input type="radio" disabled id="star2half" name="rating-{{$i}}" value="2.5" @if($rating_count==2.5) checked @endif />
                                            <label class="half" for="star2half" title="2.5 stars"></label>

                                            <input type="radio" disabled id="star2" name="rating-{{$i}}" value="2" @if($rating_count==2) checked @endif />
                                            <label class="full" for="star2" title="2 stars"></label>

                                            <input disabled type="radio" id="star1half" name="rating-{{$i}}" value="1.5" @if($rating_count==1.5) checked @endif />
                                            <label class="half" for="star1half" title="1.5 stars"></label>

                                            <input type="radio" disabled id="star1" name="rating-{{$i}}" value="1" @if($rating_count==1) checked @endif />
                                            <label class="full" for="star1" title="1 star"></label>

                                            <input type="radio" disabled id="starhalf" name="rating-{{$i}}" value="0.5" @if($rating_count==0.5) checked @endif />
                                            <label class="half" for="starhalf" title="0.5 stars"></label>
                                        </fieldset>
                                    </div>
                                    <div class="uk-clearfix"></div>
                                </div>
                                <div class="uk-width-1-2@s">
                                    <div class="uk-text-right@s">
                                        <div class="uk-text-small">Ordered at {{ date("M j, Y", strtotime($row->order->created_at)) }}</div>
                                        <div class="uk-text-small">Reviewed at {{ date("M j, Y", strtotime($row->updated_at)) }}</div>
                                        <div class="uk-text-bold">{{ $row->is_active == 0 ? 'Pending' : ($row->temp_comment == null ? 'Approved' : 'Pending') }}</div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div uk-grid>
                                <div class="uk-width-1-1">
                                    <div>
                                    {{ $row->temp_comment ?? $row->comment }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
            <div uk-grid>
                <div class="uk-width-1-1">
                    <div class="uk-card uk-card-body uk-card-default">
                        <div uk-grid class="uk-grid-small">
                            <div class="uk-width-1-2@s">
                                <div class="uk-text-lead">No Review History !</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@include('includes.cms.footers.footer_1')
@endsection

@push('styles')
@endpush

@push('scripts')

@endpush