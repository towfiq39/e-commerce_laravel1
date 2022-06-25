<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin-Home</title>
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
				<section class="container-fluid">
					<div class="row justify-content-center">
						<div class="col-lg-8">
							<h2>Delivered product</h2>
								<table class='table '>
									<thead>
										<tr>
											<th>Id</th>
											<th>user Id</th>
											<th>Product Name</th>
											<th>Quantity</th>
											<th>Price</th>
											<th>Phone</th>
											<th>Address</th>
											<th>Status</th>
											<th>Action</th>
											
										</tr>
										
									</thead>
									<tbody>
										
										
										@foreach($product as $list)
										<tr>
											<td>{{$list->id}}</td>
											<td>{{$list->name}}</td>
											<td>{{$list->product_name}}</td>
											<td>{{$list->product_quantity}}</td>
											<td>{{$list->product_price}}</td>
											<td>{{$list->phone}}</td>
											<td>{{$list->address}}</td>
											<td>{{$list->status}}</td>
											<td>
												
												
												<a href="{{ route('delete_order',$list->id) }}" onclick="return confirm('Are your sure to delete this data')" class='btn -sm btn btn-danger p-1' title='Product Handed Successfully'>Delete</a>
											</td>
										</tr>
										
										@endforeach
									</tbody>
								</table>
						</div>
					</div>
				</section>
			</div>
			<!-- plugins:js -->
			@include('admin.script')
			<!-- End custom js for this page -->
		</body>
	</html>