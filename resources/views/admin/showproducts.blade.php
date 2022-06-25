<!DOCTYPE html>
<html lang="en">
	<head>
		<title>show products</title>
		<!-- Required meta tags -->
		@include('admin.css')
		<style>
			.show_product_heading{
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
							<h1 class='show_product_heading text-center'>All Products</h1>
							@if(session()->get('del_product'))
							<div id='msg_show' class=" my-2 alert alert-danger">
								<input type="button" class='close' value='x' data-dismiss="alert">
								{{ session()->get('del_product') }}
							</div>
							@endif
							@if(session()->get('up_product'))
							<div id='msg_show' class=" my-2 alert alert-success">
								<input type="button" class='close' value='x' data-dismiss="alert">
								{{ session()->get('up_product') }}
							</div>
							@endif
						</div>
						<div class="col-lg-10">
							<table class='table '>
								<thead>
									<tr>
										<th>Id</th>
									    <th>Title</th>
									    <th>Category</th>
									    <th>Quantity</th>
									    <th>Price</th>
									    <th>Discount Price</th>
									    <th>Image</th>
									    <th>Action</th>
									</tr>
									
								</thead>
								<tbody>
									@foreach($data as $products)
										<tr>
											<td>{{ $products->id }}</td>
											<td>{{ $products->title }}</td>
											<td>{{ $products->category }}</td>
											<td>{{ $products->quantity }}</td>
											<td>{{ $products->price }}</td>
											<td>{{ $products->discount_price }}</td>
											<td><img src="/product/{{ $products->image }}" class='img-thumbnail' alt=""></td>
											<td>
												<a href="{{ url('edit-product',$products->id) }}" class='btn btn-outline-primary btn-sm'>Edit</a>

												<a onclick="return confirm('Are Your Sure To Delete This Data')" href="{{ url('delete-product',$products->id) }}" class='btn btn-outline-danger btn-sm'>Delete</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							
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