<html>
   <head>
      <link href="{{ url('/assets/css/email-style.css') }}" rel="stylesheet" type="text/css" >
   </head>
   <body>
     <center class="wrapper">
         <div class="spacer">&nbsp;</div>
         <table class="main center" width="602" border="0" cellspacing="0" cellpadding="0">
             <tbody>
             <tr>
                 <td class="border-style">
                     <table class="content" border="0" cellspacing="0" cellpadding="0">
                         <tbody>
                             <tr>
                                 <td align="center" class="logo-background"><img src="{{ url($countryLogo) }}" width="150px"></td>
                             </tr>
                             <tr>
                                 <td></td>
                             </tr>
                             <tr>
                                 <td class="padded">
                                   {!! $content !!}
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
