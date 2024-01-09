<?php
include 'connection.php';
include 'Sidebar and Navbar.html';
?>

<?php
//insert report
if(isset($_POST['btnSave'])){
	$person = $_POST['person'];
	$name = $_POST['name'];
	$report_date_time = $_POST['report_date_time'];
	$incident = $_POST['incident'];
	$location = $_POST['location'];
	$dispatched_teams = $_POST['dispatched_teams'];
	$status = $_POST['status'];

	$insert_data = mysqli_query($conn, "INSERT INTO incidents_report (person,name,report_date_time,incident,location,dispatched_teams,status) 
	VALUES ('$person','$name','$report_date_time','$incident','$location','$dispatched_teams','$status')");

	if($insert_data){
		header('Location:incident report.php?message=successadd');
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
	$report_date_time = $_POST['report_date_time'];
	$incident = $_POST['incident'];
	$location = $_POST['location'];
	$dispatched_teams = $_POST['dispatched_teams'];
	$status = $_POST['status'];

	mysqli_query($conn, "UPDATE incidents_report SET name= person='$person', name='$name', report_date_time='$report_date_time', incident='$incident', location='$location', dispatched_teams='$dispatched_teams', status='$status' WHERE user_id=$id");
	header('location: incident report.php?message=successupdate');	
}
?>


<?php
//delete report
if(isset($_GET['delete'])){
	$id = $_GET['delete'];
	mysqli_query($conn, "DELETE FROM incidents_report WHERE user_id=$id");
	header('location: incident report.php?message=successdelete');
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
		<a href="#addNewReportModal" class="btn btn-success btn-lg" data-toggle="modal"><span>Add New Report</span></a>
		<a href="Incident-REPORT.php" class="btn btn-primary btn-lg"><span>Print</span></a>
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
						<h2>Incident <b>Report</b></h2>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th> ID</th>
						<th> Person</th>
						<th> Name</th>
						<th> Report Date Time</th>
						<th> Incident</th>
						<th> Location</th>
						<th> Dispatched Teams</th>
						<th> Status</th>
						<th> Actions</th>
					</tr>
				</thead>
				<?php
					$select_data = mysqli_query($conn, "SELECT * FROM incidents_report");
					while($user= mysqli_fetch_array($select_data)){
				?>
				<tbody>
					<tr>
						<td class="id"><?php echo $user['user_id']?></td>
						<td class="person"><?php echo $user['person']?></td>
						<td class="name"><?php echo $user['name']?></td>
						<td class="report_date_time"><?php echo $user['report_date_time']?></td>
						<td class="incident"><?php echo $user['incident']?></td>
						<td class="location"><?php echo $user['location']?></td>
						<td class="dispatched_teams"><?php echo $user['dispatched_teams']?></td>
						<td class="status"><?php echo $user['status']?></td>
						<td>
							<a href="#"class="edit" id="btnEditmodal"name="btnEditmodal" data-toggle="modal"
							><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="incident report.php?delete=<?php echo $user ['user_id']?>"class="delete" onclick="return confirm ('Are you sure you want to delete this user?')" name="btnDelete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i
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
						<h4 class="modal-title">Add New Report</h4>
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
							<label>Report Date Time</label>
							<textarea name="report_date_time" class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Incident</label>
							<input type="text" name="incident" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Location</label>
							<textarea name="location" class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Dispatched Teams</label>
							<input type="text" name="dispatched_Teams" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Status</label>
							<input type="text" name="status" class="form-control" required>
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
						<h4 class="modal-title">Edit Report</h4>
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
							<label>Report Date Time</label>
							<input type="hidden" id="id" name="id" class="form-control" required>
							<input type="text" id="report_date_time" name="report_date_time" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Incident</label>
							<input type="text" id="incident" name="incident" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Location</label>
							<textarea name="location" id="location"  class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Dispatched Teams</label>
							<input type="text" id="dispatched_teams" name="dispatched_teams"  class="form-control" required>
						</div>
						<div class="form-group">
							<label>Status</label>
							<input type="text" id="status" name="status" class="form-control" required>
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
			    var report_date_time = $row.find('.report_date_time').text();
			    var incident = $row.find('.incident').text();
			    var location = $row.find('.location').text();
			    var dispatched_Teams = $row.find('.dispatched_teams').text();
			    var status = $row.find('.status').text();

			    $('#id').val(id);
				$('#person').val(person);
				$('#name').val(name);
			    $('#report_date_time').val(report_date_time);
			    $('#incident').val(incident);
			    $('#location').val(location);
			    $('#dispatched_teams').val(dispatched_teams);
			    $('#status').val(status);

			    $('#editReportModal').modal('show');
		    });
	</script>
</body>
</html>