@extends('base.estructhtml')
@section('Title', 'Student Crud')

@section('Header')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="http://191.252.214.61:8040">Student</a>
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
						<h2>Manage <b>Admin</b></h2>
					</div>
					<div class="col-sm-6">
						<input type="text" id="searchStudent" placeholder="Search for Students">
						<a href="#addStudentModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Student</span></a>
						<a id="deleteSelectedStudents" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
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
						<th>Age</th>
						<th>CtrlCash</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody id="student-table-body">
					
				</tbody>
			</table>
		</div>
	</div>        
	<!-- Edit Modal HTML -->
	<div id="addStudentModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
					<div class="modal-header">						
						<h4 class="modal-title">Add Student</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
				<form id="studentRegisterForm">
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
							<label>Age</label>
							<input type="date" id="age" class="form-control" required>
						</div>
						<div class="form-group">
							<label>CtrlCash</label>
							<input type="number" id="ctrlCash" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" id="password" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" id="submitButtonStudentRegister" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editStudentModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="studentUpdateForm">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Student</h4>
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
							<label>Age</label>
							<input type="date" id="edit-age" class="form-control" required>
						</div>
						<div class="form-group">
							<label>CtrlCash</label>
							<input type="number" id="edit-ctrlCash" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" id="edit-password" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" id="submitButtonStudentUpdate" class="btn btn-info" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
	
@push('Script')
	<script src="/js/Student.js"></script>
@endpush



