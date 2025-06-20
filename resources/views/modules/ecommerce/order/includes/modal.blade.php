<div class="modal fade slide-up modal-view-order-detail" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content-wrapper">
            <div class="modal-content order-detail-modal-content">
                <div class="modal-header clearfix m-b-10">
                    <button type="button" class="close text-danger btn-order-detail-modal-close" data-status="" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid container-fixed-lg">
                        <div class="card card-default m-t-20">
                            <div class="card-body" style="padding-top: 0px;">
                                <div class="invoice">
                                    <div>
                                        <div class="pull-left">
                                            <address>
                                                ORDER PLACED ON:
                                                <br><span class="text-success show-order-placed-on"></span>
                                                <br>
                                            </address>
                                        </div>
                                        <div class="pull-right">
                                            <h5 class="font-montserrat all-caps hint-text text-right show-order-code"></h5>
                                            <p class="text-right">ORDER STATUS: <span class="text-warning show-order-status"></span> </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-lg-4 p-l-0 col-sm-height sm-no-padding show-billing-address">
                                                <p class="m-b-0 small underline">Billing Detail</p>
                                                <address class="no-margin">
                                                    <strong class="phone-number"></strong>
                                                    <br>
                                                    <span class="address-line-1"></span> <span class="address-line-2"></span><br>
                                                    <span class="city"></span> <span class="region"></span><span class="area"></span> <span class="country"></span>
                                                </address>
                                            </div>
                                            <div class="col-lg-4 col-sm-height sm-no-padding show-shipping-address">
                                                <p class="m-b-0 small underline">Shipping Detail</p>
                                                <address class="no-margin">
                                                    <strong class="phone-number"></strong>
                                                    <br>
                                                    <span class="delivery-instruction"></span><br>
                                                    <span class="address-line-1"></span> <span class="address-line-2"></span><br>
                                                    <span class="city"></span> <span class="region"></span><span class="area"></span> <span class="country"></span>
                                                </address>
                                            </div>
                                            <div class="col-lg-4 p-r-0 col-sm-height sm-no-padding">
                                                <p class="m-b-0 small underline text-right">Customer Detail</p>
                                                <address class="no-margin text-right pull-right">
                                                    <strong class="customer-name"></strong><br>
                                                    <span class="customer-email"></span><br>
                                                    <span class="customer-phone"></span>
                                                </address>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive table-invoice">
                                        <table class="table m-t-25">
                                            <thead>
                                                <tr>
                                                    <th class="">SN</th>
                                                    <th class="text-center">Product Name</th>
                                                    <th class="text-center">Currency</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-center">Stock Available</th>
                                                    <th class="text-center">Actual Price</th>
                                                    <th class="text-center">Sold Price</th>
                                                    <th class="text-center">Sub Total</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="order-product-list-container"></tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <div class="row p-r-15">
                                        <div class="col-md-7"></div>
                                        <div class="col-md-5 b-a b-grey">
                                            <div class="p-l-15 p-r-15">
                                                <table class="table table-condensed">
                                                    <tbody>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <span class="m-l-10 font-montserrat fs-11 all-caps">Sub Total:</span>
                                                            </td>
                                                            <td class="col-md-6 text-right">
                                                                <span class="subtotal-amount"></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <span class="m-l-10 font-montserrat fs-11 all-caps">Discount Amount:</span>
                                                            </td>
                                                            <td class="col-md-6 text-right">
                                                                <span class="discount-amount"></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <span class="m-l-10 font-montserrat fs-11 all-caps">VAT Amount:</span>
                                                                <span class="font-montserrat">(13%)</span>
                                                            </td>
                                                            <td class="col-md-6 text-right">
                                                                <span class="vat-amount"></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <span class="m-l-10 font-montserrat fs-11 all-caps">Delivery Charge:</span>
                                                            </td>
                                                            <td class="col-md-6 text-right">
                                                                <span class="delivery-charge-amount"></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <span class="m-l-10 font-montserrat fs-11 all-caps">Grand Total:</span>
                                                            </td>
                                                            <td class="col-md-6 text-right">
                                                                <strong><span class="text-primary no-margin font-montserrat total-amount"></span></strong>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>