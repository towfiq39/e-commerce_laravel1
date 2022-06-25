<section class="product_section layout_padding">
   <div class="container">
      <div class="heading_container heading_center">
         
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
      {{-- {{ !!$data->appends(Request::all())->links("pagination::bootstrap-5")!! }} --}}
      
         @if(method_exists($data,'links'))
          <div class="">
           {!! $data->appends(Request::all())->links("pagination::bootstrap-5") !!} 
           @endif
      </div>
      
      
      
   </div>
</section>