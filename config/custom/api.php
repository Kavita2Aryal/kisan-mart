<?php

return [

    'admin_email' => 'gauroughh@gmail.com',
    
	'order_code_prefix' => 'OC',

    'order_public_key' => 'ybZ8QeTkP9ecz65lyagGG9SKH8MYUoR5A3yVrBDEPUK7CN0OmU6GCG8K500MXPOc',

    'ref_code_prefix' => 'CNC',

    'payment_status' => [
        0  => 'PENDING',
        1  => 'CANCELLED',
        2  => 'CONFIRMED',
        3  => 'INVALID',
        10 => 'COMPLETED'
    ],

    'status_payment' => [
        'PENDING'    => 0,
        'CANCELLED'  => 1,
        'CONFIRMED'  => 2,
        'INVALID'    => 3,
        'COMPLETED'  => 10
    ],

    'currency_code' => ['NPR', 'USD'],

    'sparrow' => [
        'token'            => 'bqcdhRTETd8R8j0jygXm',
        'identity'         => 'ThamesIntl',
        'request_url'      => 'http://api.sparrowsms.com/v2/sms/',
        'credit_check_url' => 'http://api.sparrowsms.com/v2/credit/?token=bqcdhRTETd8R8j0jygXm'
    ],

    'fonepay' => [
        'MD' 	           => 'P',
		'PID'	           => 'NBQM',
        'CRN'	           => 'NPR',
        'sharedSecretKey'  => 'a7e3512f5032480a83137793cb2021dc',
        'request_url'      => 'https://dev-clientapi.fonepay.com/api/merchantRequest', // 'https://clientapi.fonepay.com/api/merchantRequest'
        'verification_url' => 'https://dev-clientapi.fonepay.com/api/merchantRequest/verificationMerchant' // 'https://clientapi.fonepay.com/api/merchantRequest/verificationMerchant'
    ],

    'esewa' => [
        'merchant_id'      => 'epay_payment',
        'request_url'      => 'https://uat.esewa.com.np/epay/main',
        'verification_url' => 'https://uat.esewa.com.np/epay/transrec'
    ],

    'khalti' => [
        'public_key'       => 'test_public_key_d35e3b0996b045ce990cc0aa003a6780',
        'secret_key'       => 'test_secret_key_64ed721ea35047ad84e5e8e53a9e8526',
        'request_url'      => 'https://khalti.com/api/v2/payment/verify/',
        'status_check_url' => 'https://khalti.com/api/v2/payment/status/?',
        'script'           => 'https://unpkg.com/khalti-checkout-web@latest/dist/khalti-checkout.iffe.js'
    ],

    'hbl' => [
        'non_secure'        => 'N',
        'merchant_id'       => '9100432756',
        'merchant_name'     => 'R_B_DIAMOND_JEWELLERS_P_L_ECOM_______NPL',
        'secret_key'        => 'B4VSS9NRRIWAEUXGKQCG6YHU7G11QP8M',
        'request_url'       => 'https://hblpgw.2c2p.com/HBLPGW/Payment/Payment/Payment',
        'test_request_url'  => 'https://hbl.pgw/payment',
        'currency_code'     => [
            'NPR' => 524,
            'USD' => 840
        ]
    ],
    
    'hbl_status' => [
        'success_status'    => ['RS'],
        'payment_status'    => [
            'AP' => 'Approved(Paid)',
            'SE' => 'Settled',
            'VO' => 'Voided (Canceled)',
            'DE' => 'Declined by the issuer Host',
            'FA' => 'Failed',
            'PE' => 'Pending',
            'EX' => 'Expired',
            'RE' => 'Refunded',
            'RS' => 'Ready to Settle',
            'AU' => 'Authenticated',
            'IN' => 'Initiated',
            'FP' => 'Fraud Passed',
            'PA' => 'Paid (Cash)',
            'MA' => 'Matched (Cash)',
        ],
        'response_code'     => [
            '00' => 'Approved (transaction is successfully paid)',
            '01' => 'Refer to Card Issuer',
            '02' => 'Refer to Issuer\'s Special Conditions',
            '03' => 'Invalid Merchant ID',
            '04' => 'Pick Up Card',
            '05' => 'Do Not Honour',
            '06' => 'Error',
            '07' => 'Pick Up Card, Special Conditions',
            '08' => 'Honour with ID',
            '09' => 'Request in Progress',
            '10' => 'Partial Amount Approved',
            '11' => 'Approved VIP',
            '12' => 'Invalid Transaction',
            '13' => 'Invalid Amount',
            '14' => 'Invalid Card Number',
            '15' => 'No Sun Issuer',
            '16' => 'Approved, Update Track 3',
            '17' => 'Customer Cancellation',
            '18' => 'Customer Dispute',
            '19' => 'Re-enter Transaction',
            '20' => 'Invalid Response',
            '21' => 'No Action Taken',
            '22' => 'Suspected Malfunction',
            '23' => 'Unacceptable Transaction Fee',
            '24' => 'File Update not Supported by Receiver',
            '25' => 'Unable to Locate Record on File',
            '26' => 'Duplicate File Update Record',
            '27' => 'File Update Field Edit Error',
            '28' => 'File Update File Locked Out',
            '29' => 'File Update not Successful',
            '30' => 'Format Error',
            '31' => 'Bank not Supported by Switch',
            '32' => 'Completed Partially',
            '33' => 'Expired Card - Pick Up',
            '34' => 'Suspected Fraud - Pick Up',
            '35' => 'Contact Acquirer - Pick Up',
            '36' => 'Restricted Card - Pick Up',
            '37' => 'Call Acquirer Security - Pick Up',
            '38' => 'Allowable PIN Tries Exceeded',
            '39' => 'No Credit Account',
            '40' => 'Requested Function not Supported',
            '41' => 'Lost Card - Pick Up',
            '42' => 'No Universal Amount',
            '43' => 'Stolen Card - Pick Up',
            '44' => 'No Investment Account',
            '45' => 'Settlement Success',
            '46' => 'Settlement Fail',
            '47' => 'Reserved',
            '48' => 'Cancel Fail',
            '49' => 'No Transaction Reference Number',
            '50' => 'Host Down',
            '51' => 'Insufficient Funds',
            '52' => 'No Cheque Account',
            '53' => 'No Savings Account',
            '54' => 'Expired Card',
            '55' => 'Incorrect PIN',
            '56' => 'No Card Record',
            '57' => 'Trans. not Permitted to Cardholder',
            '58' => 'Transaction not Permitted to Terminal',
            '59' => 'Suspected Fraud',
            '60' => 'Card Acceptor Contact Acquirer',
            '61' => 'Exceeds Withdrawal Amount Limits',
            '62' => 'Restricted Card',
            '63' => 'Security Violation',
            '64' => 'Original Amount Incorrect',
            '65' => 'Exceeds Withdrawal Frequency Limit',
            '66' => 'Card Acceptor Call Acquirer Security',
            '67' => 'Hard Capture - Pick Up Card at ATM',
            '68' => 'Response Received Too Late',
            '69' => 'Reserved',
            '70' => 'Settle amount cannot more than authorized amount',
            '71' => 'Inquiry Record Not Exist',
            '72' => 'Reserved',
            '73' => 'Reserved',
            '74' => 'Rejected by Fraud',
            '75' => 'Allowable PIN Tries Exceeded',
            '76' => 'Invalid Credit Card Format',
            '77' => 'Invalid Expiry Date Format',
            '78' => 'Invalid Three Digits Format',
            '79' => 'Only Full Authentication Allowed',
            '80' => 'User Cancellation by closing Internet Browser',
            '81' => 'Corporate Card Blocked',
            '82' => 'Verify Request Data Failed',
            '83' => 'Merchant Currency Mismatched',
            '84' => 'Reserved',
            '85' => 'Reserved',
            '86' => 'Reserved',
            '87' => 'No Envelope Inserted',
            '88' => 'Unable to Dispense',
            '89' => 'Administration Error',
            '90' => 'Cut-off in Progress',
            '91' => 'Issuer or Switch is Inoperative',
            '92' => 'Financial Institution not Found',
            '93' => 'Trans Cannot be Completed',
            '94' => 'Duplicate Transmission',
            '95' => 'Reconcile Error',
            '96' => 'System Malfunction',
            '97' => 'Reconciliation Totals Reset',
            '98' => 'MAC Error',
            '99' => 'System Unavailable',
        ],
        'fraud_code'        => [
            '00' => 'High possibility of no fraud',
            '86' => 'Merchant in whitelist(entry date : [[DDMMYY]])',
            '87' => 'PAN in whitelist(entry date : [[DDMMYY]])',
            '88' => 'Not Local IP Country',
            '89' => 'Bank Name not matched',
            '90' => 'Bank Country not matched',
            '91' => 'Exceeded over [[limit]] Txn limit of one IP using multiple PAN within 24 hours',
            '92' => 'Exceeded over [[limit]] PAN limit of inter non-3DS cards within 24 hours',
            '93' => 'Exceeded over [[limit]] PAN limit of inter 3DS cards within 24 hours',
            '94' => 'Exceeded over [[limit]] PAN limit of local non-3DS cards within 24 hours',
            '95' => 'Exceeded over [[limit]] PAN limit of local 3DS cards within 24 hours',
            '96' => 'BIN in black list(entry date : [[DDMMYY]])',
            '97' => 'IP in black list(entry date : [[DDMMYY]])',
            '98' => 'PAN in blacklist(entry date : [[DDMMYY]])',
            '99' => 'General Error : [[details]]'
        ]
    ],

    'nibl' => [
        'public_key'    => 'MDwjgtVspt58haKebsV7mNvAQIMRwnN3',
        'private_key'   => 'ySgpzBm4kIwExaCfIAgt7gHwwiqEWBk0ipCgEpXIgZosQV6ik0'
    ]
];

/*

https://rbdiamond.com/hbl/payment/RB1593666457/TFxBkZaJyxaySRZPAUGQehfPNWlfBvbhkcaIahbYOCwtfatYJnSzppUPHmtO

*/