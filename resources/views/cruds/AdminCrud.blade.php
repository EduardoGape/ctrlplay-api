@extends('base.estructhtml')
@section('Title', 'Admin Crud')

@section('Header')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="http://191.252.214.61:8040/admin">Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
@endsection


@section('Main')

<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Manage <b>Admins</b></h2>
					</div>
					<div class="col-sm-6">
						<input type="text" id="searchAdmin" placeholder="Search for admins">
						<a href="#addAdminModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Admin</span></a>
						<a id="deleteSelectedAdmins" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>Name</th>
						<th>Email</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody id="admin-table-body">
					
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
				<ul class="pagination">
					<li class="page-item disabled"><a href="#">Previous</a></li>
					<li class="page-item"><a href="#" class="page-link">1</a></li>
					<li class="page-item"><a href="#" class="page-link">Next</a></li>
				</ul>
			</div>
		</div>
	</div>        
	<!-- Edit Modal HTML -->
	<div id="addAdminModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
					<div class="modal-header">						
						<h4 class="modal-title">Add Admin</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
				<form id="adminRegisterForm">
					<div class="modal-body">					
						<div class="form-group">
							<label>Name</label>
							<input type="text" id="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" id="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" id="password" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" id="submitButtonAdminRegister" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editAdminModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="adminUpdateForm">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Admin</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Name</label>
							<input type="text" id="edit-name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" id="edit-email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" id="edit-password" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" id="submitButtonAdminUpdate" class="btn btn-info" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@push('Script')
	<script src="/js/Admin.js"></script>
@endpush





