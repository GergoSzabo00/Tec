<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="x-apple-disable-message-reformatting">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('app.name') }}</title>
    
		<style type="text/css">
			body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
			table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
			img { -ms-interpolation-mode: bicubic; }

			img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
			table { border-collapse: collapse !important; }
			body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }


			a[x-apple-data-detectors] {
				color: inherit !important;
				text-decoration: none !important;
				font-size: inherit !important;
				font-family: inherit !important;
				font-weight: inherit !important;
				line-height: inherit !important;
			}

			@media screen and (max-width: 480px) {
				.mobile-hide {
					display: none !important;
				}
				.mobile-center {
					text-align: center !important;
				}
			}
			div[style*="margin: 16px 0;"] { margin: 0 !important; }
		</style>
	</head>
	<body style="margin: 0 !important; padding: 20px 0 20px 0 !important !important; background-color: #f8f9fa;" bgcolor="#f8f9fa">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td align="center" style="background-color: #f8f9fa;" bgcolor="#f8f9fa">
				<table align="center" border="0" width="100%" style="max-width:600px;">
					<tr>
						<td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
						<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
							<tr>
								<td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
									<img src="{{asset('images/email_logo.png')}}" width="125" height="120" style="display: block; border: 0px;" alt="{{__('Email Logo')}}" data-auto-embed="attachment" /><br>
									<h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">
										{{__('Thank you for your purchase!')}}
									</h2>
								</td>
							</tr>
							<tr>
								<td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
									<p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777; margin-bottom:0px;">
									   {{__('We are getting your order ready to be shipped.')}}
									   <br>
									   {{__('You can see your order summary below.')}}
									</p>
									<p style="font-size: 14px; font-weight: 400; line-height: 20px; color: #777777;">
										{{__("If you didn't order these items with this email address, please ignore this email.")}}
									</p>
								</td>
							</tr>
							<tr>
								<td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
									<div style="padding: 10px; border: 1px solid #0d6efd; border-radius: 5px;background-color: #0d6efd;color: #fff;">
										<b>{{__('Order number')}}:</b> #{{$order->id}}
									</div>
								</td>
							</tr>
							<tr>
								<td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
									<div style="padding: 10px;">
										<b>{{__('Customer name')}}:</b> {{$order->customer_name}}<br>
                                        <b>{{__('Phone')}}:</b> {{$order->phone}}<br>
                                        <b>{{__('Order date')}}:</b> {{$order->created_at->isoFormat('L')}}
									</div>
								</td>
							</tr>
							<tr>
								<td align="center" height="100%" valign="top" width="100%" style="background-color: #ffffff; padding-top: 10px" bgcolor="#ffffff">
									<table align="center" width="100%" style="max-width:660px; border-collapse: separate !important; border-spacing: 10px;">
										<tr>
											<td align="left" valign="top" style="width:50%; padding: 0 15px 0 15px; font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; border:1px solid #e5e5e5; border-radius:5px;">
												<p style="font-weight: 800;">{{__('Shipping address')}}</p>
												<p style="word-break: break-word;">{{$order->shipping_address}}</p>
											</td>
											<td align="left" valign="top" style="width:50%; padding: 0 15px 0 15px; font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; border:1px solid #e5e5e5; border-radius:5px;">
												<p style="font-weight: 800;">{{__('Payment method')}}</p>
												<p style="word-break: break-word;">{{$order->payment_option_object->name}}</p>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td align="left" style="padding-top: 20px;">
									<table cellspacing="0" border="0" width="100%">
										<tr>
											<td width="60%" align="left" bgcolor="#0d6efd" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 700; color:#fff; line-height: 24px; padding: 10px; border-radius:5px 0 0 0;">
												{{__('Item')}}
											</td>
											<td width="20%" align="left" bgcolor="#0d6efd" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 700; color:#fff; line-height: 24px; padding: 10px;">
												{{__('Quantity')}}
											</td>
											<td width="20%" align="left" bgcolor="#0d6efd" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 700; color:#fff; line-height: 24px; padding: 10px; border-radius:0 5px 0 0;">
												{{__('Price')}}
											</td>
										</tr>
                                        @foreach($order->order_details as $orderDetail)
										<tr>
											<td width="60%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px; word-break: break-word">
												{{$orderDetail->product_name}}
											</td>
											<td width="20%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px; word-break: break-word">
												{{$orderDetail->bought_quantity}}x
											</td>
											<td width="20%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
												${{number_format($orderDetail->price, 2, ',', ' ')}}
											</td>
										</tr>
                                        @endforeach
									</table>
								</td>
							</tr>
							<tr>
								<td align="right">
									<table cellspacing="0" cellpadding="0" border="0" width="100%">
										<tr>
											<td width="100%" align="right" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight:700; line-height: 24px; padding: 10px; border-top: 1px solid #eeeeee;">
												{{__('Subtotal')}}: <span style="color:#0d6efd;">${{number_format($subtotal, 2, ',', ' ')}}</span>
												<br>
												{{__('Shipping cost')}}: <span style="color:#0d6efd;">${{number_format($shippingCost, 2, ',', ' ')}}</span>
												<br>
												{{__('Total')}}: <span style="color:#0d6efd;">${{number_format($order->total_price, 2, ',', ' ')}}</span>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td align="center" style="padding: 35px; background-color: #ffffff;" bgcolor="#ffffff">
						<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
							<tr>
								<td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; padding: 5px 0 10px 0;">
									<p style="font-size: 14px; font-weight: 800; line-height: 18px; color: #333333;">
										Copyright &copy; {{ now()->year }} {{ config('app.name') }}
									</p>
								</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
	</body>
</html>