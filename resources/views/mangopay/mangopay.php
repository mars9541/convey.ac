<?php
$price = floatval($_GET['price']) * floatval($_GET['credit']);
$vat = $price * floatval($_GET['vat']) / 100;
?>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://homologation-payment.payline.com/scripts/widget-min.js"> </script>
    <link href="https://homologation-payment.payline.com/styles/widget-min.css" rel="stylesheet" />
  </heaad>
   <body>
     <div class='website-logo'><img width="225px" src="https://convey.world/public/assets/images/conveyd.png"></div>
     <div  class="PaylineWidget pl-container-default">
     <div id="pl-container-default-view" class="pl-container-view">
       <header class="panel-header">
         <h6 class="heading">Price: <?=number_format((float)$_GET['price'], 2, '.', '')?> <?=$_GET['currency']?> x  <?=$_GET['credit']?> Credits <tr> = <?=number_format((float)$price, 2, '.', '')?>  <?=$_GET['currency']?></h2><br>
         <h6 class="heading">VAT: <?=$_GET['vat']?>% <tr> = <?=number_format((float)$vat, 2, '.', '')?>  <?=$_GET['currency']?> </h2><br>
         <h2 class="heading">Total: <?=number_format((float)$price+$vat, 2, '.', '')?>  <?=$_GET['currency']?></h2><br>

        </header>
    </div>
    </div>
      <div id="PaylineWidget" data-template="column" data-embeddedredirectionallowed="false" data-event-didshowstate="OnLoad" data-token=""></div>
   </body>

   <style>
    body{
      background-color: #fff;
    }
    .website-logo > img{
      display: block;
      margin-left: auto;
      margin-right: auto;
    }
    .PaylineWidget.pl-container-default .pl-paymentMethodLayout-view .pl-pmContainer.pl-odd .pl-card-logos{
      padding: .5rem;
      background-color: #ffece5;
      height: auto;
      border: 1px solid #e9785a;
      line-height: 1;
      margin: 0 1rem;
    }
    .PaylineWidget.pl-container-default .pl-pmContainer, .PaylineWidget.pl-container-default .pl-card-logos-container, .PaylineWidget.pl-layout-column .pl-pmContainer.pl-active:hover {
      border: none;
      background-color: transparent;
    }
    .PaylineWidget .pl-container-view .pl-manager {
    min-height: 200px;
    }
    .PaylineWidget * {
        font-family: WidgetFont,Arial,Helvetica,sans-serif;
        -webkit-font-smoothing: antialiased;
        text-shadow: 0 0 1px rgba(0,0,0,.01);
        text-rendering: optimizeLegibility;
    }
    #pl-container-default-view{
      background-color: #5162770f;
      border-radius: .5rem;
      margin-bottom: -15px;
    }
    .panel-header {
    border-bottom: 1px solid #3c4959;
    padding: 1.75rem 2rem 1.5rem 2rem;
}
    h2.heading {
    display: inline-block;
    font-size: 1.2rem;
    line-height: 1;
    font-weight: 500;
    margin-bottom: 0;
  }
  h6.heading {
  display: inline-block;
  font-size: 0.8rem;
  line-height: 1;
  margin-bottom: 0;
}
   </style>
   <script type="text/javascript">
   // Pour charger le widget
   var urlToken = url_query('token');
   if (urlToken) {
       var element = document.getElementById('PaylineWidget');
       element.setAttribute('data-token', urlToken);
   }

   // Parse URL Queries
   function url_query( query ) {
       query = query.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
       var expr = "[\\?&]"+query+"=([^&#]*)";
       var regex = new RegExp( expr );
       var results = regex.exec( window.location.href );
       if ( results !== null ) {
           return results[1];
       } else {
           return false;
       }
   }

     function OnLoad() {
     $('.pl-pmContainer .pl-pay-btn-container').after('<a class="cancelButton" style="display:block;cursor:pointer" data-embeddedredirectionallowed="false" title="Cancel Paymenet">Cancel</a>');
     $('.cancelButton').click(executeCancelAction);

     }
     function executeCancelAction() {

        var cancelUrl = Payline.Api.getCancelAndReturnUrls().cancelUrl;
        console.log(cancelUrl);
        //Execution du endToken
        Payline.Api.endToken(null, function ()
          { //Redirection
          window.location.href = cancelUrl;
          }, null, false);
      }
   </script>

</html>
