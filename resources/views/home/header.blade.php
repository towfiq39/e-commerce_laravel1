<header class="header_section">
   <div class="container">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
         <a class="navbar-brand" href="{{ route('index') }}"><img width="250" src="images/logo.png" alt="#" /></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class=""> </span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
               <li class="nav-item active">
                  <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
               </li>

               <div class="dropdown show">
                 <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   Category
                 </a>

                 <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  @foreach($category as $data)

                   <a class="dropdown-item" href="{{ url('category_product',$data->cid) }}">{{ $data->category }}</a>
                  @endforeach
                 </div>
               </div>
               <form class="form-inline " action='{{ route('search_product') }}' method='POST'>
                  @csrf
                     <input class="form-control" name='search_product' type="search" placeholder="Search Product by Name" aria-label="Search">
                     <button class="btn btn-outline-danger mx-2 mb-3 btn-sm" type="submit">Search</button>
               </form>
               
                  

               @if (Route::has('login'))
               @auth
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('show-cart') }}">
                     <i class="fas fa-shopping-cart text-primary"></i> [{{ $count }}]
                  </a>
               </li>
               <li class="nav-item">
                  <x-app-layout>
                  
                  </x-app-layout>
               </li>
               
               @else
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">Login</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">Regestration</a>
               </li>
               @endauth
               @endif
               
               {{-- <form class="form-inline">
                  <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                  </button>
               </form> --}}
            </ul>
         </div>
      </nav>
   </div>
</header>