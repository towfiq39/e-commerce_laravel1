<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Add products</title>
		<!-- Required meta tags -->
		@include('admin.css')
		<style>
			.product_heading{
				font-size:30px;
			}
		</style>
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
							<h1 class='product_heading text-center'>Add Category</h1>
						</div>
						
						<div class="col-lg-8 my-3">
							<form action="{{ route('add-products') }}" method='POST' enctype='multipart/form-data'>
								@csrf
								<div class="form-group">
									<label for="name">Product Title</label>
									<input type="text" class='form-control' name='title' placeholder="product title">
								</div>
								<div class="form-group">
									<label for="name">Product description</label> <br>
									<textarea name="description"  class='form-control' id="" ></textarea>
								</div>
								<div class="form-group">
									<label for="name">Product Quantity</label>
									<input type="number" class='form-control' name='quantity' placeholder="product Quantity">
								</div>
								<div class="form-group">
									<label for="name">Product Price</label>
									<input type="number" class='form-control' name='price' placeholder="product Price">
								</div>
								<div class="form-group">
									<label for="name">Discount Price</label>
									<input type="number" class='form-control' name='dis_price' placeholder=" Discount Price">
								</div>
								<div class="form-group">
									<label for="name">Category</label>
									<select name="category" class='form-control' id="">
										@foreach($category as $data)
											<option value=" {{ $data->cid }}">{{ $data->category }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label for="name">Product Image</label>
									<input type="file" class='form-control' name='image'>
								</div>
								<input type="Submit" class='btn btn-outline-light' value='Add Products'>
							</form>
							@if(session()->get('add_products'))
							<div id='msg_show' class=" my-2 alert alert-success">
								<input type="button" class='close' value='x' data-dismiss="alert">
								{{ session()->get('add_products') }}
							</div>
							@endif
							
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