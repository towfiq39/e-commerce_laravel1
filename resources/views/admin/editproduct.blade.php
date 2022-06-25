<!DOCTYPE html>
<html lang="en">
	<head>
		<base href="/public">
		<title>Admin-Edit product</title>
		<!-- Required meta tags -->
		@include('admin.css')
	</head>
	<body>
		<div class="container-scroller">
			<!-- partial:partials/_sidebar.html -->
			@include('admin.sidebar')
			<!-- partial -->
			@include('admin.header')
			<!-- partial -->
			<div class="main-panel">
				<div class="content-wrapper">
					<div class='row justify-content-center'>
						<div class="col-lg-12">
							<h1 class='product_heading text-center'>Edit Product</h1>
							@if(session()->get('up_products'))
							<div id='msg_show' class=" my-2 alert alert-success">
								<input type="button" class='close' value='x' data-dismiss="alert">
								{{ session()->get('up_products') }}
							</div>
							@endif
						</div>
						
						<div class="col-lg-8 my-3">
							<form action="{{ route('update-product',$data->id) }}" method='POST' enctype='multipart/form-data'>
								@csrf
								<div class="form-group">
									<label for="name">Product Title</label>
									<input type="text" class='form-control text-dark' name='title' placeholder="product title" value="{{$data->title}}">
								</div>
								<div class="form-group">
									<label for="name">Product description</label> <br>
									<textarea name="description"  class='form-control' id="" >{{$data->description}}</textarea>
								</div>
								<div class="form-group">
									<label for="name">Product Quantity</label>
									<input type="number" class='form-control text-dark' name='quantity' placeholder="product Quantity" value="{{$data->quantity}}">
								</div>
								<div class="form-group">
									<label for="name">Product Price</label>
									<input type="number" class='form-control text-dark' name='price' placeholder="product Price" value="{{$data->price}}">
								</div>
								<div class="form-group">
									<label for="name">Discount Price</label>
									<input type="number" class='form-control text-dark' name='dis_price' placeholder=" Discount Price" value="{{$data->discount_price}}">
								</div>
								<div class="form-group">
									<label for="name">Category</label>
									<select name="category" class='form-control' id="">
										<option value=" {{ $data->category_id }}" selected>{{ $data->category }}</option>
										@foreach($category as $list)
										<option value=" {{ $list->cid }}">{{ $list->category }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label for="name">Product Image</label>
									<input type="file" class='form-control' name='image'>
								</div>
								<label for="">Current image</label>
								<img src="product/{{ $data->image }}" class='img-thumbnail' alt="">
								<input type="Submit" class='btn btn-outline-light my-2' value='Update Products'>
							</form>
							
							
						</div>
						
					</div>
				</div>
			</div>
			<!-- container-scroller -->
			<!-- plugins:js -->
			@include('admin.script')
			<!-- End custom js for this page -->
		</body>
	</html>