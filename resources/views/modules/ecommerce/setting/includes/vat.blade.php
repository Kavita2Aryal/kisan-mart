<div class="row m-t-30">
    <div class="col-xl-4 col-lg-4">
        <h4>VAT Details</h4>
        <p>Manage and update the applicable VAT rate.</p>
    </div>
    <div class="col-xl-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('setting.update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group required form-group-default @error('setting.isrequired.vat-rate') has-error @enderror">
                                <label>Vat Rate</label>
                                <input type="text" class="form-control custom-decimal-field @error('setting.isrequired.vat-rate') error @enderror" name="setting[isrequired][vat-rate]" required autocomplete="off" value="{{ $data['vat-rate'] }}">
                                @error('setting.isrequired.vat-rate')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default form-check-group p-t-15 p-b-15">
                                <div class="form-check switch switch-lg info full-width right m-b-0 p-r-10">
                                    <input type="checkbox" class="setting-toggle" id="vat-applicable" @if ($data['vat-applicable']=='ON' ) checked @endif>
                                    <label for="vat-applicable">Vat Applicable? </label>
                                    <input type="hidden" class="form-value" name="setting[notrequired][vat-applicable]" value="{{ $data['vat-applicable'] }}">
                                </div>
                            </div>
                        </div>
                    </div>
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