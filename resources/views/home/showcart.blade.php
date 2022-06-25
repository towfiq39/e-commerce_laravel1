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
      <title>Show-Cart - Fashion HTML Template</title>
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
         @include('home.header')    <!-- end header section -->
         @include('home.slider')
         
      </div>
      
      <div class="container-fluid pt-5">
         <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5 table-hover">
               @if(!$data->isEmpty())
               <table class="table table-bordered text-center mb-0">
                  <thead class="">
                     <tr>
                        <th>Products</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Remove</th>
                     </tr>
                  </thead>
                  <tbody class="align-middle">
                      @csrf
                        @php
                        $total=0;
                        @endphp
                        @foreach($data as $list)
                        <tr>
                           <td class="align-middle">
                              {{ $list->product_title }}
                              {{-- <input type="text" name="productname[]" value='{{ $list->product_title }}' hidden="">
                              <input type="text" name="productid[]" value='{{ $list->product_id }}' hidden=""> --}}
                           </td>
                           
                           
                           <td class="align-middle">
                              <a href="{{ url('minusqty',$list->product_id) }}" class='btn btn-primary btn-sm m-1'>
                                 <i class="fa fa-minus"></i>
                              </a>
                              {{ $list->product_quantity  }}
                              <input type="number" name="quantity[]" value='{{ $list->product_quantity }}' hidden="">
                              <a href="{{ url('plusqty',$list->product_id) }}" class='btn btn-primary btn-sm m-1'>
                                 <i class="fa fa-plus"></i>
                              </a>
                           </td>
                           
                           <td class="align-middle">
                              {{ $list->product_price * $list->product_quantity }}
                              {{-- <input type="number" name="price[]" value='{{ $list->product_price * $list->product_quantity }}' hidden=""> --}}
                           </td>
                           <td class="align-middle"><a onclick="return confirm('Are You Sure Want to Delete This Data')" href="{{ url('remove_cart',$list->product_id) }}" class='btn btn-danger'><i class="fa fa-times"></i></a></td>
                        </tr>
                        @php
                        $total=$total + $list->product_price * $list->product_quantity +10;
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
                  {{-- <input type="submit" class="btn btn-block btn-outline-primary my-3 py-3" value="Proceed To Checkout"> --}}
                  <a href="{{ route('checkout') }}" class="btn btn-block btn-outline-primary my-3 py-3">Proceed To Checkout</a>
               @else
               <div id='msg_show' class=" my-2 alert alert-success">
                  <input type="button" class='close' value='x' data-dismiss="alert">
                  <h3>Please product Added  to cart</h3>
               </div>
               @endif
            </div>
            <div class="col-lg-4">
               <form class="mb-5" action="">
                  <div class="input-group">
                     <input type="text" class="form-control p-4" placeholder="Coupon Code">
                     <div class="input-group-append">
                        <button class="btn btn-secondary">Apply Coupon</button>
                     </div>
                  </div>
               </form>
               <div class="card border-secondary mb-5">
                  <div class="card-header bg-secondary border-0">
                     <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                  </div>
                  <div class="card-body">
                     <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium">
                        @if(!$data->isEmpty())
                        {{ $total }}</h6>
                        @endif
                     </div>
                     <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">$10 <small style="color:red">Each Product</small></h6>
                     </div>
                  </div>
                  <div class="card-footer border-secondary bg-transparent">
                     <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold">
                        @if(!$data->isEmpty())
                        $ {{ $total }}</h5>
                        @endif
                     </div>
                     {{-- <button class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button> --}}
                     {{-- <a href="{{ route('test-add-cart') }}" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a> --}}
                  </div>
               </div>
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