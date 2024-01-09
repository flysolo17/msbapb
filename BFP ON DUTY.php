<?php
include 'connection.php';
include 'Sidebar and Navbar.html';
?>

<?php
//insert duty
if(isset($_POST['btnSave'])){
	$full_name = $_POST['full_name'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$contact_no = $_POST['contact_no'];
	$position = $_POST['position'];
	$date_and_time = $_POST['date_and_time'];
	

	$insert_data = mysqli_query($conn, "INSERT INTO bfp_duty (full_name,email,address,contact_no,position,date_and_time) 
	VALUES ('$full_name','$email','$address','$contact_no','$position','$date_and_time')");

	if($insert_data){
		header('Location:BFP ON DUTY.php?message=successadd');
	}else{
		echo "Failed to Save User Details" .mysqli_connect_errno();
	}
}
?>

<?php
// update duty
if(isset($_POST['btnUpdate'])){
	$id = $_POST['id'];
	$full_name = $_POST['full_name'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$contact_no = $_POST['contact_no'];
	$position = $_POST['position'];
    $date_and_time = $_POST['date_and_time'];

	mysqli_query($conn, "UPDATE bfp_duty SET name= full_name='$full_name', email='$email', address='$address', contact_no='$contact_no', position='$position', date_and_time='$date_and_time' WHERE user_id=$id");
	header('location: BFP ON DUTY.php?message=successupdate');	
}
?>


<?php
//delete duty
if(isset($_GET['delete'])){
	$id = $_GET['delete'];
	mysqli_query($conn, "DELETE FROM bfp_duty WHERE user_id=$id");
	header('location: BFP ON DUTY.php?message=successdelete');
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
		<a href="#addNewDutyModal" class="btn btn-success btn-lg" data-toggle="modal"><span>Add Personnels ON- Duty</span></a>
		
	</div>
	<div class="container">
		<!-- GET MESSAGE IF SUCCESS NA!-->
		<?php if(isset($_GET['message'])): ?>
			<div class="alert alert-success text-center" role="alert" id="alert">
				<?php 
				if($_GET['message'] == "successadd"){
					echo "Successfully Added User";
				}elseif($_GET['message'] == "successupdate"){
					echo "Successfully Updated User";	
				}elseif ($_GET['message'] == "successdelete") {
					echo "Successfully Deleted User";
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
						<h2>Personnel On <b>Duty</b></h2>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th> ID</th>
						<th> Full Name</th>
						<th> Email</th>
						<th> Address</th>
						<th> Contact Number</th>
						<th> Position</th>
                        <th> Date and Time</th>
						<th> Actions</th>
					</tr>
				</thead>
				<?php
					$select_data = mysqli_query($conn, "SELECT * FROM bfp_duty");
					while($user= mysqli_fetch_array($select_data)){
				?>
				<tbody>
					<tr>
                    <tbody id="myTable">
						<td class="id"><?php echo $user['user_id']?></td>
						<td class="full_name"><?php echo $user['full_name']?></td>
						<td class="email"><?php echo $user['email']?></td>
						<td class="address"><?php echo $user['address']?></td>
						<td class="contact_no"><?php echo $user['contact_no']?></td>
						<td class="position"><?php echo $user['position']?></td>
                        <td class="date_and_time"><?php echo $user['date_and_time']?></td>
						<td>
                         </div>
                         <a href="#"class="edit" id="btnEditmodal"name="btnEditmodal" data-toggle="modal"
							><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="BFP ON DUTY.php?delete=<?php echo $user ['user_id']?>"class="delete" onclick="return confirm ('Are you sure you want to delete this user?')" name="btnDelete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i
							></a>
						</td>
					</tr>
				</tbody>
				<?php } ?>
			</table>
		</div>
	</div>

	<!-- add new duty modal-->
	<div id="addNewDutyModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="#">
					<div class="modal-header">
						<h4 class="modal-title">Add New Duty</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close</
						button>
						</div>
					<div class="modal-body">
					<div class="form-group">
							<label>Full Name</label>
							<textarea name="full_name" class="form-control" required></textarea>
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
                        <div class="form-group">
							<label>Date and Time</label>
							<input type="text" name="date_and_time" class="form-control" required>
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
	<!-- edit Duty modal-->
	<div id="editDutyModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="#">
					<div class="modal-header">
						<h4 class="modal-title">Edit Duties</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close</button>
						</div>
					<div class="modal-body">
					<div class="form-group">
							<label>Full Name</label>
                            <input type="hidden" id="id" name="id" class="form-control" required>
							<input type="text" id="full_name" name="full_name" class="form-control" required>
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
                        <div class="form-group">
							<label>Date and Time</label>
							<input type="text" id="position" name="date_and_time"  class="form-control" required>
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
				var full_name = $row.find('.full_name').text();
			    var email = $row.find('.email').text();
			    var address = $row.find('.address').text();
			    var contact_no = $row.find('.contact_no').text();
			    var position = $row.find('.position').text();
                var date_and_time = $row.find('.date_and_time').text();

			    $('#id').val(id);
				$('#full_name').val(full_name);
			    $('#email').val(email);
			    $('#address').val(address);
			    $('#contact_no').val(contact_no);
			    $('#position').val(position);
                $('#date_and_time').val(date_and_time);

			    $('#editDutyModal').modal('show'); 
		    });
	</script>
</body>
</html>