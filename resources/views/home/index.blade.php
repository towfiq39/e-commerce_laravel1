<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="Home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="Home/css/all.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="Home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="Home/css/responsive.css" rel="stylesheet" />
   </head>
   <body>
      
      <div class="hero_area">
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
         @include('home.slider')
         <!-- end slider section -->
      </div>
      <!-- why section -->
      @include('home.why')
      <!-- end why section -->
      
      <!-- arrival section -->
     @include('home.arrival')
      <!-- end arrival section -->
      
      <!-- product section -->
       @include('home.product')
      
      <!-- end product section -->

      <!-- subscribe section -->
       @include('home.subscriber')
      
      <!-- end subscribe section -->
      <!-- client section -->
       @include('home.client')
      
      <!-- end client section -->
      <!-- footer start -->
       @include('home.footer')
      
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="Home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="Home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="Home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="Home/js/custom.js"></script>
      <script src="Home/js/all.js"></script>
      <script>
          (function (window, document) {
              var loader = function () {
                  var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                  script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
                  tag.parentNode.insertBefore(script, tag);
              };

              window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
          })(window, document);
      </script>
   </body>
</html>