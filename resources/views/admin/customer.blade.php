<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Customer-Page</title>
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
					<table class='table '>
						<thead>
							<tr>
								<th>Id</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>address</th>
								<th>Action</th>
								
								
							</tr>
							
						</thead>
						<tbody>
							
							
							@foreach($customer as $list)
							<tr>
								<td>{{$list->id}}</td>
								<td>{{$list->name}}</td>
								<td>{{$list->email}}</td>
								<td>{{$list->phone}}</td>
								<td>{{$list->address}}</td>
								
								<td>
									
									
									<a href="{{route('delete_user',$list->id)}}" onclick="return confirm('Are your sure to delete this Customer')" class='btn -sm btn btn-danger p-1' title='Product Handed Successfully'>Delete</a>
									
								</td>
							</tr>
							
							@endforeach
						</tbody>
					</table>
				</section>
			</div>
			<!-- plugins:js -->
			@include('admin.script')
			<!-- End custom js for this page -->
		</body>
	</html>