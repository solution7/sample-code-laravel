<html>
<head>
  <link href="{{url('/assets/css/email-style.css')}}" rel="stylesheet" type="text/css" >
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
                             <td colspan="2"><h1><b><center>{{ __('common.InvoiceOrder') }}</center></b></h1>
                             </td>
                          </tr>
                          <tr>
                              <td width="30%">{{ __('common.InvoiceOrderNumber') }}:</td>
                              <td>{{$order->id}}</td>
                          </tr>
                          @php
                          $currency = App\Models\Currency::find($order->currency_id);
                          $vat = App\Models\ValueAddedTax::find($order->rows->first()->vat_id);
                          @endphp
                          <tr>
                              <td width="30%">{{ __('common.Name') }} :</td>
                              <td>{{$customer->name}}</td>
                          </tr>
                          <tr>
                              <td width="30%">{{ __('common.Address') }} :</td>
                              <td>{{$customer->address}}</td>
                          </tr>
                          <tr>
                              <td width="30%">{{ __('common.Email') }} :</td>
                              <td>{{$customer->email}}</td>
                          </tr>
                          <tr>
                              <td width="30%">{{ __('common.Amount') }} :</td>
                              <td>{{$order->rows()->first()->amount}} {{$currency->name}}</td>
                          </tr>
                          <tr>
                              <td width="30%">{{ __('common.VAT') }} :</td>
                              <td>{{$vat->percent}}%</td>
                          </tr>
                           @if($order->specification)
                          <tr>
                              <td width="30%"><b>{{ __('common.Specification') }}</b> :</td>
                              <td>{{$order->specification}}</td>
                          </tr>
                          @endif
                          @if($order->show_date == 1)
                          @php
                          $workDates = json_decode($order->workdates);
                          @endphp
                          <tr>
                             <td>
                                @if($order->show_date == 1)
                                <h4>{{ __('common.WorkDates') }}</h4>
                                @endif
                                <tr>
                                   <td >{{ __('common.Date') }}</td>
                                   <td>{{ __('common.Hours') }}</td>
                                </tr>
                                @foreach($workDates as $key=>$workDate)
                                <tr>
                                   <td >{{$workDate->date}}</td>
                                   @if($order->show_hour == 1)
                                   <td>{{$workDate->hours}}</td>
                                    @endif
                                </tr>
                                  @endforeach
                             </td>
                          </tr>
                           @endif
                           @if($customer->reference)
                          <tr>
                             <td>
                                <b>{{ __('common.ReferenceNumber') }} : </b> {{$customer->reference}}
                             </td>
                          </tr>
                          @endif
                          @if($order->invoice->due_date)
                          <tr>
                             <td class="padded">
                                <b>{{ __('common.dueDate') }} : </b> </td><td>{{date('Y-m-d', strtotime($order->invoice->due_date))}}
                             </td>
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
