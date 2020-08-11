<html>
  <head>
    <link href="{{ url('/assets/css/email-style.css') }}" rel="stylesheet" type="text/css" >
  </head>
  <body>
    <center class="wrapper body-wrap">
      <div class="spacer">&nbsp;</div>
      <table class="main center" width="602" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="border-style">
              <table>
                <tbody class="content">
                  <tr>
                    <td colspan="2" align="center" class="logo-background"><img src="{{ url($countryLogo) }}" width="150px"></td>
                  </tr>
                  <tr>
                    <td></td>
                  </tr>
                  <tr>
                    <td ><b>{{ __('common.From') }} :</b></td>
                    <td style="float:right;">
                      <b>{{ __('common.dueDate') }} :</b> {{date('Y-m-d', strtotime($order->invoice->due_date))}}</td>
                  </tr>
                  <tr>
                    <td width="40%">{{ __('common.Name') }}  :</td>
                    <td>{{ $user->profile->fullName }}</td>
                  </tr>
                  <tr>
                    <td>{{ __('common.Email') }} :</td>
                    <td>{{$user->email}}</td>
                  </tr>
                  <tr>
                    <td></td>
                  </tr>
                  <tr>
                    <td ><b>{{ __('common.To') }} :</b></td>
                  </tr>
                  <tr>
                    <td>{{ __('common.Name') }} : </td>
                    <td>{{$customer->name}}</td>
                  </tr>
                  <tr>
                    <td>{{ __('common.Address') }} :</td>
                    <td>{{$customer->address}}</td>
                  </tr>
                  <tr>
                    <td>{{ __('client.Invoicing_option') }} :</td>
                    <td>
                      @if ($customer->invoicing === '1')
                      {{ __('client.Invoicing_option_email')}}
                      @else
                      {{ __('client.Invoicing_option_mail')}}
                      @endif
                    </td>
                  </tr>
                  @if ($customer->invoicing === '1')
                  <tr>
                    <td>{{ __('common.Email') }} :</td>
                    <td>{{$customer->email}}</td>
                  </tr>
                  @endif
                  <tr>
                    <td><b>{{ __('common.Invoice_details')}}</b></td>
                  </tr>
                  <tr>
                    <tr>
                      <td>{{ __('common.InvoiceOrderNumber') }}: </td>
                      <td>{{ $order->id }}</td>
                    </tr>
                  </tr>
                  <tr>
                    <td>{{ __('common.Amount') }} :</td>
                    <td>{{ round($orderRow->amount, 2)}} {{$order->currency->name}}</td>
                  </tr>
                  <tr>
                    <td>{{ __('common.VAT') }} :</td>
                    <td>{{ $orderRow->vat->percent }}%</td>
                  </tr>
                  @if($order->specification)
                 <tr>
                     <td width="30%"><b>{{ __('common.Specification') }}</b> :</td>
                     <td>{{ $order->specification }}</td>
                 </tr>
                 @endif
                </tbody>
              </table>
              <div class="column-bottom">&nbsp;</div>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="spacer">&nbsp;</div>
    </center>
  </body>
</html>
