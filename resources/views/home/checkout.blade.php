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
        <title>CheckOut - Fashion HTML Template</title>
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
        </div>
        @php
        $total=0;
        @endphp
        <div class="container-fluid pt-5">
            <div class="row">
                <div class="col-lg-6">
                    
                    <form action="{{ route('order') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="firstName">Full name</label>
                                <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="Enter Full Name"
                                required>
                                <div class="invalid-feedback">
                                    Valid customer name is required.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="mobile">Mobile</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+88</span>
                                    </div>
                                    <input type="text" name="customer_mobile" class="form-control" id="mobile" placeholder="Mobile"
                                    required>
                                    <div class="invalid-feedback" style="width: 100%;">
                                        Your Mobile number is required.
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email">Email <span class="text-muted">(Optional)</span></label>
                                <input type="email" name="customer_email" class="form-control" id="email"
                                placeholder="you@example.com" value={{ $user->email }}  required readonly>
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="address">Street</label>
                            <input type="text" class="form-control" name="street" id="address" placeholder="1234 Main St"
                            required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                            <input type="text" class="form-control" name="address" id="address2" placeholder="Apartment or suite">
                        </div>
                        
                    </div>
                    <div class="col-lg-6">
                        @if(!$data->isEmpty())
                        <table class="table table-bordered text-center mb-0">
                            <thead class="">
                                <tr>
                                    <th>Products</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                
                                @foreach($data as $list)
                                <tr>
                                    <td class="align-middle">
                                        {{ $list->product_title }}
                                        {{-- <input type="text" name="productname[]" value='{{ $list->product_title }}' hidden="">
                                        <input type="text" name="productid[]" value='{{ $list->product_id }}' hidden=""> --}}
                                    </td>
                                    
                                    
                                    <td class="align-middle">
                                        
                                        {{ $list->product_quantity  }}
                                        {{-- <input type="number" name="quantity[]" value='{{ $list->product_quantity }}' hidden="">
                                        --}}
                                    </td>
                                    
                                    <td class="align-middle">
                                        {{ $list->product_price * $list->product_quantity }}
                                        {{-- <input type="number" name="price[]" value='{{ $list->product_price * $list->product_quantity }}' hidden=""> --}}
                                    </td>
                                    
                                </tr>
                                @php
                                $total=$total+ $list->product_price * $list->product_quantity +10;
                                @endphp
                                @endforeach
                                
                            </tbody>
                        </table>
                        @if(session()->get('order'))
                        <div id='msg_show' class=" my-2 alert alert-success">
                            <input type="button" class='close' value='x' data-dismiss="alert">
                            {{ session()->get('order') }}
                        </div>
                        @endif
                        @if(session()->get('cart-delete'))
                        <div id='msg_show' class=" my-2 alert alert-danger">
                            <input type="button" class='close' value='x' data-dismiss="alert">
                            {{ session()->get('cart-delete') }}
                        </div>
                        @endif
                        @if(session()->get('upqty'))
                        <div id='msg_show' class=" my-2 alert alert-success">
                            <input type="button" class='close' value='x' data-dismiss="alert">
                            {{ session()->get('upqty') }}
                        </div>
                        @endif
                        {{-- for cashout method --}}
                        <div class="my-3">
                            <h4>Payment Method</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="flexRadioDefault1" value="COD" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Cash On Delivery
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="flexRadioDefault2"  value="Stripe">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Stripe
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="flexRadioDefault2"  value="ssl">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Bkash/Nogod/DBBL
                                </label>
                            </div>
                        </div>
                        
                        {{-- <input type="submit" class="btn btn-block btn-outline-primary my-3 py-3" value="Proceed To Checkout"> --}}
                        <!-- <a href="" class="btn btn-block btn-outline-primary my-3 py-3">Proceed To Checkout</a> -->
                        <input type="submit" class='btn btn-block btn-outline-primary my-3 py-3' value='Proceed To Checkout ($ {{ $total }})'>
                    </form>
                    @else
                    <div id='msg_show' class=" my-2 alert alert-success">
                        <input type="button" class='close' value='x' data-dismiss="alert">
                        <h3>Please product Added  to cart</h3>
                    </div>
                    @endif
                </div>
            </div>
        </div>
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
    <!-- font awesome js -->
    <script src="Home/js/all.js"></script>
</body>
</html>