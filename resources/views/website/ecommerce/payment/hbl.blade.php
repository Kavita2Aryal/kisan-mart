<form action="{{ $hbl['request_url'] }}" id="hbl-payment-request" method="POST"> 
	<input value="{{ $hbl['paymentGatewayID'] }}" name="paymentGatewayID" type="hidden">
	<input value="{{ $hbl['invoiceNo'] }}" name="invoiceNo" type="hidden">
	<input value="{{ $hbl['productDesc'] }}" name="productDesc" type="hidden">
	<input value="{{ $hbl['Amount'] }}" name="Amount" type="hidden">
	<input value="{{ $hbl['currencyCode'] }}" name="currencyCode" type="hidden">
	<input value="{{ $hbl['user_defined_1'] }}" name="userDefined1" type="hidden">
	<input value="{{ $hbl['user_defined_2'] }}" name="userDefined2" type="hidden">
	<input value="{{ $hbl['user_defined_3'] }}" name="userDefined3" type="hidden">
	<input value="{{ $hbl['user_defined_4'] }}" name="userDefined4" type="hidden">
	<input value="{{ $hbl['user_defined_5'] }}" name="userDefined5" type="hidden">
	<input value="{{ $hbl['nonSecure'] }}" name="nonSecure" type="hidden">
	<input value="{{ $hbl['hashValue'] }}" name="hashValue" type="hidden">
</form>

<script type="text/javascript">
	document.getElementById('hbl-payment-request').submit();
</script>