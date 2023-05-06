<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://homologation-payment.payline.com/scripts/widget-min.js"> </script>
    <link href="https://homologation-payment.payline.com/styles/widget-min.css" rel="stylesheet" />
  </heaad>
   <body>
     <div class='logo'><img src="https://convey.world/public/assets/images/logo.png"></div>
      <div id="PaylineWidget" data-token=""></div>
   </body>

   <style>
    body{
      background-color: #ffffff;
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
   </script>

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
   function executeCancelAction() {

       var cancelUrl = Payline.Api.getCancelAndReturnUrls().cancelUrl;
       //Execution du endToken
       Payline.Api.endToken(null, function ()
         { //Redirection
         window.location.href = cancelUrl;
         }, null, false);
     }
     function OnLoad() {
     $('.pl-pmContainer .pl-pay-btn-container').after('<a class="cancelButton" style="display:block;cursor:pointer" title="Cancel Paymenet">Cancel</a>');
     $('.cancelButton').click(executeCancelAction);
     }
   </script>

</html>
