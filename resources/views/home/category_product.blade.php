<!DOCTYPE html>
<html>
  <head>
    <!-- Basic -->
    <base href="/public">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Category - Fashion HTML Template</title>
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
      @include('home.slider')

      <section class="product_section layout_padding">
      <div class="container">
      <div class="heading_container heading_center">
         <h2>
         Our <span>products</span>
         </h2>
      </div>
      <div class="row">
         @foreach($data as $product)
         <div class="col-sm-6 col-md-4 col-lg-4 mb-3">
            <div class="box">
               <div class="option_container">

                  <div class="options">

                     <a href="{{ url('product-details',$product->id) }}" class="option1">
                        Product Details
                     </a>
                     <a href="" class="option2">
                        Buy Now
                     </a>
                      
                  </div>
               </div>
               <div class="img-box">
                  <img src="product/{{ $product->image }}" alt="">
               </div>
               <div class="detail-box">
                  <h5>
                  {{ $product->title }}
                  </h5>
                  @if($product->discount_price)
                     <h6>
                     <strong>${{ $product->discount_price }}</strong>
                     </h6>
                  @endif
                  <del>
                     <h6>
                        ${{ $product->price }}
                     </h6>
                  </del>
               </div>
            </div>
         </div>
         @endforeach
      </div>
      
   </div>
      
</section>
<!-- jQery -->
  <script src="Home/js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="Home/js/popper.min.js"></script>
  <!-- bootstrap js -->
  <script src="Home/js/bootstrap.js"></script>
  <!-- custom js -->
  <script src="Home/js/custom.js"></script>
  <!-- font awesome js -->
  <script src="Home/js/all.js"></script>
</body>
</html>