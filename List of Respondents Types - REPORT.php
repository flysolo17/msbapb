<!DOCTYPE html>
<html>
<head>
	<title>Respondent Types</title>
</head>
<meta charset= "UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Respondent Types Master List</title>
	<link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" 
	rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
	 integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	 <style style="text/css" media="print">
	 	@media print{
	 		.noprint, .noprint *{
	 			display: none; !important;
	 		}
	 	}
	 </style>
	</head>
<body onload="print()">
	<div class="container">
		<h3 style="margin-top: 30px;">Respondent Types Master List</h3>
		<hr>
	</center>
	<table id="ready" class="table table-striped table-bordered" style="width: 100%;">
		<thead>
			<tr>
			<th> ID</th>
			<th> Person</th>
			<th> Name</th>
			<th> Date Created</th>
			<th> Status</th>
			</tr>
		</thead>
		<tbody>
			<?php
				include 'connection.php';
				$get_master_list = mysqli_query($conn, "SELECT * from  list_of_respondent_types");

				while($row = mysqli_fetch_array($get_master_list)){
			?>

			<tr>
				<td><?php echo $row['user_id']?></td>
				<td><?php echo $row['person']?></td>
				<td><?php echo $row['name']?></td>
				<td><?php echo $row['date_created']?></td>
				<td><?php echo $row['status']?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	</div>
	<div class="container">
		<button type="" class="btn btn-info noprint" style="width: 100%" onclick="window.location.replace('List of Repondents Types.php?>');">CANCEL PRINTING</button>
	</div>
</body>
</html>