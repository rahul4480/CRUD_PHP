<!DOCTYPE html>
<html>
<head>
	<title>PHP CRUD</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="" ></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<body>

	<?php require_once 'process.php'; ?>
	
	<?php if(isset($_SESSION['message'])): ?>

	<div class="alert alert-<?=$_SESSION['msg_type']?>">

	<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	?>	
	</div>

	<?php endif ?>

	<?php
		$conn = mysqli_connect("localhost","root","","crud");
		$sql = "SELECT * FROM data";
		$result = $conn->query("SELECT * FROM data");
		?>

		<div class="row justify-content-center">
			<div class="container">
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Location</th>
							<th colspan="2">Action</th>
						</tr>
					</thead>

					<?php while($row = $result->fetch_assoc()): ?>
					<tr>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['location']; ?></td>
						<td>
							<a href="index.php?edit=<?php echo $row['id']; ?>" id="edittag" class="btn btn-info">Edit</a>

							<a href="process.php?delete=<?php echo $row['id']; ?>" class = "btn btn-danger" >Delete</a>
						</td>
					</tr>
				<?php endwhile; ?>

				</table>
			</div>
		</div>

		<?php
		function pre_r($array)
		{
			echo '<pre>';
			print_r($array);
			echo '</pre>';
		}

		?>


	<div class="row justify-content-center">
		<form action="process.php" method="POST"> 
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" name="name" value="<?php echo $name; ?>" placeholder="Enter your name">
			</div>
			<div class="form-group">
				<label>Location</label>
				<input type="text" class="form-control" name="location" value="<?php echo $location; ?>" placeholder="Enter your location">
			</div>
			<div class="form-group">

				<?php
				
				if(empty($_GET["edit"]))

				// if($id === null)
				{
					?>
<button class="btn btn-primary" type="submit" id="butn"  name="save">Save</button>
			<?php
				}
				else
{
				?>
			<button class="btn btn-info" type="submit" id="butn"  name="update">Update</button><?php }?>
						
				
			</script>



			</div>
		</form>

	</div>



	

</body>
</html>