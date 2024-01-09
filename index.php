<?php
include 'connection.php';
include 'Sidebar and Navbar.html';
?>

<?php
//insert report
if(isset($_POST['btnSave'])){
	$person = $_POST['person'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$contact_no = $_POST['contact_no'];
	$position = $_POST['position'];
	

	$insert_data = mysqli_query($conn, "INSERT INTO manage_user (person,name,email,address,contact_no,position) 
	VALUES ('$person','$name','$email','$address','$contact_no','$position')");

	if($insert_data){
		header('Location:index.php?message=successadd');
	}else{
		echo "Failed to Save User Details" .mysqli_connect_errno();
	}
}
?>

<?php
// update report
if(isset($_POST['btnUpdate'])){
	$id = $_POST['id'];
	$name = $_POST['person'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$contact_no = $_POST['contact_no'];
	$position = $_POST['position'];

	mysqli_query($conn, "UPDATE manage_user SET name= person='$person', name='$name', email='$email', address='$address', contact_no='$contact_no', position='$position' WHERE user_id=$id");
	header('location: index.php?message=successupdate');	
}
?>


<?php
//delete report
if(isset($_GET['delete'])){
	$id = $_GET['delete'];
	mysqli_query($conn, "DELETE FROM manage_user WHERE user_id=$id");
	header('location: index.php?message=successdelete');
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset= "UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Users</title>
	<link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" 
	rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
	 integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<style type="text/css">
	
		body{
		color:#566787;
		background: #fff;
		font-family: 'Varela Round', sans-serif;
		font-size: 13px;
	}
	.table-wrapper{
		background: #fff;
		padding: 10px 15px;
		margin: 30px;
		border-radius: 3px;
		box-shadow: 0 1px 1px rgba(0,0,0,.05);
	}.table-title{
		padding-bottom: 15px;
		background: (linear-gradient(to right), #808080, #56A5EC);
		color: #000000;
		padding: 16px 30px;
		margin: -20px -25px 10px;
		border-radius: 3px 3px 0 0;
	}
	.table-title h2{
		margin: 5px 0 0;
		font-size: 24px;
	}
	.delete{
		color: red;
	}
	</style>
  </head>
<body>
	<div class="container" style="margin-top: 15px">
		<a href="#addNewReportModal" class="btn btn-success btn-lg" data-toggle="modal"><span>Manage User</span></a>
		<a href="Report.php" class="btn btn-primary btn-lg"><span>Print</span></a>
	</div>
	<div class="container">
		<!-- GET MESSAGE IF SUCCESS NA!-->
		<?php if(isset($_GET['message'])): ?>
			<div class="alert alert-success text-center" role="alert" id="alert">
				<?php 
				if($_GET['message'] == "successadd"){
					echo "Successfully Added Report";
				}elseif($_GET['message'] == "successupdate"){
					echo "Successfully Updated Report";	
				}elseif ($_GET['message'] == "successdelete") {
					echo "Successfully Deleted Report";
				}
				?>
			</div>
		<?php endif ?>	
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
					<div class="form-group">
						<input type="text" id="myInput" placeholder="Search..." class="form-control">
					</div>
					<script>
		$(document).ready(function(){
			$("#myInput").on("keyup",function(){
				var value =$(this).val().toLowerCase();
				$("#myTable tr").filter(function(){
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
		});
		</script>
						<h2>Manage <b>Users</b></h2>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
				<tbody id="myTable">
					<tr>
						<th> ID</th>
						<th> Person</th>
						<th> Name</th>
						<th> Email</th>
						<th> Address</th>
						<th> Contact Number</th>
						<th> Position</th>
						<th> Actions</th>
					</tr>
				</thead>
				<?php
					$select_data = mysqli_query($conn, "SELECT * FROM manage_user");
					while($user= mysqli_fetch_array($select_data)){
				?>
				<tbody>
					<tr>
						<td class="id"><?php echo $user['user_id']?></td>
						<td class="person"><?php echo $user['person']?></td>
						<td class="name"><?php echo $user['name']?></td>
						<td class="email"><?php echo $user['email']?></td>
						<td class="address"><?php echo $user['address']?></td>
						<td class="contact_no"><?php echo $user['contact_no']?></td>
						<td class="position"><?php echo $user['position']?></td>
						<td>
							<a href="#"class="edit" id="btnEditmodal"name="btnEditmodal" data-toggle="modal"
							><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="index.php?delete=<?php echo $user ['user_id']?>"class="delete" onclick="return confirm ('Are you sure you want to delete this user?')" name="btnDelete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i
							></a>
						</td>
					</tr>
				</tbody>
				<?php } ?>
			</table>
		</div>
	</div>

	<!-- add new report modal-->
	<div id="addNewReportModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="#">
					<div class="modal-header">
						<h4 class="modal-title">Add New Users</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close</
						button>
						</div>
					<div class="modal-body">
					<div class="form-group">
							<label>Person</label>
							<textarea name="person" class="form-control" required></textarea>
						</div>
					<div class="form-group">
							<label>Name</label>
							<textarea name="name" class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Email</label>
							<textarea name="email" class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Address</label>
							<input type="text" name="address" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Contact Number</label>
							<textarea name="contact_no" class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Position</label>
							<input type="text" name="position" class="form-control" required>
						</div>
					</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-success" name="btnSave">Save</button>
						</div>
					</form> 
				</div>      
			</div>
		</div>
	<!-- edit Report modal-->
	<div id="editReportModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="#">
					<div class="modal-header">
						<h4 class="modal-title">Edit User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close</button>
						</div>
					<div class="modal-body">
					<div class="form-group">
							<label>Person</label>
							<input type="text" id="person" name="person" class="form-control" required>
						</div>
					<div class="form-group">
							<label>Name</label>
							<input type="text" id="name" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="hidden" id="id" name="id" class="form-control" required>
							<input type="text" id="email" name="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Address</label>
							<input type="text" id="address" name="address" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Contact Number</label>
							<textarea name="contact_no" id="contact_no"  class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Position</label>
							<input type="text" id="position" name="position"  class="form-control" required>
					    </div>
					</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-success" name="btnUpdate">Update</button>
						</div>
					<form> 
				</div>      
			</div>
		</div>
		
		<script type="text/javascript">
			setTimeout(function(){
				document.getElementById("alert").style.display = "none";
			},3000);
		</script>

		<script type="text/javascript">
			$('.edit').click(function(){
			    var $row = $(this).closest('tr');
			    var id = $row.find('.id').text();
				var person = $row.find('.person').text();
				var name = $row.find('.name').text();
			    var email = $row.find('.email').text();
			    var address = $row.find('.address').text();
			    var contact_no = $row.find('.contact_no').text();
			    var position = $row.find('.position').text();

			    $('#id').val(id);
				$('#person').val(person);
				$('#name').val(name);
			    $('#email').val(email);
			    $('#address').val(address);
			    $('#contact_no').val(contact_no);
			    $('#position').val(position);

			    $('#editReportModal').modal('show');
		    });
	</script>
</body>
</html>