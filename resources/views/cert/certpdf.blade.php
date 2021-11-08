<html>
   <head>
      <style type='text/css'>
         body, html {
         margin: 0;
         padding: 0;
         }
         body {
         color: black;
         /*display: table;*/
         font-family: Georgia, serif;
         font-size: 24px;
         text-align: center;
         }
         .container {
         border: 20px solid #27345C;
         width: 750px;
         height: 563px;
         /*display: table-cell;*/
         vertical-align: middle;
         }
         .logo {
         color: tan;
         }
         .marquee {
         color: #27345C;
         font-size: 48px;
         margin: 20px;
         }
         .assignment {
         margin: 20px;
         }
         .person {
         border-bottom: 2px solid black;
         font-size: 32px;
         font-style: italic;
         margin: 20px auto;
         width: 400px;
         }
         .reason {
         margin: 20px;
         }
      </style>
   </head>
   <body>
      <div class="container">
         <div class="logo" style="padding-top:120px;">
            <!-- ihs -->
            <img src="{{url('ihs.png')}}">
         </div>
         <div class="marquee">
            Certificate of Completion
         </div>
         <div class="assignment">
            This certificate is presented to
         </div>
         <div class="person">
            {{$name}}
         </div>
         <div class="reason">
            For the completion of {{$course}}.<br/>
         </div>
      </div>
   </body>
</html>