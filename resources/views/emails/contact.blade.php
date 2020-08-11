<html>
<head>
  <link href="{{url('/assets/css/email-style.css')}}" rel="stylesheet" type="text/css" >
</head>
<body>
  <center class="wrapper">
    <div class="spacer">&nbsp;</div>
    <table class="main center" width="602" border="0" cellspacing="0" cellpadding="0">
      <tbody>
        <tr>
          <td class="border-style">
            <table class="content" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2" align="center" class="logo-background"><img src="{{ url($request->countryLogo) }}" width="150px"></td>
              </tr>
              <tbody>
                <tr>
                  <td></td><td></td>
                </tr>
                <tr>
                  <td width="25%">{{ __('common.Name') }} :</td>
                  <td>{{ $request->name }}</td>
                </tr>
                <tr>
                  <td width="25%">{{ __('common.Email') }}:</td>
                  <td>{{ $request->email }}</td>
                </tr>
                <tr>
                  <td width="25%">{{ __('common.Phone') }}:</td>
                  <td>{{ $request->telephone_number }}</td>
                </tr>
                @if ($request->language)
                  <tr>
                      <td width="25%">{{ __('common.Language')}}:</td>
                      <td>{{ $request->language }}</td>
                  </tr>
                @endif
                @if ($request->call_me)
                  <tr>
                      <td width="25%">{{ __('common.CallTime')}}:</td>
                      <td>{{ $request->call_me }}</td>
                  </tr>
                @endif
                <tr>
                  <td class="padded" colspan="2">
                      <h1>{{ __('common.Message')}}:</h1>
                      <p>{{ $request->message }}</p>
                  </td>
                </tr>
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
