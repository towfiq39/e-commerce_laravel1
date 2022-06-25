
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Category</title>
		<!-- Required meta tags -->
		@include('admin.css')
		<style>
			
		</style>
	</head>.category_heading{
				font-size:30px;
			}
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
							<h1 class='category_heading text-center'>Add Category</h1>
						</div>
						
						<div class="col-lg-8 my-3">
							<form action="{{ route('add-category') }}" method='POST'>
								@csrf
								<div class="form-group">
									<label for="name">Product Category</label>
									<input type="text" class='form-control' name='category_name' placeholder="product Category">
								</div>
								<input type="Submit" class='btn btn-outline-light' value='Add Category'>
							</form>
							@if(session()->get('add_cat'))
								<div id='msg_show' class=" my-2 alert alert-success">
								  <input type="button" class='close' value='x' data-dismiss="alert">
								  {{ session()->get('add_cat') }}
								</div>
							@endif
							@if(session()->get('del_cat'))
								<div id='msg_show' class=" my-2 alert alert-danger">
								  <input type="button" class='close' value='x' data-dismiss="alert">
								  {{ session()->get('del_cat') }}
								</div>
							@endif
						</div>
						<div class="col-lg-12">
							<h1 class='category_heading text-center '>All Category</h1>
						</div>
						
						<div class="col-lg-8 my-3">
							<table class='table '>
								<thead>
									<tr>
										<th>Id</th>
									    <th>Name</th>
									    <th>Action</th>
									</tr>
									
								</thead>
								<tbody>
									@foreach($category as $list)
										<tr>
											<td>{{ $list->cid }}</td>
											<td>{{ $list->category }}</td>
											<td><a onclick="return confirm('Are Your Sure To Delete This Data')" href="{{ url('delete-category',$list->cid) }}" class='btn btn-outline-danger btn-sm'>Delete</a></td>
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