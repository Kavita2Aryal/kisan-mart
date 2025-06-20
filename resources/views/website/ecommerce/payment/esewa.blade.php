<form action="{{ $esewa['request_url'] }}" id="esewa-payment-request" method="POST"> 
    <input value="1" name="tAmt" type="hidden"> //$order->total
    <input value="1" name="amt" type="hidden"> //order->sub_total
    <input value="0" name="txAmt" type="hidden">//order->vat_amount
    <input value="0" name="psc" type="hidden">//
    <input value="0" name="pdc" type="hidden">//order->delivery_charge
    <input value="{{ $esewa['merchant_id'] }}" name="scd" type="hidden">
    <input value="{{ $order->uuid }}" name="pid" type="hidden">
    <input value="{{ route('payment.esewa.success') }}" type="hidden" name="su">
    <input value="{{ route('payment.esewa.failed') }}" type="hidden" name="fu">
    <input value="Submit" type="submit" style="display: none;">
</form>
<script type="text/javascript">
	document.getElementById('esewa-payment-request').submit();
</script>