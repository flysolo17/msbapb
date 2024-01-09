<?php
include 'connection.php';
?>

<?php
//insert report
if(isset($_POST['btnSave'])){
	$person = $_POST['person'];
	$full_name = $_POST['full_name'];
	$contact_no = $_POST['contact_no'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$certificate_type = $_POST['certificate_type'];
	$status = $_POST['status'];
    $received_by = $_POST['received_by'];
    $payment_status = $_POST['payment_status'];

	$insert_data = mysqli_query($conn, "INSERT INTO certificate_tbl (person,full_name,contact_no,address,email,certificate_type,status,received_by,payment_status) 
	VALUES ('$person','$full_name','$contact_no','$address','$email','$certificate_type','$status','$received_by','$payment_status')");

	if($insert_data){
		header('location:Certificate Status.php?message=successadd');
	}else{
		echo "Failed to Save User Details" .mysqli_connect_errno();
	}
}
?>

<?php
// update report
if(isset($_POST['btnUpdate'])){
	$person = $_POST['person'];
	$full_name = $_POST['full_name'];
	$contact_no = $_POST['contact_no'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$certificate_type = $_POST['certificate_type'];
	$status = $_POST['status'];
    $received_by = $_POST['received_by'];
    $payment_status = $_POST['payment_status'];

	mysqli_query($conn, "UPDATE certificate_tbl SET name= person='$person', full_name='$full_name', contact_no='$contact_no', address='$address', email='$email', certificate_type='$certificate_type', status='$status', received_by='$received_by', payment_status='$payment_status' WHERE user_id=$id");
	header('location: Certificate Status.php?message=successupdate');	
}
?>


<?php
//delete report
if(isset($_GET['delete'])){
	$id = $_GET['delete'];
	mysqli_query($conn, "DELETE FROM certificate_tbl WHERE user_id=$id");
	header('location: Certificate Status.php?message=successdelete');
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
		<a href="#addNewReportModal" class="btn btn-success btn-lg" data-toggle="modal"><span>Add New Applicant</span></a>
		<a href="" class="btn btn-primary btn-lg"><span>Print</span></a>
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
						<h2>Certificate <b>Status</b></h2>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th> ID</th>
						<th> Person</th>
						<th> Full Name</th>
						<th> Contact No</th>
						<th> Address</th>
						<th> Email</th>
						<th> Certificate Type</th>
						<th> Status</th>
                        <th> Recieved by</th>
                        <th> Payment Status</th>
						<th> Actions</th>
					</tr>
				</thead>
				<?php
					$select_data = mysqli_query($conn, "SELECT * FROM certificate_tbl");
					while($user= mysqli_fetch_array($select_data)){
				?>
				<tbody>
					<tr>
						<td class="id"><?php echo $user['user_id']?></td>
						<td class="person"><?php echo $user['person']?></td>
						<td class="full_name"><?php echo $user['full_name']?></td>
						<td class="contact_no"><?php echo $user['contact_no']?></td>
						<td class="address"><?php echo $user['address']?></td>
						<td class="email"><?php echo $user['email']?></td>
						<td class="certificate_type"><?php echo $user['certificate_type']?></td>
						<td class="status"><?php echo $user['status']?></td>
                        <td class="recieved_by"><?php echo $user['recieved_by']?></td>
                        <td class="payment_status"><?php echo $user['payment_status']?></td>
						<td>
							<a href="#"class="edit" id="btnEditmodal"name="btnEditmodal" data-toggle="modal"
							><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="Certificate Status.php?delete=<?php echo $user ['user_id']?>"class="delete" onclick="return confirm ('Are you sure you want to delete this user?')" name="btnDelete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i
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
						<h4 class="modal-title">Add New Applicant</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close</
						button>
						</div>
					<div class="modal-body">
					<div class="form-group">
							<label>Person</label>
							<textarea name="person" class="form-control" required></textarea>
						</div>
					<div class="form-group">
							<label>Full Name</label>
							<textarea name="full_name" class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Contact No</label>
							<textarea name="contact_no" class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Address</label>
							<input type="text" name="address" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<textarea name="email" class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Certificate Type</label>
							<input type="text" name="certificate_type" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Status</label>
							<input type="text" name="status" class="form-control" required>
							</div>
						</div>
                        <div class="form-group">
							<label>Recieved By</label>
							<input type="text" name="recieved_by" class="form-control" required>
							</div>
                        <div class="form-group">
							<label>Payment Status</label>
							<input type="text" name="payment_status" class="form-control" required>
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
		</div>
	<!-- edit Report modal-->
	<div id="editReportModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="#">
					<div class="modal-header">
						<h4 class="modal-title">Edit Applicant</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close</button>
						</div>
					<div class="modal-body">
					<div class="form-group">
							<label>Person</label>
							<input type="text" id="person" name="person" class="form-control" required>
						</div>
					<div class="form-group">
							<label>Full Name</label>
							<input type="text" id="full_name" name="full_name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Contact No</label>
							<input type="hidden" id="id" name="id" class="form-control" required>
							<input type="text" id="contact_no" name="contact_no" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Address</label>
							<input type="text" id="address" name="address" class="form-control" required>
						</div>
						<div class="form-group">
							<label>email</label>
							<textarea name="email" id="email"  class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Certificate Type</label>
							<input type="text" id="certificate_type" name="certificate_type"  class="form-control" required>
						</div>
						<div class="form-group">
							<label>Status</label>
							<input type="text" id="status" name="status" class="form-control" required>
							</div>
						</div>
                        <div class="form-group">
							<label>Recieved by</label>
							<input type="text" id="recieved_by" name="recieved_by" class="form-control" required>
							</div>
						</div>
                        <div class="form-group">
							<label>Payment Status</label>
							<input type="text" id="payment_status" name="payment_status" class="form-control" required>
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
				var full_name = $row.find('.full_name').text();
			    var contact_no = $row.find('.contact_no').text();
			    var address = $row.find('.address').text();
			    var email = $row.find('.email').text();
			    var certificate_type = $row.find('.certificate_type').text();
			    var status = $row.find('.status').text();
                var received_by = $row.find('.received_by').text();
                var payment_status = $row.find('.payment_status').text();

			    $('#id').val(id);
				$('#person').val(person);
				$('#full_name').val(full_name);
			    $('#contact_no').val(contact_no);
			    $('#address').val(address);
			    $('#email').val(email);
			    $('#certificate_type').val(certificate_type);
			    $('#status').val(status);
                $('#recieved_by').val(recieved_by);
                $('#payment_status').val(payment_status);

			    $('#editReportModal').modal('show');
		    });
	</script>
</body>
</html>
