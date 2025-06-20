@php 
$config_payment_options = get_list_group('payment_type');
$db_payment_options = explode(',', $data['payment-options']);
@endphp
<div class="row">
    <div class="col-xl-4 col-lg-4">
        <h4>Payment Options Details</h4>
        <p>Manage the payment options that will be used on the website.</p>
    </div>
    <div class="col-xl-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('setting.update') }}">
                    @csrf
                    <input type="hidden" class="form-value payment-option-value" name="setting[notrequired][payment-options]" value="{{$data['payment-options']}}">
                    @foreach($config_payment_options as $key => $row)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default form-check-group p-t-15 p-b-15">
                                <div class="form-check switch switch-lg info full-width right m-b-0 p-r-10">
                                    <input type="checkbox" class="payment-options-checkbox" id="payment-options-{{$key}}" value="{{ $row }}" @if(in_array($row, $db_payment_options)) checked @endif>
                                    <label for="payment-options-{{$key}}">{{ $row }} </label>
                                </div>
                            </div>
                        </div>
                    </div>  
                    @endforeach
                    @can('setting.update')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    UPDATE <span class="visible-x-inline m-l-5">SETTINGS</span>
                                </button>
                            </div> 
                        </div>
                    </div>
                    @endcan 
                </form>
            </div>
        </div>
    </div>
</div>