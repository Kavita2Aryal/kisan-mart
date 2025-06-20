<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
            }

            .row:after {
                content: "";
                display: table;
                clear: both;
            }
            .header {
                top: 0;
                width: 100%;
                text-align: center;
            }

            .card {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                padding: 16px;
                text-align: center;
                background-color: #f1f1f1;
            }

            .center {
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="column">
                <div class="card">
                    <div class="header">
                        <div class="container">
                            <img src="{{ storage_path('app/public/website/logo.svg') }}" alt="" width="140" />
                        </div>
                    </div>
                    <hr />
                    <h3>Gift Voucher</h3>
                    <h3>{{ $data['title'] }}</h3>
                    <h1>{{ $currency. '. ' . $data['value'] }}</h1>
                    <table class="card-table table center">
                        <tbody>
                            <tr>
                                <th>Code: </th>
                                <td>{{ $data['code'] }}</td>
                            </tr>
                            <tr>
                                <th>Verification Code: </th>
                                <td>{{ $data['verification_code'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h5>To:</h5>
                    <h5>From:</h5>
                    <div class="footer">
                        <hr />
                        <p>© {{ date('Y') }} {!! $settings['contact-title'] !!} | {!! $settings['contact-address'] !!} | {!! $settings['contact-phone'] !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
