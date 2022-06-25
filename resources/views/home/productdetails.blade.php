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
        
        <div class="container-fluid py-5">
            <div class="row px-xl-5">
                <div class="col-lg-5 pb-5">
                    <img src="product/{{ $sdata->image }}" alt="">
                </div>
                <div class="col-lg-7 pb-5 ">
                    <h3 class="font-weight-semi-bold">Product Name: {{ $sdata->title }}</h3>
                    
                    
                    @if($sdata->discount_price)
                    <h4> Price : ${{ $sdata->discount_price }}</h4>
                    @else
                    <h4 class="font-weight-semi-bold mb-4">Price : ${{ $sdata->price }}</h4>
                    @endif
                    <h4>Product Category :  {{ $sdata->category }} </h4>
                    <h4>Available Quantity :  {{ $sdata->quantity }} </h4>
                    <p class="mb-4">Description : {{ $sdata->description }}</p>
                    
                    <form action="{{ url('addtocart',$sdata->id) }}" method='POST'>
                        @csrf
                        <label for="">Quantity</label>
                        <input type="number" class='form-control w-25' name='quantity' value='1' placeholder='Quantity'>
                        <input type="submit" value="Add To Cart" class='btn btn-outline-primary'>
                    </form>
                    {{-- <a href="{{ url('test',$sdata->id) }}" class='btn btn-outline-primary'>Add Cart</a> --}}
                    @if(session()->get('add_cart'))
                    <div id='msg_show' class=" my-2 alert alert-success">
                        <input type="button" class='close' value='x' data-dismiss="alert">
                        {{ session()->get('add_cart') }}
                    </div>
                    @endif
                    
                </div>
            </div>
            
        </div>
        <!-- Shop Detail End -->
         @include('home.product_details_category')
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
    <script src="Home/js/all.js"></script>
</body>
</html>